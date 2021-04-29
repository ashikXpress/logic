@extends('layouts.app')

@section('title')
    Admission Form
@endsection
@section('style')
    <style>

    </style>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border text-center" >
                    <h3 class="box-title">Admission Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('new_admission') }}">
                    @csrf

                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">Course *</label>
                                <select class="form-control" name="training_course" id="training-course">
                                    <option value="">Select Course</option>

                                    @foreach($trainingCourses as $trainingCourse)
                                        <option value="{{ $trainingCourse->id }}" {{ old('training_course') == $trainingCourse->id ? 'selected' : '' }}>{{ $trainingCourse->name }}</option>
                                    @endforeach

                                </select>

                                @error('course_training')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Department *</label>
                                <select class="form-control" name="training_department" id="training-department">
                                    <option value="">Select Department</option>

                                    @foreach($trainingDepartments as $trainingDepartment)
                                        <option value="{{ $trainingDepartment->id }}" {{ old('training_department') == $trainingDepartment->id ? 'selected' : '' }}>{{ $trainingDepartment->name }}</option>
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
                                        <option value="{{ $trainingBatch->id }}" {{ old('training_batch') == $trainingBatch->id ? 'selected' : '' }}>{{ $trainingBatch->name }}</option>
                                    @endforeach

                                </select>

                                @error('training_batch')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">C.code</label>
                                <input type="text" class="form-control" id="course-code"
                                       name="course_code" value="{{ old('course_code') }}">

                                @error('course_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">D.code</label>
                                <input type="text" class="form-control" id="department-code"
                                       name="department_code" value="{{ old('department_code') }}">

                                @error('department_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">B.code</label>
                                <input type="text" class="form-control" id="batch-code"
                                       name="batch_code" value="{{ old('batch_code') }}">

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
                                       name="student_name" value="{{ old('student_name') }}">

                                @error('student_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Father's Name</label>
                                <input type="text" class="form-control" placeholder="Enter Father's Name"
                                       name="father_name" value="{{ old('father_name') }}">

                                @error('father_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Mother's Name</label>
                                <input type="text" class="form-control" placeholder="Enter Mother's Name"
                                       name="mother_name" value="{{ old('mother_name') }}">

                                @error('mother_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
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
                                    <option value="1">2015</option>
                                    <option value="2">2016</option>
                                    <option value="3">2017</option>
                                    <option value="4">2018</option>
                                    <option value="5">2019</option>
                                    <option value="6">2020</option>
                                    <option value="7">2021</option>
                                    <option value="8">2022</option>
                                    <option value="9">2023</option>
                                    <option value="10">2024</option>
                                </select>

                                @error('passing_year')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Batch Fee</label>
                                <input type="text" class="form-control" id="batch-fee"
                                       name="batch_fee" value="{{ old('batch_fee') }}">

                                @error('batch_fee')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">Month</label>
                                <input type="text" class="form-control"
                                       name="month" value="{{ old('month') }}">

                                @error('month')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">DOB</label>
                                <input type="date" class="form-control" placeholder="Enter Date Of Birth"
                                       name="date_of_birth" value="{{ old('date_of_birth') }}">

                                @error('date_of_birth')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Mobile No</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile No"
                                       name="mobile_no" value="{{ old('mobile_no') }}">

                                @error('mobile_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Email(optional)</label>
                                <input type="text" class="form-control" placeholder="Enter Email"
                                       name="email" value="{{ old('email') }}">

                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label class="control-label">Blood Group</label>
                                <select class="form-control" name="blood_group">
                                    <option value="">Select Passing Year</option>
                                    <option value="1">A+</option>
                                    <option value="2">A-</option>
                                    <option value="3">B+</option>
                                    <option value="4">B-</option>
                                    <option value="5">O+</option>
                                    <option value="6">O-</option>
                                    <option value="7">AB+</option>
                                    <option value="8">AB-</option>
                                </select>

                                @error('blood_group')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Admission Roll(optional)</label>
                                <input type="text" class="form-control" placeholder="Admission Roll"
                                       name="admission_roll" value="{{ old('admission_roll') }}">

                                @error('admission_roll')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Admission Date</label>
                                <input type="date" class="form-control"
                                       name="admission_date" value="{{ old('admission_date') }}">

                                @error('admission_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Reference</label>
                                <input type="text" class="form-control" placeholder="Enter Reference"
                                       name="reference" value="{{ old('reference') }}">

                                @error('reference')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1">
                                <label class="control-label">Commission</label>
                                <input type="text" class="form-control" id="comission"
                                       name="commission" value="{{ old('commission') }}">

                                @error('commission')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Balance</label>
                                <input type="text" class="form-control" id="balance" placeholder="Enter Balance"
                                       name="balance" value="{{ old('balance') }}">

                                @error('balance')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <label class="control-label">Previous Institute Description *</label>
                                <textarea name="previous_institute_description" rows="4" cols="174" placeholder="Previous Institute Description"></textarea>

                                @error('previous_institute_description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="control-label">Village</label>
                                <input type="text" class="form-control" placeholder="Enter Village Name"
                                       name="village" value="{{ old('village') }}">

                                @error('village')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Post Office</label>
                                <input type="text" class="form-control" placeholder="Enter Post Name"
                                       name="post" value="{{ old('post') }}">

                                @error('post')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">Police Station(PS)</label>
                                <input type="text" class="form-control" placeholder="Enter Police Station(PS)"
                                       name="police_station" value="{{ old('police_station') }}">

                                @error('police_station')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label">District</label>
                                <input type="text" class="form-control" placeholder="Enter District"
                                       name="district" value="{{ old('district') }}">

                                @error('district')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <label class="control-label">present Address</label>
                                <textarea name="present_address" rows="4" cols="174" placeholder="present Address"></textarea>

                                @error('present_address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Father NID No</label>
                                <input type="text" class="form-control" placeholder="Enter Father NID No"
                                       name="father_nid" value="{{ old('father_nid') }}">

                                @error('father_nid')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Mother Nid No</label>
                                <input type="text" class="form-control" placeholder="Enter Mother Nid No"
                                       name="mother_id" value="{{ old('mother_id') }}">

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
        $("#comission").on("keyup", function() {

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
