
@extends('layouts.app')
@section('title')
    System of Id card
@endsection

@section('content')
    <div class="pre-print-area">
        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>
        <div class="print-area" id="prinarea_profile">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom" style="border: 6px solid #2D3422;">
                            <div class="tab-pane active" id="profile">
                                <div class="row" id="profile">
                                    <table class="table table-bordered">
                                        <tr>
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <div class="logo" style="margin-left: 16px;">
                                                        <div class="logo-img">
                                                            <img src="{{asset('img/logo.png')}}" alt="" height="90px" width="90px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-10">
                                                    <div class="heading" style="margin-left: 25px">
                                                        <strong><h1 style="color: #E4342B;font-family: broadway; font-size: 30px; margin-left: 18px;margin-bottom: 5px;margin-top: 7px;">LOGIC</h1></strong>
                                                        <strong style="font-family: PlayfairDisplay-Regularcolor;color:#2E592E;margin-left: 12px;font-size: 22px">Automation Technologies</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div style="text-align: center;margin-top: 0px;" class="profile-image">
                                                        <img src="{{asset($employee->image)}}" alt="" height="140" width="130" style="border: 1px solid #2E592E">

                                                    </div>
                                                </div>

                                                <div class="col-xs-12">
                                                    <div class="profile-name" style="text-align: center;">
                                                        <b><p style="font-family: PlayfairDisplay-Regularcolor;color:#273430;margin-bottom: -6px;font-size: 29px;">{{$employee->name}}</p></b>
                                                        <p style="font-family: PlayfairDisplay-Regularcolor;color:#273430;margin-bottom: -6px;font-size: 24px;">{{$employee->designation->name}}</p>
                                                        <p style="font-family: PlayfairDisplay-Regularcolor;color:#273430;margin-bottom: -6px;font-size: 24px;">ID: {{$employee->id}}</p>
                                                        <p style="font-family: PlayfairDisplay-Regularcolor;color:#273430;margin-bottom: -6px;font-size: 24px;">Blood: O+(Ve)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 60px;margin-bottom: -45px;">

                                                <div class="col-xs-6">
                                                    <hr style="margin-top: 40px;width:125px">
                                                    <div class="employee-signature">
                                                        <p style="font-family: PlayfairDisplay-Regularcolor;color:#2E592E;font-size: 15px;margin-left: 21px;margin-top: -20px;">Employer signature</p>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6">
                                                    <div class="authorized-signature">
                                                        <hr style="margin-top: 40px;width:134px;margin-right: 24px;">
                                                        <p style="font-family: PlayfairDisplay-Regularcolor;color:#2E592E;font-size: 15px;margin-left: 5px;margin-top: -20px;">Authorized signature</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
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
