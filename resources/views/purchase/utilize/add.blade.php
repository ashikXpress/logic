@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Utilize
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Utilize Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('utilize.add') }}">
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

                        <div class="form-group {{ $errors->has('project') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Project *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="project" id="project">
                                    <option value="">Select Project</option>
                                </select>

                                @error('project')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('product') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Product *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="product" id="product">
                                    <option value="">Select Product</option>
                                </select>

                                @error('v')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('warehouse') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Warehouse *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="warehouse">
                                    <option value="">Select Warehouse</option>

                                    @foreach($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse') == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>

                                @error('warehouse')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Quantity *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Quantity"
                                       name="quantity" value="{{ old('quantity') }}">

                                @error('quantity')
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
                                <input type="text" class="form-control" placeholder="Enter Note"
                                       name="note" value="{{ old('note') }}">

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
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {
            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            var clientSelected = '{{ old('client') }}';
            var projectSelected = '{{ old('project') }}';
            var productSelected = '{{ old('product') }}';

            $('#sister_concern').change(function () {
                var sisterConcernId = $(this).val();

                $('#client').html('<option value="">Select Client</option>');
                $('#project').html('<option value="">Select Project</option>');
                $('#product').html('<option value="">Select Product</option>');

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

                        $('#client').trigger('change');
                    });

                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_product') }}",
                        data: { sisterConcernId: sisterConcernId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (productSelected == item.id)
                                $('#product').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#product').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });

            $('#sister_concern').trigger('change');

            $('#client').change(function () {
                var clientId = $(this).val();

                $('#project').html('<option value="">Select Project</option>');

                if (clientId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_project') }}",
                        data: { clientId: clientId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (projectSelected == item.id)
                                $('#project').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#project').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }
            });
        });
    </script>
@endsection
