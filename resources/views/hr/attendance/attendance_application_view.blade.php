@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .timepicker_wrap{
            width: max-content;
        }
    </style>

@endsection

@section('title')
    Employee Attendance Application View
@endsection

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
                    <a class="pull-left btn btn-primary" href="{{route("employee.attendance_application")}}" >Add</a>
                    <br><br>

                    <hr>

                    <table id="table" class="table table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{$application->user->name}}</td>
                                <td>{{$application->date}}</td>
                                <td>
                                    @if($application->status==1)
                                    <a class="btn btn-info btn-sm">Pending</a>
                                    @elseif($application->status==2)
                                        <a class="btn btn-primary btn-sm">Processing</a>
                                    @else
                                        <a class="btn btn-success btn-sm">Approved </a>
                                    @endif
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
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('themes/backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>s

    <script>
        //Date picker
        $('#date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('#table').DataTable();



        $('#btn-add-attendance').click(function () {
            var html = $('#attendance-template').html();
            var item = $(html);

            $('#attendance-container').append(item);


            if ($('.attendance-item').length >= 1 ) {
                $('.btn-remove').show();
            }
        });
        $('body').on('click', '.btn-remove', function () {
            $(this).closest('.attendance-item').remove();


            if ($('.attendance-item').length <= 1 ) {
                $('.btn-remove').hide();
            }
        });


    </script>
@endsection
