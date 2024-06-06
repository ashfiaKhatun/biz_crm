<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

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
        <div class="content-body p-4">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h4 class="card-title mb-5">Details of {{ $agency->agency_name }}</h4>
                        <a href="{{ route('agency.update', $agency->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil color-muted m-r-5 ml-3"></i>
                        </a>

                    </div>
                    <div class="row">
                        <b class="col-3">Location</b>
                        <p class="col-9 fs-4">{{ $agency->location }}</p>
                    </div>

                    <div class="row">
                        <b class="col-3">Commission Type</b>
                        <p class="col-9 fs-4">{{ucfirst($agency->commission_type) }}</p>
                    </div>

                    @if($agency->dollar_rate)
                    <div class="row">
                        <b class="col-3">Dollar Rate</b>
                        <p class="col-9 fs-4">{{ $agency->dollar_rate }}</p>
                    </div>
                    @endif

                    @if ($agency->percentage_rate )
                    <div class="row">
                        <b class="col-3">Percentage Rate</b>
                        <p class="col-9 fs-4">{{ $agency->percentage_rate }}</p>
                    </div>
                    @endif

                    <div class="row">
                        <b class="col-3">Ad Account Type</b>
                        <p class="col-9 fs-4">{{ ucfirst(str_replace('_', ' ', $agency->ad_account_type)) }}</p>
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