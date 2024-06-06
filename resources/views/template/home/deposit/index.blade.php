<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body">
    <div class="container my-5">
        <h2>All Deposits</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Amount (USD)</th>
                    <th>Rate (BDT)</th>
                    
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deposits as $deposit)
                    <tr>
                        <td>{{ $deposit->id }}</td>
                        <td>{{ $deposit->name }}</td>
                        <td>{{ $deposit->amount_usd }}</td>
                        <td>{{ $deposit->rate_bdt }}</td>
                        
                        <td>
                            <form action="{{ route('deposit.updateStatus', $deposit->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="received" {{ $deposit->status == 'received' ? 'selected' : '' }}>Received</option>
                                    <option value="canceled" {{ $deposit->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('deposit.show', $deposit->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('deposit.edit', $deposit->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('deposit.destroy', $deposit->id) }}" method="post" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this deposit?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('template.home.layouts.footer')
@include('template.home.layouts.scripts')

</body>

</html>
