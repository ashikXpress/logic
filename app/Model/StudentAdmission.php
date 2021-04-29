<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentAdmission extends Model
{
    public function trainingDepartment() {
        return $this->belongsTo(TrainingDepartment::class);
    }
    public function trainingCourse() {
        return $this->belongsTo(TrainingCourse::class);
    }
    public function trainingBatch() {
        return $this->belongsTo(TrainingBatch::class);
    }
}
