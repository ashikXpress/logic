@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Sister Concern
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
                    <a class="btn btn-primary" href="{{ route('sister_concern.add') }}">Add Sister Concern</a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($sisterConcerns as $sisterConcern)
                            <tr>
                                <td>
                                    <img src="{{ $sisterConcern->logo ? asset($sisterConcern->logo) : Avatar::create($sisterConcern->name)->toBase64() }}"
                                         alt="{{ $sisterConcern->name }}"
                                         height="50px">
                                </td>
                                <td>{{ $sisterConcern->name }}</td>
                                <td>{{ $sisterConcern->address }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('sister_concern.edit', ['sisterConcern' => $sisterConcern->id]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function () {
            $('#table').DataTable({
                order: [[ 1, "asc" ]],
            });
        })
    </script>
@endsection
