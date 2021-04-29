
@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

@endsection

@section('title')
    Create Loan
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
                <ul class="nav nav-tabs">
                    <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                    <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
{{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                    <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                    <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                    <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                    <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                    <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                    <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evaluation</a></li>
                    <li><a href="#leave">User Account</a></li>
                    <li class="active"><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                </ul>
                <div class="box-header with-border">
                    <h3 class="box-title">Employee Wise Report</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="loan_button">
                        <div class="row">
                            <div class="col-md-12">
                                {{--                                <a href="{{route('payroll.employee_wise_salary_report',['candidate' => $candidate->id])}}"><button type="button" class="btn btn-success">Salary Report</button> </a>--}}
                                <a href="{{route('payroll.employee_wise_all_salary',['candidate' => $candidate->id])}}" class="btn btn-info">All Salary By Date</a>
                                <a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}"><button type="button" class="btn btn-primary" style="margin-left: 20px">Loan Report</button> </a>
                                <a href="{{route('payroll.employee_wise_attendance_report',['candidate' => $candidate->id])}}"><button type="button" class="btn btn-info" style="margin-left: 20px">Attendance Report</button> </a>
                                <a href="{{route('payroll.employee_wise_leave_report',['candidate' => $candidate->id])}}"><button type="button" class="btn btn-warning active" style="margin-left: 20px">Leave Report</button> </a>
                                <a href="{{route('payroll.employee_wise_deduction',['candidate' => $candidate->id])}}" class="btn btn-primary" style="margin-left: 20px">Deduction By Date</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12" style="min-height:300px">
            {{--            @if($previous_loans != null)--}}
            <section class="panel">

                <div class="panel-body">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>

                    <div class="adv-table" id="prinarea">

                        <div class="row">
                            <div class="col-xs-2">
                                <div class="logo" style="margin-left: 16px;">
                                    <div class="logo-img">
                                        <img src="{{asset('img/logo.png')}}" alt="" height="90px" width="90px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div style= text-align:center;">
                                    <h2>Logic Group</h2>
                                    <h4>Employee Wise Leave Report</h4>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered" style="margin-bottom: 0px">
                            <tr>
{{--                                <th class="text-center">Loan Date: {{date('Y-m-d',strtotime($previous_loan->loan_date))}}</th>--}}
                            </tr>
                        </table>

                        <div style="clear: both">
                            <table class="table table-bordered" style="width:100%; float:left">



                                <tr>
                                    <th class="text-center" width="25%">Employee Id</th>
                                    <td class="text-center" width="25%">{{ $employee_id->employee_id }}</td>
                                    <th class="text-center" width="25%">Department</th>
                                    <td class="text-center" width="25%">{{ $employee_id->department->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" width="25%">Employee Name</th>
                                    <td class="text-center" width="25%">{{ $employee_id->name }}</td>
                                    <th class="text-center" width="25%">Designation</th>
                                    <td class="text-center" width="25%">{{ $employee_id->designation->name }}</td>
                                </tr>
                            </table>
{{--                            @php--}}
{{--                            $totalLeave = --}}
{{--                            @endphp--}}
                            <u><h4 class="text-center text-success">Total Approved Leave</h4></u>
                            <table class="table table-bordered">
                                <tr>
                                    <th>SI No</th>
                                    <th>Leave Type</th>
                                    <th>Year</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total Days</th>
                                    <th>Laeave Applicaton Date</th>
                                    <th>Note</th>
                                </tr>
                                @foreach($approvedLeaves as $approvedLeave)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($approvedLeave->type == 1)
                                                Annual Leave
                                            @elseif($approvedLeave->type == 2)
                                                Casual Leave
                                            @else
                                            Medical Leave
                                            @endif
                                        </td>
                                        <td>{{$approvedLeave->year}}</td>
                                        <td>{{date('Y-m-d', strtotime($approvedLeave->from))}}</td>
                                        <td>{{date('Y-m-d', strtotime($approvedLeave->to))}}</td>
                                        <td>{{$approvedLeave->total_days}}</td>
                                        <td>{{date('Y-m-d', strtotime($approvedLeave->created_at))}}</td>
                                        <td>{{$approvedLeave->note}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <u><h4 class="text-center text-warning">Total Pending Leave</h4></u>
                            <table class="table table-bordered">
                                <tr>
                                    <th>SI No</th>
                                    <th>Leave Type</th>
                                    <th>Year</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total Days</th>
                                    <th>Laeave Applicaton Date</th>
                                    <th>Note</th>
                                </tr>
                                @foreach($pendingLeaves as $pendingLeave)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($pendingLeave->type == 1)
                                                Annual Leave
                                            @elseif($pendingLeave->type == 2)
                                                Casual Leave
                                            @else
                                                Medical Leave
                                            @endif
                                        </td>
                                        <td>{{$pendingLeave->year}}</td>
                                        <td>{{date('Y-m-d', strtotime($pendingLeave->from))}}</td>
                                        <td>{{date('Y-m-d', strtotime($pendingLeave->to))}}</td>
                                        <td>{{$pendingLeave->total_days}}</td>
                                        <td>{{date('Y-m-d', strtotime($pendingLeave->created_at))}}</td>
                                        <td>{{$pendingLeave->note}}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <u><h4 class="text-center text-danger">Total Cancel Leave</h4></u>
                            <table class="table table-bordered">
                                <tr>
                                    <th>SI No</th>
                                    <th>Leave Type</th>
                                    <th>Year</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Total Days</th>
                                    <th>Laeave Applicaton Date</th>
                                    <th>Note</th>
                                </tr>
                                @foreach($cancelLeaves as $cancelLeave)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($cancelLeave->type == 1)
                                                Annual Leave
                                            @elseif($cancelLeave->type == 2)
                                                Casual Leave
                                            @else
                                                Medical Leave
                                            @endif
                                        </td>
                                        <td>{{$cancelLeave->year}}</td>
                                        <td>{{date('Y-m-d', strtotime($cancelLeave->from))}}</td>
                                        <td>{{date('Y-m-d', strtotime($cancelLeave->to))}}</td>
                                        <td>{{$cancelLeave->total_days}}</td>
                                        <td>{{date('Y-m-d', strtotime($cancelLeave->created_at))}}</td>
                                        <td>{{$cancelLeave->note}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            {{--            @endif--}}
        </div>
    </div>
@endsection

@section('script')

    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Date picker
            $('#start, #end').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });
        //Initialize Select2 Elements
        $('.select2').select2()

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection


