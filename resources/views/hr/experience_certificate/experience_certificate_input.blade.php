


@extends('layouts.app')

@section('content')
@section('style')
@endsection
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#profile" data-toggle="tab">Experience Certificate</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="profile">

                    <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                        <table class="table table-bordered"  >
                            <form class="form-horizontal" method="POST" action="{{ route('experience_certificate_input', ['candidate' => $candidate->id]) }}">
                                @csrf

                                <tr>
                                    <h3><u><p style="text-align: center;margin-top: 40px;margin-bottom: 43px;">TO WHOM IT MAY CONCERN </p></u></h3>
                                </tr>

                                <tr>
                                    <div class="form-group {{ $errors->has('experience_certificate_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Body of Letter</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="experience_certificate_body" rows="10"> <p>This is to Certify that Mr. Abdul Momin, ID No: 0015 worked in our organization Logic Automation Training Institute as designation Sub
                                        Assistant Engineer (Electrical) in our Training Department from 07 Nov’2017 to 30 Apr’2018.
                                    </p>
                                    <p>
                                        We found his sincere, hardworking  and technically sound and result oriented during
                                        his tenure. Mr. Abdul Momin has a friendly, outgoing personality, a good sense of humor and works well as part of a team.
                                    </p>
                                    <p>His work output is positively influenced by his strength in communication and task-orientation.</p>
                                    <p>We wish him best in career ahead.</p>

                                    <p style="margin-top: 67px;margin-bottom: 60px;">You’re sincerely </p>

                                    <div class="letter-footer-one">

                                        <p>Koushik Ahamd Sakil</p>
                                        <p>Chairman  </p>
                                        <p>LOGIC Automation Training Institute.</p>
                                    </div></textarea>
                                            @error('experience_certificate_body')
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
