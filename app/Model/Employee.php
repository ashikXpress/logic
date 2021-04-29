<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'employee_id', 'dob', 'joining_date', 'confirmation_date',
        'department_id', 'designation_id', 'employee_type', 'reporting_to', 'gender', 'marital_status',
        'mobile_no', 'father_name', 'mother_name', 'emergency_contact', 'signature', 'photo',
        'present_address', 'permanent_address', 'email', 'religion', 'cv',
        'medical', 'travel', 'house_rent', 'basic_salary', 'tax', 'others_deduct',
        'gross_salary','bank_account','category_id','previous_salary'
    ];

    protected $dates = ['dob', 'joining_date', 'confirmation_date'];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function designationLogs() {
        return $this->hasMany(DesignationLog::class)->orderBy('date', 'desc')->orderBy('created_at', 'desc');
    }

    public function salaryChangeLog() {
        return $this->hasMany(SalaryChangeLog::class)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function leaves() {
        return $this->hasMany(Leave::class);
    }

    public function employee()
    {
        return $this->belongsTo(AttendanceProcess::class)->with('designation','department');
    }
}
