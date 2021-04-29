
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
                    <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                    <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
{{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                    <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                    <li class="active"><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                    <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                    <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                    <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                    <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                    <li><a href="#userAccount">User Account</a></li>
                    <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                </ul>

                <div class="tab-content">
                    <ul>
                        <a class="btn btn-primary btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Manual Input</a>
                        <a class="btn btn-info btn-sm" href="{{route('employee_wise_over_time',['candidate' => $candidate->id])}}">Over Time</a>
                        <a class="btn btn-primary btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Location Tracking</a>
                        <a class="btn btn-info btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Attendance application</a>
                        <a class="btn btn-warning btn-sm" href="{{route('attendance_manually_input',['candidate' => $candidate->id])}}">Last 10-in-out-check</a>

                    </ul>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modal-overtime-approved-hours">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Please Overtime Update And Mention For Month Or Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-approved-form" enctype="multipart/form-data" name="modal_approved_form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="candidate-id" name="candidate_id" readonly>
                        </div>

                        <div class="form-group">
                            <label>OverTime Update</label>
                            <input type="text" class="form-control" id="overtime" name="overtime">
                        </div>

                        <div class="form-group">
                            <label>For Date *</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="for_date" id="for-date" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="modal-btn-approved-hours">Approved Hours</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal-overtime-reject">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Please Overtime Update And Mention For Month Or Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-reject-form" enctype="multipart/form-data" name="modal_reject_form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="employee-id" name="candidate_id" readonly>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>OverTime Update</label>--}}
{{--                            <input type="text" class="form-control" id="overtime" name="overtime">--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label>For Date *</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="for_date" id="for_date" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="modal-btn-reject">Reject Overtime</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal-overtime-approved">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Please Overtime Update And Mention For Month Or Cancel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modal-overtime-approved-form" enctype="multipart/form-data" name="modal_overtime_approved_form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="approved-employee-id" name="candidate_id" readonly>
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <label>OverTime Update</label>--}}
                        {{--                            <input type="text" class="form-control" id="overtime" name="overtime">--}}
                        {{--                        </div>--}}

                        <div class="form-group">
                            <label>For Date *</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="for_date" id="approved_for_date" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " id="modal-btn-approved">Approved</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>

        $('body').on('click', '.btn-overtime-approved-hours', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_overtime') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#candidate-id').val(response.employee_id);
                $('#overtime').val(response.over_time);
                $('#for-date').val(response.process_date);


                $('#modal-overtime-approved-hours').modal('show');
            });
        });

        $('#modal-btn-approved-hours').click(function () {
            var formData = new FormData($('#modal-approved-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('overtime_approved_hours.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-overtime-approved-hours').modal('hide');
                        Swal.fire(
                            'Approved!',
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

        $('body').on('click', '.btn-overtime-reject', function () {
            var employeeId = $(this).data('id');


            $.ajax({
                method: "GET",
                url: "{{ route('get_overtime') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#employee-id').val(response.employee_id);
                $('#for_date').val(response.process_date);


                $('#modal-overtime-reject').modal('show');
            });

        });

        $('#modal-btn-reject').click(function () {
            var formData = new FormData($('#modal-reject-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('overtime_reject.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-overtime-reject').modal('hide');
                        Swal.fire(
                            'Rejected!',
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

        $('body').on('click', '.btn-overtime-approved', function () {
            var employeeId = $(this).data('id');


            $.ajax({
                method: "GET",
                url: "{{ route('get_overtime') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#approved-employee-id').val(response.employee_id);
                $('#approved_for_date').val(response.process_date);


                $('#modal-overtime-approved').modal('show');
            });

        });

        $('#modal-btn-approved').click(function () {
            var formData = new FormData($('#modal-overtime-approved-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('overtime_approved.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-overtime-approved').modal('hide');
                        Swal.fire(
                            'Approved!',
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
