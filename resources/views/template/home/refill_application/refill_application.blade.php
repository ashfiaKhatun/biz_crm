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

            <div class="w-75 mx-auto my-5 p-5 border rounded bg-white shadow-lg">
                <h4 class="mb-3">Refill Ad Account Balance</h4>
                <form class="space-y-2">
                    @csrf
                    <div>
                        <label class="col-form-label">Ad Account Name:</label>
                        <select class="form-control rounded">
                            <option>Select</option>
                            <option>Account 1</option>
                            <option>Account 2</option>

                        </select>
                    </div>
                    <div>
                        <label class="col-form-label">Amount:</label><br>

                        <div class="d-flex justify-content-between">
                            <div class="w-50 mr-2">
                                <input id="taka-input" type="text" placeholder="Taka" class="form-control rounded">

                            </div>
                            <div class="w-50">
                                <input id="dollar-input" type="text" placeholder="Dollar" class="form-control rounded">

                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="col-form-label">Payment Method</label>
                        <select class="form-control rounded">
                            <option>Select</option>
                            <option>Bank</option>
                            <option>BKash</option>
                            <option>Nagad</option>

                        </select>
                    </div>

                    <div>
                        <label class="col-form-label">Transaction Id:</label>
                        <input type="text" placeholder="Transaction Id" class="form-control rounded">
                    </div>

                    <div class="mt-2">

                        <label class="col-form-label">Screenshot:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input ">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>

                    <!-- <div>
                        <label class="col-form-label">Screenshot:</label>
                        <input type="file" class="form-control rounded">
                    </div> -->

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Refill" class="btn btn-primary">
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
    
    @include('template.home.custom_scripts.refill_application_script')

</body>

</html>