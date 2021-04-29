
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
                <li class="active"><a href="#profile" data-toggle="tab">Extension Letter</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="profile">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                    <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                        <table class="table table-bordered"  >

                            <tr>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <h4>{{date('d-m-Y', strtotime($candidate->created_at))}}</h4>
                                        <p>{{$candidate->name}}</p>
                                        <p>{{$candidate->designation->name}}</p>
                                        <p>Employee Id: {{$candidate->employee_id}}</p>
                                        <p>Logic Automation Training Institute.</p>
                                        <p>Pabna-6600.</p>
                                        <p>Through: Managing Director.........................</p>
                                    </div>
                                </div>
                            </tr>
                            <tr>
                                <h4><p style="margin-top: 40px;margin-bottom: 43px;">Subject: Warning against unruly behavior and indicipline.</p></h4>
                            </tr>
                            <tr>
                                <div class="body">
                                    <p>Dear {{$candidate->name}},</p>

                                    {!! $candidate->warning_letter_body !!}

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

