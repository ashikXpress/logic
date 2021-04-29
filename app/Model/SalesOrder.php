<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'order_no', 'sister_concern_id', 'client_id', 'date', 'sub_total', 'vat_percentage', 'vat',
        'discount', 'total', 'paid', 'due', 'next_payment', 'created_by'
    ];

    protected $dates = ['date', 'next_payment'];

    public function products() {
        return $this->belongsToMany(Product::class)
            ->withPivot('id', 'product_name', 'quantity', 'unit_price', 'total');
    }

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function payments() {
        return $this->hasMany(SalePayment::class);
    }
}
