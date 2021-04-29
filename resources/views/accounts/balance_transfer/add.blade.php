@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Balance Transfer
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
                    <h3 class="box-title">Balance Transfer Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('balance_transfer.add') }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('type') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Type *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="type" id="type">
                                    <option value="">Select Type</option>
                                    <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Bank To Cash</option>
                                    <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Cash To Bank</option>
                                    <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Bank To Bank</option>
                                </select>

                                @error('type')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="source-bank-info">
                            <div class="form-group {{ $errors->has('source_bank') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Source Bank *</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="source_bank" id="source_bank">
                                        <option value="">Select Bank</option>

                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ old('source_bank') == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('source_bank')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('source_branch') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Source Branch *</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="source_branch" id="source_branch">
                                        <option value="">Select Branch</option>
                                    </select>

                                    @error('source_branch')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('source_account') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Source Account *</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="source_account" id="source_account">
                                        <option value="">Select Account</option>
                                    </select>

                                    @error('source_account')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('source_cheque_no') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Source Cheque No</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="source_cheque_no" placeholder="Enter Cheque No.">

                                    @error('source_cheque_no')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('source_cheque_image') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Source Cheque Image</label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="source_cheque_image">

                                    @error('source_cheque_image')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="target-bank-info">
                            <div class="form-group {{ $errors->has('target_bank') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Target Bank *</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="target_bank" id="target_bank">
                                        <option value="">Select Bank</option>

                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ old('target_bank') == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('target_bank')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('target_branch') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Target Branch *</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="target_branch" id="target_branch">
                                        <option value="">Select Branch</option>
                                    </select>

                                    @error('target_branch')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('target_account') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Target Account *</label>

                                <div class="col-sm-10">
                                    <select class="form-control" name="target_account" id="target_account">
                                        <option value="">Select Account</option>
                                    </select>

                                    @error('target_account')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('target_cheque_no') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Target Cheque No</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="target_cheque_no" placeholder="Enter Cheque No.">

                                    @error('target_cheque_no')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('target_cheque_image') ? 'has-error' :'' }}">
                                <label class="col-sm-2 control-label">Target Cheque Image</label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="target_cheque_image">

                                    @error('target_cheque_image')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
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

                        <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Date *</label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="date" name="date" value="{{ empty(old('date')) ? ($errors->has('date') ? '' : date('Y-m-d')) : old('date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('date')
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
    <script>
        $(function () {
            var sourceBranchSelected = '{{ old('source_branch') }}';
            var sourceAccountSelected = '{{ old('source_account') }}';
            var targetBranchSelected = '{{ old('target_branch') }}';
            var targetAccountSelected = '{{ old('target_account') }}';

            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('#type').change(function () {
                var type = $(this).val();

                $('#account_head_type').html('<option value="">Select Account Head Type</option>');
                $('#account_head_sub_type').html('<option value="">Select Account Head Sub Type</option>');

                if (type != '') {
                    if (type == '1') {
                        $('#source-bank-info').show();
                        $('#target-bank-info').hide();
                    } else if (type == '2') {
                        $('#source-bank-info').hide();
                        $('#target-bank-info').show();
                    } else {
                        $('#source-bank-info').show();
                        $('#target-bank-info').show();
                    }
                } else {
                    $('#source-bank-info').hide();
                    $('#target-bank-info').hide();
                }
            });

            $('#type').trigger('change');

            $('#source_bank').change(function () {
                var bankId = $(this).val();
                $('#source_branch').html('<option value="">Select Branch</option>');
                $('#source_account').html('<option value="">Select Account</option>');

                if (bankId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_branch') }}",
                        data: { bankId: bankId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (sourceBranchSelected == item.id)
                                $('#source_branch').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#source_branch').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });

                        $('#source_branch').trigger('change');
                    });
                }

                $('#source_branch').trigger('change');
            });

            $('#source_bank').trigger('change');

            $('#source_branch').change(function () {
                var branchId = $(this).val();
                $('#source_account').html('<option value="">Select Account</option>');

                if (branchId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_bank_account') }}",
                        data: { branchId: branchId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (sourceAccountSelected == item.id)
                                $('#source_account').append('<option value="'+item.id+'" selected>'+item.account_no+'</option>');
                            else
                                $('#source_account').append('<option value="'+item.id+'">'+item.account_no+'</option>');
                        });
                    });
                }
            });

            $('#target_bank').change(function () {
                var bankId = $(this).val();
                $('#target_branch').html('<option value="">Select Branch</option>');
                $('#target_account').html('<option value="">Select Account</option>');

                if (bankId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_branch') }}",
                        data: { bankId: bankId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (targetBranchSelected == item.id)
                                $('#target_branch').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#target_branch').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });

                        $('#target_branch').trigger('change');
                    });
                }

                $('#target_branch').trigger('change');
            });

            $('#target_bank').trigger('change');

            $('#target_branch').change(function () {
                var branchId = $(this).val();
                $('#target_account').html('<option value="">Select Account</option>');

                if (branchId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_bank_account') }}",
                        data: { branchId: branchId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (targetAccountSelected == item.id)
                                $('#target_account').append('<option value="'+item.id+'" selected>'+item.account_no+'</option>');
                            else
                                $('#target_account').append('<option value="'+item.id+'">'+item.account_no+'</option>');
                        });
                    });
                }
            });
        });
    </script>
@endsection
