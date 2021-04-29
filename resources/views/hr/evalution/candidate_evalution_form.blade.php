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

                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('candidate_evalution_form.add') }}">
                    @csrf

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Name *</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name') }}">

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
                                            <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                                       name="mobile_no" value="{{ old('mobile_no') }}">

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
                                       name="email" value="{{ old('email') }}">

                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" {{ $errors->has('expected_salary') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Expected Salary </label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Enter Expected Salary"
                                           name="expected_salary" value="{{ old('expected_salary') }}">

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
                                    <input type="text" class="form-control pull-right date-picker" name="interview_date" value="{{ old('interview_date') }}" autocomplete="off">
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
                                           name="current_salary" value="{{ old('current_salary') }}">
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
                                       name="fathers_name" value="{{ old('fathers_name') }}">

                                @error('fathers_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" {{ $errors->has('employee_id') ? 'has-error' :'' }}">
                                <label class="col-md-2 control-label">Employee Id </label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control"
                                           name="employee_id" value="{{ $employeeId }}" readonly>
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
                            <td class="text-center"><input type="radio" class="candidate_score"  value="1" {{ old('dress_up') == '1' ? 'checked' : '' }} name="dress_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score"  value="2" {{ old('dress_up') == '2' ? 'checked' : '' }} name="dress_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score"  value="3" {{ old('dress_up') == '3' ? 'checked' : '' }} name="dress_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score"  value="4" {{ old('dress_up') == '4' ? 'checked' : '' }} name="dress_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score"  value="5" {{ old('dress_up') == '5' ? 'checked' : '' }} name="dress_up" onclick="calculate()"></td>
                            <td><input type="text" class="form-control"  placeholder="Enter Remarks"
                                       name="dress_up_remarks" value="{{ old('dress_up_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Grooming Up</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('grooming_up') == '1' ? 'checked' : '' }} name="grooming_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('grooming_up') == '2' ? 'checked' : '' }} name="grooming_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('grooming_up') == '3' ? 'checked' : '' }} name="grooming_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('grooming_up') == '4' ? 'checked' : '' }} name="grooming_up" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('grooming_up') == '5' ? 'checked' : '' }} name="grooming_up" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="grooming_up_remarks" value="{{ old('grooming_up_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Body Language</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('body_language') == '1' ? 'checked' : '' }} name="body_language" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('body_language') == '2' ? 'checked' : '' }} name="body_language" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('body_language') == '3' ? 'checked' : '' }} name="body_language" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('body_language') == '4' ? 'checked' : '' }} name="body_language" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('body_language') == '5' ? 'checked' : '' }} name="body_language" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="body_language_remarks" value="{{ old('body_language_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Attitude</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('attitude') == '1' ? 'checked' : '' }} name="attitude" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('attitude') == '2' ? 'checked' : '' }} name="attitude" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('attitude') == '3' ? 'checked' : '' }} name="attitude" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('attitude') == '4' ? 'checked' : '' }} name="attitude" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('attitude') == '5' ? 'checked' : '' }} name="attitude" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" class="candidate_score" placeholder="Enter Remarks"
                                       name="attitude_remarks" value="{{ old('attitude_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Personality</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('personality') == '1' ? 'checked' : '' }} name="personality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('personality') == '2' ? 'checked' : '' }} name="personality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('personality') == '3' ? 'checked' : '' }} name="personality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('personality') == '4' ? 'checked' : '' }} name="personality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('personality') == '5' ? 'checked' : '' }} name="personality" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="personality_remarks" value="{{ old('personality_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >CV Status</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('cv_status') == '1' ? 'checked' : '' }} name="cv_status" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('cv_status') == '2' ? 'checked' : '' }} name="cv_status" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('cv_status') == '3' ? 'checked' : '' }} name="cv_status" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('cv_status') == '4' ? 'checked' : '' }} name="cv_status" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('cv_status') == '5' ? 'checked' : '' }} name="cv_status" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="cv_status_remarks" value="{{ old('cv_status_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>QUALIFICATION</strong></td>
                        </tr>

                        <tr>
                            <td > Educational Qualification</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('educational_qualification') == '1' ? 'checked' : '' }} name="educational_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('educational_qualification') == '2' ? 'checked' : '' }} name="educational_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('educational_qualification') == '3' ? 'checked' : '' }} name="educational_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('educational_qualification') == '4' ? 'checked' : '' }} name="educational_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('educational_qualification') == '5' ? 'checked' : '' }} name="educational_qualification" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="educational_qualification_remarks" value="{{ old('educational_qualification_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Professional Qualification</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('professional_qualification') == '1' ? 'checked' : '' }} name="professional_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('professional_qualification') == '2' ? 'checked' : '' }} name="professional_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('professional_qualification') == '3' ? 'checked' : '' }} name="professional_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('professional_qualification') == '4' ? 'checked' : '' }} name="professional_qualification" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('professional_qualification') == '5' ? 'checked' : '' }} name="professional_qualification" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="professional_qualification_remarks" value="{{ old('professional_qualification_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Training and Others</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('training_and_others') == '1' ? 'checked' : '' }} name="training_and_others" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('training_and_others') == '2' ? 'checked' : '' }} name="training_and_others" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('training_and_others') == '3' ? 'checked' : '' }} name="training_and_others" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('training_and_others') == '4' ? 'checked' : '' }} name="training_and_others" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('training_and_others') == '5' ? 'checked' : '' }} name="training_and_others" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="training_and_others_remarks" value="{{ old('training_and_others_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Award Recogntion</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('award_recogntion') == '1' ? 'checked' : '' }} name="award_recogntion" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('award_recogntion') == '2' ? 'checked' : '' }} name="award_recogntion" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('award_recogntion') == '3' ? 'checked' : '' }} name="award_recogntion" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('award_recogntion') == '4' ? 'checked' : '' }} name="award_recogntion" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('award_recogntion') == '5' ? 'checked' : '' }} name="award_recogntion" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="award_recogntion_remarks" value="{{ old('award_recogntion_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>EXPERIENCE</strong></td>
                        </tr>

                        <tr>
                            <td >Relevent Experience</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('relevent_experience') == '1' ? 'checked' : '' }} name="relevent_experience" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('relevent_experience') == '2' ? 'checked' : '' }} name="relevent_experience" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('relevent_experience') == '3' ? 'checked' : '' }} name="relevent_experience" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('relevent_experience') == '4' ? 'checked' : '' }} name="relevent_experience" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('relevent_experience') == '5' ? 'checked' : '' }} name="relevent_experience" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="relevent_experience_remarks" value="{{ old('relevent_experience_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Professional Achievements</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('professional_achievements') == '1' ? 'checked' : '' }} name="professional_achievements" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('professional_achievements') == '2' ? 'checked' : '' }} name="professional_achievements" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('professional_achievements') == '3' ? 'checked' : '' }} name="professional_achievements" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('professional_achievements') == '4' ? 'checked' : '' }} name="professional_achievements" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('professional_achievements') == '5' ? 'checked' : '' }} name="professional_achievements" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="professional_achievements_remarks" value="{{ old('professional_achievements_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Potentiality</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('potentiality') == '1' ? 'checked' : '' }} name="potentiality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('potentiality') == '2' ? 'checked' : '' }} name="potentiality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('potentiality') == '3' ? 'checked' : '' }} name="potentiality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('potentiality') == '4' ? 'checked' : '' }} name="potentiality" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('potentiality') == '5' ? 'checked' : '' }} name="potentiality" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="potentiality_remarks" value="{{ old('potentiality_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>COMMUNICATION</strong></td>
                        </tr>

                        <tr>
                            <td >Oral Communication</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('oral_communication') == '1' ? 'checked' : '' }} name="oral_communication" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('oral_communication') == '2' ? 'checked' : '' }} name="oral_communication" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('oral_communication') == '3' ? 'checked' : '' }} name="oral_communication" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('oral_communication') == '4' ? 'checked' : '' }} name="oral_communication" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('oral_communication') == '5' ? 'checked' : '' }} name="oral_communication" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="oral_communication_remarks" value="{{ old('oral_communication_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Eye Contact</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('eye_contact') == '1' ? 'checked' : '' }} name="eye_contact" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('eye_contact') == '2' ? 'checked' : '' }} name="eye_contact" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('eye_contact') == '3' ? 'checked' : '' }} name="eye_contact" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('eye_contact') == '4' ? 'checked' : '' }} name="eye_contact" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('eye_contact') == '5' ? 'checked' : '' }} name="eye_contact" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="eye_contact_remarks" value="{{ old('eye_contact_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Language Proficiency</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('language_proficiency') == '1' ? 'checked' : '' }} name="language_proficiency" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('language_proficiency') == '2' ? 'checked' : '' }} name="language_proficiency" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('language_proficiency') == '3' ? 'checked' : '' }} name="language_proficiency" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('language_proficiency') == '4' ? 'checked' : '' }} name="language_proficiency" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('language_proficiency') == '5' ? 'checked' : '' }} name="language_proficiency" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="language_proficiency_remarks" value="{{ old('language_proficiency_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>SKILL</strong></td>
                        </tr>

                        <tr>
                            <td >Computer Skill</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('computer_skill') == '1' ? 'checked' : '' }} name="computer_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('computer_skill') == '2' ? 'checked' : '' }} name="computer_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('computer_skill') == '3' ? 'checked' : '' }} name="computer_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('computer_skill') == '4' ? 'checked' : '' }} name="computer_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('computer_skill') == '5' ? 'checked' : '' }} name="computer_skill" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="computer_skill_remarks" value="{{ old('computer_skill_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Interpersonal Skill</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('interpersonal_skill') == '1' ? 'checked' : '' }} name="interpersonal_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('interpersonal_skill') == '2' ? 'checked' : '' }} name="interpersonal_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('interpersonal_skill') == '3' ? 'checked' : '' }} name="interpersonal_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('interpersonal_skill') == '4' ? 'checked' : '' }} name="interpersonal_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('interpersonal_skill') == '5' ? 'checked' : '' }} name="interpersonal_skill" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="interpersonal_skill_remarks" value="{{ old('interpersonal_skill_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>KNOWLEDGE</strong></td>
                        </tr>

                        <tr>
                            <td >Job Knowledge</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('job_knowledge') == '1' ? 'checked' : '' }} name="job_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('job_knowledge') == '2' ? 'checked' : '' }} name="job_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('job_knowledge') == '3' ? 'checked' : '' }} name="job_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('job_knowledge') == '4' ? 'checked' : '' }} name="job_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('job_knowledge') == '5' ? 'checked' : '' }} name="job_knowledge" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="job_knowledge_remarks" value="{{ old('job_knowledge_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >General Knowledge</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('general_knowledge') == '1' ? 'checked' : '' }} name="general_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('general_knowledge') == '2' ? 'checked' : '' }} name="general_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('general_knowledge') == '3' ? 'checked' : '' }} name="general_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('general_knowledge') == '4' ? 'checked' : '' }} name="general_knowledge" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('general_knowledge') == '5' ? 'checked' : '' }} name="general_knowledge" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="general_knowledge_remarks" value="{{ old('general_knowledge_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td><strong>OTHERS</strong></td>
                        </tr>


                        <tr>
                            <td >Family Background</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('family_background') == '1' ? 'checked' : '' }} name="family_background" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('family_background') == '2' ? 'checked' : '' }} name="family_background" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('family_background') == '3' ? 'checked' : '' }} name="family_background" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('family_background') == '4' ? 'checked' : '' }} name="family_background" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('family_background') == '5' ? 'checked' : '' }} name="family_background" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="family_background_remarks" value="{{ old('family_background_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Wllingness to Learn</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('wllingness_to_learn') == '1' ? 'checked' : '' }} name="wllingness_to_learn" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('wllingness_to_learn') == '2' ? 'checked' : '' }} name="wllingness_to_learn" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('wllingness_to_learn') == '3' ? 'checked' : '' }} name="wllingness_to_learn" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('wllingness_to_learn') == '4' ? 'checked' : '' }} name="wllingness_to_learn" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('wllingness_to_learn') == '5' ? 'checked' : '' }} name="wllingness_to_learn" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="wllingness_to_learn_remarks" value="{{ old('wllingness_to_learn_remarks') }}">
                            </td>
                        </tr>
                        <tr>
                            <td >Long term Objectives</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('long_term_objectives') == '1' ? 'checked' : '' }} name="long_term_objectives" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('long_term_objectives') == '2' ? 'checked' : '' }} name="long_term_objectives" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('long_term_objectives') == '3' ? 'checked' : '' }} name="long_term_objectives" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('long_term_objectives') == '4' ? 'checked' : '' }} name="long_term_objectives" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('long_term_objectives') == '5' ? 'checked' : '' }} name="long_term_objectives" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="long_term_objectives_remarks" value="{{ old('long_term_objectives_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Team Skill</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('team_skill') == '1' ? 'checked' : '' }} name="team_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('team_skill') == '2' ? 'checked' : '' }} name="team_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('team_skill') == '3' ? 'checked' : '' }} name="team_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('team_skill') == '4' ? 'checked' : '' }} name="team_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('team_skill') == '5' ? 'checked' : '' }} name="team_skill" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="team_skill_remarks" value="{{ old('team_skill_remarks') }}">
                            </td>
                        </tr>

                        <tr>
                            <td >Working Planing Skill</td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="1" {{ old('working_planing_skill') == '1' ? 'checked' : '' }} name="working_planing_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="2" {{ old('working_planing_skill') == '2' ? 'checked' : '' }} name="working_planing_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="3" {{ old('working_planing_skill') == '3' ? 'checked' : '' }} name="working_planing_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="4" {{ old('working_planing_skill') == '4' ? 'checked' : '' }} name="working_planing_skill" onclick="calculate()"></td>
                            <td class="text-center"><input type="radio" class="candidate_score" value="5" {{ old('working_planing_skill') == '5' ? 'checked' : '' }} name="working_planing_skill" onclick="calculate()"></td>
                            <td><input type="text" class="form-control" placeholder="Enter Remarks"
                                       name="working_planing_skill_remarks" value="{{ old('working_planing_skill_remarks') }}">
                            </td>
                        </tr>


                        <tr>
                            <td style="float: right" ><strong>TOTAL</strong></td>
                            <td id="total" class="text-center" style="font-weight: bold"></td>

                        </tr>

                        </tbody>

                    </table>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th width="20%" scope="row"><b>Parameter</b></th>
                            <td class="text-center excellent_area">80-Above </td>
                            <td class="text-center good_area">70-79</td>
                            <td class="text-center average_area">60-69</td>
                            <td class="text-center poor_area">01-59</td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row"><b>Complement</b></th>
                            <td class="text-center excellent_area">Excellent</td>
                            <td class="text-center good_area">Good</td>
                            <td class="text-center average_area">Average</td>
                            <td class="text-center poor_area">Poor</td>
                        </tr>

                        </tbody>
                    </table>



                    <table style="margin-bottom: 10px" class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center" width="25%" scope="col"><b>Selected</b>
                            <input type="checkbox" placeholder="Enter Remarks"
                                   name="selected" value="1" {{ old('selected') == '1' ? 'checked' : '' }} style="margin-left: 8px;height: 12px;width: 13px;"></td>

                            <td class="text-center" width="25%" scope="col"><b>Short Listed</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="short_Listed" value="2" {{ old('short_Listed') == '2' ? 'checked' : '' }} style="margin-left: 8px;height: 12px;width: 13px;">
                            </td>
                            <td class="text-center" width="25%" scope="col"><b>May be Call later</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="may_be_Call_later" value="3" {{ old('may_be_Call_later') == '3' ? 'checked' : '' }} style="margin-left: 8px;height: 12px;width: 13px;">
                            </td>
                            <td class="text-center" width="25%" scope="col"><b>Rejected</b>
                                <input type="checkbox" placeholder="Enter Remarks"
                                       name="rejected" value="4" {{ old('rejected') == '4' ? 'checked' : '' }} style="margin-left: 8px;height: 12px;width: 13px;">
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
                                       name="salary_offered" value="{{ old('salary_offered') }}">
                            </td>

                        </tr>
                        <tr>
                            <th width="20%" scope="row">Others Benefits</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Others Benefits"
                                       name="others_benefits" value="{{ old('others_benefits') }}">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row">Any Condition</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Any Condition"
                                       name="any_condition" value="{{ old('any_condition') }}">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row">Expected Date Of Joining</th>
                            <td width="80%">
                                <input type="date" class="form-control pull-right datepicker" placeholder="Enter Expected Date Of Joining"
                                       name="expected_joining_date" value="{{ old('expected_joining_date') }}">
                            </td>
                        </tr>
                        <tr>
                            <th width="20%" scope="row">Required For Company Unit</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Required For Company Unit"
                                       name="required_company_unit" value="{{ old('required_company_unit') }}">
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Job Description</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Job Description"
                                       name="job_description" value="{{ old('job_description') }}">
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Reference</th>
                            <td width="80%">
                                <input type="text" class="form-control" placeholder="Enter Reference"
                                       name="reference" value="{{ old('reference') }}">
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Employee Type</th>
                            <td width="80%">
                                <div class=" {{ $errors->has('employee_type') ? 'has-error' :'' }}">

                                    <select class="form-control" name="employee_type">
                                        <option value="">Select Employee Type</option>
                                        <option value="1" {{ old('employee_type') == '1' ? 'selected' : '' }}>Permanent
                                        </option>
                                        <option value="2" {{ old('employee_type') == '2' ? 'selected' : '' }}>Temporary
                                        </option>
                                    </select>

                                    @error('employee_type')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th width="20%" scope="row">Photo</th>
                            <td width="80%">
                                <div class="form-group {{ $errors->has('image') ? 'has-error' :'' }}">

                                    <div class="col-sm-4">
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
                                    <input type="radio" name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                    Active
                                </label>
                            </div>

                            <div class="radio" style="display: inline">
                                <label>
                                    <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
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

            var designationSelected = '{{ old('designation') }}';

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
    <script>
        function calculate(){
            var score = 0;
            $(".candidate_score:checked").each(function(){
                score+=parseInt($(this).val());
            });
            if (score < 59){
                $(".poor_area").css({
                    background : "red",
                    //opacity: 0.5,
                    color:"white",
                })
            }

            if (score > 59){
                $(".average_area").css({
                    background : "black",
                    //opacity: 0.5,
                    color:"white",
                })
            }

            if (score > 69){
                $(".good_area").css({
                    background : "green",
                    //opacity: 0.5,
                    color:"white",
                })
            }

            if (score > 79){
                $(".excellent_area").css({
                    background : "blue",
                    //opacity: 0.5,
                    color:"white",
                })
            }
            $("#total").text(score)

        }
    </script>
@endsection
