<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <style>
        @page {
            @top-center {
                content: element(pageHeader);
            }
        }
        #pageHeader{
            position: running(pageHeader);
        }

        table.table-bordered{
            border:1px solid black !important;
            margin-top:20px;
        }
        table.table-bordered th{
            border:1px solid black !important;
        }
        table.table-bordered td{
            border:1px solid black !important;
        }

        .product-table th, .table-summary th {
            padding: 2px !important;
            text-align: center !important;
        }

        .product-table td, .table-summary td {
            padding: 2px !important;
            text-align: center !important;
        }

        @media screen {
            div.divFooter {
                display: none;
            }
        }
        @media print {
            div.divFooter {
                position: fixed;
                bottom: 0;
            }
        }
    </style>
</head>
<body>
<header id="pageHeader" style="margin-bottom: 10px">
    <div class="row">
        <div class="col-xs-3 col-xs-offset-1">
            <img src="{{ asset('img/logo.png') }}" width="100px" style="margin-top: 0px">
        </div>

        <div class="col-xs-8">
            <p style="font-family: 'Times New Roman'; font-size: 33px; font-style: italic; margin: 0px; font-weight: bold">{{ config('app.name') }}</p>
            <p style="margin: 0px">
                Mirpur 2 : #House:1 Section:6 Floor:1st <br>
                Road:4 Block:ka (7.77 mi) Mirpur, Dhaka, Bangladesh 1216<br>
                Mobile : 01717-180857
            </p>

        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 text-center" style="border: 1px solid black; padding: 3px; border-radius: 7px">
            <strong>Invoice</strong>
        </div>
    </div>

    <div class="row" style="border: 1px solid black; margin-top: 3px; font-size: 12px">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-6">
                    <strong>Name: </strong>{{ $order->client->name }} <br>
                    <strong>Address: </strong>{{ $order->client->address }} <br>
                    <strong>Mobile No. : </strong>{{ $order->client->mobile_no }}
                </div>

                <div class="col-xs-6 text-right">
                    <strong>ID : </strong>{{ $order->client->id }} <br>
                    <strong>Invoice No : </strong>{{ $order->order_no }} <br>
                    <strong>Date : </strong>{{ $order->date->format('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($order->products) > 0)
    <table class="table table-bordered product-table" style="margin-top: 5px; margin-bottom: 1px !important; font-size: 12px">
        <thead>
        <tr>
            <th style="background-color: lightgrey !important;">#</th>
            <th style="background-color: lightgrey !important;">Product Name</th>
            <th style="background-color: lightgrey !important;">Qty</th>
            <th style="background-color: lightgrey !important;">Unit Price</th>
            <th style="background-color: lightgrey !important;">Amount</th>
        </tr>
        </thead>

        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->pivot->product_name }}</td>
                <td>{{ $product->pivot->quantity.' '.$product->pivot->unit }}</td>
                <td>{{ number_format($product->pivot->unit_price, 2) }}</td>
                <td>{{ number_format($product->pivot->total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<div class="table-summary" style="width: 60%; float: right; font-size: 12px">
    <table class="table table-bordered" style="margin-top: 2px !important;">
        <tr>
            <th>Sub Total</th>
            <td>{{ number_format($order->sub_total, 2) }}</td>
        </tr>
        <tr>
            <th>Vat ({{ $order->vat_percentage }}%)</th>
            <td>{{ number_format($order->vat, 2) }}</td>
        </tr>
        <tr>
            <th>Discount</th>
            <td>{{ number_format($order->discount, 2) }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{ number_format($order->total, 2) }}</td>
        </tr>
    </table>
</div>

<div class="text-center" style="clear: both">
    @if($order->service_vat > 0  || $order->vat > 0)
        VAT Money was given to the customer. <br>
    @endif
    <strong>In Word: {{ $order->amount_in_word }} Only</strong>
</div>


<div class="divFooter" style="width: 100%">
    <div class="row">
        <div class="col-xs-6">
            <span style="border-top: 1px solid black">Received With Good Condition By</span>
        </div>

        <div class="col-xs-6 text-right">
            <span style="border-top: 1px solid black">Authorised Signature</span>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            Notice: Warranty will be void if there any physical damage to the product or sticker are removed or sold goods are not refundable.
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            Software developed by 2A IT. Mobile: 01884697775
        </div>
    </div>
</div>


<script>
    window.print();
    window.onafterprint = function(){ window.close()};
</script>
</body>
</html>
