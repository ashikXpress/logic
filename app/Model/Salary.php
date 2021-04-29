<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $dates = ['date'];

    protected $fillable = [
        'salary_process_id', 'employee_id', 'date', 'month', 'year', 'basic_salary',
        'house_rent', 'travel', 'medical', 'tax', 'others_deduct', 'gross_salary'
    ];

    public function employee()
    {
        return $this->belongsTo(CandidateInterviewEvalution::class)->with('department','designation');
    }

    public function getDueAttribute() {

        return EmployeeAttendance::where('supplier_id', $this->id)->sum('due');
    }

    public function salaryChange($employee_id,$month , $year)
    {
        return SalaryChangeLog::where('employee_id',$employee_id)->whereMonth('for_month', $month)->whereYear('for_month', $year)->first();
    }

    public function PaymentHistory($employee_id,$month,$year)
    {
        return SalaryChangeLog::where('employee_id',$employee_id)->whereMonth('for_month', $month)->whereYear('for_month', $year)->first();
    }

    public function salaryProcess()
    {
        return $this->belongsTo(SalaryProcess::class, 'salary_process_id', 'id');
    }



}
