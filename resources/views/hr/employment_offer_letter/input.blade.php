

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
                            <form class="form-horizontal" method="POST" action="{{ route('employment_offer_letter_input', ['candidate' => $candidate->id]) }}">
                                @csrf
                                <tr>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <h4>{{date('d-m-Y', strtotime($candidate->created_at))}}</h4>
                                            <p>{{$candidate->name}}</p>
                                            <p>{{$candidate->villaeg}}</p>
                                            <p>{{$candidate->police_station}}</p>
                                            <p>{{$candidate->district}}</p>

                                            <p>Dear {{$candidate->name}},</p>

                                        </div>
                                    </div>
                                </tr>

                                <tr>
                                    <h3><u><p style="text-align: center;margin-top: 40px;margin-bottom: 43px;">Offer of Employment </p></u></h3>
                                </tr>

                                <tr>
                                    <div class="form-group {{ $errors->has('employment_offer_letter_body') ? 'has-error' :'' }}" style="margin-top: 80px;">
                                        <label class="col-sm-1 control-label">Employment Letter Body</label>

                                        <div class="col-sm-11">
                                            <textarea id="editor" class="form-control" name="employment_offer_letter_body" rows="10"><p>We reference to your application and the subsequent interview you had with us, we are pleased to offer you employment in the position of “Electrician (Services)” in Logic Engineering Ltd.
                                        subject to the following terms and conditions.</p>
                                    <p>The compensation Package for this posting is attached.</p>
                                    <p>Your initial posting will be at our head office at Moriom Tower (1st Floor), Holding No:108/4, Gangkola, Pabna-6600, Bangladesh.
                                        You are direct to report to the Managing Director for completing the joining formalities.</p>
                                    <p>You will be reporting to the Managing Director of the office you are posted. If you accept this offer, you will be on Probation for one year from the date of your joining our service.
                                        The notice period for termination of your employment will be one month during probation and confirmation.</p>
                                    <p>A detailed Appointment Order will be given to you at the time of joining.
                                        We hope you will join soon for a long and mutually beneficial relationship.</p>
                                    <p>You’re truly</p>
                                    <p>Koushik Ahmad Sakil<br>Chairman.</p>
                                    <p>Logic Engineering Ltd.</p>
                                    <p>Copy to:	1) Personal File.</p>
                                    <p>E. Copy to 	2) Chairman, Managing Director and Director</p><p class="text-center"><u>EMPLOYMENT TERMS AND CONDITION</u></p>
                                    <p>1.	This contract will be valid for one year, which may be renewed further</p>
                                    <p>2.	During the contract period, you will be entitled to a consolidated salary of Tk. 9,000/- (Nine thousand BDT) only per month
                                        and 2 (two) festival bonuses per year equivalent to 50% of your monthly emoluments</p>
                                    <p>3.	During the contract period, you will be entitled to a consolidated salary of Tk. 9,000/- (Nine thousand BDT)
                                        only per month and 2 (two) festival bonuses per year equivalent to 50% of your monthly emoluments</p>
                                    <p>4.	You are forbidden to directly or indirectly or in any manner to associate yourself with any other
                                        commercial or industrial enterprise during the contract period.</p>
                                    <p>5.	Your appointment is subject to agreeing to abide by the
                                        company's rules and regulations as in force from time to time.</p>
                                    <p>6.	You will be entitled 05 days Casual leave, 05 days earned leave and 10 days medical leave
                                        (to be taken on submission of medical certificate) with pay per year.</p>
                                    <p>7.	One month's notice or pay in lieu of will be required for terminating this
                                        appointment from either side.</p>
                                    <p>8.	You are requested to join on September 01, 2020 and report for duty to Mr.
                                        Azizur Rahman, Managing Director Maintenance, Engineering Department, Pabna Unit, Salgaria, Pabna. Your appointment ml takes effect from the date of your joining.</p>
                                    <p>Although we understand that this offer is acceptable to you, please sign the duplicate
                                        copy of this letter as an expression of your acceptance.</p></textarea>
                                            @error('employment_offer_letter_body')
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
