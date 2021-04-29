@extends('layouts.app')

@section('title')
    Product Add
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('product.add') }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('sister_concern') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Sister Concern *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="sister_concern">
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

                        <div class="form-group {{ $errors->has('unit') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Unit *</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="unit">
                                    <option value="">Select Unit</option>

                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" {{ old('unit') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>

                                @error('unit')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('code') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Code</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Code"
                                       name="code" value="{{ old('code') }}">

                                @error('code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Description"
                                       name="description" value="{{ old('description') }}">

                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status *</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
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
