<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    protected $guarded=[];

    //protected $dates = ['late_time'];

    public function employee()
    {
        return $this->belongsTo(Employee::class)->with('designation','department');
    }

    public function employeeProcess()
    {
        return $this->belongsTo(AttendanceProcess::class, 'employee_id','employee_id')->with('designation','department');
    }
}
