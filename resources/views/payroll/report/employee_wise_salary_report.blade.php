@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1.5px solid #000 !important;
        }
    </style>

@endsection

@section('title')
    Due Salary
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                            <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
                            {{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                            <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                            <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                            <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                            <li class="active"><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                            <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                            <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                            <li><a href="#leave">User Account</a></li>
                            <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                        </ul>
                        <div class="box-header with-border">
                            <a style="margin-left: 15px" class="btn btn-primary btn-sm " href="{{route('payroll.employee_wise_salary_page',['candidate' => $candidate->id])}}">Salary Sanction By Month</a>
                            <a style="margin-left: 15px" class="btn btn-success btn-sm active" href="{{route('payroll.employee_wise_due_salary',['candidate' => $candidate->id])}}">Due Salary</a>
                            <a style="margin-left: 15px" class="btn btn-warning btn-sm" role="button" data-id="{{$candidate->id}}">Payment</a>
                            <a style="margin-left: 15px" class="btn btn-primary btn-sm" role="button" data-id="{{$candidate->id}}">Funded</a>
                            <a style="margin-left: 15px" class="btn btn-info btn-sm active " href="{{route('payroll.employee_wise_salary_report',['candidate' => $candidate->id])}}">Report</a>
                        </div>
                        <div class="box-header with-border" style="margin-top: 30px">
                            <a style="margin-right: 15px;float: right" href="{{route('payroll.employee_wise_all_salary',['candidate' => $candidate->id])}}" class="btn btn-success">All Salary By Date</a>
                            <a style="margin-right: 15px;float: right" href="{{route('payroll.employee_wise_deduction',['candidate' => $candidate->id])}}" class="btn btn-warning" style="margin-left: 20px">Deduction By Date</a>
                            <a style="margin-right: 15px;float: right" href="{{route('payroll.employee_wise_all_due_report',['candidate' => $candidate->id])}}" class="btn btn-info" style="margin-left: 20px">All Due Report</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

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
            $('#start, #end').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection


