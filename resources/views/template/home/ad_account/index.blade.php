<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container my-5">
            <h2>Ad Account Applications</h2>

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
                        <th>Agency</th>
                        <th>Doller Rate</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adAccounts as $adAccount)
                        <tr>
                            
                            <td>{{ $adAccount->client->name }}</td>
                            <td>{{ $adAccount->ad_acc_name }}</td>
                            <td>{{ $adAccount->agency->agency_name }}</td>
                            <td>{{ $adAccount->dollar_rate }}৳</td>
                            <td>
                                <form action="{{ route('ad-account.updateStatus', $adAccount->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="pending" {{ $adAccount->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $adAccount->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $adAccount->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('ad-account.show', $adAccount->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('ad-account.edit', $adAccount->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('ad-account.destroy', $adAccount->id) }}" method="post" style="display:inline-block;">
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
