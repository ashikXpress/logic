@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@endsection

@section('title')
    Salary Process Report
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
                            <li><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>
                            <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                            <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                            <li class="active"><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                            <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                            <li><a href="{{route('candidate_evalution_form.edit',['candidate' => $candidate->id])}}">Evalution</a></li>
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
                            <a style="margin-right: 15px;float: right" href="{{route('payroll.employee_wise_all_salary',['candidate' => $candidate->id])}}" class="btn btn-success active">All Salary By Date</a>
                            <a style="margin-right: 15px;float: right" href="{{route('payroll.employee_wise_deduction',['candidate' => $candidate->id])}}" class="btn btn-warning " style="margin-left: 20px">Deduction By Date</a>
                            <a style="margin-right: 15px;float: right" href="{{route('payroll.employee_wise_all_due_report',['candidate' => $candidate->id])}}" class="btn btn-info" style="margin-left: 20px">All Due Report</a>
                        </div>
                        <div class="box-header with-border">
                            <h3 class="box-title">Filter All Salary By Date</h3>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <form action="{{ route('payroll.employee_wise_all_salary',['candidate' => $candidate->id ]) }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start Date</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right"
                                               id="start" name="start" value="{{ request()->get('start')  }}" autocomplete="off" required>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End Date</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right"
                                               id="end" name="end" value="{{ request()->get('end')  }}" autocomplete="off" required>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>	&nbsp;</label>

                                    <input class="btn btn-primary form-control" type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12" style="min-height:300px">
            @if($salaries)
                <section class="panel">

                    <div class="panel-body">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>

                        <div class="adv-table" id="prinarea">
                            <div style="padding:10px; width:100%; text-align:center;">
                                <h2>Logic Group</h2>
                                <h4>Salary Process Report</h4>
                            </div>
                            <table class="table table-bordered" style="margin-bottom: 0px">
                                <tr>
                                    <th class="text-center">{{ date("F d, Y", strtotime(request()->get('start'))).' - '.date("F d, Y", strtotime(request()->get('end'))) }}</th>
                                </tr>
                            </table>
                                <div style="clear: both">
                                    <table class="table table-bordered" style="width:100%; float:left">
                                        <tr>
                                            <th class="text-center" width="10%">Employee Id</th>
                                            <th class="text-center" width="20%">Employee Name</th>
                                            <th class="text-center" width="10%">Month</th>
                                            <th class="text-center" width="15%">Year</th>
                                            <th class="text-center" width="20%">Salary/month-wise</th>
                                            <th class="text-center" width="20%">Date</th>
                                            <th class="text-center" width="20%">Action</th>
                                        </tr>

                                        @foreach($salaries as $salarie)
                                            <tr>
                                                <td class="text-center">{{ $salarie->employee_id }}</td>
                                                <td class="text-center">{{ $salarie->employee->name }}</td>
                                                <td class="text-center">{{ $salarie->month }}</td>
                                                <td class="text-center">{{ $salarie->year }}</td>
                                                <td class="text-center">৳ {{ number_format($salarie->gross_salary,2) }}</td>
                                                <td class="text-center">{{ $salarie->date->format('j F, Y') }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="{{route('payroll.employee_wise_salary_slip_details', ['candidate' => $salarie->employee_id,'month'=>$salarie->month,'year'=>$salarie->year])}}" >Details</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th class="text-center" colspan="4">Total</th>
                                            <th class="text-center">৳ {{ number_format($salaries->sum('gross_salary'),2) }}</th>
                                        </tr>
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

