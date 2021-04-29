
@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@endsection

@section('title')
    Candidate Evalution Form
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                        <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
{{--                        <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                        <li><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>
                        <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                        <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                        <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                        <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                        <li class="active"><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                        <li><a href="#leave">User Account</a></li>
                        <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                    </ul>
                    <!-- /.tab-content -->
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" >
                        <button class="pull-right btn btn-primary" style="margin-right: 12px;" onclick="getprint('prinarea')">Print</button>
                        <a class="pull-left btn btn-primary" style="margin-left: 12px;margin-top: -10px;" href="{{route('promotion_proposal',['candidate' => $candidate->id])}}" >promotion proposal</a>
                    </div>
                    <div class="row" id="prinarea" style="margin-top: 30px">
                        <div class="col-md-12">
                        <div class="box-header with-border">
                             <h3 class="box-title">Candidate Evaluation Information</h3>
                        </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th colspan="4" style="font-size: 17px;" class="text-center" width="100%" scope="col">Logic Engineering Ltd.</th>
                        </tr>
                        <tr>
                            <th colspan="4" style="font-size: 15px;" class="text-center" width="100%" scope="col">Employee Appraisal</th>
                        </tr>
                        <tr >
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">Name</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">{{$candidate->name}}</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">Job Title</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">{{$candidate->name}}</th>
                        </tr>
                        <tr >
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">Dept/Sec</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">{{$candidate->department->name}}</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">Job Grade</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col"></th>
                        </tr>
                        <tr >
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">DATE JOINED: </th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">{{$candidate->department->name}}</th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">PERIOD: </th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col"></th>
                        </tr>
                        <tr >
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col"> </th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col"></th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">EMPLOYEE ID : </th>
                            <th style="font-size: 14px;" class="text-center" width="25%"  scope="col">{{$candidate->employee_id}}</th>
                        </tr>
                        </thead>
                    </table>
                    <div>
                        <h3 style="margin-left: 20px">Instruction:</h3>
                        <ul style="font-size: 17px">
                            <li>Read each characteristic and The Various descriptions which follow.</li>
                            <li>Then select the phrase that best reflects the employee and enter the rating (1-10) into the appropriate appraisal period</li>
                            <li>These characteristic may not apply to all job classifications. If this is the case, do not complete.</li>
                        </ul>
                    </div>

                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">
                    @csrf
                    <div class="box-body">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Particulars</th>
                                <th>1-2</th>
                                <th>3-4</th>
                                <th>5-6</th>
                                <th>7-8</th>
                                <th>9-10</th>
                                <th>Jan-Jun</th>
                                <th>Jul-Dec</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>( A) WORK STANDARDS  1      SKILL/ KNOWLEDGE  Ability to meet the work quality requirement.</td>
                              <td>Poor knowledge and skill for the requirement of the job.</td>
                                <td>Has limited Knowledge and skill for performing the job</td>
                               <td>Has avarge knowledge and skills for performing the job.</td>
                                <td>Above average job knowledge and skills for success of the job </td>
                                <td>Exceptionally knowledge able and skillful.</td>
                                <td>
                                    <input type="number" style="width: 100px" class="form-control" name="jan_jun_work_standards" value="{{ empty(old('jan_jun_work_standards')) ? ($errors->has('jan_jun_work_standards') ? '' : $appraisals->jan_jun_work_standards) : old('jan_jun_work_standards') }}" >
                                </td>
                                <td>
                                    <input type="number" style="width: 100px" class="form-control" name="jul_dec_work_standards" value="{{ empty(old('jul_dec_work_standards')) ? ($errors->has('jul_dec_work_standards') ? '' : $appraisals->jul_dec_work_standards) : old('jul_dec_work_standards') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2.   SPEED   Consider the consistency of volume of work in relation to deadline met.</td>
                                <td>Slow and consistenly late with frequent reminders.</td>
                                <td>Moderate and sometimes late with reminders</td>
                                <td>Average and normally just meet deadline</td>
                                <td>Rapid, meet deadline and sometimes ahead of time </td>
                                <td>Exceptionally and consistently ahead of time</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_speed_consider" value="{{ empty(old('jan_jun_speed_consider')) ? ($errors->has('jan_jun_speed_consider') ? '' : $appraisals->jan_jun_speed_consider) : old('jan_jun_speed_consider') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_speed_consider" value="{{ empty(old('jul_dec_speed_consider')) ? ($errors->has('jul_dec_speed_consider') ? '' : $appraisals->jul_dec_speed_consider) : old('jul_dec_speed_consider') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td> 3.QUALITY OF WORK Consider work thoroughness and accuracy.</td>
                                <td>Seldom meets quality targets.</td>
                                <td>Partially meets quality targets.</td>
                                <td>Meets quality target.</td>
                                <td>Often exceeds work quality targets. </td>
                                <td>Consistently exceeds quality targets.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_quality_of_work" value="{{ empty(old('jan_jun_quality_of_work')) ? ($errors->has('jan_jun_quality_of_work') ? '' : $appraisals->jan_jun_quality_of_work) : old('jan_jun_quality_of_work') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_quality_of_work" value="{{ empty(old('jul_dec_quality_of_work')) ? ($errors->has('jul_dec_quality_of_work') ? '' : $appraisals->jul_dec_quality_of_work) : old('jul_dec_quality_of_work') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>4.CARE OF EQUIPMENT  Sense of responsibility for equipment.</td>
                                <td>Must be worried occasionally as to care of equipment</td>
                                <td>Has to be checked consistenly as to care of equipment given.</td>
                                <td>Equipment kept in running order.</td>
                                <td>Equipment kept in good running order. </td>
                                <td>Equipment best cared for in his department.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_care_of_equipment" value="{{ empty(old('jan_jun_care_of_equipment')) ? ($errors->has('jan_jun_care_of_equipment') ? '' : $appraisals->jan_jun_care_of_equipment) : old('jan_jun_care_of_equipment') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_care_of_equipment" value="{{ empty(old('jul_dec_care_of_equipment')) ? ($errors->has('jul_dec_care_of_equipment') ? '' : $appraisals->jul_dec_care_of_equipment) : old('jul_dec_care_of_equipment') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>(B) WORK HABITS 1.  ORDERLINESS   Ability to upkeep neat and organized workplace.</td>
                                <td>Sloppy as to arrangement of worktools and materials.</td>
                                <td>Workplace usually not in good order.</td>
                                <td>Usually keeps material and tool in proper place</td>
                                <td>Workplace is seldom out of order. </td>
                                <td>Always keeps workplace well arranged and orderly.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_work_habits" value="{{ empty(old('jan_jun_work_habits')) ? ($errors->has('jan_jun_work_habits') ? '' : $appraisals->jan_jun_work_habits) : old('jan_jun_work_habits') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_work_habits" value="{{ empty(old('jul_dec_work_habits')) ? ($errors->has('jul_dec_work_habits') ? '' : $appraisals->jul_dec_work_habits) : old('jul_dec_work_habits') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>2. DEPENDABILITY    Consider sense of responsibility and reliability in executing the job and assignment.</td>
                                <td>Does not follow direction/ procedure and requires  constant supervision. </td>
                                <td>Occationally does not follow direction and requires considerable supervision.</td>
                                <td>Work requires average or normal supervision.</td>
                                <td>Always reliable and dependable with supervision.</td>
                                <td>Extremely reliable and dependable which need no supervision.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_dependability" value="{{ empty(old('jan_jun_dependability')) ? ($errors->has('jan_jun_dependability') ? '' : $appraisals->jan_jun_dependability) : old('jan_jun_dependability') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_dependability" value="{{ empty(old('jul_dec_dependability')) ? ($errors->has('jul_dec_dependability') ? '' : $appraisals->jul_dec_dependability) : old('jul_dec_dependability') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>3.TIMEKEEPING   Consider sense punctuality at work place.</td>
                               <td>Seldom on time</td>
                                <td>Occationally late but is conscientious at being at work.</td>
                                <td>Always on time</td>
                                <td>Occationally early but always on time and not time waster.</td>
                                <td>Always early and ahead of time and not time waster.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_timekeeping" value="{{ empty(old('jan_jun_timekeeping')) ? ($errors->has('jan_jun_timekeeping') ? '' : $appraisals->jan_jun_timekeeping) : old('jan_jun_timekeeping') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_timekeeping" value="{{ empty(old('jul_dec_timekeeping')) ? ($errors->has('jul_dec_timekeeping') ? '' : $appraisals->jul_dec_timekeeping) : old('jul_dec_timekeeping') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>4.SAFETY CONSCIOUSNESS    Concern for safety of others, ownself materials & equipment with respect to safety rules and procedures</td>
                                <td>Careless, is a hazard both to himself and others.</td>
                                <td>Has to be reminded of regared for safety of himself & others.</td>
                                <td>Observes & practices safety rules most of the time.</td>
                                <td>Usually careful & observes & practices safety rules.</td>
                                <td>Always observes & practices safety codes & rules for own, others & equipment.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_safety_consciousness" value="{{ empty(old('jan_jun_safety_consciousness')) ? ($errors->has('jan_jun_safety_consciousness') ? '' : $appraisals->jan_jun_safety_consciousness) : old('jan_jun_safety_consciousness') }}">
                                </td>
                                <td>
                                    <input  type="number" class="form-control" name="jul_dec_safety_consciousness" value="{{ empty(old('jul_dec_safety_consciousness')) ? ($errors->has('jul_dec_safety_consciousness') ? '' : $appraisals->jul_dec_safety_consciousness) : old('jul_dec_safety_consciousness') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>( C) ATTITUDE  1. INTEREST   Consider degree of keenness of the job & its value    </td>
                                <td>No. enthusiasm for the job, always complaining</td>
                                <td>Rarely enthusiastic with interest in the job.</td>
                                <td>Some enthusiasm & normal amount of interest in the job.</td>
                                <td>Usually enthusiastic with high interest in the job.</td>
                                <td>Very enthusiastic with high interest in the job.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_attitude" value="{{ empty(old('jan_jun_attitude')) ? ($errors->has('jan_jun_attitude') ? '' : $appraisals->jan_jun_attitude) : old('jan_jun_attitude') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_attitude" value="{{ empty(old('jul_dec_attitude')) ? ($errors->has('jul_dec_attitude') ? '' : $appraisals->jul_dec_attitude) : old('jul_dec_attitude') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>2.ATTITUDE TOWARDS SUPERVISION/ MANAGEMENT     Consider the degree of acceptance & reaction</td>
                                <td>Resents to any form of supervision & management ideas.</td>
                                <td>Does not always accept constructive supervision & Management ideas.</td>
                                <td>Has about the average view point towards supervision & management ideas.</td>
                                <td>Willing to accept  suggestions & constructive Criticisms</td>
                                <td>Appreciates help of supervision & ideas from management.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_attitude_towards_supervision" value="{{ empty(old('jan_jun_attitude_towards_supervision')) ? ($errors->has('jan_jun_attitude_towards_supervision') ? '' : $appraisals->jan_jun_attitude_towards_supervision) : old('jan_jun_attitude_towards_supervision') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_attitude_towards_supervision" value="{{ empty(old('jul_dec_attitude_towards_supervision')) ? ($errors->has('jul_dec_attitude_towards_supervision') ? '' : $appraisals->jul_dec_attitude_towards_supervision) : old('jul_dec_attitude_towards_supervision') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>3.ATTITUDE TOWARDS  FELLOW EMPLOYEE Consider the dgree of cooperation</td>
                                <td>Selfish, Jealous, fault finding & uncooperative</td>
                                <td>Not consistent in relationship with others, May be quarrelsome at times</td>
                                <td>Has no serious difference with others.</td>
                                <td>Cooperative, helpful & friendly to others.</td>
                                <td>Goes out of the way, cooperative, helpful & friendly to others.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_attitude_towards" value="{{ empty(old('jan_jun_attitude_towards')) ? ($errors->has('jan_jun_attitude_towards') ? '' : $appraisals->jan_jun_attitude_towards) : old('jan_jun_attitude_towards') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_attitude_towards" value="{{ empty(old('jul_dec_attitude_towards')) ? ($errors->has('jul_dec_attitude_towards') ? '' : $appraisals->jul_dec_attitude_towards) : old('jul_dec_attitude_towards') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>4.ATTITUDE TO WARDS WORKS Consider degree of willingness towards additional responsibilities.</td>
                                <td>Refuses to accept new/ additional responsibilities</td>
                                <td>Accepts New/ additional responsibilities reluctantly</td>
                                <td>Accepts new/ additional responsibilities.But requries persuasion. </td>
                                <td>Accept new/ additional responsibilities without complaints.</td>
                                <td>Always accepts additional /new responsibilities willingly.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_attitude_to_words_works" value="{{ empty(old('jan_jun_attitude_to_words_works')) ? ($errors->has('jan_jun_attitude_to_words_works') ? '' : $appraisals->jan_jun_attitude_to_words_works) : old('jan_jun_attitude_to_words_works') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_attitude_to_words_works" value="{{ empty(old('jul_dec_attitude_to_words_works')) ? ($errors->has('jul_dec_attitude_to_words_works') ? '' : $appraisals->jul_dec_attitude_to_words_works) : old('jul_dec_attitude_to_words_works') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>(D)  PERSONAL BEHAVIOUR    1.  RESOURCE FULLNESS    Consider analytical thinking & problem solving</td>
                                <td>Requires help on all problems.</td>
                                <td>Frequently requires help on common problems.</td>
                                <td>Some enthusiasm Successful on common problems. </td>
                                <td>Usually successful in overcoming problems. May require help occasionally.</td>
                                <td>Always look for better way in problem solving.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_personal_behaviour" value="{{ empty(old('jan_jun_personal_behaviour')) ? ($errors->has('jan_jun_personal_behaviour') ? '' : $appraisals->jan_jun_personal_behaviour) : old('jan_jun_personal_behaviour') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_personal_behaviour" value="{{ empty(old('jul_dec_personal_behaviour')) ? ($errors->has('jul_dec_personal_behaviour') ? '' : $appraisals->jul_dec_personal_behaviour) : old('jul_dec_personal_behaviour') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>2.INITIATIVE Ability to work independently</td>
                                <td>Always waits to be directed.</td>
                                <td>Some attempt to go ahead on his own but easily discouraged.</td>
                                <td>Requires average supervision. </td>
                                <td>Can ordinarily work independently.</td>
                                <td>Self starter in all respects.</td>
                                <td>
                                    <input type="number" class="form-control" name="jan_jun_initiative_ability" value="{{ empty(old('jan_jun_initiative_ability')) ? ($errors->has('jan_jun_initiative_ability') ? '' : $appraisals->jan_jun_initiative_ability) : old('jan_jun_initiative_ability') }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="jul_dec_initiative_ability" value="{{ empty(old('jul_dec_initiative_ability')) ? ($errors->has('jul_dec_initiative_ability') ? '' : $appraisals->jul_dec_initiative_ability) : old('jul_dec_initiative_ability') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>3.ADAPTABILITY   Receptiveness to new ideas/ environment & ability to improve & learn  further.</td>
                                <td>Unwilling to change jobs, Difficult to adjust to new solutions.</td>
                                <td>Reluctantly tries new jobs, Requires much supervision & slow  to learn.</td>
                                <td>With average amount of instructions able to learn related jobs. </td>
                                <td>Quick to learn new jobs.</td>
                                <td>Learned/ carried out new jobs extremely well</td>
                                <td>
                                    <input type="number" style="width: 100px" class="form-control" name="jan_jun_adaptability" value="{{ empty(old('jan_jun_adaptability')) ? ($errors->has('jan_jun_adaptability') ? '' : $appraisals->jan_jun_adaptability) : old('jan_jun_adaptability') }}">
                                </td>
                                <td>
                                    <input type="number" style="width: 100px" class="form-control" name="jul_dec_adaptability" value="{{ empty(old('jul_dec_adaptability')) ? ($errors->has('jul_dec_adaptability') ? '' : $appraisals->jul_dec_adaptability) : old('jul_dec_adaptability') }}">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                  </div>
                    @php
                        $jan_jun = $appraisals->jan_jun_work_standards + $appraisals->jan_jun_speed_consider + $appraisals->jan_jun_quality_of_work + $appraisals->jan_jun_care_of_equipment + $appraisals->jan_jun_work_habits + $appraisals->jan_jun_dependability + $appraisals->jan_jun_timekeeping + $appraisals->jan_jun_safety_consciousness
                                     + $appraisals->jan_jun_attitude + $appraisals->jan_jun_attitude_towards_supervision + $appraisals->jan_jun_attitude_towards + $appraisals->jan_jun_attitude_to_words_works + $appraisals->jan_jun_personal_behaviour + $appraisals->jan_jun_initiative_ability + $appraisals->jan_jun_adaptability;
                        $jul_dec = $appraisals->jul_dec_work_standards + $appraisals->jul_dec_speed_consider + $appraisals->jul_dec_quality_of_work + $appraisals->jul_dec_care_of_equipment + $appraisals->jul_dec_work_habits + $appraisals->jul_dec_dependability + $appraisals->jul_dec_timekeeping + $appraisals->jul_dec_safety_consciousness
                                     + $appraisals->jul_dec_attitude + $appraisals->jul_dec_attitude_towards_supervision + $appraisals->jul_dec_attitude_towards + $appraisals->jul_dec_attitude_to_words_works + $appraisals->jul_dec_personal_behaviour + $appraisals->jul_dec_initiative_ability + $appraisals->jul_dec_adaptability;
                    $jan = $jan_jun / 15;
                    $jul = $jul_dec / 15;
                    $average = ($jan + $jul) / 2;
                    @endphp
                <table class="table table-bordered table-striped text-center mb-20" >
                    <thead>
                    <tr class="table-dark">
                        <th colspan="3" style="font-size: 15px;" width="100%" scope="col">PERFORMANCE RATING</th>
                    </tr>
                    <tr>
                        <th style="font-size: 14px;" scope="col">Jan-Jun</th>
                        <th style="font-size: 14px;" scope="col">Jul-Dec</th>
                        <th style="font-size: 14px;" scope="col">Average</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>{{$jan}}</td>
                        <td>{{$jul}}</td>
                        <td>{{$average}}</td>
                    </tr>
                </table>

                    <table class="table table-bordered table-striped text-center mb-20" width="100%">
                    <thead>
                    <tr class="table-dark">
                        <th  style="font-size: 15px;"  scope="col">APPRAISER'S COMMENTS</th>
                        <th  style="font-size: 15px;"  scope="col">SIGNATURE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="50%">JAN-JUN</td>
                        <td width="50%"></td>
                    </tr>
                    <tr>
                        <td width="50%">JUL-DEC</td>
                        <td width="50%"></td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-striped text-center mb-20" width="100%">
                    <thead>
                    <tr class="table-dark">
                        <th  style="font-size: 15px;"  scope="col">APPRAISER'S COMMENTS</th>
                        <th  style="font-size: 15px;"  scope="col">SIGNATURE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="50%">JAN-JUN</td>
                        <td width="50%"></td>
                    </tr>
                    <tr>
                        <td width="50%">JUL-DEC</td>
                        <td width="50%"></td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-striped text-center mb-20" width="100%">
                    <thead>
                    <tr class="table-dark">
                        <th width="25%"></th>
                        <th width="25%">Jan-Jun</th>
                        <th width="25%">Jul-Dec</th>
                        <th width="25%">Overall</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="25%">OUTSTANDING</td>
                        <td width="25%">{{$jan>=9?$jan:""}}</td>
                        <td width="25%">{{$jul>=9?$jul:""}}</td>
                        <td width="25%">{{$average>=9?$average:""}}</td>
                    </tr>
                    <tr>
                        <td width="25%">EXECELLENT</td>
                        <td width="25%">{{($jan>=8 && $jan<=9 )?$jan:""}}</td>
                        <td width="25%">{{($jul>=8 && $jul<=9)?$jul:""}}</td>
                        <td width="25%">{{($average>=8 && $average<=9)?$average:""}}</td>
                    </tr>
                    <tr>
                        <td width="25%">COMMENDABLE</td>
                        <td width="25%">{{($jan>=7 && $jan<=8 )?$jan:""}}</td>
                        <td width="25%">{{($jul>=7 && $jul<=8 )?$jul:""}}</td>
                        <td width="25%">{{($average>=7 && $average<=8 )?$average:""}}</td>
                    </tr>
                    <tr>
                        <td width="25%">ADEQUATE</td>
                        <td width="25%">{{($jan>=6 && $jan<=7 )?$jan:""}}</td>
                        <td width="25%">{{($jul>=6 && $jul<=7 )?$jul:""}}</td>
                        <td width="25%">{{($average>=6 && $average<=7 )?$average:""}}</td>
                    </tr>
                    <tr>
                        <td width="25%">UNSATISFACTORY</td>
                        <td width="25%">{{($jan>=5 && $jan<=6 )?$jan:""}}</td>
                        <td width="25%">{{($jul>=5 && $jul<=6 )?$jul:""}}</td>
                        <td width="25%">{{($average>=5 && $average<=6 )?$average:""}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-bordered table-striped text-center mb-20" width="100%">
                    <thead>
                    <tr class="table-dark">
                        <th colspan="2" style="font-size: 15px;"   scope="col">AREAS OF WEAKNESS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="font-size: 15px" width="50%">What he/she isn't doing well?</td>
                        <td width="50%">
                            <textarea name="not_doing" class="form-control" rows="3">{{$appraisals->not_doing}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 15px" width="50%">In what he/she is particularly weak?</td>
                        <td width="50%">
                            <textarea name="particularly_weak" class="form-control" rows="3">{{$appraisals->particularly_weak}}</textarea>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <table class="table table-bordered table-striped text-center mb-20" width="100%">
                    <thead>
                    <tr class="table-dark">
                        <th colspan="2" style="font-size: 15px;"   scope="col">IMPROVEMENT PLAN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td width="50%" style="font-size: 15px">What specific recommendations do you make now to overcome the weakness?</td>
                        <td width="50%">
                            <textarea name="improvement_plan" class="form-control" rows="3">{{$appraisals->improvement_plan}}</textarea>

                        </td>
                    </tr>

                    </tbody>
                </table>
                <table class="table table-bordered table-striped text-left mb-20" width="100%" style="font-size: 16px">
                    <tr>
                        <td width="50%">NAME OF APPRAISER:</td>
                        <td width="25%">SIGNATURE</td>
                        <td width="25%">DATE</td>
                    </tr>
                    <tr>
                        <td width="50%">NAME: HEAD OF THE  DEPT.</td>
                        <td width="25%">SIGNATURE</td>
                        <td width="25%">DATE</td>
                    </tr>
                    </tbody>
                </table>
                    <input type="submit" class="btn btn-primary" style="margin-bottom: 25px;margin-left: 18px;margin-top: 23px;">
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
