@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Salary Update
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
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Type</th>
                            <th>Mobile</th>
                            <th>Gross Salary</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-salary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Salary</h4>
                </div>
                <div class="modal-body">
                    <form id="modal-form" enctype="multipart/form-data" name="modal-form">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input class="form-control" id="modal-employee-id" disabled>
                        </div>

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

                        <input type="hidden" name="id" id="modal-id">

                        <div class="form-group">
                            <label>Basic Salary</label>
                            <input type="text" class="form-control" name="basic_salary" id="modal-basic-salary" placeholder="Enter Basic Salary" readonly>
                        </div>

                        <div class="form-group">
                            <label>House Rent</label>
                            <input type="text" class="form-control" name="house_rent" id="modal-house-rent" placeholder="Enter House Rent" readonly>
                        </div>

                        <div class="form-group">
                            <label>Conveyance</label>
                            <input type="text" class="form-control" name="conveyance" id="modal-conveyance" placeholder="Enter Conveyance" readonly>
                        </div>

                        <div class="form-group">
                            <label>Medical</label>
                            <input type="text" class="form-control" name="medical" id="modal-medical" placeholder="Enter Medical" readonly>
                        </div>

                        <div class="form-group">
                            <label> Deduction</label>
                            <input type="text" class="form-control" name="deduction" id="deduction" placeholder="Enter Others Deduct" readonly>
                        </div>

                        <div class="form-group">
                            <label>Gross Salary</label>
                            <input type="text" class="form-control" name="gross_salary" id="modal-gross-salary" placeholder="Enter Gross Salary">
                        </div>
                        <div class="form-group">
                            <label>Bonus(+)</label>
                            <input type="text" class="form-control" name="bonus" id="modal-bonus" placeholder="Enter Bonus Amount">
                        </div>
                        <div class="form-group">
                            <label>Special Allowance(+)</label>
                            <input type="text" class="form-control" name="special_allowance" id="modal-special-allowance" placeholder="Enter Special Allowance Amount">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>Advance</label>--}}
{{--                            <input type="text" class="form-control" name="advance" id="modal-advance" placeholder="Enter Advance Amount">--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label>TA/DA(+)</label>
                            <input type="text" class="form-control" name="ta_da" id="modal-ta-da" placeholder="Enter TA/DA Amount">
                        </div>
                        <div class="form-group">
                            <label>Consolidate(+)</label>
                            <input type="text" class="form-control" name="consolidate" id="modal-consolidate" placeholder="Enter Consolidate Amount">
                        </div>
                        <div class="form-group">
                            <label>Metro City(+)</label>
                            <input type="text" class="form-control" name="metro_city" id="modal-metro-city" placeholder="Enter Metro City Amount">
                        </div>
                        <div class="form-group">
                            <label>Factory Allowance(+)</label>
                            <input type="text" class="form-control" name="factory_allowance" id="modal-factory-allowance" placeholder="Enter Factory Allowance Amount">
                        </div>
                        <div class="form-group">
                            <label>Arrear(+)</label>
                            <input type="text" class="form-control" name="arrear" id="modal-arrear" placeholder="Enter Arrear Amount">
                        </div>
                        <div class="form-group">
                            <label>WPPF(+)</label>
                            <input type="text" class="form-control" name="wppf" id="modal-wppf" placeholder="Enter WPPF Amount">
                        </div>
                        <div class="form-group">
                            <label>COL(+)</label>
                            <input type="text" class="form-control" name="col" id="modal-col" placeholder="Enter COL Amount">
                        </div>
                        <div class="form-group">
                            <label>Special Adjustment(+)</label>
                            <input type="text" class="form-control" name="special_adjustment" id="modal-special-adjustment" placeholder="Enter Special Adjustment Amount">
                        </div>
                        <div class="form-group">
                            <label>Other Allowance(+)</label>
                            <input type="text" class="form-control" name="other_allowance" id="modal-other-allowance" placeholder="Enter Other Allowance Amount">
                        </div>
                        <div class="form-group">
                            <label>Mobile Set(+)</label>
                            <input type="text" class="form-control" name="mobile_set" id="modal-mobile-set" placeholder="Enter Mobile Set Amount">
                        </div>
                        <div class="form-group">
                            <label>Others(+)</label>
                            <input type="text" class="form-control" name="others" id="modal-others" placeholder="Enter Others Amount">
                        </div>
                        <div class="form-group">
                            <label>Others One(+)</label>
                            <input type="text" class="form-control" name="others_one" id="modal-others-one" placeholder="Enter Others One Amount">
                        </div>
                        <div class="form-group">
                            <label>Others Two(-)</label>
                            <input type="text" class="form-control" name="others_two" id="modal-others-two" placeholder="Enter Others Two Amount">
                        </div>
                        <div class="form-group">
                            <label>Others Three(-)</label>
                            <input type="text" class="form-control" name="others_three" id="modal-others-three" placeholder="Enter Others Two Three Amount">
                        </div>
                        <div class="form-group">
                            <label>PF Loan(-)</label>
                            <input type="text" class="form-control" name="pf_loan" id="modal-pf-loan" placeholder="Enter PF Loan Amount">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>Advance Loan(-)</label>--}}
{{--                            <input type="text" class="form-control" name="advance_loan" id="modal-advance-loan" placeholder="Enter Advance Loan Amount">--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label>LWP(-)</label>
                            <input type="text" class="form-control" name="lwp" id="modal-lwp" placeholder="Enter LWP Amount">
                        </div>
                        <div class="form-group">
                            <label>Stuff Bus(-)</label>
                            <input type="text" class="form-control" name="stuff_bus" id="modal-stuff-bus" placeholder="Enter Stuff Bus Loan Amount">
                        </div>
                        <div class="form-group">
                            <label>Others Deduction(-)</label>
                            <input type="text" class="form-control" name="others_deduction" id="modal-others-deduction" placeholder="Enter Others Deduction Amount">
                        </div>
                        <div class="form-group">
                            <label>SKRP Loan(-)</label>
                            <input type="text" class="form-control" name="skrp_loan" id="modal-skrp-loan" placeholder="Enter SKRP Loan Amount">
                        </div>
                        <div class="form-group">
                            <label>Mobile Bill(-)</label>
                            <input type="text" class="form-control" name="mobile_bill" id="modal-mobile-bill" placeholder="Enter Mobile Bill Amount">
                        </div>
                        <div class="form-group">
                            <label>Union Fee(-)</label>
                            <input type="text" class="form-control" name="union_fee" id="modal-union-fee" placeholder="Enter Union Fee Amount">
                        </div>
                        <div class="form-group">
                            <label>Penalty(-)</label>
                            <input type="text" class="form-control" name="penalty" id="modal-penalty" placeholder="Enter Penalty Amount">
                        </div>
                        <div class="form-group">
                            <label>Income Tex(-)</label>
                            <input type="text" class="form-control" name="income_tex" id="modal-income-tex" placeholder="Enter Income Tex Amount">
                        </div>
                        <div class="form-group">
                            <label>Revenue Stamp(-)</label>
                            <input type="text" class="form-control" name="revenue_stamp" id="modal-revenue-stamp" placeholder="Enter Revenue Stamp Amount">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>Miscellaneous</label>--}}
{{--                            <input type="text" class="form-control" name="miscellaneous" id="modal-miscellaneous" placeholder="Enter Miscellaneous Amount">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Kollan Trust</label>--}}
{{--                            <input type="text" class="form-control" name="kollan_trust" id="modal-kollan-trust" placeholder="Enter Kollan Trust Amount">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>Type</label>--}}
{{--                            <select class="form-control" name="type" id="select-type-button">--}}
{{--                                <option value="">Select Type</option>--}}
{{--                                <option value="1">Bonus</option>--}}
{{--                                <option value="2">Special Allowance</option>--}}
{{--                                <option value="3">Advance</option>--}}
{{--                                <option value="4">Other</option>--}}
{{--                                <option value="5">T/A</option>--}}
{{--                                <option value="6">D/A</option>--}}
{{--                                <option value="7">Mobile Bill</option>--}}
{{--                                <option value="8">Penalty</option>--}}
{{--                                <option value="9">Income Tex</option>--}}
{{--                                <option value="10">Revenue Stamp</option>--}}
{{--                                <option value="11">Miscellaneous</option>--}}
{{--                                <option value="12">Kollan Trust</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div id="extra-add" style="display: none">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Amount</label>--}}
{{--                                <input type="text" class="form-control" name="amount" placeholder="Enter Amount">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label>For Month</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control pull-right" name="month" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="modal-date" name="date" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
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
    <!-- /.modal -->
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('payroll.salary_update.datatable') }}',
                columns: [
                    {data: 'photo', name: 'photo', orderable: false},
                    {data: 'employee_id', name: 'employee_id'},
                    {data: 'name', name: 'name'},
                    {data: 'department', name: 'department.name'},
                    {data: 'designation', name: 'designation.name'},
                    {data: 'employee_type', name: 'employee_type'},
                    {data: 'mobile_no', name: 'mobile_no'},
                    {data: 'gross_salary', name: 'gross_salary'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[ 1, "asc" ]],
            });

            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

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
                var month = $(this).data('id');

                $.ajax({
                    method: "GET",
                    url: "{{ route('get_employee_salaryChange_details') }}",
                    data: { employeeId: employeeId }
                }).done(function( response ) {
                    console.log(response);

                    $('#modal-bonus').val(response.bonus);

                    $('#modal-update-salary').modal('show');
                });
            });

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
                    }
                });
            });
        })
    </script>
@endsection
