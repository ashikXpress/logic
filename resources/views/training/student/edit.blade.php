@extends('layouts.app')

@section('title')
    Client Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Student Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('new_admission_edit', ['studentAdmission' => $studentAdmission->id]) }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">Course *</label>
                                <select class="form-control" name="training_course" id="training-course">
                                    <option value="">Select Course</option>

                                    @foreach($trainingCourses as $trainingCourse)

                                        <option value="{{ $trainingCourse->id }}" {{ empty(old('training_course')) ? ($errors->has('training_course') ? '' : ($studentAdmission->training_course_id == $trainingCourse->id ? 'selected' : '')) :
                                            (old('training_course') == $trainingCourse->id ? 'selected' : '') }}>{{ $trainingCourse->name }}</option>
                                    @endforeach

                                </select>

                                @error('training_course')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <label class="control-label">Department *</label>
                                <select class="form-control" name="training_department" id="training-department">
                                    <option value="">Select Department</option>

                                    @foreach($trainingDepartments as $trainingDepartment)
                                        <option value="{{ $trainingDepartment->id }}" {{ empty(old('training_department')) ? ($errors->has('training_department') ? '' : ($studentAdmission->training_department_id == $trainingDepartment->id ? 'selected' : '')) :
                                            (old('training_department') == $trainingDepartment->id ? 'selected' : '') }}>{{ $trainingDepartment->name }}</option>
                                    @endforeach

                                </select>

                                @error('training_department')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Batch *</label>
                                <select class="form-control" name="training_batch" id="training-batch">
                                    <option value="">Select Batch</option>

                                    @foreach($trainingBatchs as $trainingBatch)
                                        <option value="{{ $trainingBatch->id }}" {{ empty(old('training_batch')) ? ($errors->has('training_batch') ? '' : ($studentAdmission->training_batch_id == $trainingBatch->id ? 'selected' : '')) :
                                            (old('training_batch') == $trainingBatch->id ? 'selected' : '') }}>{{ $trainingBatch->name }}</option>
                                    @endforeach

                                </select>

                                @error('training_batch')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">C.code</label>
                                <input type="text" class="form-control" id="course-code"
                                       name="course_code" value="{{ empty(old('course_code')) ? ($errors->has('course_code') ? '' : $studentAdmission->course_code) : old('course_code') }}">

                                @error('course_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">D.code</label>
                                <input type="text" class="form-control" id="department-code"
                                       name="department_code" value="{{ empty(old('department_code')) ? ($errors->has('department_code') ? '' : $studentAdmission->department_code) : old('department_code') }}">

                                @error('department_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">B.code</label>
                                <input type="text" class="form-control" id="batch-code"
                                       name="batch_code" value="{{ empty(old('batch_code')) ? ($errors->has('batch_code') ? '' : $studentAdmission->batch_code) : old('batch_code') }}">

                                @error('batch_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            {{--                            <div class="col-sm-1">--}}
                            {{--                                <label class="control-label">S.ID</label>--}}
                            {{--                                <input type="text" class="form-control" id="student-id"--}}
                            {{--                                       name="student_id" value="{{ old('student_id') }}">--}}

                            {{--                                @error('student_id')--}}
                            {{--                                <span class="help-block">{{ $message }}</span>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">Student Name</label>
                                <input type="text" class="form-control" placeholder="Enter Student Name"
                                       name="student_name" value="{{ empty(old('student_name')) ? ($errors->has('student_name') ? '' : $studentAdmission->student_name) : old('student_name') }}">

                                @error('student_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Father's Name</label>
                                <input type="text" class="form-control" placeholder="Enter Father's Name"
                                       name="father_name" value="{{ empty(old('father_name')) ? ($errors->has('father_name') ? '' : $studentAdmission->father_name) : old('father_name') }}">

                                @error('father_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Mother's Name</label>
                                <input type="text" class="form-control" placeholder="Enter Mother's Name"
                                       name="mother_name" value="{{ empty(old('mother_name')) ? ($errors->has('mother_name') ? '' : $studentAdmission->mother_name) : old('mother_name') }}">

                                @error('mother_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="1" {{$studentAdmission->gender==1?'selected':''}}>Male</option>
                                    <option value="2" {{$studentAdmission->gender==2?'selected':''}}>Female</option>
                                </select>

                                @error('gender')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label">Passing Year</label>
                                <select class="form-control" name="passing_year">
                                    <option value="">Select Passing Year</option>
                                    <option value="1" {{$studentAdmission->passing_year==1?'selected':''}}>2015</option>
                                    <option value="2" {{$studentAdmission->passing_year==2?'selected':''}}>2016</option>
                                    <option value="3" {{$studentAdmission->passing_year==3?'selected':''}}>2017</option>
                                    <option value="4" {{$studentAdmission->passing_year==4?'selected':''}}>2018</option>
                                    <option value="5" {{$studentAdmission->passing_year==5?'selected':''}}>2019</option>
                                    <option value="6" {{$studentAdmission->passing_year==6?'selected':''}}>2020</option>
                                    <option value="7" {{$studentAdmission->passing_year==7?'selected':''}}>2021</option>
                                    <option value="8" {{$studentAdmission->passing_year==8?'selected':''}}>2022</option>
                                    <option value="9" {{$studentAdmission->passing_year==9?'selected':''}}>2023</option>
                                    <option value="10"{{$studentAdmission->passing_year==10?'selected':''}}>2024</option>
                                </select>

                                @error('passing_year')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Batch Fee</label>
                                <input type="text" class="form-control" id="batch-fee"
                                       name="batch_fee" value="{{ empty(old('batch_fee')) ? ($errors->has('batch_fee') ? '' : $studentAdmission->batch_fee) : old('batch_fee') }}">

                                @error('batch_fee')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">Month</label>
                                <input type="text" class="form-control"
                                       name="month" value="{{ empty(old('month')) ? ($errors->has('month') ? '' : $studentAdmission->month) : old('month') }}">

                                @error('month')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">DOB</label>
                                <input type="date" class="form-control" placeholder="Enter Date Of Birth"
                                       name="date_of_birth" value="{{ empty(old('date_of_birth')) ? ($errors->has('date_of_birth') ? '' : $studentAdmission->date_of_birth) : old('date_of_birth') }}">

                                @error('date_of_birth')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Mobile No</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile No"
                                       name="mobile_no" value="{{ empty(old('mobile_no')) ? ($errors->has('mobile_no') ? '' : $studentAdmission->mobile_no) : old('mobile_no') }}">

                                @error('mobile_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Email(optional)</label>
                                <input type="text" class="form-control" placeholder="Enter Email"
                                       name="email" value="{{ empty(old('email')) ? ($errors->has('email') ? '' : $studentAdmission->email) : old('email') }}">

                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label">Blood Group</label>
                                <select class="form-control" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="1" {{$studentAdmission->blood_group==1?'selected':''}}>A+</option>
                                    <option value="2" {{$studentAdmission->blood_group==2?'selected':''}}>A-</option>
                                    <option value="3" {{$studentAdmission->blood_group==3?'selected':''}}>B+</option>
                                    <option value="4" {{$studentAdmission->blood_group==4?'selected':''}}>B-</option>
                                    <option value="5" {{$studentAdmission->blood_group==5?'selected':''}}>O+</option>
                                    <option value="6" {{$studentAdmission->blood_group==6?'selected':''}}>O-</option>
                                    <option value="7" {{$studentAdmission->blood_group==7?'selected':''}}>AB+</option>
                                    <option value="8" {{$studentAdmission->blood_group==8?'selected':''}}>AB-</option>
                                </select>

                                @error('blood_group')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Admission Roll(optional)</label>
                                <input type="text" class="form-control" placeholder="Admission Roll"
                                       name="admission_roll" value="{{ empty(old('admission_roll')) ? ($errors->has('admission_roll') ? '' : $studentAdmission->admission_roll) : old('admission_roll') }}">

                                @error('admission_roll')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Admission Date</label>
                                <input type="date" class="form-control"
                                       name="admission_date" value="{{ empty(old('admission_date')) ? ($errors->has('admission_date') ? '' : $studentAdmission->admission_date) : old('admission_date') }}">

                                @error('admission_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Reference</label>
                                <input type="text" class="form-control" placeholder="Enter Reference"
                                       name="reference" value="{{ empty(old('reference')) ? ($errors->has('reference') ? '' : $studentAdmission->reference) : old('reference') }}">

                                @error('reference')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">Commission</label>
                                <input type="text" class="form-control" id="commission"
                                       name="commission" value="{{ empty(old('commission')) ? ($errors->has('commission') ? '' : $studentAdmission->commission) : old('commission') }}">

                                @error('commission')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Balance</label>
                                <input type="text" class="form-control" id="balance" placeholder="Enter Balance"
                                       name="balance" value="{{ empty(old('balance')) ? ($errors->has('balance') ? '' : $studentAdmission->balance) : old('balance') }}">

                                @error('balance')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <label class="control-label">Previous Institute Description *</label>
                                <textarea name="previous_institute_description" rows="4" cols="174" placeholder="Previous Institute Description">{{ empty(old('previous_institute_description')) ? ($errors->has('previous_institute_description') ? '' : $studentAdmission->previous_institute_description) : old('previous_institute_description') }}</textarea>

                                @error('previous_institute_description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">Village</label>
                                <input type="text" class="form-control" placeholder="Enter Village Name"
                                       name="village" value="{{ empty(old('village')) ? ($errors->has('village') ? '' : $studentAdmission->village) : old('village') }}">

                                @error('village')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Post Office</label>
                                <input type="text" class="form-control" placeholder="Enter Post Name"
                                       name="post" value="{{ empty(old('post')) ? ($errors->has('post') ? '' : $studentAdmission->post) : old('post') }}">

                                @error('post')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Police Station(PS)</label>
                                <input type="text" class="form-control" placeholder="Enter Police Station(PS)"
                                       name="police_station" value="{{ empty(old('police_station')) ? ($errors->has('police_station') ? '' : $studentAdmission->police_station) : old('police_station') }}">

                                @error('police_station')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">District</label>
                                <input type="text" class="form-control" placeholder="Enter District"
                                       name="district" value="{{ empty(old('district')) ? ($errors->has('district') ? '' : $studentAdmission->district) : old('district') }}">

                                @error('district')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <label class="control-label">present Address</label>
                                <textarea name="present_address" rows="4" cols="174" placeholder="present Address">{{ empty(old('present_address')) ? ($errors->has('present_address') ? '' : $studentAdmission->present_address) : old('present_address') }}</textarea>

                                @error('present_address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Father NID No</label>
                                <input type="text" class="form-control" placeholder="Enter Father NID No"
                                       name="father_nid" value="{{ empty(old('father_nid')) ? ($errors->has('father_nid') ? '' : $studentAdmission->father_nid) : old('father_nid') }}">

                                @error('father_nid')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Mother Nid No</label>
                                <input type="text" class="form-control" placeholder="Enter Mother Nid No"
                                       name="mother_id" value="{{ empty(old('mother_id')) ? ($errors->has('mother_id') ? '' : $studentAdmission->mother_id) : old('mother_id') }}">

                                @error('mother_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- CK Editor -->
    <script src="{{ asset('themes/backend/bower_components/ckeditor/ckeditor.js') }}"></script>

    <script>

        $('#training-course').change(function () {
            var trainingCourseId = $(this).val();

            if (trainingCourseId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_course_code') }}",
                    data: { trainingCourseId: trainingCourseId }
                }).done(function( response ) {
                    $('#course-code').val(response.course_code);
                });
            }
        });
        $('#training-department').change(function () {
            var trainingDepartmentId = $(this).val();

            if (trainingDepartmentId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_department_code') }}",
                    data: { trainingDepartmentId: trainingDepartmentId }
                }).done(function( response ) {
                    $('#department-code').val(response.department_code);
                });
            }
        });
        $('#training-batch').change(function () {
            var trainingBatchId = $(this).val();

            if (trainingBatchId != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_batch_code') }}",
                    data: { trainingBatchId: trainingBatchId }
                }).done(function( response ) {
                    $('#batch-code').val(response.batch_code);
                    $('#batch-fee').val(response.batch_amount);
                    $('#balance').val(response.batch_amount);
                });
            }
        });
        function calculate() {
            var total_balance = $('#balance').val();
            var commission = $(this).val();

            var commission_balance = (total_balance*commission)/100;

            $('#balance').val(commission_balance);
        }
        $("#commission").on("keyup", function() {

            var total_balance = $('#balance').val();
            var commission = $(this).val();

            var commission_balance = (total_balance*commission)/100;

            $('#balance').val(commission_balance);

        });
    </script>
    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
