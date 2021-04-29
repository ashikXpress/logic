@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Employee Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
{{--                <ul class="nav nav-tabs">--}}
{{--                    <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>--}}
{{--                    <li><a href="#salary" data-toggle="tab">Salary</a></li>--}}
{{--                    <li><a href="#designation_log" data-toggle="tab">Designation Log</a></li>--}}
{{--                    <li><a href="#leave" data-toggle="tab">Leave</a></li>--}}
{{--                </ul>--}}

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                        <div class="row" id="prinarea_profile">
                            <div class="col-md-8">
                                <table class="table table-bordered" >

                                    <tr>
                                        <th>Student ID</th>
                                        <td>{{ $studentAdmission->student_id }}</td>
                                    </tr>

                                    <tr>
                                        <th>Student Name</th>
                                        <td>{{ $studentAdmission->student_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Course</th>
                                        <td>{{ $studentAdmission->trainingCourse->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $studentAdmission->trainingDepartment->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batch</th>
                                        <td>{{ $studentAdmission->trainingBatch->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batch Fee</th>
                                        <td>{{ $studentAdmission->batch_fee }}</td>
                                    </tr>
                                    <tr>
                                        <th>Course Code</th>
                                        <td>{{ $studentAdmission->course_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Department Code</th>
                                        <td>{{ $studentAdmission->department_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batch Code</th>
                                        <td>{{ $studentAdmission->batch_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batch Code</th>
                                        <td>{{ $studentAdmission->batch_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{ $studentAdmission->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{ $studentAdmission->mother_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>@if($studentAdmission->gender == 1)
                                                Male
                                            @else
                                            Female
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Passing Year</th>
                                        <td>@if($studentAdmission->passing_year == 1)
                                                2015
                                            @elseif($studentAdmission->passing_year == 2)
                                            2016
                                            @elseif($studentAdmission->passing_year == 3)
                                            2016
                                            @elseif($studentAdmission->passing_year == 4)
                                                2016
                                            @elseif($studentAdmission->passing_year == 5)
                                                2016
                                            @elseif($studentAdmission->passing_year == 6)
                                                2016
                                            @elseif($studentAdmission->passing_year == 7)
                                                2016
                                            @elseif($studentAdmission->passing_year == 8)
                                                2016
                                            @elseif($studentAdmission->passing_year == 9)
                                                2016
                                            @else($studentAdmission->passing_year == 10)
                                                2016
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Month</th>
                                        <td>{{ $studentAdmission->month }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date Of Birth</th>
                                        <td>{{ $studentAdmission->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile No</th>
                                        <td>{{ $studentAdmission->mobile_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $studentAdmission->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Group</th>
                                        <td>
                                            @if($studentAdmission->blood_group == 1)
                                                A+
                                            @elseif($studentAdmission->blood_group == 2)
                                                A-
                                            @elseif($studentAdmission->blood_group == 3)
                                                B+
                                            @elseif($studentAdmission->blood_group == 4)
                                                B-
                                            @elseif($studentAdmission->blood_group == 5)
                                                O+
                                            @elseif($studentAdmission->blood_group == 6)
                                                O-
                                            @elseif($studentAdmission->blood_group == 7)
                                                AB+
                                            @elseif($studentAdmission->blood_group == 8)
                                                AB-
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Admission Roll</th>
                                        <td>{{ $studentAdmission->admission_roll }}</td>
                                    </tr>

                                    <tr>
                                        <th>Admission Date</th>
                                        <td>{{ $studentAdmission->admission_date }}</td>
                                    </tr>

                                    <tr>
                                        <th>Reference</th>
                                        <td>{{ $studentAdmission->reference }}</td>
                                    </tr>
                                    <tr>
                                        <th>Commission</th>
                                        <td>{{ $studentAdmission->commission }}</td>
                                    </tr>
                                    <tr>
                                        <th>Balance</th>
                                        <td>{{ $studentAdmission->balance }}</td>
                                    </tr>
                                    <tr>
                                        <th>Previous Institute Description</th>
                                        <td>{{ $studentAdmission->previous_institute_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Village</th>
                                        <td>{{ $studentAdmission->village }}</td>
                                    </tr>
                                    <tr>
                                        <th>Post Office</th>
                                        <td>{{ $studentAdmission->post }}</td>
                                    </tr>
                                    <tr>
                                        <th>Police Station</th>
                                        <td>{{ $studentAdmission->police_station }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $studentAdmission->district }}</td>
                                    </tr>
                                    <tr>
                                        <th>Present Address</th>
                                        <td>{{ $studentAdmission->present_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Father NID</th>
                                        <td>{{ $studentAdmission->father_nid }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother NID</th>
                                        <td>{{ $studentAdmission->mother_id }}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }


    </script>
@endsection
