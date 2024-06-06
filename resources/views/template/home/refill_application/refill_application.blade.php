<!DOCTYPE html>
<html lang="en">

<head>
@include('template.home.layouts.head')
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

            <div class="w-75 mx-auto my-5 p-5 border rounded bg-white shadow-lg">
                <h4 class="mb-3">Refill Ad Account Balance</h4>
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
                        <select name="payment_method" class="form-control rounded">
                            <option>Select</option>
                            <option value="Bank">Bank</option>
                            <option value="BKash">BKash</option>
                            <option value="Nagad">Nagad</option>
                        </select>
                    </div>

                    <div>
                        <label class="col-form-label">Transaction Id:</label>
                        <input type="text" name="transaction_id" placeholder="Transaction Id" class="form-control rounded">
                    </div>

                    <div class="mt-2">
                        <label class="col-form-label">Screenshot:</label>
                        <div class="custom-file">
                            <input type="file" name="screenshot" class="custom-file-input">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Refill" class="btn btn-primary">
                    </div>
                </form>
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

    
@include('template.home.custom_scripts.refill_application_script')
</body>

</html>
