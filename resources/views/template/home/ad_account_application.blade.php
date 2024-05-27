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
                <form method="post" action="" class="space-y-2">
                    @csrf
                    <div>
                        <label class="col-form-label">Client Name:</label>
                        <select name="client_name" class="form-control rounded">
                            <option>Select</option>
                            <option value="Client 1">Client 1</option>
                            <option value="Client 2">Client 2</option>

                        </select>
                    </div>

                    <div>
                        <label class="col-form-label">Ad Account Name:</label>
                        <input type="text" name="ad_acc_name" placeholder="Ad Account Name" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Business Manager Id:</label>
                        <input type="text" name="bm_id" placeholder="Business Manager Id" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Facebook Page Link:</label>
                        <input type="text" name="fb_link" placeholder="Facebook Page Link" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Domain:</label>
                        <input type="text" name="domain" placeholder="Domain" class="form-control rounded">
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="w-50 mr-2">
                            <label class="col-form-label">Select Agency:</label>
                            <select name="agency" class="form-control rounded">
                                <option>Select</option>
                                <option value="Agency 1">Agency 1</option>
                                <option value="Agency 2">Agency 2</option>
                                <option value="Agency 3">Agency 3</option>

                            </select>
                        </div>

                        <div class="w-50">
                            <label class="col-form-label">Ad Account Type:</label>
                            <input type="text" name="ad_acc_type" class="form-control rounded">
                        </div>


                    </div>

                    <div>
                        <label class="col-form-label">Dollar Rate:</label>
                        <input type="text" name="dollar_rate" placeholder="Dollar Rate" class="form-control rounded">
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Apply" class="btn btn-primary">
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