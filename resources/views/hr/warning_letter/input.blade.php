

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
                            <form class="form-horizontal" method="POST" action="{{ route('warning_letter_input', ['candidate' => $candidate->id]) }}">
                                @csrf
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
                                    <div class="form-group {{ $errors->has('warning_letter_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Warning Letter</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="warning_letter_body" rows="10">
                                    <p>You have already read our company policy and so you must be award by now what action we can take against you regarding this. Since you are still in your professional learning period,
                                        we suggest you improved your behavior and be punctual; otherwise this can lead to termination of employment.
                                        We also expect you to be cordial towards you fellow employees and seniors and not indulge in unruly behaviour.
                                        We are officially suggested divided your personal affair and official responsibility.
                                    </p>
                                    <p>You’re sincerely </p>
                                    <p>Md. Feroz Hasan</p>
                                    <p>Supervisor</p>
                                    <p>Logic Automation Training Institute</p></textarea>
                                            @error('warning_letter_body')
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
