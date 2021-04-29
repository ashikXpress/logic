<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\BankAccount;
use App\Model\Cash;
use App\Model\Client;
use App\Model\MobileBanking;
use App\Model\Product;
use App\Model\PurchaseInventory;
use App\Model\PurchaseInventoryLog;
use App\Model\SalePayment;
use App\Model\SalesOrder;
use App\Model\SisterConcern;
use App\Model\TransactionLog;
use App\Model\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SakibRahaman\DecimalToWords\DecimalToWords;

class SaleController extends Controller
{
    public function salesOrder() {
        $warehouses = Warehouse::where('status', 1)->orderBy('name')->get();
        $banks = Bank::where('status', 1)->orderBy('name')->get();
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('sale.sales_order.create', compact('warehouses', 'banks',
            'sisterConcerns'));
    }

    public function salesOrderPost(Request $request) {
        //dd($request->all());
        $total = $request->total;
        $due = $request->due_total;

        $rules = [
            'sister_concern' => 'required',
            'client' => 'required',
            'date' => 'required|date',
            'product.*' => 'required',
            'warehouse.*' => 'required',
            'quantity.*' => 'required|numeric|min:0',
            'unit_price.*' => 'required|numeric|min:0',
        ];

        if ($due > 0)
            $rules['next_payment'] = 'required|date';

        if ($request->payment_type == '2' && $request->paid > 0) {
            $rules['bank'] = 'required';
            $rules['branch'] = 'required';
            $rules['account'] = 'required';
            $rules['cheque_no'] = 'nullable|string|max:255';
            $rules['cheque_image'] = 'nullable|image';
        }

        $request->validate($rules);

        $available = true;
        $message = '';
        $counter = 0;

        if ($request->product) {
            foreach ($request->product as $productId) {
                $product = Product::find($request->product[$counter]);
                $inventory = PurchaseInventory::where('sister_concern_id', $request->sister_concern)
                    ->where('product_id', $request->product[$counter])
                    ->where('warehouse_id', $request->warehouse[$counter])
                    ->first();

                if ($inventory) {
                    if ($request->quantity[$counter] > $inventory->quantity) {
                        $available = false;
                        $message = 'Insufficient ' . $inventory->product->name;
                        break;
                    }
                } else {
                    $available = false;
                    $message = 'Insufficient ' . $product->name;
                    break;
                }
                $counter++;
            }
        }

        if (!$available) {
            return redirect()->back()->withInput()->with('message', $message);
        }

        $order = new SalesOrder();
        $order->order_no = rand(10000000, 99999999);
        $order->sister_concern_id = $request->sister_concern;
        $order->client_id = $request->client;
        $order->date = $request->date;
        $order->sub_total = 0;
        $order->vat_percentage = $request->vat;
        $order->vat = 0;
        $order->discount = $request->discount;
        $order->total = 0;
        $order->paid = $request->paid;
        $order->due = 0;
        $order->created_by = Auth::user()->id;
        $order->save();

        $counter = 0;
        $subTotal = 0;

        if  ($request->product) {
            foreach ($request->product as $productId) {
                $inventory = PurchaseInventory::where('sister_concern_id', $request->sister_concern)
                    ->where('product_id', $request->product[$counter])
                    ->where('warehouse_id', $request->warehouse[$counter])
                    ->with('product')
                    ->first();

                $order->products()->attach($inventory->product->id, [
                    'product_name' => $inventory->product->name,
                    'quantity' => $request->quantity[$counter],
                    'unit_price' => $request->unit_price[$counter],
                    'total' => $request->quantity[$counter] * $request->unit_price[$counter],
                ]);

                $inventory->decrement('quantity', $request->quantity[$counter]);

                $inventoryLog = new PurchaseInventoryLog();
                $inventoryLog->purchase_inventory_id = $inventory->id;
                $inventoryLog->type = 2;
                $inventoryLog->date = $request->date;
                $inventoryLog->quantity = $request->quantity[$counter];
                $inventoryLog->unit_price = $request->unit_price[$counter];
                $inventoryLog->sales_order_id = $order->id;
                $inventoryLog->save();

                $subTotal += $request->quantity[$counter] * $request->unit_price[$counter];
                $counter++;
            }
        }

        $order->sub_total = $subTotal;
        $vat = ($subTotal * $request->vat) / 100;
        $order->vat = $vat;
        $total = $subTotal + $vat - $request->discount;
        $order->total = $total;
        $due = $total - $request->paid;
        $order->due = $due;
        $order->next_payment = $due > 0 ? $request->next_payment : null;
        $order->save();

        // Sales Payment
        if ($request->paid > 0) {
            if ($request->payment_type == 1 || $request->payment_type == 3) {
                $payment = new SalePayment();
                $payment->sales_order_id = $order->id;
                $payment->transaction_method = $request->payment_type;
                $payment->received_type = 1;
                $payment->amount = $request->paid;
                $payment->date = $request->date;
                $payment->save();

                if ($request->payment_type == 1)
                    Cash::first()->increment('amount', $request->paid);
                else
                    MobileBanking::first()->increment('amount', $request->paid);

                $log = new TransactionLog();
                $log->date = $request->date;
                $log->particular = 'Payment for '.$order->order_no;
                $log->sister_concern_id = $order->sister_concern_id;
                $log->transaction_type = 1;
                $log->transaction_method = $request->payment_type;
                $log->account_head_type_id = 2;
                $log->account_head_sub_type_id = 2;
                $log->amount = $request->paid;
                $log->sale_payment_id = $payment->id;
                $log->save();
            } else {
                $image = 'img/no_image.png';

                if ($request->cheque_image) {
                    // Upload Image
                    $file = $request->file('cheque_image');
                    $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                    $destinationPath = 'public/uploads/sales_payment_cheque';
                    $file->move($destinationPath, $filename);

                    $image = 'uploads/sales_payment_cheque/'.$filename;
                }

                $payment = new SalePayment();
                $payment->sales_order_id = $order->id;
                $payment->transaction_method = 2;
                $payment->received_type = 1;
                $payment->bank_id = $request->bank;
                $payment->branch_id = $request->branch;
                $payment->bank_account_id = $request->account;
                $payment->cheque_no = $request->cheque_no;
                $payment->cheque_image = $image;
                $payment->amount = $request->paid;
                $payment->date = $request->date;
                $payment->save();

                BankAccount::find($request->account)->increment('balance', $request->paid);

                $log = new TransactionLog();
                $log->date = $request->date;
                $log->particular = 'Payment from '.$order->client->name.' for '.$order->order_no;;
                $log->sister_concern_id = $order->sister_concern_id;
                $log->transaction_type = 1;
                $log->transaction_method = 2;
                $log->account_head_type_id = 2;
                $log->account_head_sub_type_id = 2;
                $log->bank_id = $request->bank;
                $log->branch_id = $request->branch;
                $log->bank_account_id = $request->account;
                $log->cheque_no = $request->cheque_no;
                $log->cheque_image = $image;
                $log->amount = $request->paid;
                $log->sale_payment_id = $payment->id;
                $log->save();
            }
        }

        return redirect()->route('sale_receipt.details', ['order' => $order->id]);
    }

