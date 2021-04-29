@extends('layouts.app')

@section('style')

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1.5px solid #000 !important;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 2px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        span {
            margin-right: 10px;
        }
    </style>

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
                    <form action="{{ route('payroll.salary.slip') }}">
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
            @if($salarie)
                @php
                    $gross_salary = $salarie->gross_salary;
                @endphp
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
                                        <h4>Monthly Salary</h4>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered" style="margin-bottom: 0px">
                                <tr>
                                    <th class="text-center">{{ date("F d, Y", strtotime(request()->get('year'))) }}</th>
                                </tr>
                            </table>

                            <div style="clear: both">
                                <table class="table table-bordered" style="width:100%; float:left">



                                        <tr>
                                            <th class="text-center" width="25%">Employee Id</th>
                                            <td class="text-center" width="25%">{{ $employee_id->employee_id }}</td>
                                            <th class="text-center" width="25%">Department</th>
                                            <td class="text-center" width="25%">{{ $employee_id->employee->department->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center" width="25%">Employee Name</th>
                                            <td class="text-center" width="25%">{{ $employee_id->employee->name }}</td>
                                            <th class="text-center" width="25%">Designation</th>
                                            <td class="text-center" width="25%">{{ $employee_id->employee->designation->name }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-center">Payment</th>
                                            <th class="text-center" width="25%">History Of Leave</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Basic Salary</td>
                                            <td width="25%">
                                                <p>TK <span style="float: right">{{$salarie->basic_salary}}</span></p>
                                            </td>
                                            <td width="25%"><p>Total Days of Month <span style="float: right">26</span></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">House Rent</td>
                                            <td width="25%">
                                                <p>TK <span style="float: right">{{$salarie->house_rent}}</span></p>
                                            </td>
                                            <td width="25%"><p>Medical Leave <span style="float: right">10</span></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Conveyance</td>
                                            <td width="25%">
                                                <p>TK <span style="float: right">{{$salarie->conveyance}}</span></p>
                                            </td>
                                            <td width="25%"><p>Annual Leave <span style="float: right">5</span></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Medical Expenses </td>
                                            <td width="25%">
                                                <p>TK <span style="float: right">{{$salarie->medical}}</span></p>
                                            </td>
                                            <td width="25%"><p>Casual Leave <span style="float: right">5</span></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Bonus</td>
                                            <td width="25%">
                                                @if($salaryChange && $salaryChange->bonus != null)
                                                    @php
                                                        $gross_salary +=$salaryChange->bonus;
                                                    @endphp

                                                    <p>TK <span style="float: right">{{$salaryChange->bonus}}</span></p>
                                                @else
                                                    <p>TK <span style="float: right">0</span></p>
                                                @endif
                                            </td>
                                            <td width="25%"><p><b>Total Leave</b> <span style="float: right"><b>20</b></span></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Special Allowance</td>
                                            <td width="25%">
                                                @if($salaryChange && $salaryChange->speacial_allowance != null)
                                                    @php
                                                        $gross_salary +=$salaryChange->speacial_allowance;
                                                    @endphp
                                                    <p>TK <span style="float: right">{{$salaryChange->speacial_allowance}}</span></p>
                                                @else
                                                    <p>TK <span style="float: right">0</span></p>
                                                @endif
                                            </td>
                                            <td width="25%">

                                                <p><b>Leave Taken</b> <span style="float: right"><b>{{$leaveInformations->sum('total_days')}}</b></span></p>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Others</td>
                                            <td width="25%">
                                                @if($salaryChange && $salaryChange->others != null)
                                                    @php
                                                        $gross_salary +=$salaryChange->others;
                                                    @endphp
                                                    <p>TK <span style="float: right">{{$salaryChange->others}}</span></p>
                                                @else
                                                    <p>TK <span style="float: right">0</span></p>
                                                @endif
                                            </td>
                                            <td width="25%"><p><b>Remaining Leave</b> <span style="float: right"><b>{{20 - $leaveInformations->sum('total_days')}}</b></span></p></td>
                                        </tr>
                                    <tr>
                                        <td colspan="2">Advanced</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->advance != null)
                                                @php
                                                    $gross_salary +=$salaryChange->advance;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->advance}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Transport Allowance</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->transport_allowence != null)
                                                @php
                                                    $gross_salary +=$salaryChange->transport_allowence;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->transport_allowence}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Dinner Allowance</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->dinner_allowence != null)
                                                @php
                                                    $gross_salary +=$salaryChange->dinner_allowence;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->dinner_allowence}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                        <td width="25%"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Mobile Bill</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->mobile_bill != null)
                                                @php
                                                    $gross_salary +=$salaryChange->mobile_bill;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->mobile_bill}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                        <td width="25%"></td>
                                    </tr>
                                        <tr>
                                            <td colspan="2" ><b><p style="float: right"> <span>Total Gross Salary</span></p></b></td>
                                            <td width="25%">

                                                <p>TK <span style="float: right"><b>{{$gross_salary}}</b></span></p>
                                            </td>
                                            <td width="25%"><p><b>Worked Day</b> <span style="float: right"><b>{{26 - $leaveInformations->sum('total_days')}}</b></span></p></td>
                                        </tr>

                                        <tr>
                                            <th colspan="3" class="text-center">Deduction</th>
                                            <th rowspan="8" width="25%">
                                                <img src="{{ asset($employee_id->employee->image) }}"alt="{{ $employee_id->employee->name }}" height="200" width="260">
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" >Bank Fund</td>
                                            <td width="25%">
                                                <p>TK <span style="float: right">{{$salarie->deduction}}</span></p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="2" >Lone</td>
                                            <td width="25%">
                                                <p>TK <span style="float: right">{{$salarie->loan}}</span></p>
                                            </td>
                                        </tr>

                                    <tr>
                                        <td colspan="2">Penalty</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->penalty != null)
                                                @php
                                                    $gross_salary -=$salaryChange->penalty;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->penalty}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">Income Tex</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->income_tex != null)
                                                @php
                                                    $gross_salary -=$salaryChange->income_tex;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->income_tex}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Revenue Stamp</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->revenue_stamp != null)
                                                @php
                                                    $gross_salary -=$salaryChange->revenue_stamp;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->revenue_stamp}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Miscellaneous</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->miscellaneous != null)
                                                @php
                                                    $gross_salary -=$salaryChange->miscellaneous;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->miscellaneous}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Kollan Trust</td>
                                        <td width="25%">
                                            @if($salaryChange && $salaryChange->kollan_trust != null)
                                                @php
                                                    $gross_salary -=$salaryChange->kollan_trust;
                                                @endphp
                                                <p>TK <span style="float: right">{{$salaryChange->kollan_trust}}</span></p>
                                            @else
                                                <p>TK <span style="float: right">0</span></p>
                                            @endif
                                        </td>
                                    </tr>

                                        <tr>
                                            <td colspan="2" ><b><p style="float: right"> <span>Total Deduction</span></p></b></td>
                                            <td width="25%">
                                                <p>TK <span style="float: right"><b>{{$salarie->deduction + $salarie->loan + ($salaryChange->penalty??0) + ($salaryChange->income_tex??0) + ($salaryChange->revenue_stamp??0) + ($salaryChange->miscellaneous??0) + ($salaryChange->kollan_trust??0)}}</b></span></p>
                                            </td>
                                            <td class="text-center">Signature Of Employee</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-center"><span style="float: right">Salary After Deduction</span></th>
                                            <th class="text-center" width="25%">{{$gross_salary - ($salarie->deduction + $salarie->loan)}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-center">Fifteen Thousands Seven Hundred Fifty Taka Only</th>
                                        </tr>

                                        <tr>
                                            <th colspan="2" class="text-center">Authorised By Accountant</th>
                                            <th colspan="2" class="text-center"> </th>
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

        {{--$('#year').change(function () {--}}
        {{--    var year = $(this).val();--}}
        {{--    $('#month').html('<option value="">Select Month</option>');--}}

        {{--    if (year != '') {--}}
        {{--        $.ajax({--}}
        {{--            method: "GET",--}}
        {{--            url: "{{ route('get_month') }}",--}}
        {{--            data: { year: year }--}}
        {{--        }).done(function( response ) {--}}
        {{--            $.each(response, function( index, item ) {--}}
        {{--                $('#month').append('<option value="'+item.id+'">'+item.name+'</option>');--}}
        {{--            });--}}
        {{--        });--}}
        {{--    }--}}
        {{--});--}}

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection


