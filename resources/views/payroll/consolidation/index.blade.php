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
    Consolidation History
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
                    <form action="{{ route('payroll.consolidation') }}">
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
            @if($salaries)
                <section class="panel">
                    <div class="panel-body">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>
                        <div class="adv-table" id="prinarea">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="margin-bottom: 0px">
                                    <tr>
                                        <th colspan="28" class="text-center">Logic Group BD.</th>
                                    </tr>
                                    <tr>
                                        <th colspan="28" class="text-center">Moriom Tower, Gangkola, Pabna-6600</th>
                                    </tr>
                                    <tr>
                                        <th colspan="28" class="text-center">Consolidation or Month Of January 2021</th>
                                    </tr>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Employment Status</th>
                                        <th>Name of Employee</th>
                                        <th>Employee ID</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>CTC</th>
                                        <th>Basic Salary</th>
                                        <th>House Rent</th>
                                        <th>Conveyance</th>
                                        <th>Medical Expenses</th>
                                        <th>Bonus</th>
                                        <th>Special Allowance</th>
                                        <th>Advanced</th>
                                        <th>Transport Allowance</th>
                                        <th>Dinner Allowance</th>
                                        <th>Mobile Bill</th>
                                        <th>Others</th>
                                        <th>Total Gross Salary</th>
                                        <th>Bank Fund</th>
                                        <th>Lone</th>
                                        <th>Penalty</th>
                                        <th>Income Tex</th>
                                        <th>Revenue Stamp</th>
                                        <th>Miscellaneous</th>
                                        <th>Kollan Trust</th>
                                        <th>Total Deduction</th>
                                        <th>Net Payble</th>
                                    </tr>
                                    @php
                                        $totalNetPayble = 0;
                                    @endphp
                                    @php
                                        $totaDeduction = 0;
                                    @endphp
                                    @foreach($salaries as  $salarie)
                                        @php
                                            $gross_salary = $salarie->gross_salary;
                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$salarie->employee->status}}</td>
                                            <td>{{$salarie->employee->name}}</td>
                                            <td>{{$salarie->employee->employee_id}}</td>
                                            <td class="text-center">
                                                @if($salarie->month == 1)
                                                    <span>April</span>
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
                                            <td>{{$salarie->year}}</td>
                                            <td>{{$salarie->gross_salary}}</td>
                                            <td>{{$salarie->basic_salary}}</td>
                                            <td>{{$salarie->house_rent}}</td>
                                            <td>{{$salarie->conveyance}}</td>
                                            <td>{{$salarie->medical}}</td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->bonus??0}}
                                                    @php
                                                        $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->bonus??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->speacial_allowance??0}}
                                                @php
                                                    $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->speacial_allowance??0;
                                                @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->advance??0}}
                                                    @php
                                                        $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->advance??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->transport_allowence??0}}
                                                    @php
                                                        $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->transport_allowence??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->dinner_allowence??0}}
                                                    @php
                                                        $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->dinner_allowence??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->mobile_bill??0}}
                                                    @php
                                                        $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->mobile_bill??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->others??0}}
                                                    @php
                                                        $gross_salary +=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->others??0;
                                                    @endphp

                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>{{$gross_salary}}</td>
                                            <td>{{$salarie->deduction}}</td>
                                            <td>{{$salarie->loan??'0'}}</td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->penalty??0}}
                                                    @php
                                                        $gross_salary -=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->penalty??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->income_tex??0}}
                                                    @php
                                                        $gross_salary -=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->income_tex??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->revenue_stamp??0}}
                                                    @php
                                                        $gross_salary -=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->revenue_stamp??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->miscellaneous??0}}
                                                    @php
                                                        $gross_salary -=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->miscellaneous??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year))
                                                    {{$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->kollan_trust??0}}
                                                    @php
                                                        $gross_salary -=$salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->kollan_trust??0;
                                                    @endphp
                                                @else
                                                    <span>0</span>
                                                @endif
                                            </td>
                                            <td>{{$salarie->deduction + ($salarie->loan??0) + ($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->miscellaneous??0)+
                                                ($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->revenue_stamp??0)+
                                                ($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->income_tex??0)+
                                                ($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->penalty??0)+
                                                ($salarie->salaryChange($salarie->employee_id,$salarie->month,$salarie->year)->kollan_trust??0)}}</td>
                                            <td>
                                                {{$gross_salary - ($salarie->deduction + $salarie->loan)}}
                                            </td>
                                        </tr>
                                        @php
                                            $totalNetPayble += $gross_salary - ($salarie->deduction + $salarie->loan) ;
                                        @endphp
                                        @php
                                            $totaDeduction += $salarie->deduction;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <th colspan="27" class="text-center">Total Net Payble</th>
                                        <th colspan="1" class="text-center">{{$totalNetPayble}}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="26" class="text-center">Total Deduction</th>
                                        <th colspan="2" class="text-center">{{$totaDeduction}}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="11" class="text-center" style="padding-top: 70px">Signature Of Account</th>
                                        <th colspan="9" class="text-center" style="padding-top: 70px">Signature Of Managing Director</th>
                                        <th colspan="8" class="text-center" style="padding-top: 70px">Signature Of Chairman</th>
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


