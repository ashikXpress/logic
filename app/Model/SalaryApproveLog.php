<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalaryApproveLog extends Model
{
    public function employee()
    {
        return $this->belongsTo(CandidateInterviewEvalution::class)->with('department','designation');
    }
}
