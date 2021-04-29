
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
                    <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
{{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                    <li class="active"><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
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

                        <u><h4 class="text-center">Previous Job Information</h4></u>
                        <div class="row" id="prinarea_profile">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SL</th>
                                        <th>Previous Company Name</th>
                                        <th>Previous Company Designation</th>
                                        <th>Previous Job Duration From</th>
                                        <th>Duration To</th>
                                        <th>Total Duration</th>
                                        <th>Major Responsibility</th>
                                        <th>Experience Certificate</th>
                                        <th class="text-center">Action</th>

                                    </tr>

                                    @foreach($jobInformations as $jobInformation)

                                    <tr>
                                        <td>{{ $jobInformation->employee_id??''}}</td>
                                        <td>{{ $jobInformation->previous_company_name??'' }}</td>
                                        <td>{{ $jobInformation->previous_company_designation??'' }}</td>
                                        <td>{{ $jobInformation->from??'' }}</td>
                                        <td>{{ $jobInformation->to??'' }}</td>
                                        <td>{{ $jobInformation->total_duration??'' }}</td>
                                        <td>{{ $jobInformation->major_responsibility??'' }}</td>

                                        <td>
                                            <img src="{{asset($jobInformation->experience_certificate??'')}}" alt="" height="50" width="50">
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{route('employee_wise_job_information.add',['jobInformation' => $jobInformation->id])}}">Add New</a>
                                            <a class="btn btn-info btn-sm" href="{{route('employee_wise_job_information.edit',['jobInformation' => $jobInformation->id])}}">Edit</a>
                                            <a class="btn btn-danger btn-sm btn-delete" role="button" data-id="{{$jobInformation->id}}">Delete</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <u><h4 class="text-center">Current Job</h4></u>
                        <div class="row" id="prinarea_profile">
                            <div class="col-md-5">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SL</th>
                                        <th>Particulars</th>
                                        <th>Data</th>
                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>Concern Name</td>
                                        <td>Logic Engineering Limited</td>


                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Employee Name</td>
                                        <td>{{ $candidate->name??'' }}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Designation</td>
                                        <td>{{ $candidate->designation->name??'' }}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Grade</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Joining Date</td>
                                        <td>{{ $candidate->expected_joining_date??'' }}</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Resignation</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Duration</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Joining Salary</td>
                                        <td>{{ $candidate->expected_salary??'' }}</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Job Description</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Promotion</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Present Salary</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Evalution</td>
                                        <td></td>
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
                var jobInformationId = $(this).data('id');

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
                            url: "{{ route('employee_wise_job_information.delete') }}",
                            data: { jobInformationId: jobInformationId }
                        }).done(function( response ) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
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
