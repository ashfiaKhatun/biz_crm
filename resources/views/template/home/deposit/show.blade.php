<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-5">
        <div class="card text-black">
            <div class="card-body">
                <div class="d-flex align-items-center mb-5">
                    <h4 class="card-title mr-4 mt-2">Deposit Details</h4>
                    <div>
                        <a href="{{ route('deposit.edit', $deposit->id) }}">
                            <button class="btn btn-sm btn-secondary text-white">Edit Info<i class="fa fa-pencil color-muted m-r-5 ml-2"></i></button>
                        </a>
                        </a>
                    </div>

                </div>

                <div>
                    <div class="row">
                        <b class="col-2">ID:</b>
                        <p class="col-10"> {{ $deposit->id }}</p>
                    </div>

                    <div class="row">
                        <b class="col-2">Name:</b>
                        <p class="col-10"> {{ $deposit->name }}</p>
                    </div>

                    <div class="row">
                        <b class="col-2">Amount (USD):</b>
                        <p class="col-10"> {{ $deposit->amount_usd }}</p>
                    </div>

                    <div class="row">
                        <b class="col-2">Rate (BDT):</b>
                        <p class="col-10"> {{ $deposit->rate_bdt }}</p>
                    </div>



                    <div class="row">
                        <b class="col-2">Status:</b>

                        @if ($deposit->status == 'pending')
                        <span class="badge custom-badge-info">Pending</span>
                        @endif

                        @if ($deposit->status == 'received')
                        <span class="badge custom-badge-success">Received</span>
                        @endif
                       
                        @if ($deposit->status == 'canceled')
                        <span class="badge badge-danger">Canceled</span>
                        @endif
                        
                    </div>

                </div>

            </div>
        </div>

        <a href="{{ route('deposits.index') }}" class="btn btn-sm btn-secondary text-white mt-3">Back</a>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')

</body>

</html>