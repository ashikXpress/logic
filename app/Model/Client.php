<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'sister_concern_id', 'name', 'mobile_no', 'address', 'email', 'status'
    ];

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function projects() {
        return $this->hasMany(Product::class);
    }

    public function getDueAttribute() {
        return SalesOrder::where('client_id', $this->id)->sum('due');
    }

    public function getPaidAttribute() {
        return SalesOrder::where('client_id', $this->id)->sum('paid');
    }

    public function getTotalAttribute() {
        return SalesOrder::where('client_id', $this->id)->sum('total');
    }

    public function getProjectDueAttribute() {
        return Project::where('client_id', $this->id)->sum('due');
    }

    public function getProjectReceiveAttribute() {
        return Project::where('client_id', $this->id)->sum('receive');
    }

    public function getProjectTotalAttribute() {
        return Project::where('client_id', $this->id)->sum('amount');
    }
}
