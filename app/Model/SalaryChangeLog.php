<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalaryChangeLog extends Model
{
    protected $fillable = [
        'employee_id', 'date', 'basic_salary', 'house_rent', 'travel',
        'medical', 'tax', 'others_deduct', 'gross_salary', 'type'
    ];

    protected $dates = ['date'];
}
