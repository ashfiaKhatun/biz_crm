<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
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

            <div class="w-75 mx-auto my-5 p-5 border rounded bg-white shadow-lg">
                <h4 class="mb-3">Add New Daily Calculation</h4>
                <form method="post" action="{{ route('dailyReport.store') }}" class="space-y-2">
                    @csrf

                    @foreach($adAccounts as $adAccount)
                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-4">
                            <b>{{ $adAccount->ad_acc_name }}</b><br>
                            <span>ID: {{ $adAccount->ad_acc_id }}</span>
                        </div>

                        <div class="col-4">
                            <input name="running_balance[]" type="number" placeholder="Running Balance" class="form-control rounded">
                        </div>
    
                        <div class="col-4">
                            <input name="remaining_balance[]" type="number" placeholder="Remaining Balance" class="form-control rounded">
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Save" class="btn btn-sm btn-primary">
                    </div>
                </form>
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