<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
</head>

<body>
    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title mr-4 mt-2">Refill Applications</h4>

                    @if (auth()->user()->role == 'customer')
                        <a href="{{ route('refills.newRefill', auth()->user()->id) }}">
                            <button class="btn btn-sm btn-secondary text-white">New Refill<i
                                    class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                        </a>
                    @else
                        <a href="#" data-toggle="modal" data-target="#refillModal">
                            <button class="btn btn-sm btn-secondary text-white">New Refill<i
                                    class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                        </a>
                    @endif
                </div>

                <div class="row">
                    <!-- Date Range Filter -->
                    <div class="col-md-3 mb-3">
                        <input type="text" id="dateRange" class="form-control rounded" placeholder="Select Date Range">
                    </div>
                
                    <!-- Search Field -->
                    <div class="col-md-9 mb-3">
                        <input type="text" id="searchInput" class="form-control rounded" placeholder="Search...">
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                        <thead>
                            <tr>
                                <th>Date  Time</th>
                                <th>Ad Account Name</th>
                                <th>Dollar Rate</th>
                                <th>Amount (Dollar)</th>
                                <th>Amount (Taka)</th>
                                <th>Method</th>
                                <th>Responsible</th>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'employee')
                                    <th></th>
                                @endif
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @include('template.home.refill_application.load_more_data')
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- refill modal -->

            <div class="modal fade" id="refillModal" tabindex="-1" role="dialog" aria-labelledby="refillModalLabel"
                aria-hidden="true">
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
                                    <input id="dollar-rate-input" type="text" placeholder="Dollar Rate"
                                        class="form-control rounded" readonly>
                                </div>

                                <div>
                                    <label class="col-form-label">Amount:</label><br>

                                    <div class="d-flex justify-content-between">
                                        <div class="w-50 mr-2">
                                            <input id="taka-input" type="text" name="amount_taka" placeholder="Taka"
                                                class="form-control rounded">
                                        </div>
                                        <div class="w-50">
                                            <input id="dollar-input" type="text" name="amount_dollar"
                                                placeholder="Dollar" class="form-control rounded">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-form-label">Payment Method</label>
                                    <select id="payment_method" name="payment_method" class="form-control rounded">
                                        <option>Select</option>
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->value }}"
                                                data-details="{{ $paymentMethod->details }}">{{ $paymentMethod->value }}
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
                                    <input type="text" name="transaction_id" placeholder="Transaction Id"
                                        class="form-control rounded">
                                </div>

                                <div class="mt-2">
                                    <label class="col-form-label">Screenshot:</label>
                                    <div class="custom-file">
                                        <input type="file" id="screenshot" name="screenshot"
                                            class="custom-file-input">
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
        </div>

        @include('template.home.layouts.footer')
        @include('template.home.layouts.scripts')
        @include('template.home.custom_scripts.refill_application_script')
        @include('template.home.custom_scripts.search_script')
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <script>
            $(document).ready(function() {
                $('#dateRange').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });

                $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                    let startDate = picker.startDate.format('YYYY-MM-DD');
                    let endDate = picker.endDate.format('YYYY-MM-DD');
                    fetchRefillData(startDate, endDate);
                });

                function fetchRefillData(startDate, endDate) {
                    $.ajax({
                        url: "{{ route('refills.filter') }}",
                        type: "GET",
                        data: {
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function(data) {
                            $('#table-body').html(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Server error');
                        }
                    });
                }

                $(document).on('click', '.load-more', function() {
                    var page = $(this).data('page');
                    loadMoreData(page);
                });

                function loadMoreData(page) {
                    $.ajax({
                        url: "/refills?page=" + page,
                        type: "get",
                        beforeSend: function() {
                            $('.load-more').html('Loading...');
                        }
                    }).done(function(data) {
                        if (data.html == "") {
                            $('.load-more').html('No more records found');
                            return;
                        }
                        $('.load-more').remove();
                        $('#table-body').append(data);
                    }).fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('Server error');
                    });
                }
            });
        </script>

    </div>
</body>

</html>
