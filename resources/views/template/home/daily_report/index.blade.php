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
                            <h4 class="card-title mr-4 mt-2">Daily Calculation</h4>
                            <a href="{{ route('dailyReport.create') }}">
                                <button class="btn btn-sm btn-secondary text-white">Add New<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                            </a>
                        </div>

                        <!-- Search Field -->
                        <div class="mb-3 w-25">
                            <input type="text" id="searchInput" class="form-control rounded" placeholder="Search...">
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date  Time</th>
                                        <th scope="col">Running Balance</th>
                                        <th scope="col">Remaining Balance</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dailyReports as $dailyReport)
                                    <tr>
                                        <td>{{ $dailyReport->created_at->format('j F Y  g:i a') }}</td>
                                        <td>{{ $dailyReport->running_balance }}</td>
                                        <td>{{ $dailyReport->remaining_balance }}</td>
                                        <td>{{ $dailyReport->total_balance }}</td>
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