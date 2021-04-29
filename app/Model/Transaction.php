<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_type', 'account_head_type_id', 'sister_concern_id',
        'account_head_sub_type_id', 'transaction_method', 'bank_id', 'branch_id',
        'bank_account_id', 'cheque_no', 'cheque_image', 'amount', 'date', 'note'
    ];

    protected $dates = ['date'];

    public function accountHeadType() {
        return $this->belongsTo(AccountHeadType::class);
    }

    public function accountHeadSubType() {
        return $this->belongsTo(AccountHeadSubType::class);
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
