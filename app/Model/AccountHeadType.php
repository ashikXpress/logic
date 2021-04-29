<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccountHeadType extends Model
{
    protected $fillable = [
        'name', 'transaction_type', 'status'
    ];
}
