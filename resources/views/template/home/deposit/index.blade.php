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
                <h2 class="card-title">All Deposits</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <div class="mb-3">
                        @foreach ($averageRates as $rate)
                            <strong>{{ \Carbon\Carbon::create()->month($rate->month)->format('F') }}
                                ({{ $rate->year }}) avarage USD Rate {{ $rate->average_rate }}</strong>
                        @endforeach
                        <table class="table table-bordered">


                    </div>
                    <table class="table table-bordered table-striped verticle-middle">
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
                                                <option value="pending"
                                                    {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="received"
                                                    {{ $deposit->status == 'received' ? 'selected' : '' }}>Received
                                                </option>
                                                <option value="canceled"
                                                    {{ $deposit->status == 'canceled' ? 'selected' : '' }}>Canceled
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <span>
                                            <a href="{{ route('deposit.show', $deposit->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="View">
                                                <i class="fa fa-eye color-muted m-r-5"></i>
                                            </a>

                                            <a href="{{ route('deposit.edit', $deposit->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="Edit">
                                                <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                            </a>

                                            <form action="{{ route('deposit.destroy', $deposit->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-transparent ml-3"
                                                    onclick="return confirm('Are you sure you want to delete this deposit?')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-close color-danger"></i></button>
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
</div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')

</body>

</html>
