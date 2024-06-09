<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    <style>
        .font-sm {
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
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="card-title mr-4 mt-2">All CLients</h4>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-secondary">Add New Client<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                    </a>
                </div>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped verticle-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Business Name</th>
                                <th>Phone</th>
                                <th>Email</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->business_name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>


                                <td>
                                    <span>
                                        <a href="" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-eye color-muted m-r-5"></i>
                                        </a>

                                        <a href="" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                        </a>

                                        <form action="" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent ml-3" onclick="return confirm('Are you sure you want to delete this refill application?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i></button>
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

</body>

</html>