

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
                            <form class="form-horizontal" method="POST" action="{{ route('job_confirmation_letter_input', ['candidate' => $candidate->id]) }}">
                                @csrf
                                <tr>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4>{{date('d-m-Y', strtotime($candidate->created_at))}}</h4>
                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <h3><u><p style="text-align: center;margin-top: 40px;margin-bottom: 43px;">Offer of Employment </p></u></h3>
                                </tr>

                                <tr>
                                    <div class="form-group {{ $errors->has('job_confirmation_letter_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Confirmation Letter Body</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="job_confirmation_letter_body" rows="10"><p>The management is pleased to confirm your appointment at our SAS Engineering & Construction
                                        A concern of Logic Group BD, Mariam Tower, 1st Floor, Gangkola, Pabna-6600, with effect from
                                        September 01, 2020 under following terms & conditions:
                                    </p>
                                    <p>1.	Designation			:	Electrician (Services)</p>
                                    <p>2.	Section / Department:	Services (LEL)</p>
                                    <p>3.	I D Number			:	0031</p>
                                    <p>3.	4.	Grade			:	M24</p>
                                    <p>5.	Basic Salary		:	Fixed at Tk. 9000/- (Nine thousand BDT ) only per
                                        Month plus admissible allowances.
                                    </p>
                                    <p>6.	The salary income tax, if any will be on your account and will be deducted at source as per income tax rules by the company at the time of monthly salary disbursement.</p>
                                    <p>7.	Your service is transferable to any place and any company within Square Group at the discretion of the management.</p>
                                    <p>8.	You are strictly forbidden to associate yourself in any manner with any other commercial or industrial enterprise without seeking prior permission of the management.</p>
                                    <p>9.	You are to abide by the company's rules and regulations as enforced from time to time.</p>
                                    <p>10.	Your appointment may be determined at 30 (thirty) days’ notice either given or received.</p>
                                    <p>Please sign the duplicate copy of this letter as a token of your having accepted this appointment with all the terms and conditions mentioned herein.</p>
                                    <p>With best wishes</p>
                                    <p>Yours sincerely</p>
                                    <p>Koushik Ahmad Sakil<br>Chairman.</p>
                                    <p>Logic Engineering Ltd.</p>
                                    <p>A Concern of Logic Group BD.</p></textarea>
                                            @error('job_confirmation_letter_body')
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
