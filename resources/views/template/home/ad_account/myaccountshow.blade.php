<!DOCTYPE html>
<html lang="en">

<head>
@include('template.home.layouts.head')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h4 class="card-title mb-5">Details of {{ $adAccount->ad_acc_name }}</h4>
                        
                    </div>

                    <div class="row">
                        <strong class="col-3">Client Name:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->client->name }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Ad Account Name:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->ad_acc_name }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Business Manager ID:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->bm_id }}</p>
                    </div>

                    @if(isset($adAccount->fb_link1) && $adAccount->fb_link1 !== '')
                    <div class="row">
                        <strong class="col-3">Facebook Link 1:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->fb_link1 }}</p>
                    </div>
                    @endif

                    @if(isset($adAccount->fb_link2) && $adAccount->fb_link2 !== '')
                    <div class="row">
                        <strong class="col-3">Facebook Link 2:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->fb_link2 }}</p>
                    </div>
                    @endif

                    @if(isset($adAccount->fb_link3) && $adAccount->fb_link3 !== '')
                    <div class="row">
                        <strong class="col-3">Facebook Link 3:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->fb_link3 }}</p>
                    </div>
                    @endif

                    @if(isset($adAccount->fb_link4) && $adAccount->fb_link4 !== '')
                    <div class="row">
                        <strong class="col-3">Facebook Link 4:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->fb_link4 }}</p>
                    </div>
                    @endif

                    @if(isset($adAccount->fb_link5) && $adAccount->fb_link5 !== '')
                    <div class="row">
                        <strong class="col-3">Facebook Link 5:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->fb_link5 }}</p>
                    </div>
                    @endif
                    
                    @if(isset($adAccount->domain1) && $adAccount->domain1 !== '')
                    <div class="row">
                        <strong class="col-3">Domain 1:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->domain1 }}</p>
                    </div>
                    @endif

                    @if(isset($adAccount->domain2) && $adAccount->domain2 !== '')
                    <div class="row">
                        <strong class="col-3">Domain 2:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->domain2 }}</p>
                    </div>
                    @endif

                    @if(isset($adAccount->domain3) && $adAccount->domain3 !== '')
                    <div class="row">
                        <strong class="col-3">Domain 3:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->domain3 }}</p>
                    </div>
                    @endif
                  
                    <div class="row">
                        <strong class="col-3">Agency:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->agency->agency_name }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Ad Account Type:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->ad_acc_type }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Dollar Rate:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->dollar_rate }}</p>
                    </div>
                    <div class="row">
                        <strong class="col-3">Status:</strong>
                        <p class="col-9 fs-4">{{ $adAccount->status }}</p>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <h2 class="card-title">Refills History</h2>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount (Taka)</th>
                                <th>Amount (USD)</th>
                                <th>Payment Method</th>
                                <th>Status</th>                  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($refills as $Refill)
                            <tr>
                                <td>{{ $Refill->created_at }}</td>
                                <td>{{ $Refill->amount_taka }}</td>
                                <td>{{ $Refill->amount_dollar }}</td>
                                <td>{{ $Refill->payment_method }}</td>
                                <td>{{ $Refill->status }}</td>                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <a href="{{ route('my-account.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')

</body>

</html>