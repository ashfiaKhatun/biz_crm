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
                <h4 class="mb-3">Add New Ad Account Agency</h4>
                <form method="post" action="{{ route('agency.store') }}" class="space-y-2">
                    @csrf
                    <div>
                        <label class="col-form-label">Agency Name:</label>
                        <input name="agency_name" type="text" placeholder="Agency Name" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Location:</label>
                        <input name="location" type="text" placeholder="Location" class="form-control rounded">
                    </div>

                    <div class="form-check my-3">
                        <label class="form-check-label">
                            <input type="checkbox" name="own_commission_type" class="form-check-input" id="own-account-checkbox" value="Own Account">Own Account</label>
                    </div>

                    <div id="commission-type-sect">
                        <label class="col-form-label">Commission Type:</label>
                        <select name="commission_type" id="commission_type" class="form-control rounded">
                            <option value="">Select</option>
                            <option value="Dollar Rate">Dollar Rate</option>
                            <option value="Percentage">Percentage</option>
                        </select>
                    </div>

                    <div id="dollar_rate" class="d-none">
                        <label class="col-form-label">Dollar Rate:</label>
                        <input id="dollar_input" name="dollar_rate" type="text" placeholder="Dollar Rate" class="form-control rounded">
                    </div>

                    <div id="percentage_rate" class="d-none">
                        <label class="col-form-label">Percentage Rate:</label>
                        <input id="percentage_input" name="percentage_rate" type="text" placeholder="Percentage Rate" class="form-control rounded">
                    </div>

                    <div>
                        <label class="col-form-label">Ad Account Type:</label>
                        <select name="ad_account_type" class="form-control rounded">
                            <option>Select</option>
                            <option value="Credit Line">Credit Line</option>
                            <option value="Card Line">Card Line</option>
                            <option value="Both">Both</option>

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

    @include('template.home.custom_scripts.add_agency_script')

</body>

</html>