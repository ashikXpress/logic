<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseInventoryLog extends Model
{
    protected $fillable = [
        'purchase_inventory_id', 'purchase_order_id', 'sales_order_id', 'type', 'date',
        'quantity', 'unit_price', 'project_id', 'note'
    ];

    protected $dates = ['date'];

    public function purchaseOrder() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
