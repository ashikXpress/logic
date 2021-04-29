
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
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 0px;
            line-height: 1;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
    </style>

@endsection

@section('title')
    Employee Wise Salary Slip
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
                    <a style="margin-left: 15px" class="btn btn-primary btn-sm active" href="{{route('payroll.employee_wise_salary_page',['candidate' => $candidate->id])}}">Salary Sanction By Month</a>
                    <a style="margin-left: 15px" class="btn btn-success btn-sm" href="{{route('payroll.employee_wise_due_salary',['candidate' => $candidate->id])}}">Due Salary</a>
                    <a style="margin-left: 15px" class="btn btn-warning btn-sm" data-id="{{$candidate->id}}">Payment</a>
                    <a style="margin-left: 15px" class="btn btn-primary btn-sm"  data-id="{{$candidate->id}}">Funded</a>
                    <a style="margin-left: 15px" class="btn btn-info btn-sm"  href="{{route('payroll.employee_wise_salary_report',['candidate' => $candidate->id])}}">Report</a>
                </div>

                <div class="box-header with-border" style="margin-top: 40px;">
                    <a style="margin-left: 20px;float: right" class="btn btn-primary btn-sm btn-update" role="button" data-id="{{$candidate->id}}">Salary Update</a>
                    <a style="margin-left: 20px;float: right" class="btn btn-success btn-sm btn-salary-approved" role="button" data-id="{{$candidate->id}}">Salary Approved</a>
                    <a style="margin-left: 20px;float: right" class="btn btn-warning btn-sm btn-salary-rejected" role="button" data-id="{{$candidate->id}}">Salary Rejected</a>
                    <a style="margin-left: 20px;float: right" class="btn btn-danger btn-sm btn-salary-delete" role="button" data-id="{{$candidate->id}}">Salary Delete</a>
                    {{--                    <a style="margin-left: 20px;float: right" class="btn btn-info" href="{{route('payroll.employee_wise_deduction',['candidate' => $candidate->id])}}">Deduction By Date</a>--}}
                    {{--                    <a style="margin-left: 20px;float: right" class="btn btn-info" href="{{route('payroll.employee_wise_all_salary',['candidate' => $candidate->id])}}">All Salary By Date</a>--}}
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <form action="{{ route('payroll.employee_wise_salary_page',['candidate' => $candidate->id ]) }}">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <i><p style="float: right;font-size: 15px;">Last Approved Salary: {{$candidate->for_month}}</p></i>
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
                                <div class="col-xs-12">
                                    <div class="logo">
                                        <div class="logo-img">
                                            <img src="{{asset('img/logo.png')}}" alt="" height="55px" width="70px"><span style="margin-left: 30px; font-size: 18px" >Logic Engineering Ltd.</span><span style="float: right;margin-top: 15px" >office copy</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Pay slip for january 2021</h5>
                            <table class="table">

                                <tr></tr>
                                <tr>
                                    <th>ID:</th>
                                    <th>{{ $employee_id->employee->employee_id }}</th>
                                    <th>Department:</th>
                                    <th>{{ $employee_id->employee->department->name }}</th>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <th>{{ $employee_id->employee->name }}</th>
                                    <th>Designation:</th>
                                    <th>{{ $employee_id->employee->designation->name }}</th>
                                </tr>

                                <tbody>
                                <tr>
                                    <th>Payment</th>
                                    <th>Amount</th>
                                    <th>Deduction</th>
                                    <th>Amount</th>
                                </tr>
                                <tr>
                                    <td>Consolidate</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->consolidate != null)
                                            @php
                                                $gross_salary +=$salaryChange->consolidate;
                                            @endphp
                                            {{$salaryChange->consolidate}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>PF</td>
                                    <td>{{$salarie->deduction}}</td>
                                </tr>
                                <tr>
                                    <td>Basic</td>
                                    <td>{{$salarie->basic_salary}}</td>
                                    <td>PF Loan</td>
                                    <td>
                                        @if($salarie && $salarie->pf_loan != null)

                                            {{$salarie->pf_loan}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>House Rent</td>
                                    <td>{{$salarie->house_rent}}</td>
                                    <td>Loan</td>
                                    <td>
                                        @if($salarie && $salarie->loan != null)

                                            {{$salarie->loan}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Med.Allow</td>
                                    <td>{{$salarie->medical}}</td>
                                    <td>Income Tex</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->income_tex != null)
                                            @php
                                                $gross_salary -=$salaryChange->income_tex;
                                            @endphp
                                            {{$salaryChange->income_tex}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Convence</td>
                                    <td>{{$salarie->conveyance}}</td>
                                    <td>Lwp</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->lwp != null)
                                            @php
                                                $gross_salary -=$salaryChange->lwp;
                                            @endphp
                                            {{$salaryChange->lwp}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metro City</td>

                                    <td>
                                        @if($salaryChange && $salaryChange->metro_city != null)
                                            @php
                                                $gross_salary +=$salaryChange->metro_city;
                                            @endphp
                                            {{$salaryChange->metro_city}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Penalty</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->penalty != null)
                                            @php
                                                $gross_salary -=$salaryChange->penalty;
                                            @endphp
                                            {{$salaryChange->penalty}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Factory Allowance</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->factory_allowance != null)
                                            @php
                                                $gross_salary +=$salaryChange->factory_allowance;
                                            @endphp
                                            {{$salaryChange->factory_allowance}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Stuff Bus</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->stuff_bus != null)
                                            @php
                                                $gross_salary -=$salaryChange->stuff_bus;
                                            @endphp
                                            {{$salaryChange->stuff_bus}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Arrear</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->arrear != null)
                                            @php
                                                $gross_salary +=$salaryChange->arrear;
                                            @endphp
                                            {{$salaryChange->arrear}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Revenue Stamp</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->revenue_stamp != null)
                                            @php
                                                $gross_salary -=$salaryChange->revenue_stamp;
                                            @endphp
                                            {{$salaryChange->revenue_stamp}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>WPPF</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->wppf != null)
                                            @php
                                                $gross_salary +=$salaryChange->wppf;
                                            @endphp
                                            {{$salaryChange->wppf}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Other Ded</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->others_deduction != null)
                                            @php
                                                $gross_salary -=$salaryChange->others_deduction;
                                            @endphp
                                            {{$salaryChange->others_deduction}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>COL</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->col != null)
                                            @php
                                                $gross_salary +=$salaryChange->col;
                                            @endphp
                                            {{$salaryChange->col}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>SKRP Loan</td>
                                    <td>
                                        @if($salarie && $salarie->skrp_loan != null)

                                            {{$salarie->skrp_loan}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->bonus != null)
                                            @php
                                                $gross_salary +=$salaryChange->bonus;
                                            @endphp
                                            {{$salaryChange->bonus}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Mobile Bill</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->mobile_bill != null)
                                            @php
                                                $gross_salary -=$salaryChange->mobile_bill;
                                            @endphp
                                            {{$salaryChange->mobile_bill}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Special Adjustment</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->special_adjustment != null)
                                            @php
                                                $gross_salary +=$salaryChange->special_adjustment;
                                            @endphp
                                            {{$salaryChange->special_adjustment}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Union Fee</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->union_fee != null)
                                            @php
                                                $gross_salary -=$salaryChange->union_fee;
                                            @endphp
                                            {{$salaryChange->union_fee}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other Allow</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->other_allowance != null)
                                            @php
                                                $gross_salary +=$salaryChange->other_allowance;
                                            @endphp
                                            {{$salaryChange->other_allowance}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>
                                        Others Two
                                    </td>
                                    <td>
                                        @if($salaryChange && $salaryChange->others_two != null)
                                            @php
                                                $gross_salary -=$salaryChange->others_two;
                                            @endphp
                                            {{$salaryChange->others_two}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td>Mobile Set</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->mobile_set != null)
                                            @php
                                                $gross_salary +=$salaryChange->mobile_set;
                                            @endphp
                                            {{$salaryChange->mobile_set}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td>Others Three</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->others_three != null)
                                            @php
                                                $gross_salary -=$salaryChange->others_three;
                                            @endphp
                                            {{$salaryChange->others_three}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <td>TA/DA</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->ta_da != null)
                                            @php
                                                $gross_salary +=$salaryChange->ta_da;
                                            @endphp
                                            {{$salaryChange->ta_da}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->others != null)
                                            @php
                                                $gross_salary +=$salaryChange->others;
                                            @endphp
                                            {{$salaryChange->others}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td>Others One</td>
                                    <td>
                                        @if($salaryChange && $salaryChange->others_one != null)
                                            @php
                                                $gross_salary +=$salaryChange->others_one;
                                            @endphp

                                            {{$salaryChange->others_one}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td>Over Time</td>
                                    <td>
                                        @if($salarie->total_overtime != null)

                                            {{$salarie->total_overtime}}
                                        @else
                                            {{0}}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <th>Gross Pay</th>
                                    <th>@if($salaryChange && $salaryChange->total_extra_add != null)

                                            {{$salaryChange->total_extra_add}}
                                        @else
                                            {{$salarie->gross_salary - $salarie->deduction + ($salarie->total_overtime)}}
                                        @endif
                                    </th>
                                    <th>Total Deduction</th>
                                    <th>
                                        @if($salaryChange && $salaryChange->total_extra_subtract != null)
                                            {{$salaryChange->total_extra_subtract + $salarie->deduction +
                                             $salarie->loan + $salarie->pf_loan + $salarie->skrp_loan+($salarie->total_overtime)}}
                                        @else
                                            {{$salarie->deduction+$salarie->loan + $salarie->pf_loan + $salarie->skrp_loan}}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th>Bank Account</th>
                                    <th>2125368952</th>
                                    <th>Net Pay</th>
                                    <th>
                                        @if($salaryChange && $salaryChange->monthly_gross_salary != null)
                                            {{$salaryChange->monthly_gross_salary - ($salarie->deduction+$salarie->loan + $salarie->pf_loan + $salarie->skrp_loan)+($salarie->total_overtime)}}
                                        @else
                                            {{$salarie->gross_salary-($salarie->deduction+$salarie->loan + $salarie->pf_loan + $salarie->skrp_loan)+($salarie->total_overtime)}}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                                </tbody>
                            </table>
                            <div class="row" style="margin-top: 30px;margin-bottom: 5px;">
                                <div class="col-xs-6">
                                    <h5>Checked By..........................</h5>
                                </div>
                                <div class="col-xs-6">
                                    <h5>Recipients Signature By.............................</h5>
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
                                                <hr>

                                                <div class="adv-table" id="prinarea">

                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="logo">
                                                                <div class="logo-img">
                                                                    <img src="{{asset('img/logo.png')}}" alt="" height="55px" width="70px"><span style="margin-left: 30px; font-size: 18px" >Logic Engineering Ltd.</span><span style="float: right;margin-top: 15px" >recipients copy</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5>Pay slip for january 2021</h5>
                                                    <table class="table">

                                                        <tr></tr>
                                                        <tr>
                                                            <th>ID:</th>
                                                            <th>{{ $employee_id->employee->employee_id }}</th>
                                                            <th>Department:</th>
                                                            <th>{{ $employee_id->employee->department->name }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Name:</th>
                                                            <th>{{ $employee_id->employee->name }}</th>
                                                            <th>Designation:</th>
                                                            <th>{{ $employee_id->employee->designation->name }}</th>
                                                        </tr>

                                                        <tbody>
                                                        <tr>
                                                            <th>Payment</th>
                                                            <th>Amount</th>
                                                            <th>Deduction</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Consolidate</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->consolidate != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->consolidate;
                                                                    @endphp
                                                                    {{$salaryChange->consolidate}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>PF</td>
                                                            <td>{{$salarie->deduction}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Basic</td>
                                                            <td>{{$salarie->basic_salary}}</td>
                                                            <td>PF Loan</td>
                                                            <td>
                                                                @if($salarie && $salarie->pf_loan != null)

                                                                    {{$salarie->pf_loan}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>House Rent</td>
                                                            <td>{{$salarie->house_rent}}</td>
                                                            <td>Loan</td>
                                                            <td>
                                                                @if($salarie && $salarie->loan != null)

                                                                    {{$salarie->loan}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Med.Allow</td>
                                                            <td>{{$salarie->medical}}</td>
                                                            <td>Income Tex</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->income_tex != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->income_tex;
                                                                    @endphp
                                                                    {{$salaryChange->income_tex}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Convence</td>
                                                            <td>{{$salarie->conveyance}}</td>
                                                            <td>Lwp</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->lwp != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->lwp;
                                                                    @endphp
                                                                    {{$salaryChange->lwp}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Metro City</td>

                                                            <td>
                                                                @if($salaryChange && $salaryChange->metro_city != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->metro_city;
                                                                    @endphp
                                                                    {{$salaryChange->metro_city}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Penalty</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->penalty != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->penalty;
                                                                    @endphp
                                                                    {{$salaryChange->penalty}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Factory Allowance</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->factory_allowance != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->factory_allowance;
                                                                    @endphp
                                                                    {{$salaryChange->factory_allowance}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Stuff Bus</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->stuff_bus != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->stuff_bus;
                                                                    @endphp
                                                                    {{$salaryChange->stuff_bus}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Arrear</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->arrear != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->arrear;
                                                                    @endphp
                                                                    {{$salaryChange->arrear}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Revenue Stamp</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->revenue_stamp != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->revenue_stamp;
                                                                    @endphp
                                                                    {{$salaryChange->revenue_stamp}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>WPPF</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->wppf != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->wppf;
                                                                    @endphp
                                                                    {{$salaryChange->wppf}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Other Ded</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->others_deduction != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->others_deduction;
                                                                    @endphp
                                                                    {{$salaryChange->others_deduction}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>COL</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->col != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->col;
                                                                    @endphp
                                                                    {{$salaryChange->col}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>SKRP Loan</td>
                                                            <td>
                                                                @if($salarie && $salarie->skrp_loan != null)

                                                                    {{$salarie->skrp_loan}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bonus</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->bonus != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->bonus;
                                                                    @endphp
                                                                    {{$salaryChange->bonus}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Mobile Bill</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->mobile_bill != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->mobile_bill;
                                                                    @endphp
                                                                    {{$salaryChange->mobile_bill}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Special Adjustment</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->special_adjustment != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->special_adjustment;
                                                                    @endphp
                                                                    {{$salaryChange->special_adjustment}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Union Fee</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->union_fee != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->union_fee;
                                                                    @endphp
                                                                    {{$salaryChange->union_fee}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other Allow</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->other_allowance != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->other_allowance;
                                                                    @endphp
                                                                    {{$salaryChange->other_allowance}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                Others Two
                                                            </td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->others_two != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->others_two;
                                                                    @endphp
                                                                    {{$salaryChange->others_two}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Mobile Set</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->mobile_set != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->mobile_set;
                                                                    @endphp
                                                                    {{$salaryChange->mobile_set}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td>Others Three</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->others_three != null)
                                                                    @php
                                                                        $gross_salary -=$salaryChange->others_three;
                                                                    @endphp
                                                                    {{$salaryChange->others_three}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>TA/DA</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->ta_da != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->ta_da;
                                                                    @endphp
                                                                    {{$salaryChange->ta_da}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                        <tr>
                                                            <td>Others</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->others != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->others;
                                                                    @endphp
                                                                    {{$salaryChange->others}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                        <tr>
                                                            <td>Others One</td>
                                                            <td>
                                                                @if($salaryChange && $salaryChange->others_one != null)
                                                                    @php
                                                                        $gross_salary +=$salaryChange->others_one;
                                                                    @endphp

                                                                    {{$salaryChange->others_one}}
                                                                @else
                                                                    {{0}}
                                                                @endif
                                                            </td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>

                                                        <tr>
                                                            <th>Gross Pay</th>
                                                            <th>@if($salaryChange && $salaryChange->total_extra_add != null)

                                                                    {{$salaryChange->total_extra_add}}
                                                                @else
                                                                    {{$salarie->gross_salary - $salarie->deduction}}
                                                                @endif
                                                            </th>
                                                            <th>Total Deduction</th>
                                                            <th>
                                                                @if($salaryChange && $salaryChange->total_extra_subtract != null)
                                                                    {{$salaryChange->total_extra_subtract + $salarie->deduction +
                                                                     $salarie->loan + $salarie->pf_loan + $salarie->skrp_loan}}
                                                                @else
                                                                    {{$salarie->deduction+$salarie->loan + $salarie->pf_loan + $salarie->skrp_loan}}
                                                                @endif
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Bank Account</th>
                                                            <th>2125368952</th>
                                                            <th>Net Pay</th>
                                                            <th>
                                                                @if($salaryChange && $salaryChange->monthly_gross_salary != null)
                                                                    {{$salaryChange->monthly_gross_salary - ($salarie->deduction+$salarie->loan + $salarie->pf_loan + $salarie->skrp_loan)}}
                                                                @else
                                                                    {{$salarie->gross_salary-($salarie->deduction+$salarie->loan + $salarie->pf_loan + $salarie->skrp_loan)}}
                                                                @endif
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <div class="row" style="margin-top: 30px;margin-bottom: 5px;">
                                                        <div class="col-xs-6">
                                                            <h5>Checked By..........................</h5>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <h5>Recipients Signature By.............................</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>


    <div class="modal fade" id="modal-update-salary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Salary</h4>
                </div>
                <div class="modal-body">
                    <form id="modal-form" enctype="multipart/form-data" name="modal-form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="modal-employee-id" disabled>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="modal-name" disabled>
                        </div>

                        <div class="form-group">
                            <label>Department</label>
                            <input class="form-control" id="modal-department" disabled>
                        </div>

                        <div class="form-group">
                            <label>Designation</label>
                            <input class="form-control" id="modal-designation" disabled>
                        </div>

                        <input type="hidden" name="id" id="modal-id">

                        <div class="form-group">
                            <label>Basic Salary</label>
                            <input type="text" class="form-control" name="basic_salary" id="modal-basic-salary" placeholder="Enter Basic Salary" readonly>
                        </div>

                        <div class="form-group">
                            <label>House Rent</label>
                            <input type="text" class="form-control" name="house_rent" id="modal-house-rent" placeholder="Enter House Rent" readonly>
                        </div>

                        <div class="form-group">
                            <label>Conveyance</label>
                            <input type="text" class="form-control" name="conveyance" id="modal-conveyance" placeholder="Enter Conveyance" readonly>
                        </div>

                        <div class="form-group">
                            <label>Medical</label>
                            <input type="text" class="form-control" name="medical" id="modal-medical" placeholder="Enter Medical" readonly>
                        </div>

                        <div class="form-group">
                            <label> Deduction</label>
                            <input type="text" class="form-control" name="deduction" id="deduction" placeholder="Enter Others Deduct" readonly>
                        </div>

                        <div class="form-group">
                            <label>Gross Salary</label>
                            <input type="text" class="form-control" name="gross_salary" id="modal-gross-salary" placeholder="Enter Gross Salary">
                        </div>
                        <div class="form-group">
                            <label>Bonus(+)</label>
                            <input type="text" class="form-control" name="bonus" id="modal-bonus" placeholder="Enter Bonus Amount">
                        </div>
                        <div class="form-group">
                            <label>Special Allowance(+)</label>
                            <input type="text" class="form-control" name="special_allowance" id="modal-special-allowance" placeholder="Enter Special Allowance Amount">
                        </div>
                        <div class="form-group">
                            <label>TA/DA(+)</label>
                            <input type="text" class="form-control" name="ta_da" id="modal-ta-da" placeholder="Enter TA/DA Amount">
                        </div>
                        <div class="form-group">
                            <label>Consolidate(+)</label>
                            <input type="text" class="form-control" name="consolidate" id="modal-consolidate" placeholder="Enter Consolidate Amount">
                        </div>
                        <div class="form-group">
                            <label>Metro City(+)</label>
                            <input type="text" class="form-control" name="metro_city" id="modal-metro-city" placeholder="Enter Metro City Amount">
                        </div>
                        <div class="form-group">
                            <label>Factory Allowance(+)</label>
                            <input type="text" class="form-control" name="factory_allowance" id="modal-factory-allowance" placeholder="Enter Factory Allowance Amount">
                        </div>
                        <div class="form-group">
                            <label>Arrear(+)</label>
                            <input type="text" class="form-control" name="arrear" id="modal-arrear" placeholder="Enter Arrear Amount">
                        </div>
                        <div class="form-group">
                            <label>WPPF(+)</label>
                            <input type="text" class="form-control" name="wppf" id="modal-wppf" placeholder="Enter WPPF Amount">
                        </div>
                        <div class="form-group">
                            <label>COL(+)</label>
                            <input type="text" class="form-control" name="col" id="modal-col" placeholder="Enter COL Amount">
                        </div>
                        <div class="form-group">
                            <label>Special Adjustment(+)</label>
                            <input type="text" class="form-control" name="special_adjustment" id="modal-special-adjustment" placeholder="Enter Special Adjustment Amount">
                        </div>
                        <div class="form-group">
                            <label>Other Allowance(+)</label>
                            <input type="text" class="form-control" name="other_allowance" id="modal-other-allowance" placeholder="Enter Other Allowance Amount">
                        </div>
                        <div class="form-group">
                            <label>Mobile Set(+)</label>
                            <input type="text" class="form-control" name="mobile_set" id="modal-mobile-set" placeholder="Enter Mobile Set Amount">
                        </div>
                        <div class="form-group">
                            <label>Others(+)</label>
                            <input type="text" class="form-control" name="others" id="modal-others" placeholder="Enter Others Amount">
                        </div>
                        <div class="form-group">
                            <label>Others One(+)</label>
                            <input type="text" class="form-control" name="others_one" id="modal-others-one" placeholder="Enter Others One Amount">
                        </div>
                        <div class="form-group">
                            <label>Others Two(-)</label>
                            <input type="text" class="form-control" name="others_two" id="modal-others-two" placeholder="Enter Others Two Amount">
                        </div>
                        <div class="form-group">
                            <label>Others Three(-)</label>
                            <input type="text" class="form-control" name="others_three" id="modal-others-three" placeholder="Enter Others Two Three Amount">
                        </div>
                        <div class="form-group">
                            <label>LWP(-)</label>
                            <input type="text" class="form-control" name="lwp" id="modal-lwp" placeholder="Enter LWP Amount">
                        </div>
                        <div class="form-group">
                            <label>Stuff Bus(-)</label>
                            <input type="text" class="form-control" name="stuff_bus" id="modal-stuff-bus" placeholder="Enter Stuff Bus Loan Amount">
                        </div>
                        <div class="form-group">
                            <label>Others Deduction(-)</label>
                            <input type="text" class="form-control" name="others_deduction" id="modal-others-deduction" placeholder="Enter Others Deduction Amount">
                        </div>

                        <div class="form-group">
                            <label>Mobile Bill(-)</label>
                            <input type="text" class="form-control" name="mobile_bill" id="modal-mobile-bill" placeholder="Enter Mobile Bill Amount">
                        </div>
                        <div class="form-group">
                            <label>Union Fee(-)</label>
                            <input type="text" class="form-control" name="union_fee" id="modal-union-fee" placeholder="Enter Union Fee Amount">
                        </div>
                        <div class="form-group">
                            <label>Penalty(-)</label>
                            <input type="text" class="form-control" name="penalty" id="modal-penalty" placeholder="Enter Penalty Amount">
                        </div>
                        <div class="form-group">
                            <label>Income Tex(-)</label>
                            <input type="text" class="form-control" name="income_tex" id="modal-income-tex" placeholder="Enter Income Tex Amount">
                        </div>
                        <div class="form-group">
                            <label>Revenue Stamp(-)</label>
                            <input type="text" class="form-control" name="revenue_stamp" id="modal-revenue-stamp" placeholder="Enter Revenue Stamp Amount">
                        </div>
                        <div class="form-group">
                            <label>For Month</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="month" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="modal-date" name="date" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-update">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal-salary-approved">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Please Salary Update And Mention For Month Or Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-approved-form" enctype="multipart/form-data" name="modal_approved_form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="candidate-id" name="candidate_id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <select class="form-control" name="approved_year">
                                <option value="">Select Year</option>
                                @for($i=2020; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ request()->get('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Month</label>
                            <select class="form-control selection-multiple" name="approved_month[]" multiple style="width: 580px;">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="modal-btn-approved">Approved</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modal-salary-rejected">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are You Rejected Salary please Mention For Month Or Cancel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-rejected-form" enctype="multipart/form-data" name="modal_rejected_form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="salary-candidate-id" name="candidate_id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <select class="form-control" name="rejected_year">
                                <option value="">Select Year</option>
                                @for($i=2020; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ request()->get('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Month</label>
                            <select class="form-control" name="rejected_month" style="width: 580px;">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="modal-btn-rejected">Rejected</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal-salary-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are You Delete Salary please Mention For Month Or Cancel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-delete-form-delete" enctype="multipart/form-data" name="modal_delete_form_delete">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="delete-salary-candidate-id" name="candidate_id" readonly>
                        </div>
                        <div class="form-group">
                            <label>For Month *</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="salary_month" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="modal-btn-delete">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            //Date picker
            $('#start, #end').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });

        //Salary Delete Area

        $('body').on('click', '.btn-salary-delete', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#delete-salary-candidate-id').val(response.id);


                $('#modal-salary-delete').modal('show');
            });
        });
        $('#modal-btn-delete').click(function () {
            var formData = new FormData($('#modal-delete-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_delete.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-salary-delete').modal('hide');
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        //Salary Delete Area End

        //Salary Approved Area

        $('body').on('click', '.btn-salary-approved', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#candidate-id').val(response.id);


                $('#modal-salary-approved').modal('show');
            });
        });
        $('#modal-btn-approved').click(function () {
            var formData = new FormData($('#modal-approved-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_approved.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-salary-approved').modal('hide');
                        Swal.fire(
                            'Approved!',
                            response.message,
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }

            });
        });

        //Salary Approved Area End


        //Salary Rejected Area Start

        $('body').on('click', '.btn-salary-rejected', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#salary-candidate-id').val(response.id);


                $('#modal-salary-rejected').modal('show');
            });
        });

        $('#modal-btn-rejected').click(function () {
            var formData = new FormData($('#modal-rejected-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_rejected.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-salary-rejected').modal('hide');
                        Swal.fire(
                            'Rejected!',
                            response.message,
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        //Salary Rejected End

        //Salary Update Start

        $('body').on('click', '.btn-update', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);
                $('#modal-employee-id').val(response.employee_id);
                $('#modal-name').val(response.name);
                $('#modal-department').val(response.department.name);
                $('#modal-designation').val(response.designation.name);
                $('#modal-id').val(response.id);
                $('#modal-basic-salary').val(response.basic_salary);
                $('#modal-house-rent').val(response.house_rent);
                $('#modal-conveyance').val(response.conveyance);
                $('#modal-medical').val(response.medical);
                $('#deduction').val(response.deduction);
                $('#modal-gross-salary').val(response.expected_salary);

                $('#modal-update-salary').modal('show');
            });
        });

        $('body').on('click', '.btn-update', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_salaryChange_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#modal-bonus').val(response.bonus);
                $('#modal-special-allowance').val(response.special_allowance);
                $('#modal-ta-da').val(response.ta_da);
                $('#modal-consolidate').val(response.consolidate);
                $('#modal-metro-city').val(response.metro_city);
                $('#modal-factory-allowance').val(response.factory_allowance);
                $('#modal-arrear').val(response.arrear);
                $('#modal-wppf').val(response.wppf);
                $('#modal-col').val(response.col);
                $('#modal-special-adjustment').val(response.special_adjustment);
                $('#modal-other-allowance').val(response.other_allowance);
                $('#modal-mobile-set').val(response.mobile_set);
                $('#modal-others').val(response.others);
                $('#modal-others-one').val(response.others_one);
                $('#modal-others-two').val(response.others_two);
                $('#modal-others-three').val(response.others_three);
                $('#modal-pf-loan').val(response.pf_loan);
                $('#modal-lwp').val(response.lwp);
                $('#modal-stuff-bus').val(response.stuff_bus);
                $('#modal-others-deduction').val(response.others_deduction);
                $('#modal-skrp-loan').val(response.skrp_loan);
                $('#modal-mobile-bill').val(response.mobile_bill);
                $('#modal-union-fee').val(response.union_fee);
                $('#modal-penalty').val(response.penalty);
                $('#modal-income-tex').val(response.income_tex);
                $('#modal-revenue-stamp').val(response.revenue_stamp);

                $('#modal-update-salary').modal('show');
            });
        });

        $('#modal-btn-update').click(function () {
            var formData = new FormData($('#modal-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_update.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-update-salary').modal('hide');
                        Swal.fire(
                            'Updated!',
                            response.message,
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        //Salary Update End

        $(document).ready(function()
        {
            $("#select-type-button").change(function() {
                if($(this).val() == "") {
                    $("#extra-add").hide();
                }
                else {
                    $("#extra-add").show();
                }
            });
        });


        //Initialize Select2 Elements
        $('.select2').select2()
        $('.selection-multiple').select2()
        // $(document).ready(function() {
        //     $('basic-multiple').select2();
        // });

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection



