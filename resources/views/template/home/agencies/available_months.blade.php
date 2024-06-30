<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mr-4 mt-2">Month Wise Agency Report</h4>

                    <form action="{{ route('agency.report.generate') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <div class="input-group date" id="startDatePicker">
                                    <input type="text" class="form-control" name="start_date"
                                        placeholder="Start Date" required>
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group date" id="endDatePicker">
                                    <input type="text" class="form-control" name="end_date" placeholder="End Date"
                                        required>
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                            </div>
                        </div>
                    </form>

                    @isset($agencies)
                        <div class="p-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h4 class="card-title mr-4 mt-2">Report of Agencies from
                                            {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} to
                                            {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                                        </h4>

                                        <h5>Total Income: ৳
                                            {{ number_format(array_sum(array_column($agencies, 'total_income_tk')), 2) }}
                                        </h5>

                                        {{-- <a href="{{ route('monthlyReport.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                                        class="btn btn-sm btn-primary mb-3">Download PDF</a> --}}

                                        <div class="table-responsive text-nowrap mt-3">
                                            <table class="table table-bordered table-striped verticle-middle"
                                                id="refillTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Agency Name</th>
                                                        <th scope="col">Total Refill (tk)</th>
                                                        <th scope="col">Total Refill (usd)</th>
                                                        <th scope="col">Income (tk)</th>
                                                        <th scope="col">Margin (Per USD)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($agencies as $agency)
                                                        <tr>
                                                            <td>{{ $agency->agency_name }}</td>
                                                            <td>৳ {{ number_format($agency->total_refill_taka, 2) }}</td>
                                                            <td>$ {{ number_format($agency->total_refill_dollar, 2) }}</td>
                                                            <td>৳ {{ number_format($agency->total_income_tk, 2) }}</td>
                                                            <td>{{ number_format($agency->total_income_tk / ($agency->total_refill_dollar ? $agency->total_refill_dollar : 1), 2) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monthsWithData as $data)
                                <tr>
                                    <td>{{ $data->year }}</td>
                                    <td>{{ \Carbon\Carbon::create()->month($data->month)->translatedFormat('F') }}</td>
                                    <td>
                                        <a href="{{ route('agency.monthlyReport', ['year' => $data->year, 'month' => $data->month]) }}"
                                            class="btn btn-sm btn-primary">View Report</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#startDatePicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('#endDatePicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>

</body>

</html>
