<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'bank_id', 'name', 'status'
    ];

    public function bank() {
        return $this->belongsTo(Bank::class);
    }
}
