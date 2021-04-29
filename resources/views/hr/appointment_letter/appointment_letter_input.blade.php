
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
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="profile">
{{--                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>--}}

                    <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                        <table class="table table-bordered"  >
                            <form class="form-horizontal" method="POST" action="{{ route('appointment_letter_input', ['candidate' => $candidate->id]) }}">
                                @csrf
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
                                    <div class="row" style="margin-left: 0px;">
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

                                <tr style="margin-top: 10px;">
                                    <div class="form-group {{ $errors->has('subject') ? 'has-error' :'' }}">
                                        <label class="col-sm-1 control-label">subject</label>

                                        <div class="col-sm-11">
                                            <textarea id="" class="form-control" name="subject" rows="2">Appointment as 'Junior Sub Assistant Engineer (Civil). </textarea>
                                            @error('subject')
                                            <span class="help-block"></span>
                                            @enderror
                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="form-group {{ $errors->has('appointment_letter_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Body of Letter</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="appointment_letter_body" rows="10"><p>The Contract management Basis as is Junior pleased Sub to offer Assistant you an appointment Engineer (Civil)</p>
                                            <p>at Square in the Pharmaceuticals Engineering Department Ltd. Pabna</p> <h3>Trams & conditions:</h3>
                                    <p>This contract will be valid for 02 (two) years which may be renewed further.</p>
                                    <p>2.	During the contract period you will be entitled to a consolidated salary of Tk. 8,000/- (Taka Eight thousand) only per month and 2 (two) festival bonuses per year equivalent to 40% of your monthly emoluments,</p>
                                    <p>3.	You will have to produce photocopies of academic certificates, two reference letters, clearance latter from your previous employer (if any) at the time of your joining,</p>
                                    <p>4.	You are forbidden to directly or indirectly or in any manner to associate yourself with any other commercial or industrial enterprise during the contract period.</p>
                                    <p>5.	Your appointment is subject to agreeing to abide by the company's rules and regulations as in force from time to time.</p>
                                    <p>6.	You will be entitled 10 days general leave and 10 days medical leave (to be taken on submission of medical certificate) with pay per year.</p>
                                    <p>7.	One month's notice or pay in lieu of will be required for terminating this appointment from either side.</p>
                                    <p>8.	You are requested to join on August 2, 2014 and report for duty to Mr. Mazibur Rahman, Manager, Maintenance, Engineering Department, Pabna Unit, Salgaria, Pabna .Your appointment ml take effect from the date of your joining.</p>
                                    <p>9.Although we understand that this offer is acceptable to you, please sign the duplicate copy of this letter as an expression of your acceptance.</p> <h5>A K Pual</h5>
                                    <h6>General Manager</h6>
                                    <h7>Human Resources</h7>
                                    <p>cc:</p><p>1. Resident Advisor, Pabna</p>
                                    <p>2. Executive Director, Operations</p>
                                    <p>3. Senior Manager, Engineering Department</p>
                                    <p>4.	Manager, Maintenance, Engineering Department</p>
                                    <p>5.	Human Resource Department, Pabna</p>
                                    <p>6.	Accounts & Finance Department, Dhaka / Pabna</p>
                                    <p>7.	Personal file</p>
                                    <p>8.	Office copy</p> </textarea>
                                            @error('appointment_letter_body')
                                            <span class="help-block"></span>
                                            @enderror
                                        </div>
                                    </div>
                                </tr>


                                <tr>
                                    <div class="button">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </tr>
                            </form>
                        </table>
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
    <!-- CK Editor -->
    <script src="{{ asset('themes/backend/bower_components/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function () {
            CKEDITOR.replace('editor');
        });
        $(function () {
            CKEDITOR.replace('editor2');
        });
    </script>

    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
