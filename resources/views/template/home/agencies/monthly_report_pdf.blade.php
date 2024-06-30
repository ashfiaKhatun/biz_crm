<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Monthly Report of Ad Account Report for {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
        {{ $year }}</h2>
    <h4>Total Income: ৳ {{ number_format(array_sum(array_column($agencies, 'total_income_tk')), 2) }}</h4>
    <table>
        <thead>
            <tr>
                <th>Agency Name</th>
                <th>Total Refill (tk)</th>
                <th>Total Refill (usd)</th>
                <th>Income (tk)</th>
                <th>Margin (Per USD)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agencies as $agency)
                <tr>
                    <td>{{ $agency->agency_name }}</td>
                    <td>৳ {{ number_format($agency->total_refill_taka, 2) }}</td>
                    <td>$ {{ number_format($agency->total_refill_dollar, 2) }}</td>
                    <td>৳ {{ number_format($agency->total_income_tk, 2) }}</td>
                    <td>{{ number_format($agency->total_income_tk / $agency->total_refill_dollar, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
