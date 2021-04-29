@extends('layouts.app')

@section('style')

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1.5px solid #000 !important;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 2px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        span {
            margin-right: 10px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 0px;
            line-height: 1;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
    </style>

@endsection

@section('title')
    Employee Wise Salary Slip
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <ul class="nav nav-tabs">
                    <li><a href="{{route('candidate_evalution_form.details',['candidate' => $candidate->id])}}">Personal Information</a></li>
                    <li><a href="{{route('academic_and_training.details', ['candidate' => $candidate->id])}}">Academic Information</a></li>
                    {{--                    <li><a href="{{route('training_information.details', ['candidate' => $candidate->id])}}">Training Information</a></li>--}}
                    <li><a href="{{route('job_information.details',['candidate' => $candidate->id])}}">Job Information</a></li>
                    <li><a href="{{route('employee_wise_attendance',['candidate' => $candidate->id])}}">Attendance</a></li>
                    <li><a href="{{route('payroll.employee_wise.leave',['candidate' => $candidate->id])}}">Leave</a></li>
                    <li class="active"><a href="{{route('payroll.employee.wise.salary.slip',['candidate' => $candidate->id])}}">Salary</a></li>
                    <li><a href="{{route('payroll.employee.wise.loan',['candidate' => $candidate->id])}}">Loan</a></li>
                    <li><a href="{{route('candidate_evaluation',['candidate' => $candidate->id])}}">Evalution</a></li>
                    <li><a href="#leave">User Account</a></li>
                    <li><a href="{{route('payroll.employee_wise.report',['candidate' => $candidate->id])}}">Report</a></li>
                </ul>
                <div class="box-header with-border">
                    <a style="margin-left: 15px" class="btn btn-primary" href="{{route('payroll.employee_wise_salary_page',['candidate' => $candidate->id])}}">Salary Sanction By Month</a>
                    <a style="margin-left: 15px" class="btn btn-success" href="{{route('payroll.employee_wise_due_salary',['candidate' => $candidate->id])}}">Due Salary</a>
                    <a style="margin-left: 15px" class="btn btn-warning">Payment</a>
                    <a style="margin-left: 15px" class="btn btn-primary">Funded</a>
                    <a style="margin-left: 15px" class="btn btn-info" href="{{route('payroll.employee_wise_salary_report',['candidate' => $candidate->id])}}">Report</a>
                </div>
                <!-- /.box-header -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            //Date picker
            $('#start, #end').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });

        //Salary Delete Area

        $('body').on('click', '.btn-salary-delete', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#delete-salary-candidate-id').val(response.id);


                $('#modal-salary-delete').modal('show');
            });
        });
        $('#modal-btn-delete').click(function () {
            var formData = new FormData($('#modal-delete-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_delete.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-salary-delete').modal('hide');
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
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        //Salary Delete Area End

        //Salary Approved Area

        $('body').on('click', '.btn-salary-approved', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#candidate-id').val(response.id);


                $('#modal-salary-approved').modal('show');
            });
        });
        $('#modal-btn-approved').click(function () {
            var formData = new FormData($('#modal-approved-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_approved.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-salary-approved').modal('hide');
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
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }

            });
        });

        //Salary Approved Area End


        //Salary Rejected Area Start

        $('body').on('click', '.btn-salary-rejected', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#salary-candidate-id').val(response.id);


                $('#modal-salary-rejected').modal('show');
            });
        });

        $('#modal-btn-rejected').click(function () {
            var formData = new FormData($('#modal-rejected-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_rejected.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-salary-rejected').modal('hide');
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
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        //Salary Rejected End

        //Salary Update Start

        $('body').on('click', '.btn-update', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);
                $('#modal-employee-id').val(response.employee_id);
                $('#modal-name').val(response.name);
                $('#modal-department').val(response.department.name);
                $('#modal-designation').val(response.designation.name);
                $('#modal-id').val(response.id);
                $('#modal-basic-salary').val(response.basic_salary);
                $('#modal-house-rent').val(response.house_rent);
                $('#modal-conveyance').val(response.conveyance);
                $('#modal-medical').val(response.medical);
                $('#deduction').val(response.deduction);
                $('#modal-gross-salary').val(response.expected_salary);

                $('#modal-update-salary').modal('show');
            });
        });

        $('body').on('click', '.btn-update', function () {
            var employeeId = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('get_employee_salaryChange_details') }}",
                data: { employeeId: employeeId }
            }).done(function( response ) {
                console.log(response);

                $('#modal-bonus').val(response.bonus);
                $('#modal-special-allowance').val(response.special_allowance);
                $('#modal-ta-da').val(response.ta_da);
                $('#modal-consolidate').val(response.consolidate);
                $('#modal-metro-city').val(response.metro_city);
                $('#modal-factory-allowance').val(response.factory_allowance);
                $('#modal-arrear').val(response.arrear);
                $('#modal-wppf').val(response.wppf);
                $('#modal-col').val(response.col);
                $('#modal-special-adjustment').val(response.special_adjustment);
                $('#modal-other-allowance').val(response.other_allowance);
                $('#modal-mobile-set').val(response.mobile_set);
                $('#modal-others').val(response.others);
                $('#modal-others-one').val(response.others_one);
                $('#modal-others-two').val(response.others_two);
                $('#modal-others-three').val(response.others_three);
                $('#modal-pf-loan').val(response.pf_loan);
                $('#modal-lwp').val(response.lwp);
                $('#modal-stuff-bus').val(response.stuff_bus);
                $('#modal-others-deduction').val(response.others_deduction);
                $('#modal-skrp-loan').val(response.skrp_loan);
                $('#modal-mobile-bill').val(response.mobile_bill);
                $('#modal-union-fee').val(response.union_fee);
                $('#modal-penalty').val(response.penalty);
                $('#modal-income-tex').val(response.income_tex);
                $('#modal-revenue-stamp').val(response.revenue_stamp);

                $('#modal-update-salary').modal('show');
            });
        });

        $('#modal-btn-update').click(function () {
            var formData = new FormData($('#modal-form')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('payroll.salary_update.post') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-update-salary').modal('hide');
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
                },
                reject: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            });
        });

        //Salary Update End

        $(document).ready(function()
        {
            $("#select-type-button").change(function() {
                if($(this).val() == "") {
                    $("#extra-add").hide();
                }
                else {
                    $("#extra-add").show();
                }
            });
        });


        //Initialize Select2 Elements
        $('.select2').select2()

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(print) {

            $('body').html($('#'+print).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection



