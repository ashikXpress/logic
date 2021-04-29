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
    Employee Payment  History
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12" style="min-height:300px">


            <section class="panel">

                <div class="panel-body">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>

                    <div class="adv-table" id="prinarea">
                        <div class="table-responsive">

                            <table class="table table-bordered" style="margin-bottom: 0px">
                                <tr>
                                    <th colspan="29" class="text-center">Logic Group BD.</th>
                                </tr>
                                <tr>
                                    <th colspan="29" class="text-center">Moriom Tower, Gangkola, Pabna-6600</th>
                                </tr>
{{--                                <tr>--}}
{{--                                    <th colspan="29" class="text-center">Consolidation or Month Of January 2021</th>--}}
{{--                                </tr>--}}
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
                                    <th>Advance</th>
                                    <th>Transport Allowance</th>
                                    <th>Dinner Allowance</th>
                                    <th>Mobile Bill</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                    <th>Bank Fund</th>
                                    <th>Lone</th>
                                    <th>Penalty</th>
                                    <th>Income Tex</th>
                                    <th>Revenue Stamp</th>
                                    <th>Miscellaneous</th>
                                    <th>Kollan Trust</th>
                                    <th>Total</th>
                                    <th>Net Payble</th>
                                    <th>Deduction Amount History</th>
                                </tr>

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
                                    <td>{{$salarie->year}}</td>
                                    <td>{{$salarie->gross_salary}}</td>
                                    <td>{{$salarie->basic_salary}}</td>
                                    <td>{{$salarie->house_rent}}</td>
                                    <td>{{$salarie->conveyance}}</td>
                                    <td>{{$salarie->medical}}</td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->bonus??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->bonus??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->speacial_allowance??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->speacial_allowance??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->advance??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->advance??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->transport_allowence??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->transport_allowence??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->dinner_allowence??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->dinner_allowence??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->mobile_bill??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->mobile_bill??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->others??0}}
                                            @php
                                                $gross_salary +=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->others??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>{{$gross_salary}}</td>
                                    <td>{{$salarie->deduction}}</td>
                                    <td>{{$salarie->loan??0}}</td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->penalty??0}}
                                            @php
                                                $gross_salary -=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->penalty??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->income_tex??0}}
                                            @php
                                                $gross_salary -=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->income_tex??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->revenue_stamp??0}}
                                            @php
                                                $gross_salary -=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->revenue_stamp??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->miscellaneous??0}}
                                            @php
                                                $gross_salary -=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->miscellaneous??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year))
                                            {{$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->kollan_trust??0}}
                                            @php
                                                $gross_salary -=$salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->kollan_trust??0;
                                            @endphp
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$salarie->deduction + ($salarie->loan??0) + ($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->miscellaneous??0)+
                                                ($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->revenue_stamp??0)+
                                                ($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->income_tex??0)+
                                                ($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->penalty??0)+
                                                ($salarie->PaymentHistory($salarie->employee_id,$salarie->month,$salarie->year)->kollan_trust??0)}}
                                    </td>
                                    <td>{{$gross_salary - ($salarie->deduction + $salarie->loan??0)}}</td>
                                    <td><span class="btn btn-danger">Not Payment</span></td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </section>

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

        $('#year').change(function () {
            var year = $(this).val();
            $('#month').html('<option value="">Select Month</option>');

            if (year != '') {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_month') }}",
                    data: { year: year }
                }).done(function( response ) {
                    $.each(response, function( index, item ) {
                        $('#month').append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                });
            }
        });

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection


