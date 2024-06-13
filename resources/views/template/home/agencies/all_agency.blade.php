<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!-- navbar start -->
        @include('template.home.layouts.navbar')

        <!-- navbar end -->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('template.home.layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="p-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="card-title mr-4 mt-2">All Agencies</h4>
                            <a href="{{ route('add-agency') }}">
                                <button class="btn btn-sm btn-secondary text-white">New Agency<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                            </a>
                        </div>

                        <!-- Search Field -->
                        <div class="mb-3 w-25">
                            <input type="text" id="searchInput" class="form-control rounded" placeholder="Search...">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Agency Name</th>
                                        <th scope="col">Ad Account Type</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agencies as $agency)
                                    <tr>
                                        <td>{{ $agency->agency_name }}</td>

                                        <td>{{ $agency->ad_account_type }}</td>

                                        <td>
                                            <span class="d-flex align-items-center">
                                                <a href="{{ route('agency.details', $agency->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa fa-eye color-muted m-r-5"></i>
                                                </a>

                                                <a href="{{ route('agency.update', $agency->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                                </a>

                                                <div class="basic-dropdown ml-2">
                                                    <div class="dropdown">
                                                        <i class="fa-solid fa-ellipsis btn btn-sm" data-toggle="dropdown"></i>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item">
                                                                <form action="{{ route('agency.destroy', $agency->id) }}" method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Agency?')">Delete</button>
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


            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('template.home.layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->
    </div>


    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    @include('template.home.layouts.scripts')

    @include('template.home.custom_scripts.search_script')


</body>

</html>