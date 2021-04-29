@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Employee Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Employee Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('employee.edit', ['employee' => $employee->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ empty(old('name')) ? ($errors->has('name') ? '' : $employee->name) : old('name') }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Employee ID *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Employee ID"
                                       name="employee_id" value="{{ $employee->employee_id }}" readonly>

                                @error('employee_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Date of Birth </label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="dob" name="date_of_birth"
                                           value="{{ empty(old('date_of_birth')) ? ($errors->has('date_of_birth') ? '' : $employee->dob) : old('date_of_birth') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('date_of_birth')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('interview_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Interview Date </label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right date-picker" name="interview_date"
                                           value="{{ empty(old('interview_date')) ? ($errors->has('interview_date') ? '' : $employee->interview_date) : old('interview_date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('interview_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('expected_joining_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Expected Joining Date </label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right date-picker" name="expected_joining_date"
                                           value="{{ empty(old('expected_joining_date')) ? ($errors->has('expected_joining_date') ? '' : $employee->expected_joining_date) : old('expected_joining_date') }}" autocomplete="off">

                                </div>
                                <!-- /.input group -->

                                @error('expected_joining_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('joining_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Joining Date </label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right date-picker" name="joining_date"
                                           value="{{ empty(old('joining_date')) ? ($errors->has('joining_date') ? '' : $employee->joining_date) : old('joining_date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('joining_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('confirmation_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Confirmation Date </label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right date-picker" name="confirmation_date"
                                           value="{{ empty(old('confirmation_date')) ? ($errors->has('confirmation_date') ? '' : $employee->confirmation_date) : old('confirmation_date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('confirmation_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('education_qualification') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Education Qualification </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Education Qualification"
                                       name="education_qualification" value="{{ empty(old('education_qualification')) ? ($errors->has('education_qualification') ? '' : $employee->education_qualification) : old('education_qualification') }}">

                                @error('education_qualification')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('department') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Department *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="department" id="department">
                                    <option value="">Select Department</option>

                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ empty(old('department')) ? ($errors->has('department') ? '' : ($employee->department_id == $department->id ? 'selected' : '')) :
                                            (old('department') == $department->id ? 'selected' : '') }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>

                                @error('department')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('designation') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Designation *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="designation" id="designation">
                                    <option value="">Select Designation</option>
                                </select>

                                @error('designation')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('employee_type') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Employee Type *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="employee_type" >
                                    <option value="">Select Employee Type</option>
                                    <option value="1" {{ empty(old('employee_type')) ? ($errors->has('employee_type') ? '' : ($employee->employee_type == '1' ? 'selected' : '')) :
                                            (old('employee_type') == '1' ? 'selected' : '') }}>Permanent</option>
                                    <option value="2" {{ empty(old('employee_type')) ? ($errors->has('employee_type') ? '' : ($employee->employee_type == '2' ? 'selected' : '')) :
                                            (old('employee_type') == '2' ? 'selected' : '') }}>Temporary</option>
                                </select>

                                @error('employee_type')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('gender') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Gender *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="gender" >
                                    <option value="">Select Gender</option>
                                    <option value="1" {{ empty(old('gender')) ? ($errors->has('gender') ? '' : ($employee->gender == '1' ? 'selected' : '')) :
                                            (old('gender') == '1' ? 'selected' : '') }}>Male</option>
                                    <option value="2" {{ empty(old('gender')) ? ($errors->has('gender') ? '' : ($employee->gender == '2' ? 'selected' : '')) :
                                            (old('gender') == '2' ? 'selected' : '') }}>Female</option>
                                </select>

                                @error('gender')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('marital_status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Marital Status *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="marital_status" >
                                    <option value="">Select Marital Status</option>
                                    <option value="1" {{ empty(old('marital_status')) ? ($errors->has('marital_status') ? '' : ($employee->marital_status == '1' ? 'selected' : '')) :
                                            (old('marital_status') == '1' ? 'selected' : '') }}>Single</option>
                                    <option value="2" {{ empty(old('marital_status')) ? ($errors->has('marital_status') ? '' : ($employee->marital_status == '2' ? 'selected' : '')) :
                                            (old('marital_status') == '2' ? 'selected' : '') }}>Married</option>
                                </select>

                                @error('marital_status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Mobile No. </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Mobile No."
                                       name="mobile_no" value="{{ empty(old('mobile_no')) ? ($errors->has('mobile_no') ? '' : $employee->mobile_no) : old('mobile_no') }}">

                                @error('mobile_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('father_name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Father Name </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Father Name"
                                       name="father_name" value="{{ empty(old('father_name')) ? ($errors->has('father_name') ? '' : $employee->father_name) : old('father_name') }}">

                                @error('father_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('mother_name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Mother Name </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Mother Name"
                                       name="mother_name" value="{{ empty(old('mother_name')) ? ($errors->has('mother_name') ? '' : $employee->mother_name) : old('mother_name') }}">

                                @error('mother_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('emergency_contact') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Emergency Contact *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Emergency Contact"
                                       name="emergency_contact" value="{{ empty(old('emergency_contact')) ? ($errors->has('emergency_contact') ? '' : $employee->emergency_contact) : old('emergency_contact') }}">

                                @error('emergency_contact')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('signature') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Signature</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="signature">

                                @error('signature')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('photo') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Photo</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photo">

                                @error('photo')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('present_address') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Present Address *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Present Address"
                                       name="present_address" value="{{ empty(old('present_address')) ? ($errors->has('present_address') ? '' : $employee->present_address) : old('present_address') }}">

                                @error('present_address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('permanent_address') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Permanent Address *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Permanent Address"
                                       name="permanent_address" value="{{ empty(old('permanent_address')) ? ($errors->has('permanent_address') ? '' : $employee->permanent_address) : old('permanent_address') }}">

                                @error('permanent_address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Email </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Email"
                                       name="email" value="{{ empty(old('email')) ? ($errors->has('email') ? '' : $employee->email) : old('email') }}">

                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('religion') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Religion *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="religion" >
                                    <option value="">Select Religion</option>
                                    <option value="1" {{ empty(old('religion')) ? ($errors->has('religion') ? '' : ($employee->religion == '1' ? 'selected' : '')) :
                                            (old('religion') == '1' ? 'selected' : '') }}>Muslim</option>
                                    <option value="2" {{ empty(old('religion')) ? ($errors->has('religion') ? '' : ($employee->religion == '2' ? 'selected' : '')) :
                                            (old('religion') == '2' ? 'selected' : '') }}>Hindu</option>
                                    <option value="3" {{ empty(old('religion')) ? ($errors->has('religion') ? '' : ($employee->religion == '3' ? 'selected' : '')) :
                                            (old('religion') == '3' ? 'selected' : '') }}>Christian</option>
                                    <option value="4" {{ empty(old('religion')) ? ($errors->has('religion') ? '' : ($employee->religion == '4' ? 'selected' : '')) :
                                            (old('religion') == '4' ? 'selected' : '') }}>Other</option>
                                </select>

                                @error('religion')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('cv') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">CV</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="cv">

                                @error('cv')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('expected_salary') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Expected Salary </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Expected Salary"
                                       name="expected_salary" value="{{ empty(old('expected_salary')) ? ($errors->has('expected_salary') ? '' : $employee->expected_salary) : old('expected_salary') }}">

                                @error('expected_salary')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('salary_offered') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Salary_Offered </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Offered Salary"
                                       name="salary_offered" value="{{ empty(old('salary_offered')) ? ($errors->has('salary_offered') ? '' : $employee->salary_offered) : old('salary_offered') }}">

                                @error('salary_offered')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('other_benefits') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Other Benefits </label>

                            <div class="col-md-10">
                                <textarea name="other_benefits" id="other_benefits" placeholder="Text Other Benefits" class="form-control">{{ $employee->other_benefits }}</textarea>

                                @error('other_benefits')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('any_condition') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Any Condition </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Any Condition"
                                       name="any_condition" value="{{ empty(old('any_condition')) ? ($errors->has('any_condition') ? '' : $employee->any_condition) : old('any_condition') }}">

                                @error('any_condition')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('required_company_unit') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Required Company Unit </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Offered Salary"
                                       name="required_company_unit" value="{{ empty(old('required_company_unit')) ? ($errors->has('required_company_unit') ? '' : $employee->required_company_unit) : old('required_company_unit') }}">

                                @error('required_company_unit')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('job_description') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Job_Description </label>

                            <div class="col-md-10">
                                <textarea name="job_description" id="job_description" placeholder="Job Description" class="form-control">{{ empty(old('job_description')) ? ($errors->has('job_description') ? '' : $employee->job_description) : old('job_description') }}</textarea>
                                @error('job_description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('dress_up') ? 'has-error' :'' }}">

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align: center;margin-bottom: 10px;" class="section">
                                        <strong><u>APPEARANCE</u></strong>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Dress Up</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($employee->dress_up == '1' ? 'checked' : '')) :
                                            (old('dress_up') == '1' ? 'checked' : '') }} name="dress_up">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($employee->dress_up == '2' ? 'checked' : '')) :
                                            (old('dress_up') == '2' ? 'checked' : '') }} name="dress_up">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($employee->dress_up == '3' ? 'checked' : '')) :
                                            (old('dress_up') == '3' ? 'checked' : '') }} name="dress_up">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($employee->dress_up == '4' ? 'checked' : '')) :
                                            (old('dress_up') == '4' ? 'checked' : '') }} name="dress_up">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($employee->dress_up == '5' ? 'checked' : '')) :
                                            (old('dress_up') == '5' ? 'checked' : '') }} name="dress_up">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Grooming Up</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($employee->grooming_up == '1' ? 'checked' : '')) :
                                            (old('grooming_up') == '1' ? 'checked' : '') }} name="grooming_up">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($employee->grooming_up == '2' ? 'checked' : '')) :
                                            (old('grooming_up') == '2' ? 'checked' : '') }} name="grooming_up">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($employee->grooming_up == '3' ? 'checked' : '')) :
                                            (old('grooming_up') == '3' ? 'checked' : '') }} name="grooming_up">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($employee->grooming_up == '4' ? 'checked' : '')) :
                                            (old('grooming_up') == '4' ? 'checked' : '') }} name="grooming_up">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($employee->grooming_up == '5' ? 'checked' : '')) :
                                            (old('grooming_up') == '5' ? 'checked' : '') }} name="grooming_up">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('body_language') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Body Language</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($employee->body_language == '1' ? 'checked' : '')) :
                                            (old('body_language') == '1' ? 'checked' : '') }} name="body_language">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($employee->body_language == '2' ? 'checked' : '')) :
                                            (old('body_language') == '2' ? 'checked' : '') }} name="body_language">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($employee->body_language == '3' ? 'checked' : '')) :
                                            (old('body_language') == '3' ? 'checked' : '') }} name="body_language">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($employee->body_language == '4' ? 'checked' : '')) :
                                            (old('body_language') == '4' ? 'checked' : '') }} name="body_language">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($employee->body_language == '5' ? 'checked' : '')) :
                                            (old('body_language') == '5' ? 'checked' : '') }} name="body_language">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Attitude</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($employee->attitude == '1' ? 'checked' : '')) :
                                            (old('attitude') == '1' ? 'checked' : '') }} name="attitude">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($employee->attitude == '2' ? 'checked' : '')) :
                                            (old('attitude') == '2' ? 'checked' : '') }} name="attitude">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($employee->attitude == '3' ? 'checked' : '')) :
                                            (old('attitude') == '3' ? 'checked' : '') }} name="attitude">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($employee->attitude == '4' ? 'checked' : '')) :
                                            (old('attitude') == '4' ? 'checked' : '') }} name="attitude">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($employee->attitude == '5' ? 'checked' : '')) :
                                            (old('attitude') == '5' ? 'checked' : '') }} name="attitude">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('personality') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Personality</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($employee->personality == '1' ? 'checked' : '')) :
                                            (old('personality') == '1' ? 'checked' : '') }} name="personality">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($employee->personality == '2' ? 'checked' : '')) :
                                            (old('personality') == '2' ? 'checked' : '') }} name="personality">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($employee->personality == '3' ? 'checked' : '')) :
                                            (old('personality') == '3' ? 'checked' : '') }} name="personality">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($employee->personality == '4' ? 'checked' : '')) :
                                            (old('personality') == '4' ? 'checked' : '') }} name="personality">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($employee->personality == '5' ? 'checked' : '')) :
                                            (old('personality') == '5' ? 'checked' : '') }} name="personality">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">CV Status</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($employee->cv_status == '1' ? 'checked' : '')) :
                                            (old('cv_status') == '5' ? 'checked' : '') }} name="cv_status">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($employee->cv_status == '2' ? 'checked' : '')) :
                                            (old('cv_status') == '5' ? 'checked' : '') }} name="cv_status">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($employee->cv_status == '3' ? 'checked' : '')) :
                                            (old('cv_status') == '5' ? 'checked' : '') }} name="cv_status">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($employee->cv_status == '4' ? 'checked' : '')) :
                                            (old('cv_status') == '5' ? 'checked' : '') }} name="cv_status">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio"value="5" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($employee->cv_status == '5' ? 'checked' : '')) :
                                            (old('cv_status') == '5' ? 'checked' : '') }} name="cv_status">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center;margin-bottom: 10px;margin-top: 10px;" class="section">
                                    <strong><u>QUALIFICATION</u></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('educational_qualification') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Educational Qualification</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($employee->educational_qualification == '1' ? 'checked' : '')) :
                                            (old('educational_qualification') == '1' ? 'checked' : '') }} name="educational_qualification">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($employee->educational_qualification == '2' ? 'checked' : '')) :
                                            (old('educational_qualification') == '2' ? 'checked' : '') }} name="educational_qualification">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($employee->educational_qualification == '3' ? 'checked' : '')) :
                                            (old('educational_qualification') == '3' ? 'checked' : '') }} name="educational_qualification">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($employee->educational_qualification == '4' ? 'checked' : '')) :
                                            (old('educational_qualification') == '4' ? 'checked' : '') }} name="educational_qualification">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($employee->educational_qualification == '5' ? 'checked' : '')) :
                                            (old('educational_qualification') == '5' ? 'checked' : '') }} name="educational_qualification">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Professional Qualification</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($employee->professional_qualification == '1' ? 'checked' : '')) :
                                            (old('professional_qualification') == '1' ? 'checked' : '') }} name="professional_qualification">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($employee->professional_qualification == '2' ? 'checked' : '')) :
                                            (old('professional_qualification') == '2' ? 'checked' : '') }} name="professional_qualification">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($employee->professional_qualification == '3' ? 'checked' : '')) :
                                            (old('professional_qualification') == '3' ? 'checked' : '') }} name="professional_qualification">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($employee->professional_qualification == '4' ? 'checked' : '')) :
                                            (old('professional_qualification') == '4' ? 'checked' : '') }} name="professional_qualification">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($employee->professional_qualification == '5' ? 'checked' : '')) :
                                            (old('professional_qualification') == '5' ? 'checked' : '') }} name="professional_qualification">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('training_and_others') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Training and Others
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($employee->training_and_others == '1' ? 'checked' : '')) :
                                            (old('training_and_others') == '1' ? 'checked' : '') }} name="training_and_others">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($employee->training_and_others == '2' ? 'checked' : '')) :
                                            (old('training_and_others') == '2' ? 'checked' : '') }} name="training_and_others">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($employee->training_and_others == '3' ? 'checked' : '')) :
                                            (old('training_and_others') == '3' ? 'checked' : '') }} name="training_and_others">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($employee->training_and_others == '4' ? 'checked' : '')) :
                                            (old('training_and_others') == '4' ? 'checked' : '') }} name="training_and_others">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($employee->training_and_others == '5' ? 'checked' : '')) :
                                            (old('training_and_others') == '5' ? 'checked' : '') }} name="training_and_others">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Award Recogntion</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($employee->award_recogntion == '1' ? 'checked' : '')) :
                                            (old('award_recogntion') == '1' ? 'checked' : '') }} name="award_recogntion">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($employee->award_recogntion == '2' ? 'checked' : '')) :
                                            (old('award_recogntion') == '2' ? 'checked' : '') }} name="award_recogntion">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($employee->award_recogntion == '3' ? 'checked' : '')) :
                                            (old('award_recogntion') == '3' ? 'checked' : '') }} name="award_recogntion">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($employee->award_recogntion == '4' ? 'checked' : '')) :
                                            (old('award_recogntion') == '4' ? 'checked' : '') }} name="award_recogntion">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($employee->award_recogntion == '5' ? 'checked' : '')) :
                                            (old('award_recogntion') == '5' ? 'checked' : '') }} name="award_recogntion">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center;margin-bottom: 10px;margin-top: 10px;" class="section">
                                    <strong><u>EXPERIENCE</u></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('relevent_experience') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Relevent Experience
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($employee->relevent_experience == '1' ? 'checked' : '')) :
                                            (old('relevent_experience') == '1' ? 'checked' : '') }} name="relevent_experience">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($employee->relevent_experience == '2' ? 'checked' : '')) :
                                            (old('relevent_experience') == '2' ? 'checked' : '') }} name="relevent_experience">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($employee->relevent_experience == '3' ? 'checked' : '')) :
                                            (old('relevent_experience') == '3' ? 'checked' : '') }} name="relevent_experience">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($employee->relevent_experience == '4' ? 'checked' : '')) :
                                            (old('relevent_experience') == '4' ? 'checked' : '') }} name="relevent_experience">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($employee->relevent_experience == '5' ? 'checked' : '')) :
                                            (old('relevent_experience') == '5' ? 'checked' : '') }} name="relevent_experience">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Professional Achievements</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($employee->professional_achievements == '1' ? 'checked' : '')) :
                                            (old('professional_achievements') == '1' ? 'checked' : '') }} name="professional_achievements">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($employee->professional_achievements == '2' ? 'checked' : '')) :
                                            (old('professional_achievements') == '2' ? 'checked' : '') }} name="professional_achievements">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($employee->professional_achievements == '3' ? 'checked' : '')) :
                                            (old('professional_achievements') == '3' ? 'checked' : '') }} name="professional_achievements">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($employee->professional_achievements == '4' ? 'checked' : '')) :
                                            (old('professional_achievements') == '4' ? 'checked' : '') }} name="professional_achievements">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($employee->professional_achievements == '5' ? 'checked' : '')) :
                                            (old('professional_achievements') == '5' ? 'checked' : '') }} name="professional_achievements">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('potentiality') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Potentiality</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($employee->potentiality == '1' ? 'checked' : '')) :
                                            (old('potentiality') == '1' ? 'checked' : '') }} name="potentiality">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($employee->potentiality == '2' ? 'checked' : '')) :
                                            (old('potentiality') == '2' ? 'checked' : '') }} name="potentiality">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($employee->potentiality == '3' ? 'checked' : '')) :
                                            (old('potentiality') == '3' ? 'checked' : '') }} name="potentiality">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($employee->potentiality == '4' ? 'checked' : '')) :
                                            (old('potentiality') == '4' ? 'checked' : '') }} name="potentiality">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($employee->potentiality == '5' ? 'checked' : '')) :
                                            (old('potentiality') == '5' ? 'checked' : '') }} name="potentiality">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div style="text-align: center;margin-bottom: 10px;margin-top: 10px;" class="section">
                                        <strong><u>COMMUNICATION</u></strong>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Oral Communication</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($employee->oral_communication == '1' ? 'checked' : '')) :
                                            (old('oral_communication') == '1' ? 'checked' : '') }} name="oral_communication">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($employee->oral_communication == '2' ? 'checked' : '')) :
                                            (old('oral_communication') == '2' ? 'checked' : '') }} name="oral_communication">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($employee->oral_communication == '3' ? 'checked' : '')) :
                                            (old('oral_communication') == '3' ? 'checked' : '') }} name="oral_communication">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($employee->oral_communication == '4' ? 'checked' : '')) :
                                            (old('oral_communication') == '4' ? 'checked' : '') }} name="oral_communication">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($employee->oral_communication == '5' ? 'checked' : '')) :
                                            (old('oral_communication') == '5' ? 'checked' : '') }} name="oral_communication">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('dress_up') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Eye Contact
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($employee->eye_contact == '1' ? 'checked' : '')) :
                                            (old('eye_contact') == '1' ? 'checked' : '') }} name="eye_contact">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($employee->eye_contact == '2' ? 'checked' : '')) :
                                            (old('eye_contact') == '2' ? 'checked' : '') }} name="eye_contact">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($employee->eye_contact == '3' ? 'checked' : '')) :
                                            (old('eye_contact') == '3' ? 'checked' : '') }} name="eye_contact">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($employee->eye_contact == '4' ? 'checked' : '')) :
                                            (old('eye_contact') == '4' ? 'checked' : '') }} name="eye_contact">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($employee->eye_contact == '5' ? 'checked' : '')) :
                                            (old('eye_contact') == '5' ? 'checked' : '') }} name="eye_contact">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Language Proficiency</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1"{{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($employee->language_proficiency == '1' ? 'checked' : '')) :
                                            (old('language_proficiency') == '1' ? 'checked' : '') }} name="language_proficiency">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($employee->language_proficiency == '2' ? 'checked' : '')) :
                                            (old('language_proficiency') == '2' ? 'checked' : '') }} name="language_proficiency">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($employee->language_proficiency == '3' ? 'checked' : '')) :
                                            (old('language_proficiency') == '3' ? 'checked' : '') }} name="language_proficiency">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($employee->language_proficiency == '4' ? 'checked' : '')) :
                                            (old('language_proficiency') == '4' ? 'checked' : '') }} name="language_proficiency">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($employee->language_proficiency == '5' ? 'checked' : '')) :
                                            (old('language_proficiency') == '5' ? 'checked' : '') }} name="language_proficiency">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center;margin-bottom: 10px;margin-top: 10px;" class="section">
                                    <strong><u>Skill</u></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('dress_up') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Computer Skill
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($employee->computer_skill == '1' ? 'checked' : '')) :
                                            (old('computer_skill') == '1' ? 'checked' : '') }} name="computer_skill">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($employee->computer_skill == '2' ? 'checked' : '')) :
                                            (old('computer_skill') == '2' ? 'checked' : '') }} name="computer_skill">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($employee->computer_skill == '3' ? 'checked' : '')) :
                                            (old('computer_skill') == '3' ? 'checked' : '') }} name="computer_skill">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($employee->computer_skill == '4' ? 'checked' : '')) :
                                            (old('computer_skill') == '4' ? 'checked' : '') }} name="computer_skill">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($employee->computer_skill == '5' ? 'checked' : '')) :
                                            (old('computer_skill') == '5' ? 'checked' : '') }} name="computer_skill">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Interpersonal Skill</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($employee->interpersonal_skill == '1' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '1' ? 'checked' : '') }} name="interpersonal_skill">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($employee->interpersonal_skill == '2' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '2' ? 'checked' : '') }} name="interpersonal_skill">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($employee->interpersonal_skill == '3' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '3' ? 'checked' : '') }} name="interpersonal_skill">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($employee->interpersonal_skill == '4' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '4' ? 'checked' : '') }} name="interpersonal_skill">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($employee->interpersonal_skill == '5' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '5' ? 'checked' : '') }} name="interpersonal_skill">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center;margin-bottom: 10px;margin-top: 10px;" class="section">
                                    <strong><u>KNOWLEDGE</u></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('job_knowledge') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Job Knowledge
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($employee->job_knowledge == '1' ? 'checked' : '')) :
                                            (old('job_knowledge') == '1' ? 'checked' : '') }} name="job_knowledge">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($employee->job_knowledge == '2' ? 'checked' : '')) :
                                            (old('job_knowledge') == '2' ? 'checked' : '') }} name="job_knowledge">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($employee->job_knowledge == '3' ? 'checked' : '')) :
                                            (old('job_knowledge') == '3' ? 'checked' : '') }} name="job_knowledge">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($employee->job_knowledge == '4' ? 'checked' : '')) :
                                            (old('job_knowledge') == '4' ? 'checked' : '') }} name="job_knowledge">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($employee->job_knowledge == '5' ? 'checked' : '')) :
                                            (old('job_knowledge') == '5' ? 'checked' : '') }} name="job_knowledge">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Genetal Knowledge</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($employee->general_knowledge == '1' ? 'checked' : '')) :
                                            (old('general_knowledge') == '1' ? 'checked' : '') }} name="general_knowledge">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($employee->general_knowledge == '2' ? 'checked' : '')) :
                                            (old('general_knowledge') == '2' ? 'checked' : '') }} name="general_knowledge">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($employee->general_knowledge == '3' ? 'checked' : '')) :
                                            (old('general_knowledge') == '3' ? 'checked' : '') }} name="general_knowledge">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($employee->general_knowledge == '4' ? 'checked' : '')) :
                                            (old('general_knowledge') == '4' ? 'checked' : '') }} name="general_knowledge">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($employee->general_knowledge == '5' ? 'checked' : '')) :
                                            (old('general_knowledge') == '5' ? 'checked' : '') }} name="general_knowledge">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center;margin-bottom: 10px;margin-top: 10px;" class="section">
                                    <strong><u>OTHERS</u></strong>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('family_background') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Family Background</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($employee->family_background == '1' ? 'checked' : '')) :
                                            (old('family_background') == '1' ? 'checked' : '') }} name="family_background">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($employee->family_background == '2' ? 'checked' : '')) :
                                            (old('family_background') == '2' ? 'checked' : '') }} name="family_background">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($employee->family_background == '3' ? 'checked' : '')) :
                                            (old('family_background') == '3' ? 'checked' : '') }} name="family_background">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($employee->family_background == '4' ? 'checked' : '')) :
                                            (old('family_background') == '4' ? 'checked' : '') }} name="family_background">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($employee->family_background == '5' ? 'checked' : '')) :
                                            (old('family_background') == '5' ? 'checked' : '') }} name="family_background">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Wllingness to Learn</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($employee->wllingness_to_learn == '1' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '1' ? 'checked' : '') }} name="wllingness_to_learn">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($employee->wllingness_to_learn == '2' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '2' ? 'checked' : '') }} name="wllingness_to_learn">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($employee->wllingness_to_learn == '3' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '3' ? 'checked' : '') }} name="wllingness_to_learn">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($employee->wllingness_to_learn == '4' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '4' ? 'checked' : '') }}  name="wllingness_to_learn">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($employee->wllingness_to_learn == '5' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '5' ? 'checked' : '') }} name="wllingness_to_learn">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('long_term_objectives') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Long term Objectives
                            </label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($employee->long_term_objectives == '1' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '1' ? 'checked' : '') }} name="long_term_objectives">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($employee->long_term_objectives == '2' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '2' ? 'checked' : '') }} name="long_term_objectives">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($employee->long_term_objectives == '3' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '3' ? 'checked' : '') }} name="long_term_objectives">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($employee->long_term_objectives == '4' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '4' ? 'checked' : '') }} name="long_term_objectives">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($employee->long_term_objectives == '5' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '5' ? 'checked' : '') }} name="long_term_objectives">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">Team Skill</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($employee->team_skill == '1' ? 'checked' : '')) :
                                            (old('team_skill') == '5' ? 'checked' : '') }} name="team_skill">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($employee->team_skill == '2' ? 'checked' : '')) :
                                            (old('team_skill') == '5' ? 'checked' : '') }} name="team_skill">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($employee->team_skill == '3' ? 'checked' : '')) :
                                            (old('team_skill') == '5' ? 'checked' : '') }} name="team_skill">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($employee->team_skill == '4' ? 'checked' : '')) :
                                            (old('team_skill') == '5' ? 'checked' : '') }} name="team_skill">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($employee->team_skill == '5' ? 'checked' : '')) :
                                            (old('team_skill') == '5' ? 'checked' : '') }} name="team_skill">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('working_planing_skill') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Working Planing Skill</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="margin-top: 7px;" class="input-group-text">
                                            <input type="radio" value="1" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($employee->working_planing_skill == '1' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '1' ? 'checked' : '') }} name="working_planing_skill">
                                            <span style="margin-left: 2px;">1</span>
                                            <input style="margin-left: 35px;" type="radio" value="2" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($employee->working_planing_skill == '2' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '2' ? 'checked' : '') }} name="working_planing_skill">
                                            <span style="margin-left: 2px;">2</span>
                                            <input style="margin-left: 35px;" type="radio" value="3" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($employee->working_planing_skill == '3' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '3' ? 'checked' : '') }} name="working_planing_skill">
                                            <span  style="margin-left: 2px;">3</span>
                                            <input style="margin-left: 35px;" type="radio" value="4" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($employee->working_planing_skill == '4' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '4' ? 'checked' : '') }} name="working_planing_skill">
                                            <span style="margin-left: 2px;">4</span>
                                            <input style="margin-left: 35px;" type="radio" value="5" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($employee->working_planing_skill == '5' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '5' ? 'checked' : '') }} name="working_planing_skill">
                                            <span style="margin-left: 2px;">5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status *</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($department->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($department->status == '0' ? 'checked' : '')) :
                                            (old('status') == '0' ? 'checked' : '') }}>
                                        Inactive
                                    </label>
                                </div>

                                @error('status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {
            //Date picker
            $('#dob').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                orientation: 'bottom'
            });

            $('.date-picker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            });

            var designationSelected = '{{ empty(old('designation')) ? ($errors->has('designation') ? '' : $employee->designation_id) : old('designation') }}';

            $('#department').change(function () {
                var departmentId = $(this).val();
                $('#designation').html('<option value="">Select Designation</option>');

                if (departmentId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_designation') }}",
                        data: { departmentId: departmentId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (designationSelected == item.id)
                                $('#designation').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#designation').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#department').trigger('change');

            $('#salary_in_jolshiri').change(function () {
                var value = $(this).val();

                if (value == 1) {
                    $('#salary').show();
                } else {
                    $('#salary').hide();
                }
            });

            $('#salary_in_jolshiri').trigger('change');
        });
    </script>
@endsection
