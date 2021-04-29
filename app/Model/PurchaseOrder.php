<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'order_no', 'sister_concern_id', 'supplier_id', 'warehouse_id', 'date', 'received_at',
        'total', 'paid', 'due'
    ];

    protected $dates = ['date', 'received_at'];

    public function products() {
        return $this->belongsToMany(Product::class)
            ->withPivot('id', 'name', 'unit', 'quantity', 'unit_price', 'total');
    }

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function payments() {
        return $this->hasMany(PurchasePayment::class);
    }
}
