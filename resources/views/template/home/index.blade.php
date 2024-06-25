<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
    <style>
        .custom-card {
            height: 170px;
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


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

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center custom-card gradient-1">
                            <div class="p-4">
                                <h5 class="text-white">Total Application: <span>{{ $allApplication }}</span></h5>
                                <h5 class="text-white">Pending Application: <span>{{ $pendingApplication }}</span></h5>
                                <h5 class="text-white">Total Ad Account: <span>{{ $allAdAccount }}</span></h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center custom-card gradient-2">
                            <div class="p-4">
                                <h5 class="text-white">Current Month Refill: <span>{{ $thisMonthRefill }}</span></h5>
                                <h5 class="text-white">Last 7 Days Refill: <span>{{ $lastSevenDaysRefill }}</span></h5>
                                <h5 class="text-white">Refill Request: <span>{{ $pendingRefillAmount }} ({{$pendingRefillCount}})</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center custom-card gradient-3">
                            <div class="p-4">
                                <h5 class="text-white">Current Month Deposit: <span></span></h5>
                                <h5 class="text-white">Average Rate: <span></span></h5>
                                <h5 class="text-white">Balance: <span></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="btn-group-vertical w-100">
                            <a class="btn btn-primary text-white mb-1 py-3 rounded">New Refill</a>
                            <a class="btn btn-secondary text-white mb-1 py-3 rounded">New Account</a>
                            <a class="btn btn-success text-white py-3 rounded">Add Deposit</a>

                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title mr-4 mt-2">Refill History</h4>

                                    <a href="{{ route('refills.index') }}">
                                        <button class="btn btn-sm btn-secondary text-white">See All</button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0">
                                        <thead>
                                            <tr>
                                                <th>Refill Date</th>
                                                <th>Ad Account Name</th>
                                                <th>Refill Amount ($)</th>
                                                <th>Payment Method</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($refills as $refill)
                                            <tr>
                                                <td>{{ $refill->created_at->format('j F Y') }}</td>
                                                <td>
                                                    <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                                                    <span class="font-sm mt-1">{{ $refill->adAccount->ad_acc_id }}</span>
                                                </td>
                                                <td>{{ $refill->amount_dollar }}</td>
                                                <td>{{ $refill->payment_method }}</td>
                                                <td>
                                                    @if ($refill->status == 'pending')
                                                    <span class="badge custom-badge-info">Pending</span>
                                                    @endif



                                                    @if ($refill->status == 'approved')
                                                    <span class="badge custom-badge-success">Approved</span>
                                                    @endif

                                                    @if ($refill->status == 'rejected')
                                                    <span class="badge badge-danger px-3 py-1">Rejected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pie chart</h4>
                                <canvas id="pieChart" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title mr-4 mt-2">Pending Applications</h4>

                                    <a href="{{ route('pending-ad-account-application') }}">
                                        <button class="btn btn-sm btn-secondary text-white">See All</button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0">
                                        <thead>
                                            <tr>
                                                <th>Application Date</th>
                                                <th>Client Name</th>
                                                <th>Ad Account Name</th>
                                                <th>BM Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($adAccounts as $adAccount)
                                            <tr>
                                                <td>{{ $adAccount->created_at->format('j F Y') }}</td>
                                                <td>{{ $adAccount->client->name }}</td>
                                                <td>
                                                    <span>{{ $adAccount->ad_acc_name }}</span><br>
                                                    <span class="font-sm mt-1">{{ $adAccount->ad_acc_id }}</span>
                                                </td>
                                                <td>{{ $adAccount->bm_id }}</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title mr-4 mt-2">Pending Refills</h4>

                                    <a href="{{ route('refills.pending') }}">
                                        <button class="btn btn-sm btn-secondary text-white">See All</button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0">
                                        <thead>
                                            <tr>
                                                <th>Refill Date</th>
                                                <th>Ad Account Name</th>
                                                <th>Refill Amount ($)</th>
                                                <th>Payment Method</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($refills as $refill)
                                            @if($refill->status == 'pending')
                                            <tr>
                                                <td>{{ $refill->created_at->format('j F Y') }}</td>
                                                <td>{{ $refill->adAccount->ad_acc_name }}</td>
                                                <td>{{ $refill->amount_dollar }}</td>
                                                <td>{{ $refill->payment_method }}</td>

                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

    <script>
        var ctx = document.getElementById("pieChart");
        ctx.height = 450;
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [45, 25],
                    backgroundColor: [
                        "rgba(117, 113, 249,0.9)",
                        "rgba(117, 113, 249,0.7)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(117, 113, 249,0.9)",
                        "rgba(117, 113, 249,0.7)"
                    ]

                }],
                labels: [
                    "Ad Accounts",
                    "Refills",
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>

</html>