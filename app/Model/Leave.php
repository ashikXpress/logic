<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'employee_id', 'year', 'from', 'to', 'total_days', 'note', 'type'
    ];

    protected $dates = ['from', 'to'];

   public function employee() {
        return $this->hasOne(CandidateInterviewEvalution::class,'id','employee_id')->with('department','designation');
    }
    

    public function designationLogs() {
        return $this->hasMany(DesignationLog::class)->orderBy('date', 'desc')->orderBy('created_at', 'desc');
    }
}
