<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title mr-4 mt-2">Ad Account Applications</h4>
                    <a href="{{ route('ad-account-application') }}">
                        <button class="btn btn-secondary">New Application<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                    </a>
                </div>

                <!-- <h2 class="card-title">Ad Account Applications</h2> -->

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
                                <th>Client Name</th>
                                <th>Ad Account Name</th>
                                <th>Agency</th>
                                <th>Doller Rate</th>

                                <th></th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adAccounts as $adAccount)
                            <tr>
                                <td>{{ $adAccount->created_at->format('j F Y') }}</td>
                                <td>{{ $adAccount->client->name }}</td>
                                <td>{{ $adAccount->ad_acc_name }}</td>
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
                                    <span class="badge badge-success">Approved</span>
                                    @endif

                                    @if ($adAccount->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif

                                    @if ($adAccount->status == 'canceled')
                                    <span class="badge badge-warning">Canceled</span>
                                    @endif

                                </td>
                                <td>
                                    <form action="{{ route('ad-account.updateStatus', $adAccount->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-control rounded" style="width: 120px;" onchange="this.form.submit()">
                                            <option value="pending" {{ $adAccount->status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="in-review" {{ $adAccount->status == 'in-review' ? 'selected' : '' }}>In Review
                                            </option>
                                            <option value="approved" {{ $adAccount->status == 'approved' ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="canceled" {{ $adAccount->status == 'canceled' ? 'selected' : '' }}>Canceled
                                            </option>
                                            <option value="rejected" {{ $adAccount->status == 'rejected' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
                                    </form>
                                </td>

                                <td>
                                    <span>
                                        <a href="{{ route('ad-account.show', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-eye color-muted m-r-5"></i>
                                        </a>

                                        <a href="{{ route('ad-account.edit', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                        </a>

                                        <form action="{{ route('ad-account.destroy', $adAccount->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent ml-3" onclick="return confirm('Are you sure you want to delete this agency?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></button>
                                        </form>
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