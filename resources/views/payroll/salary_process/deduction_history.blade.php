@extends('layouts.app')

@section('style')

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

@endsection

@section('title')
    Deduction History
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
                    <form action="{{ route('payroll.deduction_history') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Employee Id</label>
                                    <select name="employee_id" class="form-control select2">
                                        <option value="">Select Employee Id</option>
                                        @foreach($employees as $employee)
                                            <option {{ $employee->id == request()->get('employee_id') ? 'selected' : '' }} value="{{$employee->id}}">{{$employee->name}}-{{$employee->employee_id}}</option>
                                        @endforeach
                                    </select>
                                    <!-- /.input group -->
                                </div>
                            </div>

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

{{--                                <div style="clear: both">--}}
{{--                                    <table class="table table-bordered" style="width:100%; float:left">--}}
{{--                                        <tr>--}}
{{--                                            <th class="text-center" width="10%">Employee Id</th>--}}
{{--                                            <th class="text-center" width="20%">Employee Name</th>--}}
{{--                                            <th class="text-center" width="10%">Month</th>--}}
{{--                                            <th class="text-center" width="15%">Year</th>--}}
{{--                                            <th class="text-center" width="20%">Deduction/month-wise</th>--}}
{{--                                            <th class="text-center" width="20%">Date</th>--}}
{{--                                        </tr>--}}

{{--                                        <tr>--}}
{{--                                            <td class="text-center">{{ $employee_id->employee->employee_id }}</td>--}}
{{--                                            <td class="text-center">{{ $employee_id->employee->name }}</td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                @if($employee_id->month == 1)--}}
{{--                                                    <span>January</span>--}}
{{--                                                @elseif($employee_id->month == 2)--}}
{{--                                                    <span>February</span>--}}
{{--                                                @elseif($employee_id->month == 3)--}}
{{--                                                    <span>March</span>--}}
{{--                                                @elseif($employee_id->month == 4)--}}
{{--                                                    <span>April</span>--}}
{{--                                                @elseif($employee_id->month == 5)--}}
{{--                                                    <span>May</span>--}}
{{--                                                @elseif($employee_id->month == 6)--}}
{{--                                                    <span>June</span>--}}
{{--                                                @elseif($employee_id->month == 7)--}}
{{--                                                    <span>July</span>--}}
{{--                                                @elseif($employee_id->month == 8)--}}
{{--                                                    <span>August</span>--}}
{{--                                                @elseif($employee_id->month == 9)--}}
{{--                                                    <span>September</span>--}}
{{--                                                @elseif($employee_id->month == 10)--}}
{{--                                                    <span>October</span>--}}
{{--                                                @elseif($employee_id->month == 11)--}}
{{--                                                    <span>November</span>--}}
{{--                                                @else--}}
{{--                                                    <span>December</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">{{ $employee_id->year }}</td>--}}
{{--                                            <td class="text-center">৳ {{ number_format($employee_id->deduction,2) }}</td>--}}
{{--                                            <td class="text-center">{{ $employee_id->date->format('j F, Y') }}</td>--}}
{{--                                        </tr>--}}

{{--                                        <tr>--}}
{{--                                            <th class="text-center" colspan="4">Total</th>--}}
{{--                                            <th class="text-center">৳ {{ number_format($employee_id->deduction,2) }}</th>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                </div>--}}

                                <div style="clear: both">
                                    <table class="table table-bordered" style="width:100%; float:left">
                                        <tr>
                                            <th class="text-center" width="10%">Employee Id</th>
                                            <th class="text-center" width="20%">Employee Name</th>
                                            <th class="text-center" width="10%">Month</th>
                                            <th class="text-center" width="15%">Year</th>
                                            <th class="text-center" width="20%">Deduction/month-wise</th>
                                            <th class="text-center" width="20%">Date</th>
                                        </tr>

                                        @foreach($salaries as $salarie)
                                            <tr>
                                                <td class="text-center">{{ $salarie->employee_id }}</td>
                                                <td class="text-center">{{ $salarie->employee->name }}</td>
                                                <td class="text-center">
                                                    @if($salarie->month == 1)
                                                        <span>January</span>
                                                    @elseif($salarie->month == 2)
                                                        <span>February</span>
                                                    @elseif($salarie->month == 3)
                                                        <span>March</span>
                                                    @elseif($salarie->month == 4)
                                                        <span>April</span>
                                                    @elseif($salarie->month == 5)
                                                        <span>May</span>
                                                    @elseif($salarie->month == 6)
                                                        <span>June</span>
                                                    @elseif($salarie->month == 7)
                                                        <span>July</span>
                                                    @elseif($salarie->month == 8)
                                                        <span>August</span>
                                                    @elseif($salarie->month == 9)
                                                        <span>September</span>
                                                    @elseif($salarie->month == 10)
                                                        <span>October</span>
                                                    @elseif($salarie->month == 11)
                                                        <span>November</span>
                                                    @else
                                                        <span>December</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $salarie->year }}</td>
                                                <td class="text-center">৳ {{ number_format($salarie->deduction,2) }}</td>
                                                <td class="text-center">{{ $salarie->date->format('j F, Y') }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th class="text-center" colspan="4">Total</th>
                                            <th class="text-center">৳ {{ number_format($salaries->sum('deduction'),2) }}</th>
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


