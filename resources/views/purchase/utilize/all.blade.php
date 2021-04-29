@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Utilize Logs
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
                    <a class="btn btn-primary" href="{{ route('utilize.add') }}">Add</a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sister Concern</th>
                            <th>Client</th>
                            <th>Project</th>
                            <th>Product</th>
                            <th>Warehouse</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Note</th>
                        </tr>
                        </thead>
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('utilize.datatable') }}',
                columns: [
                    {data: 'date', name: 'date'},
                    {data: 'sisterConcern', name: 'sisterConcern.name'},
                    {data: 'client', name: 'client.name'},
                    {data: 'project', name: 'project.name'},
                    {data: 'product', name: 'product.name'},
                    {data: 'warehouse', name: 'warehouse.name'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'unit_price', name: 'unit_price'},
                    {data: 'note', name: 'note'},
                ],
                order: [[ 0, "desc" ]],
            });
        });
    </script>
@endsection
