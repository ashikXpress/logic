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
    Employee Attendance Aplication
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

                        <form action="{{route('employee.attendance_application')}}" method="post">
                            @csrf
                            <table id="table" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Location</th>
                                    <th>Purpose/Details</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="attendance-container">
                                @if (old('date') != null && sizeof(old('date')) > 0)
                                    @foreach(old('date') as $item)
                                    <tr  class="attendance-item">
                                        <td>
                                            <div class="form-group {{ $errors->has('date.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="date" id="date" class="form-control" name="date[]"  value="{{old("date")}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group {{ $errors->has('in_time.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="time" class="form-control" name="in_time[]"  value="{{old("in_time")}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group {{ $errors->has('out_time.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="time" class="form-control" name="out_time[]"  value="{{old("out_time")}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group {{ $errors->has('location.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="text" class="form-control" name="location[]"  value="{{old("location")}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group {{ $errors->has('purpose_details.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="text" class="form-control" name="purpose_details[]"  value="{{old("purpose_details")}}">
                                            </div>
                                        </td>
                                        <td>
                                            <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else

                                <tr  class="attendance-item">
                                    <td>
                                        <div class="form-group">
                                        <input type="date" id="date" class="form-control" name="date[]"  placeholder="Date">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                        <input type="time" class="form-control" name="in_time[]"  placeholder="In Time">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                        <input type="time" class="form-control" name="out_time[]"  placeholder="Out Time">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="location[]"  placeholder="Location">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="purpose_details[]"  placeholder="Purpose/Details">
                                        </div>
                                    </td>
                                    <td>
                                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <a role="button" class="btn btn-info btn-sm" id="btn-add-attendance">Add New</a>                                    </td>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <template id="attendance-template">
        <tr  class="attendance-item">
            <td>
                <div class="form-group">
                    <input type="date" id="date" class="form-control" name="date[]"  placeholder="Date">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="time" class="form-control" name="in_time[]"  placeholder="In Time">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="time" class="form-control" name="out_time[]"  placeholder="Out Time">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="location[]"  placeholder="Location">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="purpose_details[]"  placeholder="Purpose/Details">
                </div>
            </td>
            <td>
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>
        </tr>
    </template>


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
