<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'name', 'year', 'from', 'to', 'total_days'
    ];

    protected $dates = ['from', 'to'];
}
