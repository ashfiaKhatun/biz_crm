<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!-- navbar start -->
        @include('template.home.layouts.navbar')

        <!-- navbar end -->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('template.home.layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="p-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Date Wise Ad Account Report</h2>

                        <div>


                            <form action="{{ route('adAccounts.report.generate') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <div class="input-group date" id="startDatePicker">
                                            <input type="text" class="form-control" name="start_date" placeholder="Start Date" required>
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group date" id="endDatePicker">
                                            <input type="text" class="form-control" name="end_date" placeholder="End Date" required>
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
                                <h5>Report from {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</h5>

                                <h5>Total Income: ৳ {{ $refills->sum('income_tk') }}</h5>
                            </div>

                            <div class="table-responsive text-nowrap mt-3">

                                <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ad Account</th>
                                            <th scope="col">Total Refill (tk)</th>
                                            <th scope="col">Total Refill (usd)</th>
                                            <th scope="col">Income (tk)</th>
                                            <th scope="col">Dollar Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($refills as $refill)
                                        @if(isset($refill->refill_act_taka))
                                        <tr>
                                            <td>
                                                <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                                                <span class="font-sm mt-1">ID: {{ $refill->adAccount->ad_acc_id }}</span>
                                            </td>
                                            <td>৳ {{ $refill->total_refill_taka }}</td>
                                            <td>$ {{ $refill->total_refill_dollar }}</td>
                                            <td>৳ {{ $refill->refill_taka - $refill->refill_act_taka }}</td>
                                            <td>$ {{ $refill->adAccount->dollar_rate }}</td>
                                        </tr>
                                        @endif
                                        @if(isset($refill->refill_act_usd))
                                        <tr>
                                            <td>
                                                <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                                                <span class="font-sm mt-1">ID: {{ $refill->adAccount->ad_acc_id }}</span>
                                            </td>
                                            <td>৳ {{ $refill->total_refill_taka }}</td>
                                            <td>$ {{ $refill->total_refill_dollar }}</td>
                                            <td>৳ {{ $refill->refill_taka - $refill->refill_act_usd * $report->average_rate }}</td>
                                            <td>$ {{ $refill->adAccount->dollar_rate }}</td>
                                        </tr>
                                        @endif
                                        @if(!isset($refill->refill_act_taka) && !isset($refill->refill_act_usd))
                                        <tr>
                                            <td>
                                                <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                                                <span class="font-sm mt-1">ID: {{ $refill->adAccount->ad_acc_id }}</span>
                                            </td>
                                            <td>৳ {{ $refill->total_refill_taka }}</td>
                                            <td>$ {{ $refill->total_refill_dollar }}</td>
                                            <td>৳ {{ $refill->refill_taka - $refill->refill_usd * $report->average_rate }}</td>
                                            <td>$ {{ $refill->adAccount->dollar_rate }}</td>
                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            @endisset





                        </div>

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-sm text-white btn-secondary" data-toggle="modal" data-target="#monthlyReportModal">
                            Monthly Report
                        </button>

                    </div>
                </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="monthlyReportModal" tabindex="-1" role="dialog" aria-labelledby="monthlyReportModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="monthlyReportModalLabel">Month Wise Ad Account Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                                <a href="{{ route('monthlyReport.monthlyReportDetail', ['year' => $month->year, 'month' => $month->month]) }}" class="btn btn-sm btn-primary">View Report</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('template.home.layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>


    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
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