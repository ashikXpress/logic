
@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@endsection

@section('title')
    Candidate Evalution Form
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                        <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic & Training</a></li>
                        <li><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>
                        <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                        <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                        <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                        <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                        <li class="active"><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                        <li><a href="#leave">User Account</a></li>
                        <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                    </ul>
                    <!-- /.tab-content -->
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Candidate Evalution Information</h3>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="font-size: 20px;" class="text-center" width="100%" scope="col">CANDIDATE INTERVIEW EVALUATION FORM</th>

                    </tr>
                    </thead>

                </table>

                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('candidate_evalution_form.edit',['candidate' => $candidate->id]) }}">
                    @csrf

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Name *</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ empty(old('name')) ? ($errors->has('name') ? '' : $candidate->name) : old('name') }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" {{ $errors->has('department') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Department *</label>

                                <div class="col-md-4">
                                    <select class="form-control" name="department" id="department">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ empty(old('department')) ? ($errors->has('department') ? '' : ($candidate->department_id == $department->id ? 'selected' : '')) :
                                            (old('department') == $department->id ? 'selected' : '') }}>{{ $department->name }}</option>
                                        @endforeach

                                    </select>

                                    @error('department')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Mobile No.* </label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Mobile No."
                                       name="mobile_no" value="{{ empty(old('mobile_no')) ? ($errors->has('mobile_no') ? '' : $candidate->mobile_no) : old('mobile_no') }}">

                                @error('mobile_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" {{ $errors->has('designation') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Designation *</label>

                                <div class="col-md-4">
                                    <select class="form-control" name="designation" id="designation">
                                        <option value="">Select Designation</option>
                                    </select>

                                    @error('designation')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Email * </label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Email"
                                       name="email" value="{{ empty(old('email')) ? ($errors->has('email') ? '' : $candidate->email) : old('email') }}">

                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" {{ $errors->has('expected_salary') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Expected Salary </label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Enter Expected Salary"
                                           name="expected_salary" value="{{ empty(old('expected_salary')) ? ($errors->has('expected_salary') ? '' : $candidate->expected_salary) : old('expected_salary') }}">

                                    @error('expected_salary')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('interview_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Interview Date </label>

                            <div class="col-sm-4">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right date-picker" name="interview_date"
                                           value="{{ empty(old('interview_date')) ? ($errors->has('interview_date') ? '' : $candidate->interview_date) : old('interview_date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('interview_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" {{ $errors->has('current_salary') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Current Salary </label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Enter Current Salary"
                                           name="current_salary" value="{{ empty(old('current_salary')) ? ($errors->has('current_salary') ? '' : $candidate->current_salary) : old('current_salary') }}">
                                    @error('current_salary')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fathers_name') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Fathers Name *</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Fathers Name"
                                       name="fathers_name" value="{{ empty(old('fathers_name')) ? ($errors->has('fathers_name') ? '' : $candidate->fathers_name) : old('fathers_name') }}">

                                @error('fathers_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" {{ $errors->has('employee_id') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Employee Id </label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control"
                                           name="employee_id" value="{{ $candidate->employee_id }}" readonly>
                                    @error('employee_id')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered">

                        <thead class="thead-light ">
                        <tr>
                            <th class="text-center" width="25%" scope="col">APPEARANCE </th>
                            <th class="text-center" width="7.14%" scope="col">ONE</th>
                            <th class="text-center" width="7.14%" scope="col">TWO</th>
                            <th class="text-center" width="7.14%" scope="col">THREE</th>
                            <th class="text-center" width="7.14%" scope="col">FOUR</th>
                            <th class="text-center" width="7.14%" scope="col">FIVE</th>
                            <th class="text-center" width="35%" scope="col">REMARKS</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td></td>
                            <td class="text-center">1</td>
                            <td class="text-center">2</td>
                            <td class="text-center">3</td>
                            <td class="text-center">4</td>
                            <td class="text-center">5</td>
                            <td ></td>
                        </tr>

                        <tr>
                            <td >Dress Up</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($candidate->dress_up == '1' ? 'checked' : '')) :
                                            (old('dress_up') == '1' ? 'checked' : '') }} name="dress_up"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($candidate->dress_up == '2' ? 'checked' : '')) :
                                            (old('dress_up') == '2' ? 'checked' : '') }} name="dress_up"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($candidate->dress_up == '3' ? 'checked' : '')) :
                                            (old('dress_up') == '3' ? 'checked' : '') }} name="dress_up"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($candidate->dress_up == '4' ? 'checked' : '')) :
                                            (old('dress_up') == '4' ? 'checked' : '') }} name="dress_up"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('dress_up')) ? ($errors->has('dress_up') ? '' : ($candidate->dress_up == '5' ? 'checked' : '')) :
                                            (old('dress_up') == '5' ? 'checked' : '') }} name="dress_up"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="dress_up_remarks" value="{{ $candidate->dress_up_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Grooming Up</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($candidate->grooming_up == '1' ? 'checked' : '')) :
                                            (old('grooming_up') == '1' ? 'checked' : '') }} name="grooming_up"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($candidate->grooming_up == '2' ? 'checked' : '')) :
                                            (old('grooming_up') == '2' ? 'checked' : '') }} name="grooming_up"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($candidate->grooming_up == '3' ? 'checked' : '')) :
                                            (old('grooming_up') == '3' ? 'checked' : '') }} name="grooming_up"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($candidate->grooming_up == '4' ? 'checked' : '')) :
                                            (old('grooming_up') == '4' ? 'checked' : '') }} name="grooming_up"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('grooming_up')) ? ($errors->has('grooming_up') ? '' : ($candidate->grooming_up == '5' ? 'checked' : '')) :
                                            (old('grooming_up') == '5' ? 'checked' : '') }} name="grooming_up"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="grooming_up_remarks" value="{{ $candidate->grooming_up_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Body Language</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($candidate->body_language == '1' ? 'checked' : '')) :
                                            (old('body_language') == '1' ? 'checked' : '') }} name="body_language"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($candidate->body_language == '2' ? 'checked' : '')) :
                                            (old('body_language') == '2' ? 'checked' : '') }} name="body_language"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($candidate->body_language == '3' ? 'checked' : '')) :
                                            (old('body_language') == '3' ? 'checked' : '') }} name="body_language"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($candidate->body_language == '4' ? 'checked' : '')) :
                                            (old('body_language') == '4' ? 'checked' : '') }} name="body_language"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('body_language')) ? ($errors->has('body_language') ? '' : ($candidate->body_language == '5' ? 'checked' : '')) :
                                            (old('body_language') == '5' ? 'checked' : '') }} name="body_language"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="body_language_remarks" value="{{ $candidate->body_language_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Attitude</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($candidate->attitude == '1' ? 'checked' : '')) :
                                            (old('attitude') == '1' ? 'checked' : '') }} name="attitude"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($candidate->attitude == '2' ? 'checked' : '')) :
                                            (old('attitude') == '2' ? 'checked' : '') }} name="attitude"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($candidate->attitude == '3' ? 'checked' : '')) :
                                            (old('attitude') == '3' ? 'checked' : '') }} name="attitude"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($candidate->attitude == '4' ? 'checked' : '')) :
                                            (old('attitude') == '4' ? 'checked' : '') }} name="attitude"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('attitude')) ? ($errors->has('attitude') ? '' : ($candidate->attitude == '5' ? 'checked' : '')) :
                                            (old('attitude') == '5' ? 'checked' : '') }} name="attitude"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="attitude_remarks" value="{{ $candidate->attitude_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Personality</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($candidate->personality == '1' ? 'checked' : '')) :
                                            (old('personality') == '1' ? 'checked' : '') }} name="personality"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($candidate->personality == '2' ? 'checked' : '')) :
                                            (old('personality') == '2' ? 'checked' : '') }} name="personality"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($candidate->personality == '3' ? 'checked' : '')) :
                                            (old('personality') == '3' ? 'checked' : '') }} name="personality"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($candidate->personality == '4' ? 'checked' : '')) :
                                            (old('personality') == '4' ? 'checked' : '') }} name="personality"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('personality')) ? ($errors->has('personality') ? '' : ($candidate->personality == '5' ? 'checked' : '')) :
                                            (old('personality') == '5' ? 'checked' : '') }} name="personality"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="personality_remarks" value="{{ $candidate->personality_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >CV Status</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($candidate->cv_status == '1' ? 'checked' : '')) :
                                            (old('cv_status') == '1' ? 'checked' : '') }} name="cv_status"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($candidate->cv_status == '2' ? 'checked' : '')) :
                                            (old('cv_status') == '2' ? 'checked' : '') }} name="cv_status"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($candidate->cv_status == '3' ? 'checked' : '')) :
                                            (old('cv_status') == '3' ? 'checked' : '') }} name="cv_status"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($candidate->cv_status == '4' ? 'checked' : '')) :
                                            (old('cv_status') == '4' ? 'checked' : '') }} name="cv_status"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('cv_status')) ? ($errors->has('cv_status') ? '' : ($candidate->cv_status == '5' ? 'checked' : '')) :
                                            (old('cv_status') == '5' ? 'checked' : '') }} name="cv_status"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="cv_status_remarks" value="{{ $candidate->cv_status_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>QUALIFICATION</strong></td>
                        </tr>

                        <tr>
                            <td > Educational Qualification</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($candidate->educational_qualification == '1' ? 'checked' : '')) :
                                            (old('educational_qualification') == '1' ? 'checked' : '') }} name="educational_qualification"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($candidate->educational_qualification == '2' ? 'checked' : '')) :
                                            (old('educational_qualification') == '2' ? 'checked' : '') }} name="educational_qualification"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($candidate->educational_qualification == '3' ? 'checked' : '')) :
                                            (old('educational_qualification') == '3' ? 'checked' : '') }} name="educational_qualification"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($candidate->educational_qualification == '4' ? 'checked' : '')) :
                                            (old('educational_qualification') == '4' ? 'checked' : '') }} name="educational_qualification"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('educational_qualification')) ? ($errors->has('educational_qualification') ? '' : ($candidate->educational_qualification == '5' ? 'checked' : '')) :
                                            (old('educational_qualification') == '5' ? 'checked' : '') }} name="educational_qualification"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="educational_qualification_remarks" value="{{ $candidate->educational_qualification_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Professional Qualification</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($candidate->professional_qualification == '1' ? 'checked' : '')) :
                                            (old('professional_qualification') == '1' ? 'checked' : '') }} name="professional_qualification"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($candidate->professional_qualification == '2' ? 'checked' : '')) :
                                            (old('professional_qualification') == '2' ? 'checked' : '') }} name="professional_qualification"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($candidate->professional_qualification == '3' ? 'checked' : '')) :
                                            (old('professional_qualification') == '3' ? 'checked' : '') }} name="professional_qualification"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($candidate->professional_qualification == '4' ? 'checked' : '')) :
                                            (old('professional_qualification') == '4' ? 'checked' : '') }} name="professional_qualification"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('professional_qualification')) ? ($errors->has('professional_qualification') ? '' : ($candidate->professional_qualification == '5' ? 'checked' : '')) :
                                            (old('professional_qualification') == '5' ? 'checked' : '') }} name="professional_qualification"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="professional_qualification_remarks" value="{{ $candidate->professional_qualification_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Training and Others</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($candidate->training_and_others == '1' ? 'checked' : '')) :
                                            (old('training_and_others') == '1' ? 'checked' : '') }} name="training_and_others"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($candidate->training_and_others == '2' ? 'checked' : '')) :
                                            (old('training_and_others') == '2' ? 'checked' : '') }} name="training_and_others"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($candidate->training_and_others == '3' ? 'checked' : '')) :
                                            (old('training_and_others') == '3' ? 'checked' : '') }} name="training_and_others"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($candidate->training_and_others == '4' ? 'checked' : '')) :
                                            (old('training_and_others') == '4' ? 'checked' : '') }} name="training_and_others"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('training_and_others')) ? ($errors->has('training_and_others') ? '' : ($candidate->training_and_others == '5' ? 'checked' : '')) :
                                            (old('training_and_others') == '5' ? 'checked' : '') }} name="training_and_others"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="training_and_others_remarks" value="{{ $candidate->training_and_others_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Award Recogntion</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($candidate->award_recogntion == '1' ? 'checked' : '')) :
                                            (old('award_recogntion') == '1' ? 'checked' : '') }} name="award_recogntion"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($candidate->award_recogntion == '2' ? 'checked' : '')) :
                                            (old('award_recogntion') == '2' ? 'checked' : '') }} name="award_recogntion"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($candidate->award_recogntion == '3' ? 'checked' : '')) :
                                            (old('award_recogntion') == '3' ? 'checked' : '') }} name="award_recogntion"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($candidate->award_recogntion == '4' ? 'checked' : '')) :
                                            (old('award_recogntion') == '4' ? 'checked' : '') }} name="award_recogntion"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('award_recogntion')) ? ($errors->has('award_recogntion') ? '' : ($candidate->award_recogntion == '5' ? 'checked' : '')) :
                                            (old('award_recogntion') == '5' ? 'checked' : '') }} name="award_recogntion"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="award_recogntion_remarks" value="{{ $candidate->award_recogntion_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>EXPERIENCE</strong></td>
                        </tr>

                        <tr>
                            <td >Relevent Experience</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($candidate->relevent_experience == '1' ? 'checked' : '')) :
                                            (old('relevent_experience') == '1' ? 'checked' : '') }} name="relevent_experience"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($candidate->relevent_experience == '2' ? 'checked' : '')) :
                                            (old('relevent_experience') == '2' ? 'checked' : '') }} name="relevent_experience"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($candidate->relevent_experience == '3' ? 'checked' : '')) :
                                            (old('relevent_experience') == '3' ? 'checked' : '') }} name="relevent_experience"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($candidate->relevent_experience == '4' ? 'checked' : '')) :
                                            (old('relevent_experience') == '4' ? 'checked' : '') }} name="relevent_experience"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('relevent_experience')) ? ($errors->has('relevent_experience') ? '' : ($candidate->relevent_experience == '5' ? 'checked' : '')) :
                                            (old('relevent_experience') == '5' ? 'checked' : '') }} name="relevent_experience"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="relevent_experience_remarks" value="{{ $candidate->relevent_experience_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Professional Achievements</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($candidate->professional_achievements == '1' ? 'checked' : '')) :
                                            (old('professional_achievements') == '1' ? 'checked' : '') }} name="professional_achievements"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($candidate->professional_achievements == '2' ? 'checked' : '')) :
                                            (old('professional_achievements') == '2' ? 'checked' : '') }} name="professional_achievements"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($candidate->professional_achievements == '3' ? 'checked' : '')) :
                                            (old('professional_achievements') == '3' ? 'checked' : '') }} name="professional_achievements"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($candidate->professional_achievements == '4' ? 'checked' : '')) :
                                            (old('professional_achievements') == '4' ? 'checked' : '') }} name="professional_achievements"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('professional_achievements')) ? ($errors->has('professional_achievements') ? '' : ($candidate->professional_achievements == '5' ? 'checked' : '')) :
                                            (old('professional_achievements') == '5' ? 'checked' : '') }} name="professional_achievements"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="professional_achievements_remarks" value="{{ $candidate->professional_achievements_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Potentiality</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($candidate->potentiality == '1' ? 'checked' : '')) :
                                            (old('potentiality') == '1' ? 'checked' : '') }} name="potentiality"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($candidate->potentiality == '2' ? 'checked' : '')) :
                                            (old('potentiality') == '2' ? 'checked' : '') }} name="potentiality"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($candidate->potentiality == '3' ? 'checked' : '')) :
                                            (old('potentiality') == '3' ? 'checked' : '') }} name="potentiality"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($candidate->potentiality == '4' ? 'checked' : '')) :
                                            (old('potentiality') == '4' ? 'checked' : '') }} name="potentiality"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('potentiality')) ? ($errors->has('potentiality') ? '' : ($candidate->potentiality == '5' ? 'checked' : '')) :
                                            (old('potentiality') == '5' ? 'checked' : '') }} name="potentiality"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="potentiality_remarks" value="{{ $candidate->potentiality_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>COMMUNICATION</strong></td>
                        </tr>

                        <tr>
                            <td >Oral Communication</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($candidate->oral_communication == '1' ? 'checked' : '')) :
                                            (old('oral_communication') == '1' ? 'checked' : '') }} name="oral_communication"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($candidate->oral_communication == '2' ? 'checked' : '')) :
                                            (old('oral_communication') == '2' ? 'checked' : '') }} name="oral_communication"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($candidate->oral_communication == '3' ? 'checked' : '')) :
                                            (old('oral_communication') == '3' ? 'checked' : '') }} name="oral_communication"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($candidate->oral_communication == '4' ? 'checked' : '')) :
                                            (old('oral_communication') == '4' ? 'checked' : '') }} name="oral_communication"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('oral_communication')) ? ($errors->has('oral_communication') ? '' : ($candidate->oral_communication == '5' ? 'checked' : '')) :
                                            (old('oral_communication') == '5' ? 'checked' : '') }} name="oral_communication"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="oral_communication_remarks" value="{{ $candidate->oral_communication_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Eye Contact</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($candidate->eye_contact == '1' ? 'checked' : '')) :
                                            (old('eye_contact') == '1' ? 'checked' : '') }} name="eye_contact"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($candidate->eye_contact == '2' ? 'checked' : '')) :
                                            (old('eye_contact') == '2' ? 'checked' : '') }} name="eye_contact"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($candidate->eye_contact == '3' ? 'checked' : '')) :
                                            (old('eye_contact') == '3' ? 'checked' : '') }} name="eye_contact"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($candidate->eye_contact == '4' ? 'checked' : '')) :
                                            (old('eye_contact') == '4' ? 'checked' : '') }} name="eye_contact"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('eye_contact')) ? ($errors->has('eye_contact') ? '' : ($candidate->eye_contact == '5' ? 'checked' : '')) :
                                            (old('eye_contact') == '5' ? 'checked' : '') }} name="eye_contact"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="eye_contact_remarks" value="{{ $candidate->eye_contact_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Language Proficiency</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($candidate->language_proficiency == '1' ? 'checked' : '')) :
                                            (old('language_proficiency') == '1' ? 'checked' : '') }} name="language_proficiency"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($candidate->language_proficiency == '2' ? 'checked' : '')) :
                                            (old('language_proficiency') == '2' ? 'checked' : '') }} name="language_proficiency"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($candidate->language_proficiency == '3' ? 'checked' : '')) :
                                            (old('language_proficiency') == '3' ? 'checked' : '') }} name="language_proficiency"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($candidate->language_proficiency == '4' ? 'checked' : '')) :
                                            (old('language_proficiency') == '4' ? 'checked' : '') }} name="language_proficiency"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('language_proficiency')) ? ($errors->has('language_proficiency') ? '' : ($candidate->language_proficiency == '5' ? 'checked' : '')) :
                                            (old('language_proficiency') == '5' ? 'checked' : '') }} name="language_proficiency"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="language_proficiency_remarks" value="{{ $candidate->language_proficiency_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>SKILL</strong></td>
                        </tr>

                        <tr>
                            <td >Computer Skill</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($candidate->computer_skill == '1' ? 'checked' : '')) :
                                            (old('computer_skill') == '1' ? 'checked' : '') }} name="computer_skill"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($candidate->computer_skill == '2' ? 'checked' : '')) :
                                            (old('computer_skill') == '2' ? 'checked' : '') }} name="computer_skill"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($candidate->computer_skill == '3' ? 'checked' : '')) :
                                            (old('computer_skill') == '3' ? 'checked' : '') }} name="computer_skill"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($candidate->computer_skill == '4' ? 'checked' : '')) :
                                            (old('computer_skill') == '4' ? 'checked' : '') }} name="computer_skill"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('computer_skill')) ? ($errors->has('computer_skill') ? '' : ($candidate->computer_skill == '5' ? 'checked' : '')) :
                                            (old('computer_skill') == '5' ? 'checked' : '') }} name="computer_skill"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="computer_skill_remarks" value="{{ $candidate->computer_skill_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Interpersonal Skill</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($candidate->interpersonal_skill == '1' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '1' ? 'checked' : '') }} name="interpersonal_skill"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($candidate->interpersonal_skill == '2' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '2' ? 'checked' : '') }} name="interpersonal_skill"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($candidate->interpersonal_skill == '3' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '3' ? 'checked' : '') }} name="interpersonal_skill"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($candidate->interpersonal_skill == '4' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '4' ? 'checked' : '') }} name="interpersonal_skill"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('interpersonal_skill')) ? ($errors->has('interpersonal_skill') ? '' : ($candidate->interpersonal_skill == '5' ? 'checked' : '')) :
                                            (old('interpersonal_skill') == '5' ? 'checked' : '') }} name="computer_skill"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="interpersonal_skill_remarks" value="{{ $candidate->interpersonal_skill_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>KNOWLEDGE</strong></td>
                        </tr>

                        <tr>
                            <td >Job Knowledge</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($candidate->job_knowledge == '1' ? 'checked' : '')) :
                                            (old('job_knowledge') == '1' ? 'checked' : '') }} name="job_knowledge"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($candidate->job_knowledge == '2' ? 'checked' : '')) :
                                            (old('job_knowledge') == '2' ? 'checked' : '') }} name="job_knowledge"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($candidate->job_knowledge == '3' ? 'checked' : '')) :
                                            (old('job_knowledge') == '3' ? 'checked' : '') }} name="job_knowledge"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($candidate->job_knowledge == '4' ? 'checked' : '')) :
                                            (old('job_knowledge') == '4' ? 'checked' : '') }} name="job_knowledge"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('job_knowledge')) ? ($errors->has('job_knowledge') ? '' : ($candidate->job_knowledge == '5' ? 'checked' : '')) :
                                            (old('job_knowledge') == '5' ? 'checked' : '') }} name="job_knowledge"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="job_knowledge_remarks" value="{{ $candidate->job_knowledge_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >General Knowledge</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($candidate->general_knowledge == '1' ? 'checked' : '')) :
                                            (old('general_knowledge') == '1' ? 'checked' : '') }} name="general_knowledge"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($candidate->general_knowledge == '2' ? 'checked' : '')) :
                                            (old('general_knowledge') == '2' ? 'checked' : '') }} name="general_knowledge"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($candidate->general_knowledge == '3' ? 'checked' : '')) :
                                            (old('general_knowledge') == '3' ? 'checked' : '') }} name="general_knowledge"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($candidate->general_knowledge == '4' ? 'checked' : '')) :
                                            (old('general_knowledge') == '4' ? 'checked' : '') }} name="general_knowledge"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('general_knowledge')) ? ($errors->has('general_knowledge') ? '' : ($candidate->general_knowledge == '5' ? 'checked' : '')) :
                                            (old('general_knowledge') == '5' ? 'checked' : '') }} name="general_knowledge"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="general_knowledge_remarks" value="{{ $candidate->general_knowledge_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>OTHERS</strong></td>
                        </tr>


                        <tr>
                            <td >Family Background</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($candidate->family_background == '1' ? 'checked' : '')) :
                                            (old('family_background') == '1' ? 'checked' : '') }} name="family_background"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($candidate->family_background == '2' ? 'checked' : '')) :
                                            (old('family_background') == '2' ? 'checked' : '') }} name="family_background"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($candidate->family_background == '3' ? 'checked' : '')) :
                                            (old('family_background') == '3' ? 'checked' : '') }} name="family_background"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($candidate->family_background == '4' ? 'checked' : '')) :
                                            (old('family_background') == '4' ? 'checked' : '') }} name="family_background"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('family_background')) ? ($errors->has('family_background') ? '' : ($candidate->family_background == '5' ? 'checked' : '')) :
                                            (old('family_background') == '5' ? 'checked' : '') }} name="family_background"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="family_background_remarks" value="{{ $candidate->family_background_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Wllingness to Learn</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($candidate->wllingness_to_learn == '1' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '1' ? 'checked' : '') }} name="wllingness_to_learn"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($candidate->wllingness_to_learn == '2' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '2' ? 'checked' : '') }} name="wllingness_to_learn"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($candidate->wllingness_to_learn == '3' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '3' ? 'checked' : '') }} name="wllingness_to_learn"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($candidate->wllingness_to_learn == '4' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '4' ? 'checked' : '') }} name="wllingness_to_learn"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('wllingness_to_learn')) ? ($errors->has('wllingness_to_learn') ? '' : ($candidate->wllingness_to_learn == '5' ? 'checked' : '')) :
                                            (old('wllingness_to_learn') == '5' ? 'checked' : '') }} name="wllingness_to_learn"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="wllingness_to_learn_remarks" value="{{ $candidate->wllingness_to_learn_remarks}}">
                            </td>
                        </tr>
                        <tr>
                            <td >Long term Objectives</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($candidate->long_term_objectives == '1' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '1' ? 'checked' : '') }} name="long_term_objectives"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($candidate->long_term_objectives == '2' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '2' ? 'checked' : '') }} name="long_term_objectives"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($candidate->long_term_objectives == '3' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '3' ? 'checked' : '') }} name="long_term_objectives"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($candidate->long_term_objectives == '4' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '4' ? 'checked' : '') }} name="long_term_objectives"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('long_term_objectives')) ? ($errors->has('long_term_objectives') ? '' : ($candidate->long_term_objectives == '5' ? 'checked' : '')) :
                                            (old('long_term_objectives') == '5' ? 'checked' : '') }} name="long_term_objectives"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="long_term_objectives_remarks" value="{{ $candidate->long_term_objectives_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Team Skill</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($candidate->team_skill == '1' ? 'checked' : '')) :
                                            (old('team_skill') == '1' ? 'checked' : '') }} name="team_skill"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($candidate->team_skill == '2' ? 'checked' : '')) :
                                            (old('team_skill') == '2' ? 'checked' : '') }} name="team_skill"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($candidate->team_skill == '3' ? 'checked' : '')) :
                                            (old('team_skill') == '3' ? 'checked' : '') }} name="team_skill"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($candidate->team_skill == '4' ? 'checked' : '')) :
                                            (old('team_skill') == '4' ? 'checked' : '') }} name="team_skill"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('team_skill')) ? ($errors->has('team_skill') ? '' : ($candidate->team_skill == '5' ? 'checked' : '')) :
                                            (old('team_skill') == '5' ? 'checked' : '') }} name="team_skill"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="team_skill_remarks" value="{{ $candidate->team_skill_remarks}}">
                            </td>
                        </tr>

                        <tr>
                            <td >Working Planing Skill</td>
                            <td class="text-center"><input type="radio" value="1" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($candidate->working_planing_skill == '1' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '1' ? 'checked' : '') }} name="working_planing_skill"></td>
                            <td class="text-center"><input type="radio" value="2" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($candidate->working_planing_skill == '2' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '2' ? 'checked' : '') }} name="working_planing_skill"></td>
                            <td class="text-center"><input type="radio" value="3" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($candidate->working_planing_skill == '3' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '3' ? 'checked' : '') }} name="working_planing_skill"></td>
                            <td class="text-center"><input type="radio" value="4" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($candidate->working_planing_skill == '4' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '4' ? 'checked' : '') }} name="working_planing_skill"></td>
                            <td class="text-center"><input type="radio" value="5" {{ empty(old('working_planing_skill')) ? ($errors->has('working_planing_skill') ? '' : ($candidate->working_planing_skill == '5' ? 'checked' : '')) :
                                            (old('working_planing_skill') == '5' ? 'checked' : '') }} name="working_planing_skill"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="working_planing_skill_remarks" value="{{ $candidate->working_planing_skill_remarks}}">
                            </td>
                        </tr>


                        <tr>
                            <td style="float: right" ><strong>TOTAL</strong></td>
                            <td class="text-center"><strong></strong></td>

                        </tr>

                        </tbody>

                    </table>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th width="20%" scope="row"><b>Parameter</b></th>
                            <td class="text-center">80-Above </td>
                            <td class="text-center">70-80</td>
                            <td class="text-center">60-70</td>
                            <td class="text-center">50-60</td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row"><b>Complement</b></th>
                            <td class="text-center">Excellent</td>
                            <td class="text-center">Good</td>
                            <td class="text-center">Average</td>
                            <td class="text-center">Poor</td>
                        </tr>


                        </tbody>
                    </table>



                    <table style="margin-bottom: 10px" class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center" width="25%" scope="col"><b>Selected</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="selected" value="1" {{ empty(old('selected')) ? ($errors->has('selected') ? '' : ($candidate->selected == '1' ? 'checked' : '')) :
                                            (old('selected') == '1' ? 'checked' : '') }} style="margin-left: 8px;height: 12px;width: 13px;"></td>

                            <td class="text-center" width="25%" scope="col"><b>Short Listed</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="short_Listed" value="2" {{ empty(old('short_Listed')) ? ($errors->has('short_Listed') ? '' : ($candidate->short_Listed == '2' ? 'checked' : '')) :
                                            (old('short_Listed') == '2' ? 'checked' : '') }} style="margin-left: 8px;height: 12px;width: 13px;">
                            </td>
                            <td class="text-center" width="25%" scope="col"><b>May be Call later</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="may_be_Call_later" value="3" {{ empty(old('may_be_Call_later')) ? ($errors->has('may_be_Call_later') ? '' : ($candidate->may_be_Call_later == '3' ? 'checked' : '')) :
                                            (old('may_be_Call_later') == '3' ? 'checked' : '') }} style="margin-left: 8px;height: 12px;width: 13px;">
                            </td>
                            <td class="text-center" width="25%" scope="col"><b>Rejected</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="rejected" value="4" {{ empty(old('rejected')) ? ($errors->has('rejected') ? '' : ($candidate->rejected == '4' ? 'checked' : '')) :
                                            (old('rejected') == '4' ? 'checked' : '') }} style="margin-left: 8px;height: 12px;width: 13px;">
                            </td>
                        </tr>
                        </thead>

                    </table>


                    <table  class="table table-bordered" style="margin-bottom: 17px">

                        <tbody>
                        <tr>
                            <th width="20%" scope="row">Salary Offered</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Salary Offered"
                                       name="salary_offered" value="{{ empty(old('salary_offered')) ? ($errors->has('salary_offered') ? '' : $candidate->salary_offered) : old('salary_offered') }}">
                            </td>

                        </tr>
                        <tr>
                            <th width="20%" scope="row">Others Benefits</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Others Benefits"
                                       name="others_benefits" value="{{ empty(old('others_benefits')) ? ($errors->has('others_benefits') ? '' : $candidate->others_benefits) : old('others_benefits') }}">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row">Any Condition</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Any Condition"
                                       name="any_condition" value="{{ empty(old('any_condition')) ? ($errors->has('any_condition') ? '' : $candidate->any_condition) : old('any_condition') }}">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row">Expected Date Of Joining</th>
                            <td width="80%">
                                <input type="date" class="form-control" placeholder="Enter Expected Date Of Joining"
                                       name="expected_joining_date" value="{{ empty(old('expected_joining_date')) ? ($errors->has('expected_joining_date') ? '' : $candidate->expected_joining_date) : old('expected_joining_date') }}">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row">Required For Company Unit</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Required For Company Unit"
                                       name="required_company_unit" value="{{ empty(old('required_company_unit')) ? ($errors->has('required_company_unit') ? '' : $candidate->required_company_unit) : old('required_company_unit') }}">
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Job Description</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Job Description"
                                       name="job_description" value="{{ empty(old('job_description')) ? ($errors->has('job_description') ? '' : $candidate->job_description) : old('job_description') }}">
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Reference</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Reference"
                                       name="reference" value="{{ empty(old('reference')) ? ($errors->has('reference') ? '' : $candidate->reference) : old('reference') }}">
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Employee Type</th>
                            <td width="80%">

                                <select class="form-control" name="employee_type" >
                                    <option value="">Select Employee Type</option>
                                    <option value="1" {{ empty(old('employee_type')) ? ($errors->has('employee_type') ? '' : ($candidate->employee_type == '1' ? 'selected' : '')) :
                                            (old('employee_type') == '1' ? 'selected' : '') }}>Permanent</option>
                                    <option value="2" {{ empty(old('employee_type')) ? ($errors->has('employee_type') ? '' : ($candidate->employee_type == '2' ? 'selected' : '')) :
                                            (old('employee_type') == '2' ? 'selected' : '') }}>Temporary</option>
                                </select>

                                @error('employee_type')
                                <span class="help-block">{{ $message }}</span>
                                @enderror

                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Photo</th>
                            <td width="80%">
                                <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">

                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image">

                                        @error('image')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    <table class="table table-bordered">
                        <tbody>
                        <tr style="height: 70px;">

                            <td width="33.33%" style="text-align: center;"></td>
                            <td style="text-align: center"></td>
                            <td style="text-align: center"></td>

                        </tr>
                        <tr>

                            <td style="text-align: center">Signature of the Interviewer</td>
                            <td style="text-align: center">Signature of the Interviewer</td>
                            <td style="text-align: center">Signature of the Interviewer</td>

                        </tr>

                        </tbody>
                    </table>

                    <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                        <label class="col-sm-2 control-label">Status *</label>

                        <div class="col-sm-10" style="margin-top:7px;">

                            <div class="radio" style="display: inline">
                                <label>
                                    <input type="radio" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($candidate->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                    Active
                                </label>
                            </div>

                            <div class="radio" style="display: inline">
                                <label>
                                    <input type="radio" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($candidate->status == '0' ? 'checked' : '')) :
                                            (old('status') == '0' ? 'checked' : '') }}>
                                    Inactive
                                </label>
                            </div>

                            @error('status')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

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

            var designationSelected = '{{ $candidate->designation_id }}';

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
        });
    </script>
@endsection
