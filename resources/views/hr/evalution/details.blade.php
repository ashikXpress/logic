
@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Candidate Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                    <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
{{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                    <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                    <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                    <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                    <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                    <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                     <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evaluation</a></li>
                    <li><a href="#">User Account</a></li>
                    <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button>
{{--                        <a class="btn btn-info btn-sm btn-update" href="">Delete Personal Info</a>--}}
                        <a class="btn btn-info btn-sm btn-update" data-id="{{$candidate->id}}" role="button">Update Employee Information</a>
                        <br>


                        <div class="row" id="prinarea_profile" style="margin-top: 30px">
                            <div class="col-md-12">
                                <table class="table table-bordered" >
                                     <u><h4 class="text-center" style="color:#A54342">Employee All Personal Information</h4></u>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $candidate->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $candidate->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employee Picture</th>
                                        <td><img src="{{ asset($candidate->image) }}" alt="{{ $candidate->name }}" height="150" width="150"></td>
                                    </tr>
                                    <tr>
                                        <th>BirthDate</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->date_of_birth : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Age</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->age : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Expected Joining Date</th>
                                        <td>
                                            @if ($candidate->expected_joining_date!=null)
                                                {{ $candidate->expected_joining_date}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Resignation Date</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->resignation_date : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Gender</th>
                                        <td>
                                            @if ($candidate->employeeExtraData)
                                                @if($candidate->employeeExtraData->gender == 1)
                                                    <span>Male</span>
                                                @else
                                                    <span>Female</span>
                                                @endif
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Highest Education</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->highest_education : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Highest Education Passing Year</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->highest_education_passing_year : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Major Education</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->major_education : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Major Education Passing Year</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->major_education_passing_year : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Group</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->blood_group : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nationality</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->nationality : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>
                                            @if ($candidate->employeeExtraData)
                                                @if($candidate->employeeExtraData->marital_status == 1)
                                                    <span>Married</span>
                                                @else
                                                    <span>Unmarried</span>
                                                @endif
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->religion : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>National Id</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->national_id : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Spouse Name</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->spause_name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Spouse NID</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->spause_nid : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Spouse Mobile No</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->spause_mobile : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sons</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->son_names : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Daughter</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->daughter_names : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fathers Name</th>
                                        <td>{{ $candidate->fathers_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fathers NID</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->father_nid : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fathers Mobile No</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->father_mobile_no : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->mother_name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother NID</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->mother_nid : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Mobile No</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->mother_mobile_no : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Home District</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->home_district : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="2">Permanent Address</th>
                                    </tr>
                                    <tr>
                                        <th>Village:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->permanent_village : '' }}</th>
                                        <th>Post Office:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->permanent_post_office  : '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Upozilla:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->permanent_upozilla : '' }}</th>
                                        <th>District:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->permanent_district : '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Post Code:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->permanent_post_code : '' }}</th>
                                        <th>Country:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->permanent_country : '' }}</th>
                                    </tr>

                                    <tr>
                                        <th class="text-center" colspan="2">Present Address</th>
                                    </tr>
                                    <tr>
                                        <th>Village:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->present_village : '' }}</th>
                                        <th>Post Office:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->present_post_office : '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Upozilla:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->present_upozilla : '' }}</th>
                                        <th>District:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->present_district : '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Post Code:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->present_post_code : '' }}</th>
                                        <th>Country:<span></span> {{ $candidate->employeeExtraData ? $candidate->employeeExtraData->present_country : '' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Emergency Contact Number</th>
                                        <td>{{ $candidate->employeeExtraData ? $candidate->employeeExtraData->emergency_contact_number : '' }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <div class="modal fade" id="update-employee-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Employee Information</h4>
                </div>
                <div class="modal-body">
                    <form id="modal-form" enctype="multipart/form-data" name="modal-form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" class="form-control" id="modal-employee-id" name="employee_id" readonly>
                        </div>
                        <input type="hidden" class="form-control" id="modal-id" name="id">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="modal-name" disabled>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <input class="form-control" id="modal-department" disabled>
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input class="form-control" id="modal-designation" disabled>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control pull-right" id="date-of-birth" name="date_of_birth" value="{{ date('Y-m-d') }}" autocomplete="off">
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Present Date</label>
                            <input type="date" class="form-control" name="present_date" id="present-date" value="{{ date('Y-m-d') }}" placeholder="Enter Present Date">
                        </div>
                        <div class="form-group">
                            <label>Age(Years)</label>
                            <input type="text" class="form-control" name="age" id="age" placeholder="Enter Age">
                        </div>

                        <div class="form-group">
                            <label> Resignation Date</label>
                            <input type="date" class="form-control" name="resignation_date" id="resignation-date" value="{{ date('Y-m-d') }}" placeholder="Enter Resignation Date">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" id="gender">
                                <option value=" "> Select Gender </option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Highest Education</label>
                            <input type="text" class="form-control" name="highest_education" id="highest-education" placeholder="Enter Highest Education">
                        </div>
                        <div class="form-group">
                            <label>Highest Education Passing Year</label>
                            <input type="text" class="form-control" name="highest_education_passing_year" id="highest-education-passing-year" placeholder="Enter Highest Education Passing Year">
                        </div>
                        <div class="form-group">
                            <label>Major Education</label>
                            <input type="text" class="form-control" name="major_education" id="major-education" placeholder="Enter Major Education">
                        </div>
                        <div class="form-group">
                            <label>Major Education Passing Year</label>
                            <input type="text" class="form-control" name="major_education_passing_year" id="major-education-passing-year" placeholder="Enter Major Education Passing Year">
                        </div>
                        <div class="form-group">
                            <label>Blood Group</label>
                            <input type="text" class="form-control" name="blood_group" id="blood-group" placeholder="Enter Blood Group">
                        </div>
                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Enter Nationality">
                        </div>
                        <div class="form-group">
                            <label>Marital Status</label>
                            <select name="marital_status" id="marital-status">
                                <option value=" "> Select Marital </option>
                                <option value="1">Married</option>
                                <option value="2">Unmarried</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Religion</label>
                            <input type="text" class="form-control" name="religion" id="religion" placeholder="Enter Nationality">
                        </div>
                        <div class="form-group">
                            <label>National ID</label>
                            <input type="text" class="form-control" name="national_id" id="national-id" placeholder="Enter Nationality">
                        </div>
                        <div class="form-group">
                            <label>Spause Name</label>
                            <input type="text" class="form-control" name="spause_name" id="spause-name" placeholder="Enter Spause Name">
                        </div>
                        <div class="form-group">
                            <label>Spause NID</label>
                            <input type="text" class="form-control" name="spause_nid" id="spause-nid" placeholder="Enter Spause NID">
                        </div>
                        <div class="form-group">
                            <label>Spause Mobile</label>
                            <input type="text" class="form-control" name="spause_mobile" id="spause-mobile" placeholder="Enter Spause Mobile">
                        </div>

                        <div class="form-group">
                            <label>Father NID</label>
                            <input type="text" class="form-control" name="father_nid" id="father-nid" placeholder="Enter Father NID">
                        </div>
                        <div class="form-group">
                            <label>Father Mobile No</label>
                            <input type="text" class="form-control" name="father_mobile_no" id="father-mobile-no" placeholder="Enter Father Mobile No">
                        </div>
                        <div class="form-group">
                            <label>Mother Name</label>
                            <input type="text" class="form-control" name="mother_name" id="mother-name" placeholder="Enter Mother Name">
                        </div>
                        <div class="form-group">
                            <label>Mother NID</label>
                            <input type="text" class="form-control" name="mother_nid" id="mother-nid" placeholder="Enter Mother NID">
                        </div>
                        <div class="form-group">
                            <label>Mother Mobile No:</label>
                            <input type="text" class="form-control" name="mother_mobile_no" id="mother-mobile-no" placeholder="Enter Mother Mobile No">
                        </div>
                        <div class="form-group">
                            <label>Home District</label>
                            <input type="text" class="form-control" name="home_district" id="home-district" placeholder="Enter Home District">
                        </div>
                        <h5 class="text-center">Children Status</h5>
                        <div class="form-group">
                            <label>Son Names</label>
                            <textarea class="form-control" name="son_names" id="son-names" rows="2" cols="174" placeholder="Enter All Son Name"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Daughter Names</label>
                            <textarea class="form-control" name="daughter_names" id="daughter-names" rows="2" cols="174" placeholder="Enter All Daughter Name"></textarea>
                        </div>

                        <h5 class="text-center">Permanent Address Information</h5>
                        <div class="form-group">
                            <label>Permanent Village</label>
                            <input type="text" class="form-control" name="permanent_village" id="permanent-village" placeholder="Enter Permanent Village">
                        </div>
                        <div class="form-group">
                            <label>Permanent Post Office</label>
                            <input type="text" class="form-control" name="permanent_post_office" id="permanent-post-office" placeholder="Enter Permanent Post Office">
                        </div>
                        <div class="form-group">
                            <label>Permanent Upozilla</label>
                            <input type="text" class="form-control" name="permanent_upozilla" id="permanent-upozilla" placeholder="Enter Permanent Upozilla">
                        </div>
                        <div class="form-group">
                            <label>Permanent District</label>
                            <input type="text" class="form-control" name="permanent_district" id="permanent-district" placeholder="Enter Permanent District">
                        </div>
                        <div class="form-group">
                            <label>Permanent Post Code</label>
                            <input type="text" class="form-control" name="permanent_post_code" id="permanent-post-code" placeholder="Enter Permanent Post Code">
                        </div>
                        <div class="form-group">
                            <label>Permanent Country</label>
                            <input type="text" class="form-control" name="permanent_country" id="permanent-country" placeholder="Enter Permanent Country">
                        </div>

                        <h5 class="text-center">Present Address Information</h5>
                        <div class="form-group">
                            <label>Present Village</label>
                            <input type="text" class="form-control" name="present_village" id="present-village" placeholder="Enter Present Village">
                        </div>
                        <div class="form-group">
                            <label>Present Post Office</label>
                            <input type="text" class="form-control" name="present_post_office" id="present-post-office" placeholder="Enter Present Post Office">
                        </div>
                        <div class="form-group">
                            <label>Present Upozilla</label>
                            <input type="text" class="form-control" name="present_upozilla" id="present-upozilla" placeholder="Enter Present Upozilla">
                        </div>
                        <div class="form-group">
                            <label>Present District</label>
                            <input type="text" class="form-control" name="present_district" id="present-district" placeholder="Enter Present District">
                        </div>
                        <div class="form-group">
                            <label>Present Post Code</label>
                            <input type="text" class="form-control" name="present_post_code" id="present-post-code" placeholder="Enter Present Post Code">
                        </div>
                        <div class="form-group">
                            <label>Present Country</label>
                            <input type="text" class="form-control" name="present_country" id="present-country" placeholder="Enter Present Country">
                        </div>
                        <div class="form-group">
                            <label>Emergency Contact Number</label>
                            <input type="text" class="form-control" name="emergency_contact_number" id="emergency-contact-number" placeholder="Emergency Contact Number">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-update">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $('.btn-update').on('click', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);
                $('#modal-employee-id').val(response.employee_id);
                $('#modal-id').val(response.id);
                $('#modal-name').val(response.name);
                $('#modal-department').val(response.department.name);
                $('#modal-designation').val(response.designation.name);
                if(response.employee_extra_data){
                    $('#date-of-birth').val(response.employee_extra_data.date_of_birth);
                    $('#present-date').val(response.employee_extra_data.present_date);
                    $('#age').val(response.employee_extra_data.age);
                    $('#spause-name').val(response.employee_extra_data.spause_name);
                    $('#resignation-date').val(response.employee_extra_data.resignation_date);
                    $('#spause-nid').val(response.employee_extra_data.spause_nid);
                    $('#spause-mobile').val(response.employee_extra_data.spause_mobile);
                    $('#father-nid').val(response.employee_extra_data.father_nid);
                    $('#father-mobile-no').val(response.employee_extra_data.father_mobile_no);
                    $('#mother-nid').val(response.employee_extra_data.mother_nid);
                    $('#mother-mobile-no').val(response.employee_extra_data.mother_mobile_no);
                    $('#son-names').val(response.employee_extra_data.son_names);
                    $('#daughter-names').val(response.employee_extra_data.daughter_names);
                    $('#gender').val(response.employee_extra_data.gender);
                    $('#highest-education').val(response.employee_extra_data.highest_education);
                    $('#highest-education-passing-year').val(response.employee_extra_data.highest_education_passing_year);
                    $('#major-education').val(response.employee_extra_data.major_education);
                    $('#major-education-passing-year').val(response.employee_extra_data.major_education_passing_year);
                    $('#blood-group').val(response.employee_extra_data.blood_group);
                    $('#nationality').val(response.employee_extra_data.nationality);
                    $('#marital-status').val(response.employee_extra_data.marital_status);
                    $('#religion').val(response.employee_extra_data.religion);
                    $('#permanent-village').val(response.employee_extra_data.permanent_village);
                    $('#national-id').val(response.employee_extra_data.national_id);
                    $('#mother-name').val(response.employee_extra_data.mother_name);
                    $('#home-district').val(response.employee_extra_data.home_district);
                    $('#permanent-post-office').val(response.employee_extra_data.permanent_post_office);
                    $('#permanent-upozilla').val(response.employee_extra_data.permanent_upozilla);
                    $('#permanent-district').val(response.employee_extra_data.permanent_district);
                    $('#permanent-post-code').val(response.employee_extra_data.permanent_post_code);
                    $('#permanent-country').val(response.employee_extra_data.permanent_country);
                    $('#present-village').val(response.employee_extra_data.present_village);
                    $('#present-post-office').val(response.employee_extra_data.present_post_office);
                    $('#present-upozilla').val(response.employee_extra_data.present_upozilla);
                    $('#present-district').val(response.employee_extra_data.present_district);
                    $('#present-post-code').val(response.employee_extra_data.present_post_code);
                    $('#present-country').val(response.employee_extra_data.present_country);
                    $('#emergency-contact-number').val(response.employee_extra_data.emergency_contact_number);
                }

                $('#update-employee-data').modal('show');

            });

        });

        $('#modal-btn-update').click(function () {
            var formData = new FormData($('#modal-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.employee_update.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#update-employee-data').modal('hide');
                        Swal.fire(
                            'Updated!',
                            response.message,
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                }
            });
        });

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
        function getprintleave(prinarea_leave) {

            $('body').html($('#'+prinarea_leave).html());
            window.print();
            window.location.replace(APP_URL)
        }
        function getprintleave(prinarea_salary) {

            $('body').html($('#'+prinarea_salary).html());
            window.print();
            window.location.replace(APP_URL)
        }

    </script>
@endsection
