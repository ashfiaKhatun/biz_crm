<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body">
    <div class="container my-5">
        <h2>Refill Application Details</h2>
        
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $refill->id }}</p>
                <p><strong>Client Name:</strong> {{ $refill->client->name }}</p>
                <p><strong>Ad Account Name:</strong> {{ $refill->adAccount->ad_acc_name }}</p>
                <p><strong>Amount (Taka):</strong> {{ $refill->amount_taka }}</p>
                <p><strong>Amount (Dollar):</strong> {{ $refill->amount_dollar }}</p>
                <p><strong>Payment Method:</strong> {{ $refill->payment_method }}</p>
                <p><strong>Transaction ID:</strong> {{ $refill->transaction_id }}</p>
                <p><strong>Status:</strong> {{ $refill->status }}</p>
                @if($refill->screenshot)
                    <p><strong>Screenshot:</strong></p>
                    <img src="{{ asset('storage/' . $refill->screenshot) }}" alt="Screenshot" class="img-fluid">
                @endif
            </div>
        </div>

        <a href="{{ route('refills.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>

@include('template.home.layouts.footer')

</body>

</html>
