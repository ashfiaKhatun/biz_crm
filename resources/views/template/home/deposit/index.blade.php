<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">All Deposits</h2>

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

                                            <th>Name</th>
                                            <th>Amount (USD)</th>
                                            <th>Rate (BDT)</th>

                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposits as $deposit)
                                        <tr>

                                            <td>{{ $deposit->name }}</td>
                                            <td>{{ $deposit->amount_usd }}</td>
                                            <td>{{ $deposit->rate_bdt }}</td>

                                            <td>
                                                <form action="{{ route('deposit.updateStatus', $deposit->id) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                                        <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="received" {{ $deposit->status == 'received' ? 'selected' : '' }}>Received
                                                        </option>
                                                        <option value="canceled" {{ $deposit->status == 'canceled' ? 'selected' : '' }}>Canceled
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <span>
                                                    <a href="{{ route('deposit.show', $deposit->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="fa fa-eye color-muted m-r-5"></i>
                                                    </a>

                                                    <a href="{{ route('deposit.edit', $deposit->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                                    </a>

                                                    <form action="{{ route('deposit.destroy', $deposit->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-transparent ml-3" onclick="return confirm('Are you sure you want to delete this deposit?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></button>
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

                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Last three months average USD rate</h5>
                            @foreach ($averageRates as $rate)
                            <div class="row">
                                <b class="col-5">{{ \Carbon\Carbon::create()->month($rate->month)->format('F') }}
                                    ({{ $rate->year }})</b>
                                <p class="col-7"> {{ $rate->average_rate }}</p>

                            </div>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')
    @include('template.home.custom_scripts.search_script')

</body>

</html>