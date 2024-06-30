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
    <div>
        <h4>Monthly Report of Ad Account for {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</h4>

        <h5>Total Income: ৳ {{number_format($refills->sum('income_tk'), 2)}}</h5>

        <div>

            <table>
                <thead>
                    <tr>
                        <th>Ad Account</th>
                        <th>Total Refill (tk)</th>
                        <th>Total Refill (usd)</th>
                        <th>Income (tk)</th>
                        <th>Dollar Rate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refills as $refill)
                    @if(isset($refill->refill_act_taka))
                    <tr>
                        <td>
                            <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                            <span>ID: {{ $refill->adAccount->ad_acc_id }}</span>
                        </td>
                        <td>৳ {{ $refill->total_refill_taka }}</td>
                        <td>$ {{ $refill->total_refill_dollar }}</td>
                        <td>৳ {{ $refill->refill_taka - $refill->refill_act_taka }}</td>
                        <td>{{ $refill->adAccount->dollar_rate }}</td>
                    </tr>
                    @endif
                    @if(isset($refill->refill_act_usd))
                    <tr>
                        <td>
                            <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                            <span>ID: {{ $refill->adAccount->ad_acc_id }}</span>
                        </td>
                        <td>৳ {{ $refill->total_refill_taka }}</td>
                        <td>$ {{ $refill->total_refill_dollar }}</td>
                        <td>৳ {{ $refill->refill_taka - $refill->refill_act_usd * $averageRate }}</td>
                        <td>{{ $refill->adAccount->dollar_rate }}</td>
                    </tr>
                    @endif
                    @if(!isset($refill->refill_act_taka) && !isset($refill->refill_act_usd))
                    <tr>
                        <td>
                            <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                            <span>ID: {{ $refill->adAccount->ad_acc_id }}</span>
                        </td>
                        <td>{{ $refill->total_refill_taka }}</td>
                        <td>{{ $refill->total_refill_dollar }}</td>
                        <td>{{ $refill->refill_taka - $refill->refill_usd * $averageRate }}</td>
                        <td>{{ $refill->adAccount->dollar_rate }}</td>
                    </tr>
                    @endif
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</body>

</html>