
@extends('layouts.app')

@section('content')
@section('style')
@endsection
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic & Training</a></li>
                <li class="active"><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                <li><a href="#leave">User Account</a></li>
                <li><a href="#leave">Report</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="profile">

                    <div class="row" id="prinarea_profile" style="margin-left: 30px;">

                        <table class="table table-bordered"  >
                            <form class="form-horizontal" method="POST" action="{{ route('job_description_input', ['candidate' => $candidate->id]) }}">
                                @csrf

                                <tr>
                                    <div class="row" style="margin-left: 0px;">
                                        <div class="col-xs-3 col-xs-offset-5">
                                            <div class="heading">
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <h3><u><p style="text-align: center;margin-top: 40px;margin-bottom: 43px;">Job Description </p></u></h3>
                                </tr>

                                <tr style="margin-top: 10px;">
                                    <div class="form-group {{ $errors->has('section') ? 'has-error' :'' }}"style="margin-bottom: 100px">
                                        <label class="col-sm-1 control-label">Section</label>

                                        <div class="col-sm-11">
                                            <textarea id="" class="form-control" name="section" rows="1"></textarea>
                                            @error('section')
                                            <span class="help-block"></span>
                                            @enderror
                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <div class="form-group {{ $errors->has('reporting_to') ? 'has-error' :'' }}" style="margin-bottom: 150px">
                                        <label class="col-sm-1 control-label">Reporting To</label>

                                        <div class="col-sm-11">
                                            <textarea id="" class="form-control" name="reporting_to" rows="1">Executive,Engineering</textarea>
                                            @error('reporting_to')
                                            <span class="help-block"></span>
                                            @enderror
                                        </div>
                                    </div>
                                </tr>


                                <tr>
                                    <div class="form-group {{ $errors->has('duties_and_responsibilities') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label  class="col-sm-1 control-label">Duties</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="duties_and_responsibilities" rows="10"><div class="description">
                                                <p>1.Cleaning job of all service/utility machines.</p>
                                                <p>2.Assisting of fitting job.</p>
                                                <p>3.Assisting of plubing job job.</p>
                                                <p>4.Cleaning of all utility technical area.</p>
                                                <p>5.Other technical job as & when required by the supervisor.</p>
                                            </div>
                                            <p><u><b>Cross Functional Activities</b></u></p>
                                            <p>Nill</p>
                                            <p><u><b>Job Delegation</b></u></p>
                                            <p>Nill</p> </textarea>
                                            @error('duties_and_responsibilities')
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
@endsection
