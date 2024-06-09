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
                <h2 class="card-title">My Ad Accounts</h2>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle">
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
                                <td>{{ $adAccount->status}}</td>
                                <td>
                                    <span>
                                        <a href="{{ route('my-account.show', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-eye color-muted m-r-5  ml-3"></i>
                                        </a>
                                        
                                        <a href="{{ route('refill.refill', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="Refill">
                                        <i class="fa-solid fa-fill m-r-5 ml-2"></i>
                                        </a>


                                        {{-- <a href="{{ route('ad-account.edit', $adAccount->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                        </a>

                                        <form action="{{ route('ad-account.destroy', $adAccount->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent ml-3" onclick="return confirm('Are you sure you want to delete this agency?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></button>
                                        </form> --}}
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