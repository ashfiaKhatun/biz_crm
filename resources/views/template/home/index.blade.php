<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
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
                            <div class="basic-list-group w-100">
                                <ul class="list-group">
                                    <li class="list-group-item bg-transparent border-0 border-bottom">
                                        <h5 class="text-white">Total Application: <span class="font-lg">{{ $allApplication }}</span></h5>
                                    </li>
                                    <li class="list-group-item bg-transparent border-0 border-bottom">
                                        <h5 class="text-white">Pending Application: <span class="font-lg">{{ $pendingApplication }}</span></h5>
                                    </li>
                                    <li class="list-group-item bg-transparent border-0">
                                        <h5 class="text-white">Total Ad Account: <span class="font-lg">{{ $allAdAccount }}</span></h5>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center custom-card gradient-2">
                            <div class="basic-list-group w-100">
                                <ul class="list-group">
                                    <li class="list-group-item bg-transparent border-0 border-bottom">
                                        <h5 class="text-white">Current Month Refill: <span>{{ $thisMonthRefill }}</span></h5>
                                    </li>
                                    <li class="list-group-item bg-transparent border-0 border-bottom">
                                        <h5 class="text-white">Last 7 Days Refill: <span>{{ $lastSevenDaysRefill }}</span></h5>
                                    </li>
                                    <li class="list-group-item bg-transparent border-0">
                                        <h5 class="text-white">Refill Request: <span>{{ $pendingRefillAmount }} ({{ $pendingRefillCount }})</span></h5>
                                    </li>
                                </ul>



                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center custom-card gradient-3">
                            <div class="basic-list-group w-100">
                                <ul class="list-group">
                                    <li class="list-group-item bg-transparent border-0 border-bottom">
                                        <h5 class="text-white">Current Month Deposit: <span>${{ $totalDeposit }}</span></h5>
                                    </li>
                                    <li class="list-group-item bg-transparent border-0 border-bottom">
                                        <h5 class="text-white">Average Rate: <span>৳{{ $averageRate }}</span></h5>
                                    </li>
                                    <li class="list-group-item bg-transparent border-0
                                    ">
                                        <h5 class="text-white">Balance: <span></span></h5>
                                    </li>
                                </ul>



                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="btn-group-vertical w-100">
                            <a href="#" class="btn btn-primary text-white my-2 py-3 rounded" data-toggle="modal" data-target="#refillModal">New Refill</a>
                            <a href="{{ route('ad-account-application') }}" class="btn btn-secondary text-white mb-2 py-3 rounded">New Application</a>
                            <a href="#" class="btn btn-success text-white py-3 rounded" data-toggle="modal" data-target="#depositModal">Add Deposit</a>

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
                                {{$refilledAdAccount}}
                                {{$nonRefilledAdAccount}}
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
                                            @if ($refill->status == 'pending')
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




        <!-- Refill Modal -->
        <div class="modal fade" id="refillModal" tabindex="-1" role="dialog" aria-labelledby="refillModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="refillModalLabel">New Refill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('refill.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label class="col-form-label">Client Name:</label>
                                <select id="client-select" name="client_id" class="form-control rounded">
                                    <option>Select</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="col-form-label">Ad Account Name:</label>
                                <select id="ad-account-select" name="ad_account_id" class="form-control rounded">
                                    <option>Select</option>
                                </select>
                            </div>

                            <div>
                                <label class="col-form-label">Dollar Rate:</label>
                                <input id="dollar-rate-input" type="text" placeholder="Dollar Rate" class="form-control rounded" readonly>
                            </div>

                            <div>
                                <label class="col-form-label">Amount:</label><br>

                                <div class="d-flex justify-content-between">
                                    <div class="w-50 mr-2">
                                        <input id="taka-input" type="text" name="amount_taka" placeholder="Taka" class="form-control rounded">
                                    </div>
                                    <div class="w-50">
                                        <input id="dollar-input" type="text" name="amount_dollar" placeholder="Dollar" class="form-control rounded">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="col-form-label">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-control rounded">
                                    <option>Select</option>
                                    @foreach ($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->value }}" data-details="{{ $paymentMethod->details }}">{{ $paymentMethod->value }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="details" class="d-none">
                                <p class="col-form-label font-bold">Payment Method Details: </p>
                                <p id="payment_details"></p>
                            </div>

                            <div>
                                <label class="col-form-label">Transaction Id:</label>
                                <input type="text" name="transaction_id" placeholder="Transaction Id" class="form-control rounded">
                            </div>

                            <div class="mt-2">
                                <label class="col-form-label">Screenshot:</label>
                                <div class="custom-file">
                                    <input type="file" id="screenshot" name="screenshot" class="custom-file-input">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <input type="submit" name="submit" value="Refill" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Deposit Modal -->
        <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="depositModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="depositModalLabel">Add Deposit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('deposit.store') }}" method="POST">
                            @csrf
                            <div>
                                <label class="col-form-label">Vendor Name</label>
                                <select name="name" class="form-control rounded">
                                    <option>Select</option>
                                    @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->value }}">{{ $vendor->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="col-form-label">Amount (USD):</label>
                                <input type="number" step="0.01" name="amount_usd" placeholder="Amount (USD)" class="form-control rounded" required>
                            </div>

                            <div>
                                <label class="col-form-label">Rate (BDT):</label>
                                <input type="number" step="0.01" name="rate_bdt" placeholder="Rate (BDT)" class="form-control rounded" required>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <input type="submit" name="submit" value="Create Deposit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    @include('template.home.layouts.scripts')

    @include('template.home.custom_scripts.refill_application_script')

    <script>
        var ctx = document.getElementById("pieChart");
        ctx.height = 450;
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [{{ $refilledAdAccount }}, {{ $nonRefilledAdAccount }}],
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