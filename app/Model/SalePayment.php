<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    protected $fillable = [
        'sales_order_id', 'type', 'transaction_method', 'bank_id', 'branch_id',
        'bank_account_id', 'cheque_no', 'cheque_image', 'amount', 'date', 'note',
        'received_type'
    ];

    protected $dates = ['date'];

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function account() {
        return $this->belongsTo(BankAccount::class, 'bank_account_id', 'id');
    }
}
