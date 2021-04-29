@extends('layouts.app')
@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">

                    <form action="{{route('employee.excelfileimport')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-2">
                            <label for="excel_import">Upload Excel File</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="file" name="excel_import"  class="form-control" autocomplete="off">
                                <span class="text-danger">{{$errors->first('excel_import')}}</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
