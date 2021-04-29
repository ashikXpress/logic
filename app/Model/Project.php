<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'sister_concern_id', 'client_id', 'name', 'description', 'amount', 'receive',
        'due', 'deadline', 'work_order'
    ];

    protected $dates = ['deadline'];

    public function sisterConcern() {
        return $this->belongsTo(SisterConcern::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
