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
        <div class="container-fluid">

            <div class="row text-black">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="card-title mr-4 mt-2">Details of {{ $adAccount->ad_acc_name }}</h4>
                                </a>
                                @if (auth()->user()->role == 'admin')
                                    <div>
                                        <a href="{{ route('ad-account.edit', $adAccount->id) }}">
                                            <button class="btn btn-sm btn-secondary text-white">Edit Info<i
                                                    class="fa fa-pencil color-muted m-r-5 ml-2"></i></button>
                                        </a>
                                    </div>
                                @endif


                            </div>

                            <div class="row">
                                <b class="col-4">Ad Account Name:</b>
                                <p class="col-8 ">{{ $adAccount->ad_acc_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Business Manager ID:</b>
                                <p class="col-8 ">{{ $adAccount->bm_id }}</p>
                            </div>

                            @if (isset($adAccount->fb_link1) && $adAccount->fb_link1 !== '')
                                <div class="row">
                                    <b class="col-4">Facebook Link 1:</b>
                                    <p class="col-8 ">{{ $adAccount->fb_link1 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->fb_link2) && $adAccount->fb_link2 !== '')
                                <div class="row">
                                    <b class="col-4">Facebook Link 2:</b>
                                    <p class="col-8 ">{{ $adAccount->fb_link2 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->fb_link3) && $adAccount->fb_link3 !== '')
                                <div class="row">
                                    <b class="col-4">Facebook Link 3:</b>
                                    <p class="col-8 ">{{ $adAccount->fb_link3 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->fb_link4) && $adAccount->fb_link4 !== '')
                                <div class="row">
                                    <b class="col-4">Facebook Link 4:</b>
                                    <p class="col-8 ">{{ $adAccount->fb_link4 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->fb_link5) && $adAccount->fb_link5 !== '')
                                <div class="row">
                                    <b class="col-4">Facebook Link 5:</b>
                                    <p class="col-8 ">{{ $adAccount->fb_link5 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->domain1) && $adAccount->domain1 !== '')
                                <div class="row">
                                    <b class="col-4">Domain 1:</b>
                                    <p class="col-8 ">{{ $adAccount->domain1 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->domain2) && $adAccount->domain2 !== '')
                                <div class="row">
                                    <b class="col-4">Domain 2:</b>
                                    <p class="col-8 ">{{ $adAccount->domain2 }}</p>
                                </div>
                            @endif

                            @if (isset($adAccount->domain3) && $adAccount->domain3 !== '')
                                <div class="row">
                                    <b class="col-4">Domain 3:</b>
                                    <p class="col-8 ">{{ $adAccount->domain3 }}</p>
                                </div>
                            @endif

                            <div class="row">
                                <b class="col-4">Agency:</b>
                                <p class="col-8 ">{{ $adAccount->agency->agency_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Ad Account Type:</b>
                                <p class="col-8 ">{{ $adAccount->ad_acc_type }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Dollar Rate:</b>
                                <p class="col-8 ">{{ $adAccount->dollar_rate }}</p>
                            </div>

                            <div class="row">
                                <strong class="col-4">Total Refill Amount:</strong>
                                <p class="col-8">${{ $totalAmountUsd }}</p>
                            </div>
                            @if (auth()->user()->role == 'admin')
                                <div class="row">
                                    <b class="col-4">Status:</b>
                                    <form action="{{ route('ad-account.updateStatus', $adAccount->id) }}"
                                        method="post">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select-sm rounded"
                                            onchange="this.form.submit()">
                                            <option
                                                class="{{ $adAccount->status == 'in-review' || $adAccount->status == 'canceled' || $adAccount->status == 'approved' || $adAccount->status == 'rejected' ? 'd-none' : '' }}"
                                                value="pending"
                                                {{ $adAccount->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option
                                                class="{{ $adAccount->status == 'approved' || $adAccount->status == 'rejected' || $adAccount->status == 'canceled' ? 'd-none' : '' }}"
                                                value="in-review"
                                                {{ $adAccount->status == 'in-review' ? 'selected' : '' }}>In Review
                                            </option>
                                            <option
                                                class="{{ $adAccount->status == 'canceled' || $adAccount->status == 'rejected' ? 'd-none' : '' }}"
                                                value="approved"
                                                {{ $adAccount->status == 'approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>
                                            <option
                                                class="{{ $adAccount->status == 'approved' || $adAccount->status == 'rejected' ? 'd-none' : '' }}"
                                                value="canceled"
                                                {{ $adAccount->status == 'canceled' ? 'selected' : '' }}>
                                                Canceled
                                            </option>
                                            <option
                                                class="{{ $adAccount->status == 'approved' || $adAccount->status == 'canceled' ? 'd-none' : '' }}"
                                                value="rejected"
                                                {{ $adAccount->status == 'rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-body font-sm">

                            <h4 class="card-title mb-5">Clients' Information</h4>
                            <div class="row">
                                <b class="col-5">Client Name:</b>
                                <p class="col-7">{{ $adAccount->client->name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Phone Number:</b>
                                <p class="col-7">{{ $adAccount->client->phone }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Email:</b>
                                <p class="col-7">{{ $adAccount->client->email }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Type:</b>
                                <p class="col-7">{{ $adAccount->client->business_type }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Name:</b>
                                <p class="col-7">{{ $adAccount->client->business_name }}</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <a href="{{ route('ad-account.index') }}" class="btn btn-sm btn-secondary text-white mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')

</body>

</html>
