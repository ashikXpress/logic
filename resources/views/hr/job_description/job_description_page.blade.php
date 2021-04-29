
@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Job Description
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                    <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic & Training</a></li>
                    <li class="active"><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>
                    <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                    <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                    <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                    <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                    <li><a href="{{route('candidate_evalution_form.edit',['candidate' => $candidate->id])}}">Evalution</a></li>
                    <li><a href="#leave">User Account</a></li>
                    <li><a href="#leave">Report</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                        <div class="row" id="prinarea_profile">
                            <div class="col-md-12">
                                <table class="table table-bordered" >
                                    <tr>
                                        <div class="header" style="text-align: center;margin-bottom: 30px;">
                                            <u><h2>Job Description</h2></u>
                                        </div>
                                    </tr>

                                    <tr>
                                        <th width="25%">Name of Employee</th>
                                        <td width="25%">{{$candidate->name}}</td>
                                        <th width="25%">Department</th>
                                        <td width="25%">{{$candidate->department->name}}</td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Id Number</th>
                                        <td width="25%">{{$jobdescription->id}}</td>
                                        <th width="25%">Section</th>
                                        <td width="25%">{{$jobdescription->section}}</td>
                                    </tr>
                                    <tr>
                                        <th width="25%">Designation</th>
                                        <td width="25%">{{$candidate->designation->name}}</td>
                                        <th width="25%">Issue Date</th>
                                        <td width="25%">{{date("Y-m-d", strtotime(($jobdescription->created_at)))}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b><u>Relationships</u></b></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Reporting to</th>
                                        <td colspan="2">Executive,Engineering</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Immidiate Subordinate Staff</th>
                                        <td colspan="2">None</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Other Internal Contacts</th>
                                        <td colspan="2">Production,QAD,Account,HRD,PPIC</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">External Contacts</th>
                                        <td colspan="2">Nil</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b><u>Summary Statement</u></b></td>
                                    </tr>
                                    <tr height="50px">
                                        <td colspan="4">Perform Cleaning job.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b><u>Duties and Responsibilities</u></b></td>
                                    </tr>
                                    <tr height="200px">
                                        <td colspan="4"><b><u>Major Activities</u></b>
                                            {!!$jobdescription->duties_and_responsibilities  !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b><u>Work Environment</u></b></td>
                                    </tr>
                                    <tr>
                                        <th colspan="1">Work Hours</th>
                                        <td colspan="3">48 hours work week normal</td>
                                    </tr>
                                    <tr>
                                        <th colspan="1">Work Condition</th>
                                        <td colspan="3">Hot and Himud</td>
                                    </tr>
                                    <tr>
                                        <th colspan="1">Travel</th>
                                        <td colspan="3">No</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b><u>Empowerment</u></b></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Financial Authority</th>
                                        <td colspan="2">No</td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Personeel Decision Making Authority</th>
                                        <td colspan="2">No</td>
                                    </tr>

                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="20%" height="50px">Name of Incumbent</th>
                                        <th width="20%" height="50px">Date</th>
                                        <th width="20%" height="50px">Name Of Supervisor</th>
                                        <th width="20%" height="50px">Signature Of Supervisor</th>
                                        <th width="20%" height="50px">Date</th>
                                    </tr>
                                    <tr>
                                        <td width="20%" height="50px"></td>
                                        <td width="20%" height="50px"></td>
                                        <td width="20%" height="50px">Badhon Saha</td>
                                        <td width="20%" height="50px"></td>
                                        <td width="20%" height="50px"></td>
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
        function getprintleave(prinarea_leave) {

            $('body').html($('#'+prinarea_leave).html());
            window.print();
            window.location.replace(APP_URL)
        }
        function getprintleave(prinarea_salary) {

            $('body').html($('#'+prinarea_salary).html());
            window.print();
            window.location.replace(APP_URL)
        }

    </script>
@endsection


