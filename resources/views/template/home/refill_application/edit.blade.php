<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="w-75 mx-auto my-5 p-5 border rounded bg-white shadow-lg">
            <h4 class="mb-3">Edit Refill Application</h4>

            <form action="{{ route('refills.update', $refill->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label class="col-form-label">Client Name:</label>
                    <select id="client-select" name="client_id" class="form-control rounded">
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $refill->client_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="col-form-label">Ad Account Name:</label>
                    <select id="ad-account-select" name="ad_account_id" class="form-control rounded">
                        @foreach ($adAccounts as $adAccount)
                        <option value="{{ $adAccount->id }}" {{ $refill->ad_account_id == $adAccount->id ? 'selected' : '' }}>{{ $adAccount->ad_acc_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="col-form-label">Dollar Rate:</label>
                    <input id="dollar-rate-input" type="text" placeholder="Dollar Rate" class="form-control rounded" readonly value="{{ $refill->adAccount->dollar_rate }}">
                </div>

                <div>
                    <label class="col-form-label">Amount:</label><br>

                    <div class="d-flex justify-content-between">
                        <div class="w-50 mr-2">
                            <input id="taka-input" type="text" name="amount_taka" placeholder="Taka" class="form-control rounded" value="{{ $refill->amount_taka }}">
                        </div>
                        <div class="w-50">
                            <input id="dollar-input" type="text" name="amount_dollar" placeholder="Dollar" class="form-control rounded" value="{{ $refill->amount_dollar }}">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="col-form-label">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="form-control rounded">
                        <option>{{ $refill->payment_method }}</option>
                        @foreach ($paymentMethods as $paymentMethod)
                        <option value="{{ $paymentMethod->value }}" data-details="{{ $paymentMethod->details }}">{{ $paymentMethod->value }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="details" class="d-none">
                    <p class="col-form-label font-bold">Payment Method Details: </p>
                    <p id="payment_details"></p>
                </div>

                <div>
                    <label class="col-form-label">Transaction Id:</label>
                    <input type="text" name="transaction_id" placeholder="Transaction Id" class="form-control rounded" value="{{ $refill->transaction_id }}">
                </div>

                <div>
                    <label class="col-form-label">Date</label>
                    <input type="date" name="new_date" class="form-control rounded w-25">
                </div>

                <div class="mt-2">
                    <label class="col-form-label">Screenshot:</label>
                    <div class="custom-file">
                        <input type="file" id="screenshot" name="screenshot" class="custom-file-input">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                    @if($refill->screenshot)
                    <img src="{{ asset('storage/' . $refill->screenshot) }}" alt="Screenshot" width="300" class="img-fluid mt-2">
                    @endif
                </div>

                <div>
                    <label class="col-form-label">Status</label>
                    <select name="status" class="form-select-sm rounded" style="width: 90px;">
                        <option value="pending" {{ $refill->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $refill->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $refill->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <input type="submit" name="submit" value="Update" class="btn btn-sm btn-primary">
                </div>
            </form>
        </div>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')
    @include('template.home.custom_scripts.refill_application_script')
</body>

</html>