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
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Monthly Report of Agencies for {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</h2>
    <h4>Total Income: ৳ {{ number_format($refills->sum('income_tk'), 2) }}</h4>
    <table>
        <thead>
            <tr>
                <th>Agency Name</th>
                <th>Total Refill (tk)</th>
                <th>Total Refill (usd)</th>
                <th>Income (tk)</th>
                <th>Margin (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($refills as $refill)
                @php
                    $income = $refill->income_tk;
                    $margin = $refill->margin;
                @endphp
                <tr>
                    <td>{{ $refill->adAccount->agency->agency_name }}<br>ID: {{ $refill->adAccount->ad_acc_id }}</td>
                    <td>৳ {{ number_format($refill->total_refill_taka, 2) }}</td>
                    <td>$ {{ number_format($refill->total_refill_dollar, 2) }}</td>
                    <td>৳ {{ number_format($income, 2) }}</td>
                    <td>{{ number_format($margin, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
