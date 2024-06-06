<!DOCTYPE html>
<html lang="en">
<head>
    @include('template.home.layouts.head')
</head>

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body p-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Average USD Rate per Month</h2>
    
            <div class="table-responsive">
                <table class="table table-bordered table-striped verticle-middle">
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
    </div>
</div>

@include('template.home.layouts.footer')
@include('template.home.layouts.scripts')

</body>

</html>
