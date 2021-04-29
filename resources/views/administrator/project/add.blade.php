@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Project Add
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal"
                      method="POST"
                      action="{{ route('project.add') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('sister_concern') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Sister Concern *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="sister_concern" id="sister_concern">
                                    <option value="">Select Sister Concern</option>

                                    @foreach($sisterConcerns as $sisterConcern)
                                        <option value="{{ $sisterConcern->id }}" {{ old('sister_concern') == $sisterConcern->id ? 'selected' : '' }}>{{ $sisterConcern->name }}</option>
                                    @endforeach
                                </select>

                                @error('sister_concern')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('client') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Client *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="client" id="client">
                                    <option value="">Select Client</option>
                                </select>

                                @error('client')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <textarea class="form-control"
                                          rows="5"
                                          placeholder="Enter Description"
                                          name="description">{{ old('description') }}</textarea>

                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('amount') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Amount *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Amount"
                                       name="amount" value="{{ old('amount') }}">

                                @error('amount')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('deadline') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Deadline *</label>

                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right date" name="deadline" value="{{ old('deadline') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('deadline')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('work_order') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Work Order</label>

                            <div class="col-sm-10">
                                <input type="file" class="form-control"
                                       name="work_order">

                                @error('work_order')
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
            //Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            var clientSelected = '{{ old('client') }}';

            $('#sister_concern').change(function () {
                var sisterConcernId = $(this).val();

                $('#client').html('<option value="">Select Client</option>');

                if (sisterConcernId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_client') }}",
                        data: { sisterConcernId: sisterConcernId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (clientSelected == item.id)
                                $('#client').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#client').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#sister_concern').trigger('change');
        });
    </script>
@endsection
