<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body">
    <div class="container my-5">
        <h2>Deposit Details</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $deposit->id }}</p>
                <p><strong>Name:</strong> {{ $deposit->name }}</p>
                <p><strong>Amount (USD):</strong> {{ $deposit->amount_usd }}</p>
                <p><strong>Rate (BDT):</strong> {{ $deposit->rate_bdt }}</p>
                <p><strong>Amount (BDT):</strong> {{ $deposit->amount_bdt }}</p>
                <p><strong>Status:</strong> {{ $deposit->status }}</p>
            </div>
        </div>

        <a href="{{ route('deposits.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>

@include('template.home.layouts.footer')
@include('template.home.layouts.scripts')

</body>

</html>
