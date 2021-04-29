<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateInterviewEvalution extends Model
{

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function designationLogs() {
        return $this->hasMany(DesignationLog::class)->orderBy('date', 'desc')->orderBy('created_at', 'desc');
    }

    public function employee()
    {
        return $this->hasMany(AttendanceProcess::class, 'employee_id','employee_id')->with('designation','department');
    }

    public function leaves() {
        return $this->belongsTo(Leave::class,'employee_id','employee_id');
    }

    public function leaveInformation($employee_id, $year, $month) {

        if ($month != 0){
            return Leave::where('employee_id',$employee_id)->where('status', 2)->whereMonth('from', date('m' , strtotime($month)))->where('year', date('Y' , strtotime($year)))->get();
        }
        else{
            return Leave::where('employee_id',$employee_id)->where('status', 2)->where('year', $year)->get();
        }

    }
    public function employeeExtraData()
    {
        return $this->belongsTo(ExtraEmployeeData::class, 'id','employee_id');
    }


}
