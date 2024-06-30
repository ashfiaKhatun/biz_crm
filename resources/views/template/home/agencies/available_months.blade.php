<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mr-4 mt-2">Month Wise Agency Report</h4>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Month</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monthsWithData as $month)
                            <tr>
                                <td>{{ $month->year }}</td>
                                <td>{{ \Carbon\Carbon::create()->month($month->month)->translatedFormat('F') }}</td>
                                <td>
                                    <a href="{{ route('agency.monthlyReport', ['year' => $month->year, 'month' => $month->month]) }}" class="btn btn-sm btn-primary">View Report</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <a href="{{ route('home') }}" class="btn btn-secondary text-white mt-3">Back</a> --}}
        </div>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')

</body>

</html>