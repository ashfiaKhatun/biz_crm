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
                        <h4 class="card-title mb-5">Details of {{ $agency->agency_name }}</h4>
                        <div class="row">
                            <h5 class="col-3">Location</h5>
                            <p class="col-9 fs-4">{{ $agency->location }}</p>
                        </div>
                        <div class="row">
                            <h5 class="col-3">Commission Type</h5>
                            <p class="col-9 fs-4">{{ $agency->commission_type }}</p>
                        </div>
                        <div class="row">
                            <h5 class="col-3">Dollar Rate</h5>
                            <p class="col-9 fs-4">{{ $agency->dollar_rate }}</p>
                        </div>
                        
                        <div class="row">
                            <h5 class="col-3">Percentage Rate</h5>
                            <p class="col-9 fs-4">{{ $agency->percentage_rate }}</p>
                        </div>
                        <div class="row">
                            <h5 class="col-3">Ad Account Type</h5>
                            <p class="col-9 fs-4">{{ $agency->ad_account_type }}</p>
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