@extends('layouts.app')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">

@endsection

@section('title')
    Holiday Edit
@endsection

@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif

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
                    <h3 class="box-title">Holiday Information</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <form action="{{ route('payroll.holiday_edit',['holiday'=>$holiday->id]) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                                    <label>Holiday Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name"
                                           name="name" value="{{ $holiday->name }}">

                                    @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('from') ? 'has-error' :'' }}">
                                    <label>From</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right"
                                               id="from" name="from"
                                               value="{{ date('Y-m-d',strtotime($holiday->from))  }}"
                                               autocomplete="off" data-date-end-date="{{ date('Y-12-31') }}" >

                                    </div>
                                    @error('from')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                    <!-- /.input group -->
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('to') ? 'has-error' :'' }}">
                                    <label>To</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right"
                                               id="to" name="to"
                                               value="{{ date('Y-m-d',strtotime($holiday->to)) }}"
                                               autocomplete="off" data-date-end-date="{{ date('Y-12-31') }}">

                                    </div>
                                    <!-- /.input group -->
                                    @error('to')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>	&nbsp;</label>

                                    <input class="btn btn-primary form-control" type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
            $('#from, #to').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                orientation: 'bottom'
            });

            //Initialize Select2 Elements
            $('.select2').select2();
        });




    </script>

@endsection
