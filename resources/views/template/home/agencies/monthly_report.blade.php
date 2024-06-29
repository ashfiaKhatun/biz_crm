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
            <h2 class="card-title text-center">
                Monthly Report for {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}
            </h2>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Agency Name</th>
                                <th>Total Amount (USD)</th>
                                <th>Total Amount (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportData as $agency)
                                @php
                                    $totalUsd = $agency->adAccounts->flatMap->refills->sum('amount_dollar');
                                    $totalBdt = $agency->adAccounts->flatMap->refills->sum('amount_taka');
                                @endphp
                                <tr>
                                    <td>{{ $agency->agency_name }}</td>
                                    <td>{{ $totalUsd }}</td>
                                    <td>{{ $totalBdt }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ route('agency.showAvailableMonths') }}" class="btn btn-secondary text-white mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')

</body>

</html>
