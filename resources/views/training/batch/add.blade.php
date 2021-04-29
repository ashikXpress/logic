@extends('layouts.app')

@section('title')
    Batch Add
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Batch Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('create_batch') }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('course') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Course Name*</label>

                            <div class="col-sm-10">
                                <select class="form-control" name="course">
                                    <option value="">Select Course</option>

                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('project') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                    @endforeach
                                </select>

                                @error('course')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Batch Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('batch_code') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Batch Code *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Course Code"
                                       name="batch_code" value="{{ old('batch_code') }}">

                                @error('batch_code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('batch_amount') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Batch Amount</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Enter Batch Amount"
                                       name="batch_amount" value="{{ old('batch_amount') }}">

                                @error('batch_amount')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('total_mark') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Total Mark</label>

                            <div class="col-sm-10">
                                <input type="number" id="total" class="form-control" placeholder="Enter Total Mark"
                                       name="total_mark" value="{{ old('total_mark') }}">

                                @error('total_mark')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('level') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Assign Mark</label>
                            <div class="col-sm-10">
                                <table class="table table-bordered">
                                    <thead>
                                    <th>Level</th>
                                    <th>Mark</th>
                                    <th></th>
                                    </thead>
                                    <tbody id="level-container">
                                    <tr class="level-item">
                                        <td>
                                            <input type="text" step="any" class="form-control level" name="level[]">
                                        </td>
                                        <td>
                                            <input type="number" step="any" class="form-control mark" name="mark[]">
                                        </td>
                                        <td class="text-center">
                                            <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>
                                            <a role="button" class="btn btn-info btn-sm" id="btn-add-level">Add More Level</a>
                                        </td>
                                        <th colspan="2"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('sort') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Sort *</label>

                            <div class="col-sm-10">
                                <input type="number" value="{{old('sort')}}"  name="sort" placeholder="Sort" class="form-control">

                                @error('sort')
                                <span class="text-danger">{{$errors->first('sort')}}</span>
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

    <template id="template-level">
        <div class="col-sm-10">
            <table class="table table-bordered">
                <tr class="level-item">
                    <td>
                        <input type="text" step="any" class="form-control level" name="level[]">
                    </td>
                    <td>
                        <input type="number" step="any" class="form-control mark" name="mark[]">
                    </td>
                    <td class="text-center">
                        <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                    </td>
                </tr>
            </table>
        </div>
    </template>
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

        $(function () {
            var supplierSelected = '{{ old('supplier') }}';
            var first = true;

            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('#sister_concern').change(function (e, callback) {
                var sisterConcernId = $(this).val();

                $('#supplier').html('<option value="">Select Supplier</option>');

                if (sisterConcernId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_supplier') }}",
                        data: { sisterConcernId: sisterConcernId }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            if (supplierSelected == item.id)
                                $('#supplier').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#supplier').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    });
                }

                if (!first) {
                    $('.product').html('<option value="">Select Product</option>');
                    $('.product-name').val('');
                }

                first = false;
            });

            $('#sister_concern').trigger('change');

            $('#btn-add-level').click(function () {
                var html = $('#template-level').html();
                var item = $(html);
                //alert('bfg')

                $('#level-container').append(item);

                initProduct();

                if ($('.level-item').length >= 1 ) {
                    $('.btn-remove').show();
                }
            });

            $('body').on('click', '.btn-remove', function () {
                $(this).closest('.level-item').remove();
                calculate();

                if ($('.level-item').length <= 1 ) {
                    $('.btn-remove').hide();
                }
            });

            $('body').on('keyup', '.quantity, .unit_price', function () {
                calculate();
            });

            if ($('.product-item').length <= 1 ) {
                $('.btn-remove').hide();
            } else {
                $('.btn-remove').show();
            }

            initProduct();
            calculate();
        });
        function calculate() {
            var total = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = $('.quantity:eq('+i+')').val();
                var unit_price = $('.unit_price:eq('+i+')').val();

                if (quantity == '' || quantity < 0 || !$.isNumeric(quantity))
                    quantity = 0;

                if (unit_price == '' || unit_price < 0 || !$.isNumeric(unit_price))
                    unit_price = 0;

                $('.total-cost:eq('+i+')').html('৳ ' + (quantity * unit_price).toFixed(2) );
                total += quantity * unit_price;
            });

            $('#total-amount').html('৳ ' + total.toFixed(2));
        }

        function initProduct() {
            $('.product').select2({
                ajax: {
                    url: "{{ route('purchase_product.json') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term,
                            sisterConcernId: $('#sister_concern').val()
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $('.product').on('select2:select', function (e) {
                var data = e.params.data;

                var index = $(".product").index(this);
                $('.product-name:eq('+index+')').val(data.text);
            });
        }
    </script>
@endsection
