
@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1.5px solid #000 !important;
        }
    </style>

@endsection

@section('title')
    All Employee Data
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12" style="min-height:300px">
            <section class="panel">
                <div class="panel-body">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><hr>
                    <div class="adv-table" id="prinarea">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="margin-bottom: 0px">
                                <tr>
                                    <th colspan="38" class="text-center">Logic Group BD.</th>
                                </tr>
                                <tr>
                                    <th colspan="38" class="text-center">Moriom Tower, Gangkola, Pabna-6600</th>
                                </tr>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Picture</th>
                                    <th>Complete Name</th>
                                    <th>Date of Birth</th>
                                    <th>Present Date</th>
                                    <th>Age(Years)</th>
                                    <th>Joining Date</th>
                                    <th>Service(Years)</th>
                                    <th>Resignation Date</th>
                                    <th>Service Duration</th>
                                    <th>Employment Status</th>
                                    <th>Function Family</th>
                                    <th>Workplace</th>
                                    <th>Employee Group</th>
                                    <th>Employee Subgroup</th>
                                    <th>Employee Category</th>
                                    <th>Employee Type</th>
                                    <th>Position</th>
                                    <th>Company</th>
                                    <th>Gender</th>
                                    <th>Highest Education</th>
                                    <th>Highest Education passing year.</th>
                                    <th>Major Education</th>
                                    <th>Major Education passing year</th>
                                    <th>Blood Group</th>
                                    <th>Nationality</th>
                                    <th>Marital Status</th>
                                    <th>Religion</th>
                                    <th>No Child</th>
                                    <th>National Id</th>
                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>Home District</th>
                                    <th>Permanent Address</th>
                                    <th>Present Address</th>
                                    <th>Emergency Contact Number</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->employee_id}}</td>
                                    <td><img src="{{ asset($employee->image) }}" alt="{{ $employee->name }}" height="100" width="100"></td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->employeeExtraData->date_of_birth??''}}</td>
                                    <td>{{$employee->employeeExtraData->present_date??''}}</td>
                                    <td>{{$employee->employeeExtraData->age??''}}</td>
                                    <td>{{$employee->expected_joining_date??''}}</td>
                                    <td>{{$employee->employeeExtraData->service??''}}</td>
                                    <td>{{$employee->employeeExtraData->resignation_date??''}}</td>
                                    <td>{{$employee->employeeExtraData->service_duration??''}}</td>
                                    <td>
                                        @if($employee->status == 1)
                                            <span class="btn btn-success">Active</span>
                                        @else
                                            <span class="btn btn-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{$employee->employeeExtraData->function_family??''}}</td>
                                    <td>{{$employee->employeeExtraData->work_place??''}}</td>
                                    <td>{{$employee->employeeExtraData->employee_group??''}}</td>
                                    <td>{{$employee->employeeExtraData->employee_subgroup??''}}</td>
                                    <td>{{$employee->employeeExtraData->employee_category??''}}</td>
                                    <td>
                                        @if($employee->employee_type == 1)
                                            <span class="btn btn-success">Permanent</span>
                                        @else
                                            <span class="btn btn-danger">Temponary</span>
                                        @endif
                                    </td>
                                    <td>{{ $employee->designation->name ??''}}</td>
                                    <td>{{$employee->employeeExtraData->work_place??''}}</td>
                                    <td>
                                        @if($employee->employeeExtraData && $employee->employeeExtraData->gender = 1)
                                            <span>Male</span>
                                        @else
                                            <span>Female</span>
                                        @endif
                                    </td>
                                    <td>{{$employee->employeeExtraData->highest_education??''}}</td>
                                    <td>{{$employee->employeeExtraData->highest_education_passing_year??''}}</td>
                                    <td>{{$employee->employeeExtraData->major_education??''}}</td>
                                    <td>{{$employee->employeeExtraData->major_education_passing_year??''}}</td>
                                    <td>{{$employee->employeeExtraData->blood_group??''}}</td>
                                    <td>{{$employee->employeeExtraData->nationality??''}}</td>
                                    <td>
                                        @if($employee->employeeExtraData && $employee->employeeExtraData->marital_status = 1)
                                            <span>Married</span>
                                        @else
                                            <span>Unmarried</span>
                                        @endif
                                    </td>
                                    <td>{{$employee->employeeExtraData->religion??''}}</td>
                                    <td>{{$employee->employeeExtraData->no_of_child??''}}</td>
                                    <td>{{$employee->employeeExtraData->national_id??''}}</td>
                                    <td>{{ $employee->fathers_name ??'' }}</td>
                                    <td>{{$employee->employeeExtraData->mother_name??''}}</td>
                                    <td>{{$employee->employeeExtraData->home_district??''}}</td>
                                    <td>{{$employee->employeeExtraData->permanent_address??''}}</td>
                                    <td>{{$employee->employeeExtraData->present_address??''}}</td>
                                    <td>{{ $employee->mobile_no??'' }}</td>
                                    <td>{{ $employee->department->name ??''}}</td>
                                    <td><a class="btn btn-info btn-sm btn-update" data-id="{{$employee->id}}" role="button">Update Employee Information</a></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function () {
            //Date picker
            $('#start, #end').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });
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
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }

    </script>
@endsection


