<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    protected $fillable = [
        'project_id', 'transaction_method', 'bank_id', 'branch_id',
        'bank_account_id', 'cheque_no', 'cheque_image', 'amount', 'date', 'note'
    ];

    protected $dates = ['date'];

    public function project() {
        return $this->belongsTo(Project::class);
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
