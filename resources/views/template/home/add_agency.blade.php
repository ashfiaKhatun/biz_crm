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
            <h4 class="mb-3">Add New Ad Account Agency</h4>
                <form class="space-y-2">
                    <div>
                        <label class="col-form-label">Agency Name:</label>
                        <input type="text" placeholder="Agency Name" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Location:</label>
                        <input type="text" placeholder="Location" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Commission Type:</label>
                        <select class="form-control rounded">
                            <option>Select</option>
                            <option>Dollar Rate</option>
                            <option>Percentage</option>

                        </select>
                    </div>

                    <div>
                        <label class="col-form-label">Ad Account Type:</label>
                        <select class="form-control rounded">
                            <option>Select</option>
                            <option>Credit Line</option>
                            <option>Card Line</option>
                            <option>Both</option>

                        </select>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Add Agency" class="btn btn-primary">
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