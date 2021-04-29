@extends('layouts.app')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Sales Order
@endsection

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ route('sales_order.create') }}">
@csrf
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Order Information</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('sister_concern') ? 'has-error' :'' }}">
                                <label>Sister Concern</label>

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

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('client') ? 'has-error' :'' }}">
                                <label>Client</label>

                                <select class="form-control" name="client" id="client">
                                    <option value="">Select Client</option>
                                </select>

                                @error('client')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                <label>Date</label>

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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Products</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Warehouse</th>
                                <th width="10%">Quantity</th>
                                <th width="15%">Unit Price</th>
                                <th>Total Cost</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody id="product-container">
                            @if (old('product') != null && sizeof(old('product')) > 0)
                                @foreach(old('product') as $item)
                                    <tr class="product-item">
                                        <td>
                                            <div class="form-group {{ $errors->has('product.'.$loop->index) ? 'has-error' :'' }}">
                                                <select class="form-control select2 product" style="width: 100%;" name="product[]" data-placeholder="Select Product" required>
                                                    <option value="">Select Product</option>

                                                    @if (old('product.'.$loop->index) != '')
                                                        <option value="{{ old('product.'.$loop->index) }}" selected>{{ old('product-name.'.$loop->index) }}</option>
                                                    @endif
                                                </select>

                                                <input type="hidden" name="product-name[]" class="product-name" value="{{ old('product-name.'.$loop->index) }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <select class="form-control warehouse select2" style="width: 100%;" name="warehouse[]" required>
                                                    <option value="">Select Warehouse</option>

                                                    @foreach($warehouses as $warehouse)
                                                        <option value="{{ $warehouse->id }}" {{ old('warehouse.'.$loop->parent->index) == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group {{ $errors->has('quantity.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="number" step="any" class="form-control quantity" name="quantity[]" value="{{ old('quantity.'.$loop->index) }}">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group {{ $errors->has('unit_price.'.$loop->index) ? 'has-error' :'' }}">
                                                <input type="text" class="form-control unit_price" name="unit_price[]" value="{{ old('unit_price.'.$loop->index) }}">
                                            </div>
                                        </td>

                                        <td class="total-cost">৳0.00</td>
                                        <td class="text-center">
                                            <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="7" class="available-quantity" style="font-weight: bold"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="product-item">
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control select2 product" style="width: 100%;" name="product[]" data-placeholder="Select Product" required>
                                                <option value="">Select Product</option>

                                            </select>

                                            <input type="hidden" name="product-name[]" class="product-name">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <select class="form-control warehouse select2" style="width: 100%;" name="warehouse[]" required>
                                                <option value="">Select Warehouse</option>

                                                @foreach($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <input type="number" step="any" class="form-control quantity" name="quantity[]">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unit_price" name="unit_price[]">
                                        </div>
                                    </td>

                                    <td class="total-cost">৳0.00</td>
                                    <td class="text-center">
                                        <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="7" class="available-quantity" style="font-weight: bold"></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <a role="button" class="btn btn-info btn-sm" id="btn-add-product" style="margin-bottom: 10px">Add Product</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Payment</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Payment Type</label>
                                <select class="form-control" id="modal-pay-type" name="payment_type">
                                    <option value="1" {{ old('payment_type') == '1' ? 'selected' : '' }}>Cash</option>
                                    <option value="2" {{ old('payment_type') == '2' ? 'selected' : '' }}>Bank</option>
                                    <option value="3" {{ old('payment_type') == '3' ? 'selected' : '' }}>Mobile Banking</option>
                                </select>
                            </div>

                            <div id="modal-bank-info">
                                <div class="form-group {{ $errors->has('bank') ? 'has-error' :'' }}">
                                    <label>Bank</label>
                                    <select class="form-control" id="modal-bank" name="bank">
                                        <option value="">Select Bank</option>

                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ old('bank') == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group {{ $errors->has('branch') ? 'has-error' :'' }}">
                                    <label>Branch</label>
                                    <select class="form-control" id="modal-branch" name="branch">
                                        <option value="">Select Branch</option>
                                    </select>
                                </div>

                                <div class="form-group {{ $errors->has('account') ? 'has-error' :'' }}">
                                    <label>Account</label>
                                    <select class="form-control" id="modal-account" name="account">
                                        <option value="">Select Account</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Cheque No.</label>
                                    <input class="form-control" type="text" name="cheque_no" placeholder="Enter Cheque No." value="{{ old('cheque_no') }}">
                                </div>

                                <div class="form-group {{ $errors->has('cheque_image') ? 'has-error' :'' }}">
                                    <label>Cheque Image</label>
                                    <input class="form-control" name="cheque_image" type="file">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered">
                            <tr>
                                <th colspan="4" class="text-right">Sub Total</th>
                                <th id="product-sub-total">৳0.00</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">VAT (%)</th>
                                <td>
                                    <div class="form-group {{ $errors->has('vat') ? 'has-error' :'' }}">
                                        <input type="text" class="form-control" name="vat" id="vat" value="{{ empty(old('vat')) ? ($errors->has('vat') ? '' : '0') : old('vat') }}">
                                        <span id="vat_total">৳0.00</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Discount</th>
                                <td>
                                    <div class="form-group {{ $errors->has('discount') ? 'has-error' :'' }}">
                                        <input type="text" class="form-control" name="discount" id="discount" value="{{ empty(old('discount')) ? ($errors->has('discount') ? '' : '0') : old('discount') }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th id="final-amount">৳0.00</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Paid</th>
                                <td>
                                    <div class="form-group {{ $errors->has('paid') ? 'has-error' :'' }}">
                                        <input type="text" class="form-control" name="paid" id="paid" value="{{ empty(old('paid')) ? ($errors->has('paid') ? '' : '0') : old('paid') }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Due</th>
                                <th id="due">৳0.00</th>
                            </tr>
                            <tr id="tr-next-payment">
                                <th colspan="4" class="text-right">Next Payment Date</th>
                                <td>
                                    <div class="form-group {{ $errors->has('next_payment') ? 'has-error' :'' }}">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="next_payment" name="next_payment" value="{{ old('next_payment') }}" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="total" id="total">
                    <input type="hidden" name="due_total" id="due_total">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

    <template id="template-product">
        <tr class="product-item">
            <td>
                <div class="form-group">
                    <select class="form-control select2 product" style="width: 100%;" name="product[]" data-placeholder="Select Product" required>
                        <option value="">Select Product</option>

                    </select>

                    <input type="hidden" name="product-name[]" class="product-name">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <select class="form-control warehouse select2" style="width: 100%;" name="warehouse[]" required>
                        <option value="">Select Warehouse</option>

                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="number" step="any" class="form-control quantity" name="quantity[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" class="form-control unit_price" name="unit_price[]">
                </div>
            </td>

            <td class="total-cost">৳0.00</td>
            <td class="text-center">
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>
        </tr>

        <tr>
            <td colspan="7" class="available-quantity" style="font-weight: bold"></td>
        </tr>
    </template>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function () {
            var clientSelected = '{{ old('client') }}';
            var first = true;

            //Initialize Select2 Elements
            $('.select2').select2()

            //Date picker
            $('#date, #next_payment').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            var message = '{{ session('message') }}';

            if (!window.performance || window.performance.navigation.type != window.performance.navigation.TYPE_BACK_FORWARD) {
                if (message != '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                    });
                }
            }

            $('#btn-add-product').click(function () {
                var html = $('#template-product').html();
                var item = $(html);
                $('#product-container').append(item);

                initProduct();

                if ($('.product-item').length >= 1 ) {
                    $('.btn-remove').show();
                }
            });

            $('#sister_concern').change(function (e, callback) {
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

                if (!first) {
                    $('.product').html('<option value="">Select Product</option>');
                    $('.product-name').val('');
                }

                first = false;
            });

            $('#sister_concern').trigger('change');

            $('body').on('change', '.product, .warehouse', function (e) {
                var productId = $(this).closest('.product-item').find('.product').val();
                var warehouseId = $(this).closest('.product-item').find('.warehouse').val();
                var sisterConcernId = $('#sister_concern').val();

                $this = $(this);
                var index = $('.' + e.target.name.slice(0, -2)).index(this);

                if (productId != '' && warehouseId != '' && sisterConcernId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('sale_product.details') }}",
                        data: { productId: productId, warehouseId: warehouseId, sisterConcernId: sisterConcernId }
                    }).done(function( response ) {
                        if (response.success) {
                            $this.closest('tr').find('.quantity').val(1);
                            $this.closest('tr').find('.quantity').attr({
                                "max" : response.count,
                                "min" : 1
                            });
                            $this.closest('tr').find('.unit_price').val(response.data.avg_unit_price);
                            $('.available-quantity:eq('+index+')').html('Available: ' + response.count);
                            calculate();
                        } else {
                            $this.closest('tr').find('.quantity').val('');
                            $this.closest('tr').find('.unit_price').val('');
                            $('.available-quantity:eq('+index+')').html('');
                            calculate();
                        }
                    });
                }
            });

            $('.warehouse').trigger('change');

            $('body').on('click', '.btn-remove', function () {
                var index = $('.btn-remove').index(this);
                $(this).closest('.product-item').remove();

                $('.available-quantity:eq('+index+')').closest('tr').remove();
                calculate();

                if ($('.product-item').length <= 1 ) {
                    $('.btn-remove').hide();
                }
            });

            $('body').on('keyup', '.quantity, .unit_price,#vat, #discount, #paid', function () {
                calculate();
            });

            $('body').on('change', '.quantity, .unit_price', function () {
                calculate();
            });

            $('#modal-pay-type').change(function () {
                if ($(this).val() == '1' || $(this).val() == '3') {
                    $('#modal-bank-info').hide();
                } else {
                    $('#modal-bank-info').show();
                }
            });

            $('#modal-pay-type').trigger('change');

            var selectedBranch = '{{ old('branch') }}';
            var selectedAccount = '{{ old('account') }}';

            $('#modal-bank').change(function () {
                var bankId = $(this).val();
                $('#modal-branch').html('<option value="">Select Branch</option>');
                $('#modal-account').html('<option value="">Select Account</option>');

                if (bankId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_branch') }}",
                        data: { bankId: bankId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (selectedBranch == item.id)
                                $('#modal-branch').append('<option value="'+item.id+'" selected>'+item.name+'</option>');
                            else
                                $('#modal-branch').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });

                        $('#modal-branch').trigger('change');
                    });
                }

                $('#modal-branch').trigger('change');
            });

            $('#modal-branch').change(function () {
                var branchId = $(this).val();
                $('#modal-account').html('<option value="">Select Account</option>');

                if (branchId != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_bank_account') }}",
                        data: { branchId: branchId }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if (selectedAccount == item.id)
                                $('#modal-account').append('<option value="'+item.id+'" selected>'+item.account_no+'</option>');
                            else
                                $('#modal-account').append('<option value="'+item.id+'">'+item.account_no+'</option>');
                        });
                    });
                }
            });

            $('#modal-bank').trigger('change');

            if ($('.product-item').length <= 1 ) {
                $('.btn-remove').hide();
            } else {
                $('.btn-remove').show();
            }

            initProduct();
            calculate();
        });

        function calculate() {
            var productSubTotal = 0;

            var vat = $('#vat').val();
            var discount = $('#discount').val();
            var paid = $('#paid').val();

            if (vat == '' || vat < 0 || !$.isNumeric(vat))
                vat = 0;

            if (discount == '' || discount < 0 || !$.isNumeric(discount))
                discount = 0;

            if (paid == '' || paid < 0 || !$.isNumeric(paid))
                paid = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = $('.quantity:eq('+i+')').val();
                var unit_price = $('.unit_price:eq('+i+')').val();


                if (quantity == '' || quantity < 0 || !$.isNumeric(quantity))
                    quantity = 0;

                if (unit_price == '' || unit_price < 0 || !$.isNumeric(unit_price))
                    unit_price = 0;

                $('.total-cost:eq('+i+')').html('৳' + (quantity * unit_price).toFixed(2) );
                productSubTotal += quantity * unit_price;
            });


            var productTotalVat = (productSubTotal * vat) / 100;

            $('#product-sub-total').html('৳' + productSubTotal.toFixed(2));

            $('#vat_total').html('৳' + productTotalVat.toFixed(2));

            var total = parseFloat(productSubTotal) + parseFloat(productTotalVat) +
                 - parseFloat(discount);

            var due = parseFloat(total) - parseFloat(paid);
            $('#final-amount').html('৳' + total.toFixed(2));
            $('#due').html('৳' + due.toFixed(2));
            $('#total').val(total.toFixed(2));
            $('#due_total').val(due.toFixed(2));

            if (due > 0) {
                $('#tr-next-payment').show();
            } else {
                $('#tr-next-payment').hide();
            }
        }

        function initProduct() {
            $('.warehouse').select2();

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
