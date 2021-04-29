<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalaryPreApproveLog extends Model
{
    protected $guarded = [];


    public function employee(){
        return $this->belongsTo(CandidateInterviewEvalution::class)->with('department','designation');
    }
}
