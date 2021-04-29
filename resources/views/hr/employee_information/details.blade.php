
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
                    <li class="active"><a href="#profile" data-toggle="tab">Candidate Profile</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>

                        <div class="row" id="prinarea_profile">
                            <div class="col-md-8">
                                <table class="table table-bordered" >

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
                                        <td>{{ $candidate->employeeExtraData->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <th>Age</th>
                                        <td>{{ $candidate->employeeExtraData->age }}</td>
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
                                        <th>Service</th>
                                        <td>{{ $candidate->employeeExtraData->service }}</td>
                                    </tr>
                                    <tr>
                                        <th>Service</th>
                                        <td>{{ $candidate->employeeExtraData->resignation_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Service</th>
                                        <td>{{ $candidate->employeeExtraData->service_duration }}</td>
                                    </tr>

                                    <tr>
                                        <th>Employee Status</th>
                                        <td>
                                            @if($candidate->status == 1)
                                            <span class="btn btn-success">Active</span>
                                            @else
                                                <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Function Family</th>
                                        <td>{{ $candidate->employeeExtraData->function_family }}</td>
                                    </tr>
                                    <tr>
                                        <th>Work Place</th>
                                        <td>{{ $candidate->employeeExtraData->work_place }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employee Group</th>
                                        <td>{{ $candidate->employeeExtraData->employee_group }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employee Subgroup</th>
                                        <td>{{ $candidate->employeeExtraData->employee_subgroup }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employee Category</th>
                                        <td>{{ $candidate->employeeExtraData->employee_category }}</td>
                                    </tr>
                                    <tr>
                                        <th>Employee Type</th>
                                        <td>{{ $candidate->designation->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Position</th>
                                        <td>{{ $candidate->employeeExtraData->position }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ $candidate->employeeExtraData->company }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>
                                            @if($candidate->employeeExtraData->gender == 1)
                                                <span>Male</span>
                                            @else
                                                <span>Female</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Highest Education</th>
                                        <td>{{ $candidate->employeeExtraData->highest_education }}</td>
                                    </tr>
                                    <tr>
                                        <th>Highest Education Passing Year</th>
                                        <td>{{ $candidate->employeeExtraData->highest_education_passing_year }}</td>
                                    </tr>
                                    <tr>
                                        <th>Major Education</th>
                                        <td>{{ $candidate->employeeExtraData->major_education }}</td>
                                    </tr>
                                    <tr>
                                        <th>Major Education Passing Year</th>
                                        <td>{{ $candidate->employeeExtraData->major_education_passing_year }}</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Group</th>
                                        <td>{{ $candidate->employeeExtraData->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nationality</th>
                                        <td>{{ $candidate->employeeExtraData->nationality }}</td>
                                    </tr>
                                    <tr>
                                        <th>Marital Status</th>
                                        <td>
                                            @if($candidate->employeeExtraData->marital_status == 1)
                                                <span>Married</span>
                                            @else
                                                <span>Unmarried</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>{{ $candidate->employeeExtraData->religion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Child No</th>
                                        <td>{{ $candidate->employeeExtraData->no_of_child }}</td>
                                    </tr>
                                    <tr>
                                        <th>National Id</th>
                                        <td>{{ $candidate->employeeExtraData->national_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fathers Name</th>
                                        <td>{{ $candidate->fathers_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{ $candidate->employeeExtraData->mother_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Home District</th>
                                        <td>{{ $candidate->employeeExtraData->home_district }}</td>
                                    </tr>
                                    <tr>
                                        <th>Permanent Address</th>
                                        <td>{{ $candidate->employeeExtraData->permanent_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Present Address</th>
                                        <td>{{ $candidate->employeeExtraData->present_address }}</td>
                                    </tr>

                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $candidate->department->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Emergency Contact Number</th>
                                        <td>{{ $candidate->mobile_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $candidate->email }}</td>
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

    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            $('#leave-year').change(function () {--}}
    {{--                var year = $(this).val();--}}
    {{--                var employeeId = '{{ $employee->id }}';--}}

    {{--                $.ajax({--}}
    {{--                    method: "POST",--}}
    {{--                    url: "{{ route('employee.get_leaves') }}",--}}
    {{--                    data: { year: year, employeeId: employeeId }--}}
    {{--                }).done(function( response ) {--}}
    {{--                    $('#leave-table').html(response.html);--}}
    {{--                });--}}
    {{--            });--}}
    {{--        })--}}
    {{--    </script>--}}
    <script>

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
