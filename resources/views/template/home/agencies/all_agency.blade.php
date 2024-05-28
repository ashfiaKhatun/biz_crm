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

            <div class=" p-5 ">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Agency Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Commission Type</th>
                            <th scope="col">Dollar Rate</th>
                            <th scope="col">Percentage Rate</th>
                            <th scope="col">Ad Account Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agencies as $agency)
                        <tr>
                            <td>{{ $agency->agency_name }}</td>
                            <td>{{ $agency->location }}</td>
                            <td>{{ $agency->commission_type }}</td>
                            <td>{{ $agency->dollar_rate }}</td>
                            <td>{{ $agency->percentage_rate }}</td>
                            <td>{{ $agency->ad_account_type }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>

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