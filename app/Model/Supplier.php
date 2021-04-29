<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'sister_concern_id', 'name', 'company_name', 'mobile', 'address', 'status'
    ];

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function getDueAttribute() {
        return PurchaseOrder::where('supplier_id', $this->id)->sum('due');
    }

    public function getPaidAttribute() {
        return PurchaseOrder::where('supplier_id', $this->id)->sum('paid');
    }

    public function getTotalAttribute() {
        return PurchaseOrder::where('supplier_id', $this->id)->sum('total');
    }
}
