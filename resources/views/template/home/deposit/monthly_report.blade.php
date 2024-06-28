<!DOCTYPE html>
<html lang="en">
<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body p-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Monthly Report</h2>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-striped verticle-middle">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthsWithData as $month)
                            <tr>
                                <td>{{ $month->year }}</td>
                                <td>{{ \Carbon\Carbon::create()->month($month->month)->translatedFormat('F') }}</td>
                                <td>
                                    <a href="{{ route('deposits.monthlyReportDetail', ['year' => $month->year, 'month' => $month->month]) }}" class="btn btn-sm btn-primary" target="_blank">View Report</a>
                                </td>
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
