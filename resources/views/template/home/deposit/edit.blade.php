<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body">
    <div class="container my-5">
        <h2>Edit Deposit</h2>

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
                <label class="col-form-label">Amount (BDT):</label>
                <input type="number" step="0.01" name="amount_bdt" placeholder="Amount (BDT)" class="form-control rounded" value="{{ $deposit->amount_bdt }}" required>
            </div>

            <div>
                <label class="col-form-label">Status:</label>
                <select name="status" class="form-control rounded">
                    <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $deposit->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $deposit->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
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