<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body">
    <div class="container my-5">
        <h2>Refill Applications</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    
                    <th>Client Name</th>
                    <th>Ad Account Name</th>
                    <th>Amount (Taka)</th>
                    
                    <th>Payment Method</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($refills as $refill)
                    <tr>
                        
                        <td>{{ $refill->client->name }}</td>
                        <td>{{ $refill->adAccount->ad_acc_name }}</td>
                        <td>{{ $refill->amount_taka }}</td>
                        
                        <td>{{ $refill->payment_method }}</td>
                        <td>{{ $refill->transaction_id }}</td>
                        <td>
                            <form action="{{ route('refills.updateStatus', $refill->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $refill->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $refill->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $refill->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('refills.show', $refill->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('refills.edit', $refill->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('refills.destroy', $refill->id) }}" method="post" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this application?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('template.home.layouts.footer')

</body>

</html>
