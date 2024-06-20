<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="w-75 mx-auto my-5 p-5 border rounded bg-white shadow-lg">
            <h4 class="mb-3">Edit Deposit</h4>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('deposit.update', $deposit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label class="col-form-label">Name:</label>
                    <input type="text" name="name" placeholder="Name" class="form-control rounded" value="{{ $deposit->name }}" required>
                </div>

                <div>
                    <label class="col-form-label">Amount (USD):</label>
                    <input type="number" step="0.01" name="amount_usd" placeholder="Amount (USD)" class="form-control rounded" value="{{ $deposit->amount_usd }}" required>
                </div>

                <div>
                    <label class="col-form-label">Rate (BDT):</label>
                    <input type="number" step="0.01" name="rate_bdt" placeholder="Rate (BDT)" class="form-control rounded" value="{{ $deposit->rate_bdt }}" required>
                </div>

                <div>
                    <label class="col-form-label">Date</label>
                    <input type="date" name="new_date" class="form-control rounded w-25">
                </div>



                <div>
                    <label class="col-form-label">Status:</label>
                    <select name="status" class="form-select-sm rounded" style="width: 90px;">
                        <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="received" {{ $deposit->status == 'received' ? 'selected' : '' }}>Received</option>
                        <option value="canceled" {{ $deposit->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <input type="submit" name="submit" value="Update Deposit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')

</body>

</html>