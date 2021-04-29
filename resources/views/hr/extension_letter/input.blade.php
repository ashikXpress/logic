

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
                            <form class="form-horizontal" method="POST" action="{{ route('extension_letter_input', ['candidate' => $candidate->id]) }}">
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
                                        <div class="col-xs-3 col-xs-offset-5">
                                            <div class="heading">
                                                <h4>{{date('d-m-Y', strtotime($candidate->created_at))}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <h3><u><p style="text-align: center;margin-top: 40px;margin-bottom: 43px;">Acceptance of Resignation </p></u></h3>
                                </tr>

                                <tr>
                                    <div class="form-group {{ $errors->has('extension_letter_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Extension Letter</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="extension_letter_body" rows="10"><p>With reference to the letter of appointment no. HR/ 1791/14 dated July 14, 2014 this is to inform you that your Contractual
                                        Period is extended for further period of 01 (one) year with effect from August 2, 2016
                                        with same terms & conditions contained in the letter of appointment mentioned above.</p>
                                    <p>The management expects that you will try your best to perform your duties satisfactorily.</p>
                                    <p>A K Paul</p>
                                    <p>General Manager</p>
                                    <p>Human Resources</p>
                                    <p>1. Department Head</p>
                                    <p>2. Human Resource Department, Dhaka Unit</p>
                                    <p>3. Accounts & Finance Deptt. Dhaka</p>
                                    <p>4. Personal File</p>
                                    <p>5. Office copy</p></textarea>
                                            @error('extension_letter_body')
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
