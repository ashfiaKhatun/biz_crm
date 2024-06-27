<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        .header-img {
            width: 100%;
            height: auto;
            display: block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        {{-- <img src="../../../template/images/Biz-Latterhead.png" alt="BizMappers Limited" class="header-img"> --}}
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">
                    Monthly Report for {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}
                </h2>
                @php
                    $sumAmountUsd = $deposits->sum('amount_usd');
                @endphp
                <h3>Total USD Deposit: {{ number_format($sumAmountUsd, 4) }}</h3>
                <h3>Average USD Rate: {{ number_format($averageRate->average_rate, 4) }}</h3>

                <div class="mt-4 mb-3 no-print">
                    <a href="{{ route('deposits.downloadExcel', ['year' => $year, 'month' => $month]) }}"
                        class="btn btn-success">Download Excel</a>
                    <button onclick="printPage()" class="btn btn-primary ml-2">Print this page</button>
                </div>

                <div class="table-responsive text-nowrap mt-4">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Amount USD</th>
                                <th>Rate BDT</th>
                                <th>Amount BDT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($deposit->created_at)->format('d F Y') }}</td>
                                    <td>{{ $deposit->name }}</td>
                                    <td>{{ $deposit->amount_usd }}</td>
                                    <td>{{ $deposit->rate_bdt }}</td>
                                    <td>{{ $deposit->amount_bdt }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>
