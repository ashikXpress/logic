<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseInventory extends Model
{
    protected $fillable = [
        'sister_concern_id', 'warehouse_id', 'product_id', 'quantity', 'avg_unit_price',
        'last_unit_price'
    ];

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
