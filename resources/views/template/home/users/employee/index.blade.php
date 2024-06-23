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
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title mr-4 mt-2">All Employees</h4>
                    <a href="{{ route('register.employee') }}">
                        <button class="btn btn-sm btn-secondary text-white">Add New Employee<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                    </a>
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

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>


                                <td>
                                    <span class="d-flex align-items-center">
                                        <a href="{{ route('employee.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                        </a>

                                        <div class="basic-dropdown ml-2">
                                            <div class="dropdown">
                                                <i class="fa-solid fa-ellipsis btn btn-sm" data-toggle="dropdown"></i>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item">
                                                        <form action="{{ route('employee.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Employee?')">Delete</button>
                                                        </form>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
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