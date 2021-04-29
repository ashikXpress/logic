@extends('layouts.app')

@section('content')
@section('style')
@endsection
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidate Evalution Information</h3>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="font-size: 20px;" class="text-center" width="100%" scope="col">ACADEMIC & TRAINING INFORMATION</th>

                </tr>
                </thead>
            </table>
            <u><h4 class="text-center">Academic Information</h4></u>

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('academic_wise.add',['academicTraining' => $academicTraining->id]) }}">
                @csrf

                <div class="box-body">

                    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                        <label class="col-md-2 control-label">Title </label>

                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Enter Title"
                                   name="title" value="{{ old('title') }}">
                            <input type="hidden" class="form-control"
                                   name="employee_id" value="{{$candidate->id}}">

                            @error('title')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" {{ $errors->has('institute') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Institute</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Institute"
                                       name="institute" value="{{ old('institute') }}">

                                @error('institute')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('department') ? 'has-error' :'' }}">
                        <label class="col-md-2 control-label">Department </label>

                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Enter Department"
                                   name="department" value="{{ old('department') }}">

                            @error('department')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" {{ $errors->has('passing_year') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Passing Year</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Passing Year"
                                       name="passing_year" value="{{ old('passing_year') }}">

                                @error('passing_year')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('result') ? 'has-error' :'' }}">
                        <label class="col-md-2 control-label">Result </label>

                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Enter Result"
                                   name="result" value="{{ old('result') }}">

                            @error('result')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" {{ $errors->has('out_off_result') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Out Off Result </label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Out Off Result"
                                       name="out_off_result" value="{{ old('out_off_result') }}">

                                @error('out_off_result')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('duration') ? 'has-error' :'' }}">
                        <label class="col-sm-2 control-label">Duration</label>

                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Enter Duration"
                                   name="duration" value="{{ old('duration') }}">

                            @error('duration')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" {{ $errors->has('academic_certificate') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Academic Certificate Image </label>

                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="academic_certificate">

                                @error('academic_certificate')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

{{--                <u><h4 class="text-center">Training Information</h4></u>--}}
{{--                <div class="box-body">--}}

{{--                    <div class="form-group {{ $errors->has('training_title') ? 'has-error' :'' }}">--}}
{{--                        <label class="col-md-2 control-label">Training Title </label>--}}

{{--                        <div class="col-md-4">--}}
{{--                            <input type="text" class="form-control" placeholder="Enter Training Title"--}}
{{--                                   name="training_title" value="{{ old('training_title') }}">--}}

{{--                            @error('training_title')--}}
{{--                            <span class="help-block">{{ $message }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

{{--                        <div class=" {{ $errors->has('training_institute') ? 'has-error' :'' }}">--}}
{{--                            <label class="col-md-2 control-label">Training Institute </label>--}}

{{--                            <div class="col-md-4">--}}
{{--                                <input type="text" class="form-control" placeholder="Enter Training Institute"--}}
{{--                                       name="training_institute" value="{{ old('training_institute') }}">--}}

{{--                                @error('training_institute')--}}
{{--                                <span class="help-block">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group {{ $errors->has('training_certificate') ? 'has-error' :'' }}">--}}
{{--                        <label class="col-md-2 control-label">Training Certificate image </label>--}}

{{--                        <div class="col-sm-4">--}}
{{--                            <input type="file" class="form-control" name="training_certificate">--}}

{{--                            @error('training_certificate')--}}
{{--                            <span class="help-block">{{ $message }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- CK Editor -->
    <script src="{{ asset('themes/backend/bower_components/ckeditor/ckeditor.js') }}"></script>

    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            CKEDITOR.replace('editor');--}}
    {{--        });--}}
    {{--        $(function () {--}}
    {{--            CKEDITOR.replace('editor2');--}}
    {{--        });--}}
    {{--    </script>--}}

    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
