<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\BankAccount;
use App\Model\Cash;
use App\Model\MobileBanking;
use App\Model\Product;
use App\Model\ProductUtilize;
use App\Model\PurchaseInventory;
use App\Model\PurchaseInventoryLog;
use App\Model\PurchaseOrder;
use App\Model\PurchasePayment;
use App\Model\SisterConcern;
use App\Model\Supplier;
use App\Model\TransactionLog;
use App\Model\Warehouse;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SakibRahaman\DecimalToWords\DecimalToWords;

class PurchaseController extends Controller
{
    public function purchaseOrder() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();
        $warehouses = Warehouse::where('status', 1)->orderBy('name')->get();

        return view('purchase.purchase_order.create', compact('sisterConcerns', 'warehouses'));
    }

    public function purchaseOrderPost(Request $request) {
        $request->validate([
            'sister_concern' => 'required',
            'supplier' => 'required',
            'warehouse' => 'required',
            'date' => 'required|date',
            'product.*' => 'required',
            'quantity.*' => 'required|numeric|min:.01',
            'unit_price.*' => 'required|numeric|min:0',
        ]);


        $order = new PurchaseOrder();
        $order->order_no = random_int(100000, 999999);
        $order->sister_concern_id = $request->sister_concern;
        $order->supplier_id = $request->supplier;
        $order->warehouse_id = $request->warehouse;
        $order->date = $request->date;
        $order->total = 0;
        $order->due = 0;
        $order->save();

        $counter = 0;
        $total = 0;
        foreach ($request->product as $reqProduct) {
            $product = Product::find($reqProduct);

            $order->products()->attach($reqProduct, [
                'name' => $product->name,
                'unit' => $product->unit->name,
                'quantity' => $request->quantity[$counter],
                'unit_price' => $request->unit_price[$counter],
                'total' => $request->quantity[$counter] * $request->unit_price[$counter],
            ]);

            $total += $request->quantity[$counter] * $request->unit_price[$counter];
            $counter++;
        }
        $order->total = $total;
        $order->due = $total;
        $order->save();

        return redirect()->route('purchase_receipt.details', ['order' => $order->id]);
    }

    public function purchaseReceipt() {
        return view('purchase.receipt.all');
    }

    public function purchaseReceiptDetails(PurchaseOrder $order) {
        return view('purchase.receipt.details', compact('order'));
    }

    public function purchaseReceiptPrint(PurchaseOrder $order) {
        return view('purchase.receipt.print', compact('order'));
    }

    public function purchasePaymentDetails(PurchasePayment $payment) {
        $payment->amount_in_word = DecimalToWords::convert($payment->amount,'Taka',
            'Poisa');
        return view('purchase.receipt.payment_details', compact('payment'));
    }

    public function supplierPayment() {
        $suppliers = Supplier::all();
        $banks = Bank::where('status', 1)->orderBy('name')->get();

        return view('purchase.supplier_payment.all', compact('suppliers', 'banks'));
    }

    public function purchasePaymentPrint(PurchasePayment $payment) {
        $payment->amount_in_word = DecimalToWords::convert($payment->amount,'Taka',
            'Poisa');
        return view('purchase.receipt.payment_print', compact('payment'));
    }

    public function purchaseInventory() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();
        $warehouses = Warehouse::where('status', 1)->orderBy('name')->get();

        return view('purchase.inventory.all', compact('sisterConcerns', 'warehouses'));
    }

    public function purchaseInventoryDetails(PurchaseInventory $inventory) {
        return view('purchase.inventory.details', compact('inventory'));
    }

    public function utilizeIndex() {
        return view('purchase.utilize.all');
    }

    public function utilizeAdd() {
        $sisterConcerns = SisterConcern::orderBy('name')->get();
        $warehouses = Warehouse::where('status', 1)
            ->orderBy('name')->get();

        return view('purchase.utilize.add', compact('sisterConcerns', 'warehouses'));
    }

    public function utilizeAddPost(Request $request) {
        $validator = Validator::make($request->all(), [
            'sister_concern' => 'required',
            'client' => 'required',
            'project' => 'required',
            'product' => 'required',
            'warehouse' => 'required',
            'quantity' => 'required|numeric|min:0.01',
            'date' => 'date|date',
            'note' => 'nullable|string|max:255',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validator->after(function ($validator) use ($request) {
            $inventory = PurchaseInventory::where('sister_concern_id',$request->sister_concern)
                ->where('warehouse_id', $request->warehouse)
                ->where('product_id', $request->product)
                ->first();
            if ($inventory) {
                if ($inventory->quantity < $request->quantity)
                    $validator->errors()->add('quantity', 'Insufficient stock.');
            } else {
                $validator->errors()->add('quantity', 'Insufficient stock.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $inventory = PurchaseInventory::where('sister_concern_id',$request->sister_concern)
            ->where('warehouse_id', $request->warehouse)
            ->where('product_id', $request->product)
            ->first();

        $inventoryLog = new PurchaseInventoryLog();
        $inventoryLog->purchase_inventory_id = $inventory->id;
        $inventoryLog->project_id = $request->project;
        $inventoryLog->type = 2;
        $inventoryLog->date = $request->date;
        $inventoryLog->quantity = $request->quantity;
        $inventoryLog->unit_price = $inventory->avg_unit_price;
        $inventoryLog->note = $request->note;
        $inventoryLog->save();

        $utilize = new ProductUtilize();
        $utilize->sister_concern_id = $request->sister_concern;
        $utilize->client_id = $request->client;
        $utilize->project_id = $request->project;
        $utilize->product_id = $request->product;
        $utilize->warehouse_id = $request->warehouse;
        $utilize->quantity = $request->quantity;
        $utilize->unit_price = $inventory->avg_unit_price;
        $utilize->total = $request->quantity * $inventory->avg_unit_price;
        $utilize->date = $request->date;
        $utilize->note = $request->note;
        $utilize->save();

        $inventory->decrement('quantity', $request->quantity);

        $log = new TransactionLog();
        $log->date = $request->date;
        $log->particular = 'Product Utilize';
        $log->sister_concern_id = $request->sister_concern;
        $log->transaction_method = 0;
        $log->transaction_type = 2;
        $log->account_head_type_id = 5;
        $log->account_head_sub_type_id = 5;
        $log->amount = $request->quantity * $inventory->avg_unit_price;
        $log->note = $request->note;
        $log->product_utilize_id = $utilize->id;
        $log->save();

        return redirect()->route('utilize.all')->with('message', 'Utilize add successfully.');
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
            $order = PurchaseOrder::find($request->order);
            $rules['amount'] = 'required|numeric|min:0|max:'.$order->due;
        }

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request) {
            if ($request->payment_type == 1) {
                $cash = Cash::first();

                if ($request->amount > $cash->amount)
                    $validator->errors()->add('amount', 'Insufficient balance.');
            } elseif ($request->payment_type == 3) {
                $mobileBanking = MobileBanking::first();

                if ($request->amount > $mobileBanking->amount)
                    $validator->errors()->add('amount', 'Insufficient balance.');
            } else {
                if ($request->account != '') {
                    $account = BankAccount::find($request->account);

                    if ($request->amount > $account->balance)
                        $validator->errors()->add('amount', 'Insufficient balance.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $order = PurchaseOrder::find($request->order);

        if ($request->payment_type == 1 || $request->payment_type == 3) {
            $payment = new PurchasePayment();
            $payment->purchase_order_id = $order->id;
            $payment->transaction_method = $request->payment_type;
            $payment->amount = $request->amount;
            $payment->date = $request->date;
            $payment->note = $request->note;
            $payment->save();

            if ($request->payment_type == 1)
                Cash::first()->decrement('amount', $request->amount);
            else
                MobileBanking::first()->decrement('amount', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Paid to '.$order->supplier->name.' for '.$order->order_no;
            $log->sister_concern_id = $order->sister_concern_id;
            $log->transaction_type = 2;
            $log->transaction_method = $request->payment_type;
            $log->account_head_type_id = 1;
            $log->account_head_sub_type_id = 1;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->purchase_payment_id = $payment->id;
            $log->save();

        } else {
            $image = 'img/no_image.png';

            if ($request->cheque_image) {
                // Upload Image
                $file = $request->file('cheque_image');
                $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/purchase_payment_cheque';
                $file->move($destinationPath, $filename);

                $image = 'uploads/purchase_payment_cheque/'.$filename;
            }

            $payment = new PurchasePayment();
            $payment->purchase_order_id = $order->id;
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

            BankAccount::find($request->account)->decrement('balance', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Paid to '.$order->supplier->name.' for '.$order->order_no;
            $log->sister_concern_id = $order->sister_concern_id;
            $log->transaction_type = 2;
            $log->transaction_method = 2;
            $log->account_head_type_id = 1;
            $log->account_head_sub_type_id = 1;
            $log->bank_id = $request->bank;
            $log->branch_id = $request->branch;
            $log->bank_account_id = $request->account;
            $log->cheque_no = $request->cheque_no;
            $log->cheque_image = $image;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->purchase_payment_id = $payment->id;
            $log->save();
        }

        $order->increment('paid', $request->amount);
        $order->decrement('due', $request->amount);

        return response()->json(['success' => true, 'message' => 'Payment has been completed.', 'redirect_url' => route('purchase_receipt.payment_details', ['payment' => $payment->id])]);
    }

    public function purchaseProductJson(Request $request) {
        if (!$request->searchTerm) {
            $products = Product::where('sister_concern_id', $request->sisterConcernId)
                ->where('status', 1)->orderBy('name')->limit(10)->get();
        } else {
            $products = Product::where('sister_concern_id', $request->sisterConcernId)
                ->where('status', 1)
                ->where('name', 'like', '%'.$request->searchTerm.'%')
                ->orderBy('name')
                ->limit(10)->get();
        }

        $data = array();

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'text' => $product->name
            ];
        }

        echo json_encode($data);
    }

    public function purchaseReceiptDatatable() {
        $query = PurchaseOrder::with('supplier', 'warehouse', 'sisterConcern');

        return DataTables::eloquent($query)
            ->addColumn('supplier', function(PurchaseOrder $order) {
                return $order->supplier->name;
            })
            ->addColumn('warehouse', function(PurchaseOrder $order) {
                return $order->warehouse->name;
            })
            ->addColumn('sisterConcern', function(PurchaseOrder $order) {
                return $order->sisterConcern->name;
            })
            ->addColumn('action', function(PurchaseOrder $order) {
                if ($order->received_at)
                    return '<a href="'.route('purchase_receipt.details', ['order' => $order->id]).'" class="btn btn-primary btn-sm">View</a>';
                else
                    return '<a href="'.route('purchase_receipt.details', ['order' => $order->id]).'" class="btn btn-primary btn-sm">View</a> <a class="btn btn-success btn-sm btn-receive" role="button" data-id="'.$order->id.'">Receive</a>';

            })
            ->editColumn('date', function(PurchaseOrder $order) {
                return $order->date->format('j F, Y');
            })
            ->editColumn('total', function(PurchaseOrder $order) {
                return '৳ '.number_format($order->total, 2);
            })
            ->editColumn('paid', function(PurchaseOrder $order) {
                return '৳ '.number_format($order->paid, 2);
            })
            ->editColumn('due', function(PurchaseOrder $order) {
                return '৳ '.number_format($order->due, 2);
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function orderReceive(Request $request) {
        $order = PurchaseOrder::where('id', $request->orderId)->with('products')->first();
        $order->received_at = $request->date;
        $order->save();

        $receivedOrderIds = PurchaseOrder::select('id')
            ->where('sister_concern_id', $order->sister_concern_id)
            ->where('warehouse_id', $order->warehouse_id)
            ->whereNotNull('received_at')
            ->get()->pluck('id')->toArray();

        foreach ($order->products as $product) {
            $inventory = PurchaseInventory::where('product_id', $product->id)
                ->where('sister_concern_id', $order->sister_concern_id)
                ->where('warehouse_id', $order->warehouse_id)
                ->first();

            $totalPrice = DB::table('product_purchase_order')
                ->whereIn('purchase_order_id', $receivedOrderIds)
                ->where('product_id', $product->id)
                ->sum('total');
            $totalQuantity = DB::table('product_purchase_order')
                ->whereIn('purchase_order_id', $receivedOrderIds)
                ->where('product_id', $product->id)
                ->sum('quantity');

            $avgPrice = $totalPrice / $totalQuantity;

            if ($inventory) {
                $inventory->increment('quantity', $product->pivot->quantity);
                $inventory->avg_unit_price = $avgPrice;
                $inventory->last_unit_price = $product->pivot->unit_price;
                $inventory->save();
            } else {
                $inventory = new PurchaseInventory();
                $inventory->sister_concern_id = $order->sister_concern_id;
                $inventory->warehouse_id = $order->warehouse_id;
                $inventory->product_id = $product->id;
                $inventory->quantity = $product->pivot->quantity;
                $inventory->avg_unit_price = $avgPrice;
                $inventory->last_unit_price = $product->pivot->unit_price;
                $inventory->save();
            }


            $inventoryLog = new PurchaseInventoryLog();
            $inventoryLog->purchase_inventory_id = $inventory->id;
            $inventoryLog->purchase_order_id = $order->id;
            $inventoryLog->type = 1;
            $inventoryLog->date = $request->date;
            $inventoryLog->quantity = $product->pivot->quantity;
            $inventoryLog->unit_price = $product->pivot->unit_price;
            $inventoryLog->save();
        }
    }

    public function supplierPaymentGetOrders(Request $request) {
        $orders = PurchaseOrder::where('supplier_id', $request->supplierId)
            ->where('due', '>', 0)
            ->orderBy('order_no')
            ->get()->toArray();

        return response()->json($orders);
    }

    public function supplierPaymentOrderDetails(Request $request) {
        $order = PurchaseOrder::where('id', $request->orderId)
            ->first()->toArray();

        return response()->json($order);
    }

    public function purchaseInventoryDatatable() {
        $query = PurchaseInventory::with('product', 'warehouse', 'sisterConcern')
            ->select(DB::raw('purchase_inventories.*, products.name'));

        return DataTables::eloquent($query)
            ->addColumn('product', function(PurchaseInventory $inventory) {
                return $inventory->product->name;
            })
            ->addColumn('warehouse', function(PurchaseInventory $inventory) {
                return $inventory->warehouse->name;
            })
            ->addColumn('sisterConcern', function(PurchaseInventory $inventory) {
                return $inventory->sisterConcern->name;
            })
            ->addColumn('action', function($row) {
                return '<a href="'.route('purchase_inventory.details', ['inventory' => $row->id]).'" class="btn btn-primary btn-sm">Details</a>';

            })
            ->editColumn('quantity', function(PurchaseInventory $inventory) {
                return number_format($inventory->quantity, 2).' '.$inventory->product->unit->name;
            })
            ->editColumn('avg_unit_price', function(PurchaseInventory $inventory) {
                return '৳'.number_format($inventory->avg_unit_price, 2);
            })
            ->rawColumns(['action'])
            ->filter(function ($query) {
                if (request()->has('sister_concern_id') && request('sister_concern_id') != '') {
                    $query->where('purchase_inventories.sister_concern_id', request('sister_concern_id'));
                }

                if (request()->has('warehouse_id') && request('warehouse_id') != '') {
                    $query->where('purchase_inventories.warehouse_id', request('warehouse_id'));
                }
            })
            ->toJson();
    }

    public function purchaseInventoryDetailsDatatable() {
        $query = PurchaseInventoryLog::where('purchase_inventory_id', request('purchase_inventory_id'))
            ->with('purchaseOrder', 'project', 'salesOrder');

        return DataTables::eloquent($query)
            ->editColumn('date', function(PurchaseInventoryLog $log) {
                return $log->date->format('j F, Y');
            })
            ->editColumn('type', function(PurchaseInventoryLog $log) {
                if ($log->type == 1)
                    return '<span class="label label-success">In</span>';
                elseif ($log->type == 2)
                    return '<span class="label label-danger">Out</span>';
                elseif ($log->type == 3)
                    return '<span class="label label-success">Add</span>';
                else
                    return '<span class="label label-danger">Return</span>';
            })
            ->editColumn('quantity', function(PurchaseInventoryLog $log) {
                return number_format($log->quantity, 2);
            })
            ->editColumn('unit_price', function(PurchaseInventoryLog $log) {
                if ($log->unit_price)
                    return '৳'.number_format($log->unit_price, 2);
                else
                    return '';
            })
            ->addColumn('supplier', function(PurchaseInventoryLog $log) {
                if ($log->purchaseOrder)
                    return $log->purchaseOrder->supplier->name;
                else
                    return '';
            })
            ->addColumn('purchaseOrder', function(PurchaseInventoryLog $log) {
                if ($log->purchaseOrder)
                    return '<a href="'.route('purchase_receipt.details', ['order' => $log->purchaseOrder->id]).'">'.$log->purchaseOrder->order_no.'</a>';
                else
                    return '';
            })
            ->addColumn('salesOrder', function(PurchaseInventoryLog $log) {
                if ($log->salesOrder)
                    return '<a href="#">'.$log->salesOrder->order_no.'</a>';
                else
                    return '';
            })
            ->addColumn('project', function(PurchaseInventoryLog $log) {
                if ($log->project)
                    return $log->project->name;
                else
                    return '';
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['type', 'purchaseOrder', 'salesOrder'])
            ->filter(function ($query) {
                if (request()->has('date') && request('date') != '') {
                    $dates = explode(' - ', request('date'));
                    if (count($dates) == 2) {
                        $query->where('date', '>=', $dates[0]);
                        $query->where('date', '<=', $dates[1]);
                    }
                }

                if (request()->has('type') && request('type') != '') {
                    $query->where('type', request('type'));
                }
            })
            ->toJson();
    }

    public function utilizeDatatable() {
        $query = ProductUtilize::with('sisterConcern','client', 'project', 'product', 'warehouse');

        return DataTables::eloquent($query)
            ->addColumn('sisterConcern', function(ProductUtilize $utilize) {
                return $utilize->sisterConcern->name;
            })
            ->addColumn('client', function(ProductUtilize $utilize) {
                return $utilize->client->name;
            })
            ->addColumn('project', function(ProductUtilize $utilize) {
                return $utilize->project->name;
            })
            ->addColumn('product', function(ProductUtilize $utilize) {
                return $utilize->product->name;
            })
            ->addColumn('warehouse', function(ProductUtilize $utilize) {
                return $utilize->warehouse->name;
            })
            ->editColumn('quantity', function(ProductUtilize $utilize) {
                return number_format($utilize->quantity, 2).' '. $utilize->product->unit->name;
            })
            ->editColumn('date', function(ProductUtilize $utilize) {
                return $utilize->date->format('j F, Y');
            })
            ->editColumn('unit_price', function(ProductUtilize $utilize) {
                return '৳ '.number_format($utilize->unit_price,2);
            })
            ->orderColumn('date', function ($query, $order) {
                $query->orderBy('date', $order)->orderBy('created_at', 'desc');
            })
            ->toJson();
    }
}
