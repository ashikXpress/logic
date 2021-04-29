

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

                    <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                        <table class="table table-bordered"  >
                            <form class="form-horizontal" method="POST" action="{{ route('resignation_letter_input', ['candidate' => $candidate->id]) }}">
                                @csrf
                                <tr>
                                    <div class="row" style="margin-left: 0px;">
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
                                    <div class="form-group {{ $errors->has('resignation_letter_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Body of Letter</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="resignation_letter_body" rows="10"> <p>With reference to your letter of resignation dated on November 01, 2017. This is to inform you that the management
                                        has accepted the same of decided to release you from your duties effective from November 12, 2017.
                                    </p>
                                    <p>Please hand over your charges as per instruction of Mr. Md. Feroz Hasan, Supervisor, Logic Automation Training Institute and obtain clearance for the submitted for the final settlement.</p>
                                    <p>You are requested to contact the Accounts Department during normal office hours for final settlement of your accounts.</p>
                                    <p>We wish you every success and happiness in your future career.</p>

                                    <p style="margin-top: 67px;margin-bottom: 60px;">You’re sincerely </p>

                                    <div class="letter-footer-one">
                                        <p>Md. Azizur Rahman.</p>
                                        <p>Managing Director.  </p>
                                        <p>Logic Automation Training Institute.</p>
                                    </div>

                                    <div class="letter-footer-two" style="margin-top: 72px;margin-bottom: -10px;">
                                        <p>CC:</p>
                                    </div>
                                    <div class="footer-end" style="margin-left: 33px;">
                                        <p>1. Chairman</p>
                                        <p>2. Human Resource Department.  </p>
                                        <p>3. Accounts.</p>
                                        <p>4. Office Copy.</p>
                                        <p>5. Personal File.</p>
                                    </div></textarea>
                                            @error('resignation_letter_body')
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
