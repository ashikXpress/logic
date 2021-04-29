
@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Employee Information All
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
{{--                            <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>--}}
{{--                            <li><a href="#designation_log">Academic & Training</a></li>--}}
{{--                            <li><a href="{{route('job_description_input',['candidate' => $candidate->id])}}">Job Information</a></li>--}}
{{--                            <li><a href="{{route('job_description.all')}}">Attendance</a></li>--}}
{{--                            <li class="active"><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>--}}
{{--                            <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>--}}
{{--                            <li><a href="#leave">Loan</a></li>--}}
{{--                            <li><a href="#leave">Evalution</a></li>--}}
{{--                            <li><a href="#leave">User Account</a></li>--}}
{{--                            <li><a href="#leave">Report</a></li>--}}
                        </ul>
                        <!-- /.tab-content -->
                    </div>
                    <hr>
                    <table id="table" class="table table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Employee ID</th>
                            <th>Year</th>
                            <th>Total Days</th>
                            <th>Date</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Great!</h4>
                    <p>Your account has been created successfully.</p>
                    <button class="btn btn-success" data-dismiss="modal"><span>Start Exploring</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function () {
            var designationSelected;

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('payroll.leave.datatable') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'employee_name', name: 'employee_name'},
                    // {data: 'name', name: 'name'},
                    {data: 'department', name: 'department'},
                    {data: 'designation', name: 'designation'},
                    {data: 'employee_id', name: 'employee_id'},
                    {data: 'year', name: 'year'},
                    {data: 'total_days', name: 'total_days'},
                    {data: 'date', name: 'date'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ],
                order: [[ 1, "asc" ]],
            });

            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

        })
        $(function () {
            $('body').on('click', '.btn-confirm-leave', function (e) {
                e.preventDefault();
                var LeaveId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirm Leave !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "get",
                            url: "{{ route('leave_application_confirm') }}",
                            data: { LeaveId: LeaveId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'Apporved!',
                                    response.message,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                    //window.location.href = response.redirect_url;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        });

                    }
                })

            });
        });
        $(function () {
            $('body').on('click', '.btn-cancel-leave', function (e) {
                e.preventDefault();
                var LeaveId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirm Leave Cancel !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "get",
                            url: "{{ route('leave_application_cancel') }}",
                            data: { LeaveId: LeaveId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'OK Leave Cancel!',
                                    response.message,
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                    //window.location.href = response.redirect_url;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                });
                            }
                        });

                    }
                })

            });
        });
    </script>
@endsection
