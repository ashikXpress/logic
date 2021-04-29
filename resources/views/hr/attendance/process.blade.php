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
    Employee Attendance Process
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

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form method="POST" action="{{ route('employee.attendance.process') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-1">
                                <label for="process_date">Date</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="attend_date" value="{{old('process_date')}}" name="process_date" type="text" class="form-control" autocomplete="off">
                                    <span class="text-danger">{{$errors->first('process_date')}}</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary form-control">Attendance Process</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box">

                <table id="table" class="table table-bordered  ">
                    <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Present/Absent</th>
                        <th>Present Date</th>
                        <th>Intime</th>
                        <th>Outtime</th>
                        <th>Total Hours</th>
                        <th>LateTime</th>
                        <th>OverTime</th>
                        <th>Note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($employees)
                        @foreach ($employees as $employee)
                            <span class="item">
                                <tr>
                                    <td>{{$employee->employee_id}}</td>
                                    <td>{{$employee->employee->name}}</td>
                                    <td>{{$employee->employee->department->name}}</td>
                                    <td>{{$employee->employee->designation->name}}</td>
                                    <td>
                                        @if($employee->status == 1)
                                            Present
                                        @else
                                            Absent
                                        @endif

                                    </td>
                                    <td>{{ $employee->process_date}}</td>
                                    @if($employee->intime)
                                        <td>{{(date('H:i:s', strtotime($employee->intime)))}}</td>
                                    @endif
                                    @if($employee->intime)
                                        <td>{{(date('H:i:s', strtotime($employee->outtime)))}}</td>
                                    @endif
                                    @if($employee->intime)
                                        <td>{{(date('H:i:s', strtotime($employee->total_hours??'')))}}</td>
                                    @endif
                                    @if($employee->intime)
                                        <td>{{(date('H:i:s', strtotime($employee->late_time)))}}</td>
                                    @endif
                                    @if($employee->intime)
                                        <td>{{(date('H:i:s', strtotime($employee->over_time)))}}</td>
                                    @endif
                                    <td>{{$employee->note}}</td>

                                </tr>
                            </span>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
