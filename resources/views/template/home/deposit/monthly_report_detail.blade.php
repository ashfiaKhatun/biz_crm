<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Monthly Deposit Report for {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</h2>

            <h3>Average USD Rate: {{ number_format($averageRate->average_rate, 2) }}</h3>

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
                        @foreach($deposits as $deposit)
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
</body>
</html>
