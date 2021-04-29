<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TrainingBatch extends Model
{
    public function course(){
        return $this->belongsTo(TrainingCourse::class);
    }
    public function batchLevels(){
        return $this->hasMany(BatchLevel::class,'batch_id','id');
    }
}
