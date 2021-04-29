<?php

namespace App\Http\Controllers;

use App\Model\AccountHeadSubType;
use App\Model\AccountHeadType;
use App\Model\BalanceTransfer;
use App\Model\Bank;
use App\Model\BankAccount;
use App\Model\Cash;
use App\Model\Client;
use App\Model\MobileBanking;
use App\Model\Project;
use App\Model\ProjectPayment;
use App\Model\SisterConcern;
use App\Model\Transaction;
use App\Model\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use SakibRahaman\DecimalToWords\DecimalToWords;
use DataTables;

class AccountsController extends Controller
{
    public function accountHeadType() {
        $types = AccountHeadType::whereNotIn('id', [1, 2, 3, 4, 5, 6])->get();

        return view('accounts.account_head_type.all', compact('types'));
    }

    public function accountHeadTypeAdd() {
        return view('accounts.account_head_type.add');
    }

    public function accountHeadTypeAddPost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer|min:1|max:2',
            'status' => 'required'
        ]);

        $type = new AccountHeadType();
        $type->name = $request->name;
        $type->transaction_type = $request->type;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('account_head.type')->with('message', 'Account head type add successfully.');
    }

    public function accountHeadTypeEdit(AccountHeadType $type) {
        return view('accounts.account_head_type.edit', compact('type'));
    }

    public function accountHeadTypeEditPost(AccountHeadType $type, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer|min:1|max:2',
            'status' => 'required'
        ]);

        $type->name = $request->name;
        $type->transaction_type = $request->type;
        $type->status = $request->status;
        $type->save();

        return redirect()->route('account_head.type')->with('message', 'Account head type edit successfully.');
    }

    public function accountHeadSubType() {
        $subTypes = AccountHeadSubType::whereNotIn('id', [1, 2, 3, 4, 5, 6])->get();

        return view('accounts.account_head_sub_type.all', compact('subTypes'));
    }

    public function accountHeadSubTypeAdd() {
        return view('accounts.account_head_sub_type.add');
    }

    public function accountHeadSubTypeAddPost(Request $request) {
        $request->validate([
            'type' => 'required',
            'name' => 'required|string|max:255',
            'account_head_type' => 'required',
            'status' => 'required'
        ]);

        $subType = new AccountHeadSubType();
        $subType->account_head_type_id = $request->account_head_type;
        $subType->name = $request->name;
        $subType->status = $request->status;
        $subType->save();

        return redirect()->route('account_head.sub_type')->with('message', 'Account head sub type add successfully.');
    }

    public function accountHeadSubTypeEdit(AccountHeadSubType $subType) {
        return view('accounts.account_head_sub_type.edit', compact('subType'));
    }

    public function accountHeadSubTypeEditPost(AccountHeadSubType $subType, Request $request) {
        $request->validate([
            'type' => 'required',
            'name' => 'required|string|max:255',
            'account_head_type' => 'required',
            'status' => 'required'
        ]);

        $subType->account_head_type_id = $request->account_head_type;
        $subType->name = $request->name;
        $subType->status = $request->status;
        $subType->save();

        return redirect()->route('account_head.sub_type')->with('message', 'Account head sub type edit successfully.');
    }

    public function transactionIndex() {
        return view('accounts.transaction.all');
    }

    public function transactionAdd() {
        $banks = Bank::where('status', 1)
            ->orderBy('name')
            ->get();
        $sisterConcerns = SisterConcern::orderBy('name')->get();

        return view('accounts.transaction.add', compact('banks', 'sisterConcerns'));
    }

    public function transactionAddPost(Request $request) {
        $messages = [
            'bank.required_if' => 'The bank field is required.',
            'branch.required_if' => 'The branch field is required.',
            'account.required_if' => 'The account field is required.',
        ];

        $validator = Validator::make($request->all(), [
            'sister_concern' => 'required',
            'type' => 'required|integer|min:1|max:2',
            'account_head_type' => 'required',
            'account_head_sub_type' => 'required',
            'payment_type' => 'required|integer|min:1|max:3',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
            'bank' => 'required_if:payment_type,==,2',
            'branch' => 'required_if:payment_type,==,2',
            'account' => 'required_if:payment_type,==,2',
            'cheque_no' => 'nullable|string|max:255',
            'cheque_image' => 'nullable|image',
        ], $messages);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validator->after(function ($validator) use ($request) {
            if ($request->type == 2) {
                if ($request->payment_type == 1) {
                    $cash = Cash::first();

                    if ($request->amount > $cash->amount)
                        $validator->errors()->add('amount', 'Insufficient balance.');
                } elseif ($request->payment_type == 3) {
                    $mobileBanking = MobileBanking::first();

                    if ($request->amount > $mobileBanking->amount)
                        $validator->errors()->add('amount', 'Insufficient balance.');
                } else {
                    $bankAccount = BankAccount::find($request->account);

                    if ($request->amount > $bankAccount->balance)
                        $validator->errors()->add('amount', 'Insufficient balance.');
                }

            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $image = null;
        if ($request->payment_type == 2) {
            $image = 'img/no_image.png';

            if ($request->cheque_image) {
                // Upload Image
                $file = $request->file('cheque_image');
                $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/transaction_cheque';
                $file->move($destinationPath, $filename);

                $image = 'uploads/transaction_cheque/'.$filename;
            }
        }

        $transaction = new Transaction();
        $transaction->sister_concern_id = $request->sister_concern;
        $transaction->transaction_type = $request->type;
        $transaction->account_head_type_id = $request->account_head_type;
        $transaction->account_head_sub_type_id = $request->account_head_sub_type;
        $transaction->transaction_method = $request->payment_type;
        $transaction->bank_id = $request->payment_type == 2 ? $request->bank : null;
        $transaction->branch_id = $request->payment_type == 2 ? $request->branch : null;
        $transaction->bank_account_id = $request->payment_type == 2 ? $request->account : null;
        $transaction->cheque_no = $request->payment_type == 2 ? $request->cheque_no : null;
        $transaction->cheque_image = $image;
        $transaction->amount = $request->amount;
        $transaction->date = $request->date;
        $transaction->note = $request->note;
        $transaction->save();

        if ($request->type == 1) {
            // Income
            if ($request->payment_type == 1) {
                // Cash
                Cash::first()->increment('amount', $request->amount);
            } elseif ($request->payment_type == 3) {
                // Mobile Banking
                MobileBanking::first()->increment('amount', $request->amount);
            } else {
                // Bank
                BankAccount::find($request->account)->increment('balance', $request->amount);
            }
        } else {
            // Expense
            if ($request->payment_type == 1) {
                // Cash
                Cash::first()->decrement('amount', $request->amount);
            } elseif ($request->payment_type == 3) {
                // Mobile Banking
                MobileBanking::first()->decrement('amount', $request->amount);
            } else {
                // Bank
                BankAccount::find($request->account)->decrement('balance', $request->amount);
            }
        }

        $accountHeadSubType = AccountHeadSubType::find($request->account_head_sub_type);

        $log = new TransactionLog();
        $log->date = $request->date;
        $log->particular = $accountHeadSubType->name;
        $log->sister_concern_id = $request->sister_concern;
        $log->transaction_type = $request->type;
        $log->transaction_method = $request->payment_type;
        $log->account_head_type_id = $request->account_head_type;
        $log->account_head_sub_type_id = $request->account_head_sub_type;
        $log->bank_id = $request->payment_type == 2 ? $request->bank : null;
        $log->branch_id = $request->payment_type == 2 ? $request->branch : null;
        $log->bank_account_id = $request->payment_type == 2 ? $request->account : null;
        $log->cheque_no = $request->payment_type == 2 ? $request->cheque_no : null;
        $log->cheque_image = $image;
        $log->amount = $request->amount;
        $log->note = $request->note;
        $log->transaction_id = $transaction->id;
        $log->save();

        return redirect()->route('transaction.details', ['transaction' => $transaction->id]);
    }

    public function transactionEditPost(Request $request) {
        $rules = [
            'id' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        $transaction = Transaction::find($request->id);

        if ($transaction->transaction_method == 1) {
            $balance = Cash::first()->amount;
        } elseif ($transaction->transaction_method == 3) {
            $balance = MobileBanking::first()->amount;
        } else {
            $balance = BankAccount::find($transaction->bank_account_id)->balance;
        }

        if ($request->type == 1) {
            $updateBalance = ($balance - $transaction->amount) + $request->amount;
        } else {
            $updateBalance = ($balance + $transaction->amount) - $request->amount;
        }

        $validator->after(function ($validator) use ($updateBalance) {
            if ($updateBalance < 0) {
                $validator->errors()->add('amount', 'Insufficient balance.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $transaction->amount = $request->amount;
        $transaction->note = $request->note;
        $transaction->save();

        if ($transaction->transaction_method == 1) {
            Cash::first()->update([
                'amount' => $updateBalance
            ]);
        } elseif ($transaction->transaction_method == 3) {
            MobileBanking::first()->update([
                'amount' => $updateBalance
            ]);
        } else {
            $balance = BankAccount::find($transaction->bank_account_id)->update([
                'balance' => $updateBalance
            ]);
        }

        TransactionLog::where('transaction_id', $transaction->id)
            ->update([
                'amount' => $request->amount,
                'note' => $request->note
            ]);

        return response()->json(['success' => true, 'message' => 'Transaction has been updated.']);
    }

    public function transactionDetails(Transaction $transaction) {
        $transaction->amount_in_word = DecimalToWords::convert($transaction->amount,'Taka',
            'Poisa');

        return view('accounts.transaction.details', compact('transaction'));
    }

    public function transactionDetailsJson(Request $request) {
        $transaction = Transaction::find($request->transactionId)->toArray();

        return response()->json($transaction);
    }

    public function transactionPrint(Transaction $transaction) {
        $transaction->amount_in_word = DecimalToWords::convert($transaction->amount,'Taka',
            'Poisa');

        return view('accounts.transaction.print', compact('transaction'));
    }

    public function balanceTransferAdd() {
        $banks = Bank::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('accounts.balance_transfer.add', compact('banks'));
    }

    public function balanceTransferAddPost(Request $request) {
        $messages = [
            'source_bank.required_if' => 'The source bank field is required.',
            'source_branch.required_if' => 'The source branch field is required.',
            'source_account.required_if' => 'The source account field is required.',
            'target_bank.required_if' => 'The target bank field is required.',
            'target_branch.required_if' => 'The target branch field is required.',
            'target_account.required_if' => 'The target account field is required.',
        ];

        $validator = Validator::make($request->all(), [
            'type' => 'required|integer|min:1|max:3',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
            'source_bank' => 'required_if:type,==,1|required_if:type,==,3',
            'source_branch' => 'required_if:type,==,1|required_if:type,==,3',
            'source_account' => 'required_if:type,==,1|required_if:type,==,3',
            'source_cheque_no' => 'nullable|string|max:255',
            'source_cheque_image' => 'nullable|image',
            'target_bank' => 'required_if:type,==,2|required_if:type,==,3',
            'target_branch' => 'required_if:type,==,2required_if:type,==,3',
            'target_account' => 'required_if:type,==,2|required_if:type,==,3',
            'target_cheque_no' => 'nullable|string|max:255',
            'target_cheque_image' => 'nullable|image',
        ], $messages);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validator->after(function ($validator) use ($request) {
            if ($request->type == 1 || $request->type == 3) {
                $bankAccount = BankAccount::find($request->source_account);

                if ($request->amount > $bankAccount->balance)
                    $validator->errors()->add('amount', 'Insufficient balance.');
            } else {
                $cash = Cash::first();

                if ($request->amount > $cash->amount)
                    $validator->errors()->add('amount', 'Insufficient balance.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sourceImage = null;
        $targetImage = null;
        if ($request->type == 1 || $request->type == 3) {
            $sourceImage = 'img/no_image.png';

            if ($request->source_cheque_image) {
                // Upload Image
                $file = $request->file('source_cheque_image');
                $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/balance_transfer_cheque';
                $file->move($destinationPath, $filename);

                $sourceImage = 'uploads/balance_transfer_cheque/'.$filename;
            }
        }

        if ($request->type == 2 || $request->type == 3) {
            $targetImage = 'img/no_image.png';

            if ($request->target_cheque_image) {
                // Upload Image
                $file = $request->file('target_cheque_image');
                $filename = Uuid::uuid1()->toString().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/balance_transfer_cheque';
                $file->move($destinationPath, $filename);

                $targetImage = 'uploads/balance_transfer_cheque/'.$filename;
            }
        }

        $transfer = new BalanceTransfer();
        $transfer->type = $request->type;
        $transfer->source_bank_id = in_array($request->type, [1, 3]) ? $request->source_bank : null;
        $transfer->source_branch_id = in_array($request->type, [1, 3]) ? $request->source_branch : null;
        $transfer->source_bank_account_id = in_array($request->type, [1, 3]) ? $request->source_account : null;
        $transfer->source_cheque_no = in_array($request->type, [1, 3]) ? $request->source_cheque_no : null;
        $transfer->source_cheque_image = $sourceImage;
        $transfer->target_bank_id = in_array($request->type, [2, 3]) ? $request->target_bank : null;
        $transfer->target_branch_id = in_array($request->type, [2, 3]) ? $request->target_branch : null;
        $transfer->target_bank_account_id = in_array($request->type, [2, 3]) ? $request->target_account : null;
        $transfer->target_cheque_no = in_array($request->type, [2, 3]) ? $request->target_cheque_no : null;
        $transfer->target_cheque_image = $targetImage;
        $transfer->amount = $request->amount;
        $transfer->date = $request->date;
        $transfer->note = $request->note;
        $transfer->save();

        if ($request->type == 1) {
            // Bank To Cash
            BankAccount::find($request->source_account)->decrement('balance', $request->amount);
            Cash::first()->increment('amount', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Balance Transfer';
            $log->transaction_type = 2;
            $log->transaction_method = 2;
            $log->account_head_type_id = 4;
            $log->account_head_sub_type_id = 4;
            $log->bank_id = $request->source_bank;
            $log->branch_id = $request->source_branch;
            $log->bank_account_id = $request->source_account;
            $log->cheque_no = $request->source_cheque_no;
            $log->cheque_image = $sourceImage;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->balance_transfer_id = $transfer->id;
            $log->save();

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Balance Transfer';
            $log->transaction_type = 1;
            $log->transaction_method = 1;
            $log->account_head_type_id = 3;
            $log->account_head_sub_type_id = 3;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->balance_transfer_id = $transfer->id;
            $log->save();
        } elseif ($request->type == 2) {
            // Cash To Bank
            Cash::first()->decrement('amount', $request->amount);
            BankAccount::find($request->target_account)->increment('balance', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Balance Transfer';
            $log->transaction_type = 2;
            $log->transaction_method = 1;
            $log->account_head_type_id = 4;
            $log->account_head_sub_type_id = 4;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->balance_transfer_id = $transfer->id;
            $log->save();

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Balance Transfer';
            $log->transaction_type = 1;
            $log->transaction_method = 2;
            $log->account_head_type_id = 3;
            $log->account_head_sub_type_id = 3;
            $log->bank_id = $request->target_bank;
            $log->branch_id = $request->target_branch;
            $log->bank_account_id = $request->target_account;
            $log->cheque_no = $request->target_cheque_no;
            $log->cheque_image = $targetImage;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->balance_transfer_id = $transfer->id;
            $log->save();
        } else {
            // Bank To Bank
            BankAccount::find($request->source_account)->decrement('balance', $request->amount);
            BankAccount::find($request->target_account)->increment('balance', $request->amount);

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Balance Transfer';
            $log->transaction_type = 2;
            $log->transaction_method = 2;
            $log->account_head_type_id = 4;
            $log->account_head_sub_type_id = 4;
            $log->bank_id = $request->source_bank;
            $log->branch_id = $request->source_branch;
            $log->bank_account_id = $request->source_account;
            $log->cheque_no = $request->source_cheque_no;
            $log->cheque_image = $sourceImage;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->balance_transfer_id = $transfer->id;
            $log->save();

            $log = new TransactionLog();
            $log->date = $request->date;
            $log->particular = 'Balance Transfer';
            $log->transaction_type = 1;
            $log->transaction_method = 2;
            $log->account_head_type_id = 3;
            $log->account_head_sub_type_id = 3;
            $log->bank_id = $request->target_bank;
            $log->branch_id = $request->target_branch;
            $log->bank_account_id = $request->target_account;
            $log->cheque_no = $request->target_cheque_no;
            $log->cheque_image = $targetImage;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->balance_transfer_id = $transfer->id;
            $log->save();
        }

        return redirect()->route('balance_transfer.add')->with('message', 'Balance transfer successful.');
    }

    public function projectPayment() {
        $banks = Bank::where('status', 1)->orderBy('name')->get();

        return view('accounts.project_payment.all', compact('banks'));
    }

    public function projectPaymentGetProjects(Request $request) {
        $projects = Project::where('client_id', $request->clientId)
            ->where('due', '>', 0)
            ->orderBy('name')
            ->get()->toArray();

        return response()->json($projects);
    }

    public function makeProjectPayment(Request $request) {
        $rules = [
            'project' => 'required',
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

        if ($request->project != '') {
            $project = Project::find($request->project);
            $rules['amount'] = 'required|numeric|min:0|max:'.$project->due;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $project = Project::find($request->project);

        if ($request->payment_type == 1 || $request->payment_type == 3) {
            $payment = new ProjectPayment();
            $payment->project_id = $project->id;
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
            $log->particular = 'Project Payment for '.$project->name;
            $log->sister_concern_id = $project->sister_concern_id;
            $log->transaction_type = 1;
            $log->transaction_method = $request->payment_type;
            $log->account_head_type_id = 6;
            $log->account_head_sub_type_id = 6;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->project_payment_id = $payment->id;
            $log->save();
        } else {
            $image = 'img/no_image.png';

            if ($request->cheque_image) {
                // Upload Image
                $file = $request->file('cheque_image');
                $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
                $destinationPath = 'public/uploads/project_payment_cheque';
                $file->move($destinationPath, $filename);

                $image = 'uploads/project_payment_cheque/'.$filename;
            }

            $payment = new ProjectPayment();
            $payment->project_id = $project->id;
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
            $log->particular = 'Project Payment for '.$project->name;
            $log->sister_concern_id = $project->sister_concern_id;
            $log->transaction_type = 1;
            $log->transaction_method = 2;
            $log->account_head_type_id = 6;
            $log->account_head_sub_type_id = 6;
            $log->bank_id = $request->bank;
            $log->branch_id = $request->branch;
            $log->bank_account_id = $request->account;
            $log->cheque_no = $request->cheque_no;
            $log->cheque_image = $image;
            $log->amount = $request->amount;
            $log->note = $request->note;
            $log->project_payment_id = $payment->id;
            $log->save();
        }

        $project->increment('receive', $request->amount);
        $project->decrement('due', $request->amount);

        return response()->json(['success' => true, 'message' => 'Payment has been completed.', 'redirect_url' => route('sale_receipt.payment_details', ['payment' => $payment->id])]);
    }

    public function transactionDatatable() {
        $query = Transaction::with('accountHeadType', 'accountHeadSubType');

        return DataTables::eloquent($query)
            ->addColumn('accountHeadType', function(Transaction $transaction) {
                return $transaction->accountHeadType->name;
            })
            ->addColumn('accountHeadSubType', function(Transaction $transaction) {
                return $transaction->accountHeadSubType->name;
            })
            ->addColumn('action', function(Transaction $transaction) {
                return '<a href="'.route('transaction.details', ['transaction' => $transaction->id]).'" class="btn btn-primary btn-sm">Details</a> <a role="button" data-id="'.$transaction->id.'" class="btn btn-info btn-sm btn-edit">Edit</a>';
            })
            ->editColumn('date', function(Transaction $transaction) {
                return $transaction->date->format('j F, Y');
            })
            ->editColumn('transaction_type', function(Transaction $transaction) {
                if ($transaction->transaction_type == 1)
                    return '<span class="label label-success">Income</span>';
                else
                    return '<span class="label label-warning">Expense</span>';
            })
            ->editColumn('amount', function(Transaction $transaction) {
                return '৳'.number_format($transaction->amount, 2);
            })
            ->orderColumn('date', function ($query, $transaction) {
                $query->orderBy('date', $transaction)->orderBy('created_at', 'desc');
            })
            ->rawColumns(['action', 'transaction_type'])
            ->toJson();
    }

    public function projectPaymentDatatable() {
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
                return '৳'.number_format($client->project_total, 2);
            })
            ->addColumn('receive', function(Client $client) {
                return '৳'.number_format($client->project_receive, 2);
            })
            ->addColumn('due', function(Client $client) {
                return '৳'.number_format($client->project_due, 2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
