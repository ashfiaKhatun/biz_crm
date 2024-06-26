<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="card">
            <div class="card-body">
                @if (auth()->user()->role == 'admin')
                <h2 class="card-title">All Ad Accounts</h2>
                @elseif (auth()->user()->role == 'customer')
                <h2 class="card-title">My Ad Accounts</h2>
                @endif

                <!-- Search Field -->
                <div class="mb-3 w-25">
                    <input type="text" id="searchInput" class="form-control rounded" placeholder="Search...">
                </div>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                        <thead>
                            <tr>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'employee')
                                <th>Client Name</th>
                                @endif

                                <th>Ad Account Name</th>
                                <th>Agency</th>
                                <th>Doller Rate</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adAccounts as $adAccount)
                            <tr>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'employee')
                                <td>{{ $adAccount->client->name }}</td>
                                @endif
                                <td>
                                    <span>{{ $adAccount->ad_acc_name }}</span><br>
                                    <span class="font-sm mt-1">ID: {{ $adAccount->ad_acc_id }}</span>
                                </td>
                                <td>{{ $adAccount->agency->agency_name }}</td>
                                <td>{{ $adAccount->dollar_rate }}৳</td>
                                <td>
                                    @if ($adAccount->status == 'pending')
                                    <span class="badge badge-primary">Pending</span>
                                    @endif

                                    @if ($adAccount->status == 'in-review')
                                    <span class="badge badge-info">In Review</span>
                                    @endif

                                    @if ($adAccount->status == 'approved')
                                    <span class="badge custom-badge-success">Approved</span>
                                    @endif

                                    @if ($adAccount->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif

                                    @if ($adAccount->status == 'canceled')
                                    <span class="badge badge-warning">Canceled</span>
                                    @endif

                                </td>
                                <td>
                                    <span>
                                        <a href="{{ route('my-account.show', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-eye color-muted m-r-5  ml-3"></i>
                                        </a>

                                        <a href="{{ route('refill.refill', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="Refill">
                                            <i class="fa-solid fa-bolt m-r-5 ml-2"></i>
                                        </a>



                                    </span>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')

    @include('template.home.custom_scripts.search_script')

</body>

</html>