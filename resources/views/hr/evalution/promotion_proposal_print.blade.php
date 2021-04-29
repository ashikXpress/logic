
@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<style>
    .content-text{
        padding: 10px ;
        font-size: 16px;
        line-height: 20px;
    }
</style>
@endsection

@section('title')
    Promotion Proposal Print
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                        <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
                        <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>
                        <li><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>
                        <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                        <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                        <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                        <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                        <li class="active"><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                        <li><a href="">User Account</a></li>
                        <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                    </ul>
                    <!-- /.tab-content -->
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" >
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button>
                    </div>
                    <div class="row" id="prinarea" style="margin-top: 30px">
                        <div class="col-md-12">
                            <div class="box-header with-border">
{{--                                <h3 class="box-title">Promotion Proposal</h3>--}}
                            </div>
                            <div class="box-header with-border">
                                <h3 class="text-center">Logic Group BD</h3>
                                <h3 class="text-center">Promotion Proposal</h3>
                                <h3 class="text-center">(Strictly Confidential )</h3>
                            </div>
                            <div class="box-header with-border">
                                <h4>A. Personal particulars of proposed Candidate</h4>
                                <h4>a. Personal Profile</h4>
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr >
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Name</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">{{$candidate->name}}</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Id No.</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">{{$candidate->employee_id}}</td>
                                </tr>
                                <tr >
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Designation</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">{{$candidate->designation->name}}</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Department</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">{{$candidate->department->name}}</td>
                                </tr>
                                <tr >
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Working Place</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col"></td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Academic Qualification</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col"></td>
                                </tr>
                                <tr >
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Date Of Joining</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col"></td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Date of Birth</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col"></td>
                                </tr>
                                <tr >
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Present Grade</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col"></td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col">Time in the Present Grade</td>
                                    <td style="font-size: 16px;"  width="25%"  scope="col"></td>
                                </tr>
                                </thead>
                            </table>
                            <div class="with-border">
                                <h4>b. Promotion History</h4>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr >
                                    <th style="font-size: 16px;"   scope="col">Position</th>
                                    <th style="font-size: 16px;"    scope="col">Effective Form</th>
                                    <th style="font-size: 16px;"   scope="col">Work Station/Department</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="with-border">
                                <h4>c. Career History</h4>
                                <h4>I. Achievement in the Present Job:(if needed please additional sheets)</h4>
                            </div>
                            <form method="post" action="{{route("promotion_proposal",["candidate"=>$candidate])}}">
                                @csrf
                                <div class="content-text">{!! $proposal->achievement_in_the_present_job !!}</div>
                                <h4>II. PMS rating of last year</h4>
                                <table width="50%" class="table table-bordered table-striped">
                                    <tr>
                                        <td style="font-size:16px">Year:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:16px">Grade:</td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="box-header with-border">
                                    <h4>B.(a)  Proposed DESIGNATION & GRADE: _______________Sub Asst. Engineer ( Engineering Store) , N-3</h4>
                                    <h4>(b). What will be his/her new/additional responsibilities after promotion ?</h4>
                                </div>
                                <div class="content-text">{{$proposal->additional_responsibilities}}</div>
                                <div class="box-header with-border">
                                    <h4>(c). Please comment on his following skills in 1-6 scale with respect to his/her new position </h4>
                                </div>
                                <table width="50%" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="30%">Management skills</th>
                                        <th width="10%">1</th>
                                        <th width="10%">2</th>
                                        <th width="10%">3</th>
                                        <th width="10%">4</th>
                                        <th width="10%">5</th>
                                        <th width="10%">6</th>
                                        <th width="10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Knowledge of Work</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>1- Poor</td>
                                    </tr>
                                    <tr>
                                        <td>Quality of Work</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>2- Limited</td>
                                    </tr>
                                    <tr>
                                        <td>Communication Skill</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>3- Below Average</td>
                                    </tr>
                                    <tr>
                                        <td>Capability to Work under pressure</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>4- Average</td>
                                    </tr>
                                    <tr>
                                        <td>Capability to carryout instructions</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>5- Good</td>
                                    </tr>
                                    <tr>
                                        <td>Behaviour</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>6- Outstanding</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>

                                <div class="box-header with-border">
                                    <h4>(d). Does s/he need any extra training to comply with job of his/her future position ?</h4>
                                    <h4> If yes , please mention those …..</h4>
                                </div>
                                <div class="content-text">{{$proposal->extra_training}}</div>
                                <div class="box-header with-border">
                                    <h4>(e). With the promotion to the next higher position , do you need any extra manpower to handle his previous jobs? Please comment.</h4>
                                </div>
                                <div class="content-text">{{$proposal->promotion_next_higher_position}}</div>
                             <div class="box-header with-border">
                                    <h4>(f). Comments of immediate Supervisor</h4>
                                </div>
                                <div class="content-text">{{$proposal->comments_of_immediate_supervisor}}</div>
                                <h4>Name.........................     Signature........................ Date.........................</h4>
                                <div class="box-header with-border">
                                    <h4>(g). Comments of Next Supervisor  (as applicable)</h4>
                                </div>
                                <div class="content-text">{{$proposal->comments_of_next_supervisor}}</div>
                                <h4>Name........................     Signature........................ Date..........................</h4>
                                <div class="box-header with-border">
                                    <h4>(h).Comments of Concern Managers (as applicable)</h4>
                                </div>
                                <div class="content-text">{{$proposal->comments_of_concern_managers}}</div>
                                <h4>Name............................     Signature........................... Date........................</h4>
                                <div class="box-header with-border">
                                    <h4>(i). Comments of Division Heads (Director/ GM/DGM/AGM)- as applicable</h4>
                                </div>
                                <div class="content-text">{{$proposal->comments_of_division_head}}</div>
                                <h4>Name.............................     Signature............................ Date.......................</h4>
                                <div class="box-header with-border">
                                    <h4>(j). Comments of Executive Director (Marketing/ Operations/ Finance) - as applicable</h4>
                                </div>
                                <div class="content-text">{{$proposal->comments_of_executive_director}}</div>
                                <div class="box-header with-border">
                                    <h4>(l). Acknowledgement from Unit HR</h4>
                                </div>
                                <div class="content-text">{{$proposal->acknowledgement_from_unit_hr}}</div>
                                <div class="box-header with-border">
                                    <h4>C.  Training attended (to be filled in by HRD)</h4>
                                </div>

                                <table width="100%" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Topic</th>
                                        <th>Venue </th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Performance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="box-header with-border">
                                    <h4>Comments of Head of HR</h4>
                                </div>
                                <div class="content-text">{{$proposal->comments_of_head_of_hr}}</div>
                                <h4> Signature.............................       Date.......................</h4>
                                <div class="box-header with-border">
                                    <h4>Approved by</h4>
                                </div>
                                <h4> Signature.............................       Date.......................</h4>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {

            //Date picker
            $('#dob').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                orientation: 'bottom'
            });

            $('.date-picker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
            });

            var designationSelected = '{{ $candidate->designation_id }}';

            $('#department').change(function () {
                var departmentId = $(this).val();
                $('#designation').html('<option value="">Select Designation</option>');

                if (departmentId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_designation') }}",
                        data: { departmentId: departmentId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (designationSelected == item.id)
                                $('#designation').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#designation').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#department').trigger('change');
        });

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea) {

            $('body').html($('#'+prinarea).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
