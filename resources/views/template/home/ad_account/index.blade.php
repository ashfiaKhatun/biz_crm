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
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title mr-4 mt-2">Ad Account Applications</h4>
                    @if (auth()->user()->role == 'customer')
                        <a href="{{ route('adaccount.adaccount', auth()->user()->id) }}">
                            <button class="btn btn-sm btn-secondary text-white">New Application<i
                                    class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                        </a>
                    @else
                    
                    <a href="{{ route('ad-account-application') }}">
                        <button class="btn btn-sm btn-secondary text-white">New Application<i
                                class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                    </a>
                    @endif
                </div>

                <!-- Search Field -->
                <div class="mb-3 w-25">
                    <input type="text" id="searchInput" class="form-control rounded" placeholder="Search...">
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                @if (auth()->user()->role == 'admin')
                                    <th>Client Name</th>
                                @endif

                                <th>Ad Account Name</th>
                                <th>Agency</th>
                                <th>Doller Rate</th>

                                <th></th>
                                @if (auth()->user()->role == 'admin')
                                    <th>Status</th>
                                @endif

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adAccounts as $adAccount)
                                <tr>
                                    <td>{{ $adAccount->created_at->format('j F Y') }}</td>
                                    @if (auth()->user()->role == 'admin')
                                        <td>{{ $adAccount->client->name }}</td>
                                    @endif

                                    <td>{{ $adAccount->ad_acc_name }}</td>
                                    <td>{{ $adAccount->agency->agency_name }}</td>
                                    <td>{{ $adAccount->dollar_rate }}৳</td>

                                    <td class="text-center">
                                        @if ($adAccount->status == 'pending')
                                            <span class="badge custom-badge-info">Pending</span>
                                        @endif

                                        @if ($adAccount->status == 'in-review')
                                            <span class="badge custom-badge-primary">In Review</span>
                                        @endif

                                        @if ($adAccount->status == 'approved')
                                            <span class="badge custom-badge-success">Approved</span>
                                        @endif

                                        @if ($adAccount->status == 'rejected')
                                            <span class="badge badge-danger px-3 py-1">Rejected</span>
                                        @endif

                                        @if ($adAccount->status == 'canceled')
                                            <span class="badge badge-warning px-3 py-1 text-white">Canceled</span>
                                        @endif

                                    </td>
                                    @if (auth()->user()->role == 'admin')
                                        <td>
                                            <form action="{{ route('ad-account.updateStatus', $adAccount->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select-sm custom-status"
                                                    style="width: 90px;" onchange="this.form.submit()">
                                                    <option value="pending"
                                                        {{ $adAccount->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="in-review"
                                                        {{ $adAccount->status == 'in-review' ? 'selected' : '' }}>In
                                                        Review
                                                    </option>
                                                    <option value="approved"
                                                        {{ $adAccount->status == 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="canceled"
                                                        {{ $adAccount->status == 'canceled' ? 'selected' : '' }}>
                                                        Canceled
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $adAccount->status == 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    @endif


                                    <td>
                                        <span class="d-flex align-items-center">
                                            <a href="{{ route('ad-account.show', $adAccount->id) }}"
                                                data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa fa-eye color-muted m-r-5"></i>
                                            </a>
                                            @if (auth()->user()->role == 'admin')
                                                <a href="{{ route('ad-account.edit', $adAccount->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                                </a>

                                                <div class="basic-dropdown ml-2">
                                                    <div class="dropdown">
                                                        <i class="fa-solid fa-ellipsis btn btn-sm"
                                                            data-toggle="dropdown"></i>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item">
                                                                <form
                                                                    action="{{ route('ad-account.destroy', $adAccount->id) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this Ad Account Application?')">Delete</button>
                                                                </form>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

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
