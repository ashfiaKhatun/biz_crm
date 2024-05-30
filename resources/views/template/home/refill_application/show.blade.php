<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-5">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h4 class="card-title mb-5">Details of {{ $refill->adAccount->ad_acc_name }}</h4>
                        <a href="{{ route('refills.edit', $refill->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                        </a>

                    </div>

                    <div class="row">
                        <strong class="col-3">ID:</strong>
                        <p class="col-9 fs-4">{{ $refill->id }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Client Name:</strong>
                        <p class="col-9 fs-4">{{ $refill->client->name }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Ad Account Name:</strong>
                        <p class="col-9 fs-4">{{ $refill->adAccount->ad_acc_name }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Amount (Taka):</strong>
                        <p class="col-9 fs-4">{{ $refill->amount_taka }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Amount (Dollar):</strong>
                        <p class="col-9 fs-4">{{ $refill->amount_dollar }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Payment Method:</strong>
                        <p class="col-9 fs-4">{{ $refill->payment_method }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Transaction ID:</strong>
                        <p class="col-9 fs-4">{{ $refill->transaction_id }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Status:</strong>
                        <p class="col-9 fs-4">{{ $refill->status }}</p>
                    </div>
                    
                    @if($refill->screenshot)
                    <div class="row">
                        <strong class="col-3">Screenshot:</strong>
                        <img src="{{ asset('storage/' . $refill->screenshot) }}" alt="Screenshot" class="img-fluid">
                    </div>
                    @endif
                    
                </div>
            </div>

            <a href="{{ route('refills.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')

</body>

</html>