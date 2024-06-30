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
                        <div>
                            <h4 class="card-title mr-4 mt-2">Monthly Report of Agencies for
                                {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}
                            </h4>

                            <h5>Total Income: ৳
                                {{ number_format(array_sum(array_column($agencies, 'total_income_tk')), 2) }}
                            </h5>

                            <a href="{{ route('monthlyReport.pdf', ['year' => $year, 'month' => $month]) }}" class="btn btn-sm btn-primary mb-3">Download PDF</a>

                            <div class="table-responsive text-nowrap mt-3">
                                <table class="table table-bordered table-striped verticle-middle" id="refillTable">
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
                                            <td>{{ number_format($agency->total_income_tk/$agency->total_refill_dollar, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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

</body>

</html>