    public function saleReceipt() {
        return view('sale.receipt.all');
    }

    public function saleReceiptDetails(SalesOrder $order) {
        return view('sale.receipt.details', compact('order'));
    }

    public function saleReceiptPrint(SalesOrder $order) {
        $order->amount_in_word = DecimalToWords::convert($order->total,'Taka',
            'Poisa');

        return view('sale.receipt.print', compact('order'));
    }

    public function salePaymentDetails(SalePayment $payment) {
        $payment->amount_in_word = DecimalToWords::convert($payment->amount,'Taka',
            'Poisa');
        return view('sale.receipt.payment_details', compact('payment'));
    }

    public function salePaymentPrint(SalePayment $payment) {
        $payment->amount_in_word = DecimalToWords::convert($payment->amount,'Taka',
            'Poisa');
        return view('sale.receipt.payment_print', compact('payment'));
    }

    public function clientPayment() {
        $banks = Bank::where('status', 1)->orderBy('name')->get();

        return view('sale.client_payment.all', compact('banks'));
    }

    public function clientPaymentGetOrders(Request $request) {
        $orders = SalesOrder::where('client_id', $request->clientId)
            ->where('due', '>', 0)
            ->orderBy('id', 'desc')
            ->get()->toArray();

        return response()->json($orders);
    }

