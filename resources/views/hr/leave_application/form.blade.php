@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #000 !important;
}
    </style>
@endsection

@section('title')
    Leave Application Form
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">Candidate Leave Form</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                        <div class="row" id="prinarea_profile">
                            <div class="col-xs-12">
                                <form method="post" action="">
                                    <table class="table table-bordered" style="margin-top: 45px;" >

                                        <tr>
                                            <h2 style="text-align: center"><b>Logic Automation Technologies</b></h2>
                                            <b><p style="text-align: center">Khan Market(5th Floor),Dillalpur,Pabna-6600,Bangladesh</p></b>
                                        </tr>

                                        <tr>
                                            <div class="row">
                                                <div class="col-xs-4 col-xs-offset-4">
                                                    <u><p style="font-size: 20px; height:40px; text-align: center;margin-top: 20px;margin-bottom: 43px;border: 2px solid;border-radius: 20px;">Leave Application Form </p></u>

                                                </div>
                                            </div>
                                        </tr>

                                        <tr>
                                            <th width="10%">Date</th>
                                            <td width="23.33%">{{date('d-m-Y', strtotime($leave->created_at??''))}}</td>
                                            <th width="10%">Department</th>
                                            <td width="23.33%">{{$candidate->employee->department->name??''}}</td>
                                            <th width="10%">Employee Id</th>
                                            <td width="23.33%">{{$candidate->employee_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td colspan="2">{{$candidate->employee->name??''}}</td>
                                            <th>Designation</th>
                                            <td colspan="2">{{$candidate->employee->designation->name??''}}</td>
                                        </tr>
                                        <tr class="leave-duration">
                                            <th width="10%">From</th>
                                            <td width="23.33%">{{date('d-m-Y',strtotime($leave->from??''))}}</td>
                                            <th width="10%">To</th>
                                            <td width="23.33%">{{date('d-m-Y',strtotime($leave->to??''))}}</td>
                                            <th width="10%">Total Day</th>
                                            <td width="23.33%">{{$leave->total_days??''}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Leave Type</th>
                                            <td colspan="2" style="text-align: center">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                                    {{ empty(old('type')) ? ($errors->has('type') ? '' : ($leave->type == '1' ? 'checked' : '')) :
                                             (old('type') == '1' ? 'checked' : '')}}>
                                                <label class="form-check-label" for="exampleCheck1">Casual leave</label></td>

                                            <td colspan="2" style="text-align: center">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="2"
                                                    {{ empty(old('type')) ? ($errors->has('type') ? '' : ($leave->type == '2' ? 'checked' : '')) :
                                                    (old('type') == '2' ? 'checked' : '')}}>
                                                <label class="form-check-label" for="exampleCheck1">Annual leave</label></td>
                                            <td style="text-align: center">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value=""
                                                    {{ empty(old('type')) ? ($errors->has('type') ? '' : ($leave->type == '3' ? 'checked' : '')) :
                                                    (old('type') == '3' ? 'checked' : '')}}>
                                                <label class="form-check-label" for="exampleCheck1">Medical leave</label></td>

                                        </tr>
                                        <tr>
                                            <th>Reason</th>
                                            <td colspan="2">{{$leave->note??''}}</td>
                                            <th>Phone Number</th>
                                            <td colspan="2">{{$candidate->mobile_no}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" id="twelve-hour-clock">Address of leaving time</th>
                                            <td colspan="4">{{$leave->created_at->diffForHumans()??''}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Last Date of leaving</th>
                                            <td colspan="4">{{date('Y-m-d', strtotime($lastDateofLeave->created_at))}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: center">Leave Details</th>
                                            <th colspan="3" rowspan="5"></th>
                                        </tr>
                                        <tr>
                                            <th>Leave Type</th>
                                            <th style="text-align: center">Used</th>
                                            <th style="text-align: center">Remain</th>

                                        </tr>
                                        <tr>
                                            <th>Casual leave</th>
                                            <td class="text-center">
                                                @if($leave->type == '1' ? 'checked' : '')
                                                    {{$annualLeaveSum}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-center">

                                                @if($leave->type == '1' ? 'checked' : '')
                                                    {{$annualLeaveRemaining}}
                                                @else
                                                    5
                                                @endif
                                                </td>

                                        </tr>
                                        <tr>
                                            <th>Annual leave</th>
                                            <td class="text-center">
                                                @if($leave->type == '2' ? 'checked' : '')
                                                    {{$casualLeaveSum}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-center">

                                                @if($leave->type == '2' ? 'checked' : '')
                                                    {{$casualLeaveRemaining}}
                                                @else
                                                    5
                                                @endif
                                                </td>

                                        </tr>
                                        <tr>
                                            <th>Medical leave</th>
                                            <td class="text-center">
                                                @if($leave->type == '3' ? 'checked' : '')
                                                    {{$medicalLeaveSum}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($leave->type == '3' ? 'checked' : '')
                                                    {{$annualLeaveRemaining}}
                                                @else
                                                    10
                                                @endif

                                                </td>
                                        </tr>

                                        <tr style="height:100px">
                                            <td colspan="3">
                                                <div class="button" id="btn-ok">
                                                    <a class="btn btn-primary" href="{{route('leave_application')}}">OK</a>
{{--                                                    <button type="" class="btn btn-primary">OK</button>--}}
                                                </div>
                                            </td>
                                            <td colspan="2" style="text-align: center;padding-top: 68px;font-size: 16px;">Applicant Signature</td>
                                            <td style="text-align: center;padding-top: 68px;font-size: 16px;">Approved By</td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection


@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function () {
            //Date picker
            $('#from, #to, #date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                orientation: 'bottom'
            });

            //Initialize Select2 Elements
            $('.select2').select2();
        });
        $('body').on('keyup', '.from,.to', function () {
            calculate();
        });
        function calculate() {
            var total = 0;

            $('.leave-duration').each(function(i, obj) {
                var from = $('.from:eq('+i+')').val();
                var to = $('.to:eq('+i+')').val();


                if (from == '' || from < 0 || !$.isDate(from))
                    from = 0;

                if (to == '' || to < 0 || !$.isDate(to))
                    to = 0;


                $('.total:eq('+i+')').val((from + to).toFixed(2) );

            });


            $('#total').html(total.toFixed(2));

        }
    </script>
    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            $('#btn-ok').hide();
            window.print();
            window.location.replace(APP_URL)
        }
        

    </script>
@endsection

