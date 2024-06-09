<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    <style>
        .font-sm{
            font-size: 12px;
        }
    </style>
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Refill Applications</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Ad Account Name</th>
                                <th>Dollar Rate</th>
                                <th>Amount (Dollar)</th>
                                <th>Amount (Taka)</th>
                                <th>Method</th>

                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refills as $refill)
                                <tr>
                                    <td>{{ $refill->created_at }}</td>
                                    <td>{{ $refill->adAccount->ad_acc_name }}</td>
                                    <td>{{ $refill->adAccount->dollar_rate }}</td>
                                    <td>{{ $refill->amount_dollar }}</td>
                                    <td>{{ $refill->amount_taka }}</td>

                                    <td>{{ $refill->payment_method }}</td>

                                    <td>
                                        <form action="{{ route('refills.updateStatus', $refill->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="pending"
                                                    {{ $refill->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="approved"
                                                    {{ $refill->status == 'approved' ? 'selected' : '' }}>Approved
                                                </option>
                                                <option value="rejected"
                                                    {{ $refill->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <span>
                                            <a href="{{ route('refills.show', $refill->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="View">
                                                <i class="fa fa-eye color-muted m-r-5"></i>
                                            </a>

                                            <a href="{{ route('refills.edit', $refill->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="Edit">
                                                <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                            </a>

                                            <form action="{{ route('refills.destroy', $refill->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-transparent ml-3"
                                                    onclick="return confirm('Are you sure you want to delete this refill application?')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-close color-danger"></i></button>
                                            </form>

                                            @if ($refill->sent_to_agency == 0)
                                            <form action="{{ route('refills.sendToAgency', $refill->id) }}" method="post" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="border-0 bg-transparent ml-1" onclick="return confirm('Are you sure you want to send this refill application to the agency?')" data-toggle="tooltip" data-placement="top" title="Send to Agency">
                                                    <i class="fa fa-send color-primary"></i>
                                                </button>
                                            </form>
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

</body>

</html>
