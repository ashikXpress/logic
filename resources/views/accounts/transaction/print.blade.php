<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <style>
        #receipt-content{
            font-size: 18px;
        }

        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1px solid black !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4">
            <img src="{{ asset('img/logo.png') }}" height="50px" style="float: left">
            <h2 style="margin: 0px; float: left">RECEIPT</h2>
        </div>

        <div class="col-xs-4 text-center">
            <b>Date: </b> {{ $transaction->date->format('j F, Y') }}
        </div>

        <div class="col-xs-4 text-right">
            <b>No: </b> {{ $transaction->id + 1000 }}
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <tr>
                    <th width="20%">For Payment of</th>
                    <td>
                        {{ $transaction->accountHeadType->name.' - '.$transaction->accountHeadSubType->name }}
                    </td>
                    <th width="10%">Amount</th>
                    <td width="15%">৳{{ number_format($transaction->amount, 2) }}</td>
                </tr>

                <tr>
                    <th>Amount (In Word)</th>
                    <td colspan="3">{{ $transaction->amount_in_word }}</td>
                </tr>

                <tr>
                    <th>Paid By</th>
                    <td colspan="3">
                        @if($transaction->transaction_method == 1)
                            Cash
                        @elseif($transaction->transaction_method == 3)
                            Mobile Banking
                        @else
                            Bank - {{ $transaction->bank->name.' - '.$transaction->branch->name.' - '.$transaction->account->account_no }}
                        @endif
                    </td>
                </tr>

                @if($transaction->transaction_method == 2)
                    <tr>
                        <th>Cheque No.</th>
                        <td colspan="3">{{ $transaction->cheque_no }}</td>
                    </tr>
                @endif

                <tr>
                    <th>Note</th>
                    <td colspan="3">{{ $transaction->note }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>


<script>
    window.print();
    window.onafterprint = function(){ window.close()};
</script>
</body>
</html>
