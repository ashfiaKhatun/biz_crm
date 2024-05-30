<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

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
                <select name="payment_method" class="form-control rounded">
                    <option value="Bank" {{ $refill->payment_method == 'Bank' ? 'selected' : '' }}>Bank</option>
                    <option value="BKash" {{ $refill->payment_method == 'BKash' ? 'selected' : '' }}>BKash</option>
                    <option value="Nagad" {{ $refill->payment_method == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                </select>
            </div>

            <div>
                <label class="col-form-label">Transaction Id:</label>
                <input type="text" name="transaction_id" placeholder="Transaction Id" class="form-control rounded" value="{{ $refill->transaction_id }}">
            </div>

            <div class="mt-2">
                <label class="col-form-label">Screenshot:</label>
                <div class="custom-file">
                    <input type="file" name="screenshot" class="custom-file-input">
                    <label class="custom-file-label">Choose file</label>
                </div>
                @if($refill->screenshot)
                    <img src="{{ asset('storage/' . $refill->screenshot) }}" alt="Screenshot" class="img-fluid mt-2">
                @endif
            </div>

            <div>
                <label class="col-form-label">Status</label>
                <select name="status" class="form-control rounded">
                    <option value="pending" {{ $refill->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $refill->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $refill->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@include('template.home.layouts.footer')

@include('template.home.layouts.scripts')

@include('template.home.custom_scripts.refill_application_script')
</body>

</html>
