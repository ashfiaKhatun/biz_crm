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

            <div class="p-2">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mr-4 mt-2">Agency Report</h4>
    
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Agency</th>
                                            <th scope="col">Total Refill (tk)</th>
                                            <th scope="col">Dollar Refilled</th>
                                            <th scope="col">Income</th>
                                            <th scope="col">Margin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        
                        <div>
                            <h4 class="card-title mr-4 mt-2">Ad Account Report</h4>
    
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ad Account</th>
                                            <th scope="col">Total Refill (tk)</th>
                                            <th scope="col">Dollar Refilled</th>
                                            <th scope="col">Income</th>
                                            <th scope="col">Dollar Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($refills as $refill)
                                        <tr>
                                            <td>
                                                <span>{{ $refill->adAccount->ad_acc_name }}</span><br>
                                                <span class="font-sm mt-1">ID: {{ $refill->adAccount->ad_acc_id }}</span>
                                            </td>
                                            <td>{{ $refill->total_refill_taka }}</td>
                                            <td>{{ $refill->total_refill_dollar }}</td>
                                            <td>{{ $refill->refill_taka - $refill->refill_act_taka }}</td>
                                            <td>{{ $refill->adAccount->dollar_rate }}</td>
                                        </tr>
                                        @endforeach
    
                                    </tbody>
                                </table>
                            </div>

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