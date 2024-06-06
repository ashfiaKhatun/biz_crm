<!DOCTYPE html>
<html lang="en">
<head>
    @include('template.home.layouts.head')
</head>

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body">
    <div class="container my-5">
        <h2>Average USD Rate per Month</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Average USD Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($averageRates as $rate)
                    <tr>
                        <td>{{ $rate->year }}</td>
                        <td>{{ \Carbon\Carbon::create()->month($rate->month)->format('F') }}</td>
                        <td>{{ $rate->average_rate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('template.home.layouts.footer')
@include('template.home.layouts.scripts')

</body>

</html>
