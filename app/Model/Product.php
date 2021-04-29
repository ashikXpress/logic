<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sister_concern_id', 'client_id', 'name', 'unit_id', 'code', 'description', 'status'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }
}
