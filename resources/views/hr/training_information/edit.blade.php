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
                    <th style="font-size: 20px;" class="text-center" width="100%" scope="col">TRAINING INFORMATION</th>

                </tr>
                </thead>
            </table>

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('training_information.edit',['candidate' => $candidate->id]) }}">
                @csrf

                <u><h4 class="text-center">Training Information</h4></u>
                <div class="box-body">

                    <div class="form-group {{ $errors->has('training_title') ? 'has-error' :'' }}">
                        <label class="col-md-2 control-label">Training Title </label>

                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Enter Training Title"
                                   name="training_title" value="{{ empty(old('training_title')) ? ($errors->has('training_title') ? '' : $trainingInformation->training_title) : old('training_title') }}">

                            @error('training_title')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" {{ $errors->has('training_institute') ? 'has-error' :'' }}">
                            <label class="col-md-2 control-label">Training Institute </label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Enter Training Institute"
                                       name="training_institute" value="{{ empty(old('training_institute')) ? ($errors->has('training_institute') ? '' : $trainingInformation->training_institute) : old('training_institute') }}">

                                @error('training_institute')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('training_certificate') ? 'has-error' :'' }}">
                        <label class="col-md-2 control-label">Training Certificate image </label>

                        <div class="col-sm-4">
                            <input type="file" class="form-control" name="training_certificate">

                            @error('training_certificate')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

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

    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
