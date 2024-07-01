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
                        <div class="d-flex align-items-center custom-card">
                            <div class="w-100 p-3">
                                <ul>
                                    <li>
                                        <h6 class="text-white">Total Application: <span class="font-lg">{{ $allApplication }}</span></h6>
                                    </li>
                                    <li class="bg-transparent border-0">
                                        <h6 class="text-white">Pending Application: <span class="font-lg">{{ $pendingApplication }}</span></h6>
                                    </li>
                                    <li class="bg-transparent border-0">
                                        <h6 class="text-white">Total Ad Account: <span class="font-lg">{{ $allAdAccount }}</span></h6>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="d-flex align-items-center custom-card">
                            <div class=" w-100 p-3">
                                <ul>
                                    <li>
                                        <h6 class="text-white">Current Month Refill: <span class="font-lg">${{ $thisMonthRefill }}</span></h6>
                                    </li>
                                    <li>
                                        <h6 class="text-white">Last 7 Days Refill: <span class="font-lg">${{ $lastSevenDaysRefill }}</span></h6>
                                    </li>
                                    <li>
                                        <h6 class="text-white">Refill Request: <span class="font-lg">${{ $pendingRefillAmount }} ({{ $pendingRefillCount }})</span></h6>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="d-flex align-items-center custom-card">
                            <div class=" w-100 p-3">
                                <ul>
                                    <li>
                                        <h6 class="text-white">Current Month Deposit: <span class="font-lg">${{ $totalDeposit }}</span></h6>
                                    </li>
                                    <li>
                                        <h6 class="text-white">Current Month Average Rate: <span class="font-lg">৳{{ $averageRate }}</span></h6>
                                    </li>
                                    <li class="     
                                    ">
                                        <h6 class="text-white">Balance: <span class="font-lg"></span></h6>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="btn-group-vertical w-100">
                            <a href="#" class="btn btn-primary text-white my-2 py-2 rounded" data-toggle="modal" data-target="#refillModal">New Refill</a>
                            <a href="#" class="btn btn-success text-white mb-2 py-2 rounded" data-toggle="modal" data-target="#depositModal">Add Deposit</a>
                            <a href="{{ route('ad-account-application') }}" class="btn btn-secondary text-white py-2 rounded">New Application</a>

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
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title mr-4 mt-2">Pending Applications</h4>

                                    <a href="{{ route('pending-ad-account-application') }}">
                                        <button class="btn btn-sm btn-secondary text-white">See All</button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0 font-sm">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Ad Acc.</th>
                                                <th>BM Id</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($adAccounts as $adAccount)
                                            <tr>
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

                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title mr-4 mt-2">Pending Refills</h4>

                                    <a href="{{ route('refills.pending') }}">
                                        <button class="btn btn-sm btn-secondary text-white">See All</button>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0 font-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Ad Acc.</th>
                                                <th>Amount ($)</th>
                                                <th>Method</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pendingRefills as $pendingRefill)
                                            <tr>
                                                <td>{{ $pendingRefill->created_at->format('j F Y') }}</td>
                                                <td>
                                                    <span>{{ $pendingRefill->adAccount->ad_acc_name }}</span><br>
                                                    <span class="font-sm mt-1">{{ $pendingRefill->adAccount->ad_acc_id }}</span>
                                                </td>
                                                <td>{{ $pendingRefill->amount_dollar }}</td>
                                                <td>{{ $pendingRefill->payment_method }}</td>
                                                <td>
                                                    <span>
                                                        <form action="{{ route('refill.approve', $refill->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm bg-transparent" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa-solid fa-check"></i></button>
                                                        </form>
                                                        <form action="{{ route('refill.reject', $refill->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm bg-transparent" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa-solid fa-xmark"></i></button>
                                                        </form>

                                                    </span>
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
                    data: [{{$refilledAdAccount}}, {{$nonRefilledAdAccount}}],
                    backgroundColor: [
                        "rgba(117, 113, 249,0.9)",
                        "rgba(255, 82, 82, 1)"
                    ]

                }],
                labels: [
                    "Refilled",
                    "Non-refilled",
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>

</html>