@extends('layouts.app')

@section('content')
    @section('style')
    @endsection
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">Appointment Letter</a></li>
                    {{--                    <li><a href="#salary" data-toggle="tab">Salary</a></li>--}}
                    {{--                    <li><a href="#designation_log" data-toggle="tab">Designation Log</a></li>--}}
                    {{--                    <li><a href="#leave" data-toggle="tab">Leave</a></li>--}}
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                        <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                            <table class="table table-bordered"  >

                                <tr style="height: 100%;width: 100%">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <div class="logo" style="margin-top: 26px;margin-left: 22px;">
                                                <div class="logo-img">
                                                    <img src="{{asset('img/logo.png')}}" alt="" height="120px" width="120px">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xs-10">
                                            <div class="heading">
                                                <strong><h1 style="color: #00B050;font-family: broadway; font-size: 43px;">LOGIC</h1></strong>
                                                <strong><h1 style="color:#FF0000;font-family: times-new-roman;font-size: 33px;">ENGINEERING LIMITED</h1></strong>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <hr style="margin-right: 16px;border-top: 4px solid #B898D0;">

                                <tr>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p>{{$candidate->hr}}</p>
                                            <p>{{$candidate->name}}</p>
                                            <p>{{$candidate->fathers_name}}</p>
                                            <p>{{$candidate->post_office}}</p>
                                            <p>{{$candidate->police_station}}</p>
                                            <p>{{$candidate->villaeg}}</p>
                                            <p>{{$candidate->district}}</p>

                                        </div>
                                        <div class="col-xs-3 col-xs-offset-5">
                                            <div class="heading">
                                                <h4>{{date('d-m-Y', strtotime($candidate->created_at))}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <p>subject: {{$candidate->subject}} </p>
                                </tr>
                                <tr>
                                    <h3>Dear {{$candidate->name}}</h3>
                                    <div class="body">
                                        {!! $candidate->appointment_letter_body !!}
                                    </div>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr style="border-top: 4px solid #B898D0;">

{{--                    <div class="addrea" style="text-align: center;">--}}
{{--                        {!! $candidate->address !!}--}}
{{--                    </div>--}}

                    <table class="table table-bordered" style="" >


                    </table>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('script')
    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>

@endsection
