<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')

    <style>
        .text-black {
            color: black;
        }

        .font-sm {
            font-size: 13px;
        }
    </style>
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container-fluid">

            <div class="row text-black">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="card-title mr-4 mt-2">Detailed refill information of
                                    {{ $refill->adAccount->ad_acc_name }}</h4>
                                    @if(auth()->user()->role == 'admin')
                                <a href="{{ route('refills.edit', $refill->id) }}">
                                    <button class="btn btn-sm btn-secondary text-white">Edit Info<i
                                            class="fa fa-pencil color-muted m-r-5 ml-2"></i></button>
                                </a>
                                @endif
                            </div>

                            <div class="row">
                                <b class="col-4">Amount (Taka):</b>
                                <p class="col-8">{{ $refill->amount_taka }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Amount (Dollar):</b>
                                <p class="col-8">{{ $refill->amount_dollar }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Payment Method:</b>
                                <p class="col-8">{{ $refill->payment_method }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Transaction ID:</b>
                                <p class="col-8">{{ $refill->transaction_id }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Status:</b>
                                @if (auth()->user()->role == 'admin')


                                    <form action="{{ route('refills.updateStatus', $refill->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select-sm" onchange="this.form.submit()">
                                            <option
                                                class="{{ $refill->status == 'approved' || $refill->status == 'rejected' ? 'd-none' : '' }}"
                                                value="pending" {{ $refill->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option class="{{ $refill->status == 'rejected' ? 'd-none' : '' }}"
                                                value="approved" {{ $refill->status == 'approved' ? 'selected' : '' }}>
                                                Approved</option>
                                            <option class="{{ $refill->status == 'approved' ? 'd-none' : '' }}"
                                                value="rejected" {{ $refill->status == 'rejected' ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>
                                    </form>
                                @elseif(auth()->user()->role == 'customer')
                                    @if ($refill->status == 'pending')
                                        <span class="badge custom-badge-info">Pending</span>
                                    @endif



                                    @if ($refill->status == 'approved')
                                        <span class="badge custom-badge-success">Approved</span>
                                    @endif

                                    @if ($refill->status == 'rejected')
                                        <span class="badge badge-danger px-3 py-1">Rejected</span>
                                    @endif
                                @endif
                            </div>

                            @if ($refill->screenshot)
                                <div class="row">
                                    <b class="col-4">Screenshot:</b><br>
                                </div>
                                <img src="{{ asset('storage/' . $refill->screenshot) }}" height="1050px" width="350px"
                                    alt="Screenshot" class="img-fluid">
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-5 font-sm">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Ad Account Information</h4>

                            <div class="row">
                                <b class="col-5">Client Name:</b>
                                <p class="col-7 fs-4">{{ $refill->client->name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Ad Account Name:</b>
                                <p class="col-7 fs-4">{{ $refill->adAccount->ad_acc_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Name:</b>
                                <p class="col-7 fs-4">{{ $refill->client->business_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">BM Id:</b>
                                <p class="col-7 fs-4">{{ $refill->adAccount->bm_id }}</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <a href="{{ route('refills.index') }}" class="btn btn-sm btn-secondary text-white mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')

</body>

</html>
