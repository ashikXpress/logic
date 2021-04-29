<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalaryProcess extends Model
{
    protected $fillable = [
        'date', 'month', 'year', 'bank_id', 'branch_id', 'bank_account_id', 'total'
    ];
}
