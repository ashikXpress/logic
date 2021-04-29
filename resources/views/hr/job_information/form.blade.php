@extends('layouts.app')

@section('content')
@section('style')
@endsection
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Candidate Job Information</h3>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="font-size: 20px;" class="text-center" width="100%" scope="col">Job INFORMATION</th>

                </tr>
                </thead>
            </table>
            <u><h4 class="text-center">Add Previous Job Information</h4></u>

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('job_information_form',['candidate' => $candidate->id]) }}">
                @csrf

                <div class="box-body">

                    <div class="form-group {{ $errors->has('previous_company_name') ? 'has-error' :'' }}">
                        <label class="col-md-3 control-label"> Previous Company Name</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Previous Company Name"
                                   name="previous_company_name" value="{{ old('previous_company_name') }}">

                            @error('previous_company_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('previous_company_designation') ? 'has-error' :'' }}">
                        <label class="col-md-3 control-label">Previous Company Designation </label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Enter Previous Company Designation"
                                   name="previous_company_designation" value="{{ old('previous_company_designation') }}">

                            @error('previous_company_designation')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('from') ? 'has-error' :'' }}">

                        <label class="col-md-3 control-label">Previous Job Duration From </label>

                        <div class="col-md-3">
                            <input type="date" class="form-control job-duration" id="from"
                                   name="from" value="{{ old('from"') }}">

                            @error('from')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="col-md-1 control-label">Duration To </label>
                        <div class="col-md-3">
                            <input type="date" class="form-control job-duration" id="to"
                                   name="to" value="{{ old('to"') }}">

                            @error('to')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <input type="text" class="form-control total-duration" placeholder="Total Duration" id="total-duration"
                                   name="total_duration">

                            @error('total_duration')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('major_responsibility') ? 'has-error' :'' }}">
                        <label class="col-sm-3 control-label">Major Responsibility</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Enter Major Responsibility"
                                   name="major_responsibility" value="{{ old('major_responsibility') }}">

                            @error('major_responsibility')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('experience_certificate') ? 'has-error' :'' }}">
                        <label class="col-md-3 control-label">Experience Certificate Image </label>

                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="experience_certificate">

                            @error('experience_certificate')
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
    <script src="{{ asset('themes/backend/js/moment.min.js') }}"></script>

    <script>

        $(".job-duration").change(function(){

            var a = moment(document.getElementById("from").value);
            var b = moment(document.getElementById("to").value);
            var diffDays = b.diff(a, 'days');

            var days = diffDays;
            var calculateTimimg = d => {
                let months = 0, years = 0, days = 0, weeks = 0;
                while(d){
                    if(d >= 365){
                        years++;
                        d -= 365;
                    }else if(d >= 30){
                        months++;
                        d -= 30;
                    // }else if(d >= 7){
                    //     weeks++;
                    //     d -= 7;
                    }else{
                        days++;
                        d--;
                    }
                };
                return {
                    years, months, days
                };
            };
            var total = calculateTimimg(days).years+ '  ' +"Years"+ '  ' + calculateTimimg(days).months+ '  ' +"Months"+ '  ' +calculateTimimg(days).days+ '  ' +"Days";
            document.getElementById("total-duration").value = total;

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
