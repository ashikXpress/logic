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
                    <a style="margin-left: 15px" class="btn btn-info btn-sm " href="{{route('payroll.employee_wise_salary_report',['candidate' => $candidate->id])}}">Report</a>
                </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                </div>
                <!-- /.box-header -->

{{--                <div class="box-body">--}}
{{--                    <form action="{{ route('payroll.salary.approved-list') }}">--}}
{{--                        <div class="row">--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Year</label>--}}

{{--                                    <select class="form-control" name="year" id="year" required>--}}
{{--                                        <option value="">Select Year</option>--}}
{{--                                        @for($i=2020; $i <= date('Y'); $i++)--}}
{{--                                            <option value="{{ $i }}" {{ request()->get('year') == $i ? 'selected' : '' }}>{{ $i }}</option>--}}
{{--                                        @endfor--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-3">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Month</label>--}}

{{--                                    <select class="form-control" name="month" id="month" required>--}}
{{--                                        <option value="">Select Month</option>--}}
{{--                                        <option value="1">January</option>--}}
{{--                                        <option value="2">February</option>--}}
{{--                                        <option value="3">March</option>--}}
{{--                                        <option value="4">April</option>--}}
{{--                                        <option value="5">May</option>--}}
{{--                                        <option value="6">June</option>--}}
{{--                                        <option value="7">July</option>--}}
{{--                                        <option value="8">August</option>--}}
{{--                                        <option value="9">September</option>--}}
{{--                                        <option value="10">October</option>--}}
{{--                                        <option value="11">November</option>--}}
{{--                                        <option value="12">December</option>--}}

{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>	&nbsp;</label>--}}

{{--                                    <input class="btn btn-primary form-control" type="submit" value="Submit">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12" style="min-height:300px">
            @if($dueSalaries)
                <section class="panel">
                    <div class="panel-body">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>
                        <div class="adv-table" id="prinarea">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="margin-bottom: 0px">
                                    <tr>
                                        <th colspan="6" class="text-center">Logic Group BD.</th>
                                    </tr>
                                    <tr>
                                        <th colspan="6" class="text-center">Due Salary List</th>
                                    </tr>

                                    <tr>
                                        <th>SL No</th>
                                        <th>Employee ID</th>
                                        <th>Name of Employee</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Approval Status</th>
                                    </tr>

                                    @foreach($dueSalaries as  $dueSalary)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$dueSalary->employee_id}}</td>
                                            <td>{{$dueSalary->name}}</td>
                                            <td>{{$dueSalary->approved_year}}</td>
                                            <td>
                                                @if($dueSalary->approved_month == 1)
                                                    January
                                                @elseif($dueSalary->approved_month == 2)
                                                    February
                                                @elseif($dueSalary->approved_month == 3)
                                                    March
                                                @elseif($dueSalary->approved_month == 4)
                                                    April
                                                @elseif($dueSalary->approved_month == 5)
                                                    May
                                                @elseif($dueSalary->approved_month == 6)
                                                    June
                                                @elseif($dueSalary->approved_month == 7)
                                                    July
                                                @elseif($dueSalary->approved_month == 8)
                                                    August
                                                @elseif($dueSalary->approved_month == 9)
                                                    September
                                                @elseif($dueSalary->approved_month == 10)
                                                    October
                                                @elseif($dueSalary->approved_month == 11)
                                                    November
                                                @else
                                                    December

                                                @endif


                                            </td>
                                            <td>
                                                @if($dueSalary->salary_approve_status == 0)
                                                    Due
                                                @else
                                                    Approved
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
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


