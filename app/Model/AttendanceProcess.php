<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttendanceProcess extends Model
{
    public function employee()
    {
        return $this->belongsTo(CandidateInterviewEvalution::class)->with('designation','department');
    }
    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
