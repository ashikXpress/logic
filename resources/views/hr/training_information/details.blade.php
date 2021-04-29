
@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Candidate Details
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
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                    <li class="active"><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>
                    <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                    <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                    <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                    <li><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                    <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                    <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                    <li><a href="#userAccount">User Account</a></li>
                    <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>
                        <a class="btn-primary btn-sm" href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information </a>

                        <u><h4 class="text-center">Training Information</h4></u>
                        <div class="row" id="prinarea_profile">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SL</th>
                                        <th>Training Title</th>
                                        <th>Institute</th>
                                        <th>Training Certificate</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($trainingInformations as $trainingInformation)
                                    <tr>
                                        <td>{{ $candidate->employee_id??''}}</td>
                                        <td>{{ $trainingInformation->training_title??'' }}</td>
                                        <td>{{ $trainingInformation->training_institute??'' }}</td>
                                        <td>
                                            <img src="{{asset($trainingInformation->training_certificate??'')}}" alt="" height="50" width="50">
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('employee_wise_training_information.add',['trainingInformation' => $trainingInformation->id])}}">Add New</a>
                                            <a class="btn btn-info btn-sm" href="{{route('employee_wise_training_information.edit',['trainingInformation' => $trainingInformation->id])}}">Edit</a>
                                            <a class="btn btn-danger btn-sm btn-delete" role="button" data-id="{{$trainingInformation->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
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
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }

        $(function () {
            $('body').on('click', '.btn-delete', function (e) {
                e.preventDefault();
                var TrainingInformationId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm deleted !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "get",
                            url: "{{ route('employee_wise_training_information.delete') }}",
                            data: { TrainingInformationId: TrainingInformationId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
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
                        });

                    }
                })

            });
        });

    </script>
@endsection
