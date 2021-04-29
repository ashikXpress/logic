@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .timepicker_wrap{
            width: max-content;
        }
    </style>

@endsection

@section('title')
    Employee Attendance
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif

    @isset($employee)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <ul class="nav nav-tabs">
                        <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                        <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
                        {{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                        <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                        <li class="active"><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                        <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                        <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                        <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                        <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                        <li><a href="#userAccount">User Account</a></li>
                        <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                    </ul>
                    <div class="tab-content" style="margin-top: 24px;margin-bottom: 23px;">
                        <ul>
                            <a class="btn btn-primary btn-sm active" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Manual Input</a>
                            <a class="btn btn-info btn-sm" href="{{route('employee_wise_over_time',['candidate' => $candidate->id])}}">Over Time</a>
                            <a class="btn btn-primary btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Location Tracking</a>
                            <a class="btn btn-info btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Attendance application</a>
                            <a class="btn btn-warning btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Last 10-in-out-check</a>

                        </ul>

                    </div>
                    <div class="box-body table-responsive">

                        <form action="{{route('attendance_manually_input',['candidate' => $employee->id])}}" method="post">
                            @csrf
                            <div class="col-md-2">
                                <label for="attend_date">Date</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="attend_date" value="{{old('attend_date')}}" name="attend_date" type="text" class="form-control" autocomplete="off">
                                    <span class="text-danger">{{$errors->first('attend_date')}}</span>
                                </div>
                            </div>

                            <table id="table" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Present/Absent</th>
                                    <th width="5%">Present Time</th>
                                    {{--                                <th >Late</th>--}}
                                    {{--                                <th width="5%">Late Time</th>--}}
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <span class="item">
                                <tr>
                                    <td>{{$employee->employee_id}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->designation->name}}</td>
                                    <td>{{$employee->department->name}}</td>
                                    <td>
                                        <input value="1" class="present_check" name="present_{{ $employee->id }}" type="checkbox" checked>
                                    </td>
                                    <td><input class="timepicker present_time"  name="present_time_{{ $employee->id }}" type="text" value="{{old('present_time_'. $employee->id)}}"></td>
{{--                                    <td><input value="1" class="late_check" name="late_{{ $employee->id }}" type="checkbox"></td>--}}
                                    {{--                                    <td><input class="timepicker late_time"  name="late_time_{{ $employee->id }}" type="text"></td>--}}
                                    <td><input  name="note_{{ $employee->id }}" placeholder="Note" type="text"></td>

                                </tr>
                                </span>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>
                                        <button class="btn btn-primary form-control">Submit</button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                            <input type="hidden" name="employee" value="{{ $employee->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endisset


@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('themes/backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>s

    <script>
        //Date picker
        $('#attend_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            orientation: 'bottom'
        });

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false,
            defaultTime: null
        });


        //$('.present_time').prop( "disabled", true );

        $(".present_check").change(function () {
            var check =$(this)
            if ($(this).prop('checked')) {
                check.closest('tr').find('.present_time').prop( "disabled", false );
            }else{
                check.closest('tr').find('.present_time').prop( "disabled", true ).val(' ');

            }
        });

        $(".late_check").change(function () {
            var check =$(this)
            if ($(this).prop('checked')) {
                check.closest('tr').find('.late_time').prop( "disabled", false );
            }else{
                check.closest('tr').find('.late_time').prop( "disabled", true ).val(' ');

            }
        });
        $(".late_check").trigger("change")

    </script>
@endsection
