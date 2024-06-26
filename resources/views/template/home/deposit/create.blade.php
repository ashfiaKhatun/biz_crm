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
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <h4 class="mb-3">Create Deposit</h4>
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
                    <input type="submit" name="submit" value="Create Deposit" class="btn btn-sm btn-primary">
                </div>
            </form>
        </div>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')

</body>

</html>