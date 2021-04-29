<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DesignationLog extends Model
{
    protected $fillable = [
        'employee_id', 'department_id', 'designation_id', 'date'
    ];

    protected $dates = ['date'];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
