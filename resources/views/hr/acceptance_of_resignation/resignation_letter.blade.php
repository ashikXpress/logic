
@extends('layouts.app')

@section('content')
@section('style')
    <style>
        .tab-content p{
            font-family: Calibri;
        }
    </style>

@endsection
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#profile" data-toggle="tab">Resignation Letter</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="profile">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                    <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                        <table class="table table-bordered"  >

                            <tr>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p>{{$candidate->name}}</p>
                                        <p>{{$candidate->designation->name}}</p>
                                        <p>Employee Id: {{$candidate->id}}</p>
                                        <p>Logic Automation Training Institute.</p>
                                        <p>Pabna-6600.</p>
                                        <p>Dear {{$candidate->name}},</p>

                                    </div>
                                </div>
                            </tr>

                            <tr>
                                <h3><u><p style="text-align: center;margin-top: 40px;margin-bottom: 43px;">Acceptance of Resignation </p></u></h3>
                            </tr>
                            <tr>
                                <div class="body">
                                   {!! $candidate->resignation_letter_body !!}
                                </div>
                            </tr>
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
    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>

@endsection

