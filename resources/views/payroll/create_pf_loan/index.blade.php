@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

@endsection

@section('title')
    Create Loan
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
                <div class="box-header with-border">
                    <h3 class="box-title">Create Loan</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('payroll.create.pf_loan') }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('employee_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Employee ID(Loan Give)*</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" name="employee_id" id="employee_id">
                                    <option value="">Select Employee Id</option>
                                    @foreach($employees as $employee)
                                        <option {{ $employee->id == request()->get('employee_id') ? 'selected' : '' }} value="{{$employee->id}}">{{$employee->name}}-{{$employee->employee_id}}</option>
                                    @endforeach
                                </select>

                                @error('employee_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('amount') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Amount *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}">

                                @error('amount')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('interest') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Interest *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="interest" placeholder="%" value="{{ old('interest') }}">

                                @error('interest')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('installment_month') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Installment Month *</label>

                            <div class="col-sm-10">
                                <select name="installment_month" class="form-control" placeholder="Enter Installment Month" value="{{ old('installment_month') }}">
                                    <option value=" "> Select Month </option>
                                    <option value="3">Three Month</option>
                                    <option value="6">Six Month</option>
                                    <option value="9">Nine Month</option>
                                    <option value="12">Twelve Month</option>
                                    <option value="15">Fifteen Month</option>
                                    <option value="18">Eighteen Month</option>
                                    <option value="21">Twenty One Month</option>
                                    <option value="24">Twenty Four Month</option>
                                </select>

                                @error('installment_month')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('pf_loan_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Loan Date *</label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="date" name="pf_loan_date" value="{{ empty(old('pf_loan_date')) ? ($errors->has('pf_loan_date') ? '' : date('Y-m-d')) : old('pf_loan_date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('pf_loan_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('note') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Note</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="note" placeholder="Enter Note" value="{{ old('note') }}">

                                @error('note')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Date picker
            $('#start, #end').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
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


