<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
</head>

<body>
    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Date Range Report</h2>
                            <form action="{{ route('deposits.report.generate') }}" method="POST">
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
                                            <input type="text" class="form-control" name="end_date"
                                                placeholder="End Date" required>
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

                            @isset($report)
                                <div class="mt-5">
                                    <h5>Report from {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} to  {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</h5>
                                    <p>Average USD Rate: {{ $report->average_rate }}</p>
                                </div>

                                <div class="table-responsive text-nowrap mt-4">
                                    <table class="table table-bordered table-striped verticle-middle" id="depositsTable">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Amount (USD)</th>
                                                <th>Rate (BDT)</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deposits as $deposit)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($deposit->created_at)->format('d F Y') }}</td>
                                                    <td>{{ $deposit->name }}</td>
                                                    <td>{{ $deposit->amount_usd }}</td>
                                                    <td>{{ $deposit->rate_bdt }}</td>
                                                    
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
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
