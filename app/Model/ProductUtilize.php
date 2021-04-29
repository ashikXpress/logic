<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductUtilize extends Model
{
    protected $fillable = [
        'sister_concern_id', 'client_id', 'project_id', 'product_id', 'warehouse_id',
        'quantity', 'unit_price', 'total', 'date', 'note'
    ];

    protected $dates = ['date'];

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
