<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


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
                        <h4 class="card-title">All Agencies</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Agency Name</th>
                                        <th scope="col">Ad Account Type</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agencies as $agency)
                                    <tr>
                                        <td>{{ $agency->agency_name }}</td>

                                        <td>{{ ucfirst(str_replace('_', ' ', $agency->ad_account_type)) }}</td>

                                        <td>
                                            <span>
                                                <a href="{{ route('agency.details', $agency->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa fa-eye color-muted m-r-5"></i>
                                                </a>

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                                                </a>
                                                
                                                <form action="{{ route('agency.destroy', $agency->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent ml-3" onclick="return confirm('Are you sure you want to delete this agency?')"><i class="fa fa-close color-danger"></i></button>
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



</body>

</html>