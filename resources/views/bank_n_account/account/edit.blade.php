@extends('layouts.app')

@section('title')
    Bank Account Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Bank Account Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('bank_account.edit', ['account' => $account->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('bank') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Bank *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="bank" id="bank">
                                    <option value="">Select Bank</option>

                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}" {{ empty(old('bank')) ? ($errors->has('bank') ? '' : ($account->bank_id == $bank->id ? 'selected' : '')) :
                                            (old('bank') == $bank->id ? 'selected' : '') }}>{{ $bank->name }}</option>
                                    @endforeach
                                </select>

                                @error('bank')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('branch') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Branch *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="branch" id="branch">
                                    <option value="">Select Branch</option>
                                </select>

                                @error('branch')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Account Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Account Name"
                                       name="account_name" value="{{ empty(old('account_name')) ? ($errors->has('account_name') ? '' : $account->account_name) : old('account_name') }}">

                                @error('account_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_no') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Account No. *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Account No."
                                       name="account_no" value="{{ empty(old('account_no')) ? ($errors->has('account_no') ? '' : $account->account_no) : old('account_no') }}">

                                @error('account_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_code') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Account Code</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Code"
                                       name="account_code" value="{{ empty(old('account_code')) ? ($errors->has('account_code') ? '' : $account->account_code) : old('account_code') }}">

                                @error('account_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Description"
                                       name="description" value="{{ empty(old('description')) ? ($errors->has('description') ? '' : $account->description) : old('description') }}">

                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('opening_balance') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Opening Balance</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Opening Balance"
                                       name="opening_balance" value="{{ empty(old('opening_balance')) ? ($errors->has('opening_balance') ? '' : $account->opening_balance) : old('opening_balance') }}">

                                @error('opening_balance')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status *</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($account->status == '1' ? 'checked' : '')) :
                                            (old('status') == '1' ? 'checked' : '') }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ empty(old('status')) ? ($errors->has('status') ? '' : ($account->status == '0' ? 'checked' : '')) :
                                            (old('status') == '0' ? 'checked' : '') }}>
                                        Inactive
                                    </label>
                                </div>

                                @error('status')
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
    <script>
        $(function () {
            var branchSelected = '{{ empty(old('branch')) ? ($errors->has('branch') ? '' : $account->branch_id) : old('branch') }}';

            $('#bank').change(function () {
                var bankId = $(this).val();

                $('#branch').html('<option value="">Select Branch</option>');

                if (bankId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('bank_account.get_branch') }}",
                        data: { bankId: bankId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (branchSelected == item.id)
                                $('#branch').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#branch').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#bank').trigger('change');
        });
    </script>
@endsection
