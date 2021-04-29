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
    Employee Leave Information
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <form action="{{ route('payroll.employee.leave.information') }}">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Year</label>

                                    <select class="form-control" name="year" id="year" required>
                                        <option value="">Select Year</option>
                                        @for($i=2020; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}" {{ request()->get('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Month</label>

                                    <select class="form-control" name="month">
                                        <option value="">Select Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
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
            @if($year)
                <section class="panel">

                    <div class="panel-body">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>

                        <div class="adv-table" id="prinarea">

                            <table class="table table-bordered" style="margin-bottom: 0px">
                                <tr>
                                    <th colspan="11" class="text-center">Logic Group BD.</th>
                                </tr>
                                <tr>
                                    <th colspan="11" class="text-center">Total Leave of Organization</th>
                                </tr>

                                <tr>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Designation</th>
                                    <th class="text-center">Employee ID</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Employee Status</th>
                                    <th class="text-center">Medical Leave</th>
                                    <th class="text-center">Annual Leave</th>
                                    <th class="text-center">Casual Leave</th>
                                    <th class="text-center">Total Leave</th>
                                    <th class="text-center">Leave Taken</th>
                                    <th class="text-center"> Remaining Leave</th>
                                </tr>

                                @foreach($employees as $employee)
                                    <tr>
                                        <td class="text-center">{{$employee->name}}</td>
                                        <td class="text-center">{{$employee->designation->name}}</td>
                                        <td class="text-center">{{$employee->employee_id}}</td>
                                        <td class="text-center">{{$year}}</td>
                                        <td class="text-center">{{$employee->status}}</td>
                                        <td class="text-center">{{$employee->leaveInformation($employee->employee_id,$year,$month)->sum('total_medical')}}</td>
                                        <td class="text-center">{{$employee->leaveInformation($employee->employee_id,$year,$month)->sum('total_annual')}}</td>
                                        <td class="text-center">{{$employee->leaveInformation($employee->employee_id,$year,$month)->sum('total_casual')}}</td>
                                        <td class="text-center">20</td>
                                        <td class="text-center">{{$employee->leaveInformation($employee->employee_id,$year,$month)->sum('total_days')}}</td>
                                        <td class="text-center">{{20 - $employee->leaveInformation($employee->employee_id,$year,$month)->sum('total_days')}}</td>
                                    </tr>
                                @endforeach

                            </table>

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