    public function makePayment(Request $request) {
        $rules = [
            'order' => 'required',
            'payment_type' => 'required',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ];

        if ($request->payment_type == '2') {
            $rules['bank'] = 'required';
            $rules['branch'] = 'required';
            $rules['account'] = 'required';
            $rules['cheque_no'] = 'nullable|string|max:255';
            $rules['cheque_image'] = 'nullable|image';
        }

        if ($request->order != '') {
            $order = SalesOrder::find($request->order);
            $rules['amount'] = 'required|numeric|min:0|max:'.$order->due;
        }

        if ($request->order != '') {
            if ($request->amount < $order->due)
                $rules['next_payment_date'] = 'required|date';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = SalesOrder::find($request->order);

        if ($request->payment_type == 1 || $request->payment_type == 3) {
            $payment = new SalePayment();
            $payment->sales_order_id = $order->id;
            $payment->transaction_method = $request->payment_type;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            if ($request->payment_type == 1)
                Cash::first()->increment('amount', $request->amount);
            else
                MobileBanking::first()->increment('amount', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Payment from '.$order->client->name.' for '.$order->order_no;
            $log->sister_concern_id = $order->sister_concern_id;
            $log->transaction_type = 1;
            $log->transaction_method = $request->payment_type;
            $log->account_head_type_id = 2;
            $log->account_head_sub_type_id = 2;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->sale_payment_id = $payment->id;
            $log->save();
        } else {
            $image = 'img/no_image.png';

            if ($request->cheque_image) {
                // Upload Image
                $file = $request->file('cheque_image');
                $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/sales_payment_cheque';
                $file->move($destinationPath, $filename);

                $image = 'uploads/sales_payment_cheque/'.$filename;
            }

            $payment = new SalePayment();
            $payment->sales_order_id = $order->id;
            $payment->transaction_method = 2;
            $payment->bank_id = $request->bank;
            $payment->branch_id = $request->branch;
            $payment->bank_account_id = $request->account;
            $payment->cheque_no = $request->cheque_no;
            $payment->cheque_image = $image;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            BankAccount::find($request->account)->increment('balance', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Payment from '.$order->customer->name.' for '.$order->order_no;
            $log->sister_concern_id = $order->sister_concern_id;
            $log->transaction_type = 1;
            $log->transaction_method = 2;
            $log->account_head_type_id = 2;
            $log->account_head_sub_type_id = 2;
            $log->bank_id = $request->bank;
            $log->branch_id = $request->branch;
            $log->bank_account_id = $request->account;
            $log->cheque_no = $request->cheque_no;
            $log->cheque_image = $image;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->sale_payment_id = $payment->id;
            $log->save();
        }

        $order->increment('paid', $request->amount);
        $order->decrement('due', $request->amount);

        if ($order->due > 0) {
            $order->next_payment = $request->next_payment_date;
        } else {
            $order->next_payment = null;
        }

        $order->save();

        return response()->json(['success' => true, 'message' => 'Payment has been completed.', 'redirect_url' => route('sale_receipt.payment_details', ['payment' => $payment->id])]);
    }

    public function saleProductDetails(Request $request) {
        $product = PurchaseInventory::where('sister_concern_id', $request->sisterConcernId)
            ->where('product_id', $request->productId)
            ->where('warehouse_id', $request->warehouseId)
            ->where('quantity', '>', 0)
            ->with('product')
            ->first();

        if ($product) {
            $product = $product->toArray();
            return response()->json(['success' => true, 'data' => $product, 'count' => $product['quantity']]);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found.']);
        }
    }

    public function saleReceiptDatatable() {
        $query = SalesOrder::with('sisterConcern', 'client');

        return DataTables::eloquent($query)
            ->addColumn('sisterConcern', function(SalesOrder $order) {
                return $order->sisterConcern->name;
            })
            ->addColumn('client', function(SalesOrder $order) {
                return $order->client->name;
            })
            ->addColumn('action', function(SalesOrder $order) {
                $action = '<a href="'.route('sale_receipt.details', ['order' => $order->id]).'" class="btn btn-primary btn-sm">View</a>';

                return $action;
            })
            ->editColumn('date', function(SalesOrder $order) {
                return $order->date->format('j F, Y');
            })
            ->editColumn('total', function(SalesOrder $order) {
                return '৳'.number_format($order->total, 2);
            })
            ->editColumn('paid', function(SalesOrder $order) {
                return '৳'.number_format($order->paid, 2);
            })
            ->editColumn('due', function(SalesOrder $order) {
                return '৳'.number_format($order->due, 2);
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function clientPaymentDatatable() {
        $query = Client::with('sisterConcern')
            ->select(DB::raw('clients.*, sister_concerns.name AS sister_concern_name'));

        return DataTables::eloquent($query)
            ->addColumn('sisterConcern', function(Client $client) {
                return $client->sister_concern_name;
            })
            ->addColumn('action', function(Client $client) {
                return '<a class="btn btn-info btn-sm btn-pay" role="button" data-id="'.$client->id.'" data-name="'.$client->name.'">Payment</a>';
            })
            ->addColumn('total', function(Client $client) {
                return '৳'.number_format($client->total, 2);
            })
            ->addColumn('paid', function(Client $client) {
                return '৳'.number_format($client->paid, 2);
            })
            ->addColumn('due', function(Client $client) {
                return '৳'.number_format($client->due, 2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
