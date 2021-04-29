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
    Approved History
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
                    <form action="{{ route('payroll.salary.approved-list') }}">
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

                                    <select class="form-control" name="month" id="month" required>
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
            @if($salaryApproves)
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
                                        <th colspan="6" class="text-center">Pre Salary Approved List</th>
                                    </tr>

                                    <tr>
                                        <th>SL No</th>
                                        <th>Employee ID</th>
                                        <th>Name of Employee</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Approval Status</th>
                                    </tr>

                                    @foreach($salaryApproves as  $salaryApprove)

                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$salaryApprove->employee_id}}</td>
                                            <td>{{$salaryApprove->name}}</td>
                                            <td>{{$appovedYear}}</td>
                                            <td>
                                                @if($appovedMonth == 1)
                                                    January
                                                @elseif($appovedMonth == 2)
                                                February
                                                @elseif($appovedMonth == 2)
                                                    February
                                                @elseif($appovedMonth == 3)
                                                    March
                                                @elseif($appovedMonth == 4)
                                                    April
                                                @elseif($appovedMonth == 5)
                                                    May
                                                @elseif($appovedMonth == 6)
                                                    June
                                                @elseif($appovedMonth == 7)
                                                    July
                                                @elseif($appovedMonth == 8)
                                                    August
                                                @elseif($appovedMonth == 9)
                                                    September
                                                @elseif($appovedMonth == 10)
                                                    October
                                                @elseif($appovedMonth == 11)
                                                    November
                                                @else
                                                December

                                                @endif


                                            </td>
                                            <td>
                                                @if($salaryApprove->salary_approve_status == 1)
                                                    Approved
                                                @else
                                                    Not Approved
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


