@extends('layouts.app')

@section('style')

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

    <style>
        span {
            margin-right: 10px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 2px;
            line-height: 1.5;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
    </style>

@endsection

@section('title')
    Employee Salary Slip
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <ul class="nav nav-tabs">
                        <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                        <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic & Training</a></li>
                        <li><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>
                        <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                        <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                        <li class="active"><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                        <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                        <li><a href="{{route('candidate_evalution_form.edit',['candidate' => $candidate->id])}}">Evalution</a></li>
                        <li><a href="#leave">User Account</a></li>
                        <li><a href="#leave">Report</a></li>
                    </ul>
                </div>
                <!-- /.box-header -->

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
                        <hr>

                        <div class="adv-table" id="prinarea">

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="logo">
                                        <div class="logo-img">
                                            <img src="{{asset('img/logo.png')}}" alt="" height="55px" width="70px"><span style="margin-left: 30px; font-size: 18px" >Logic Engineering Ltd.</span>
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


