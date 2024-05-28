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

                    <div>
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
                            <option value="credit_line">Credit Line</option>
                            <option value="card_line">Card Line</option>
                            <option value="both">Both</option>

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

    <script>
        const dollar = document.getElementById('dollar_rate');
        const percentage = document.getElementById('percentage_rate');
        const dollarInput = document.getElementById('dollar_input');
        const percentageInput = document.getElementById('percentage_input');
        const commissionType = document.getElementById('commission_type');

        const handleSelection = () => {
            const selectedValue = commissionType.value;
            if (selectedValue === "Dollar Rate") {
                dollar.classList.remove("d-none");
                percentage.classList.add("d-none");
                percentageInput.value="";
            } else if (selectedValue === "Percentage") {
                percentage.classList.remove("d-none");
                dollar.classList.add("d-none");
                dollarInput.value="";
            } else {
                // Hide both inputs if "Select" is chosen
                dollar.classList.add("d-none");
                percentage.classList.add("d-none");
                
            }
        };

        // Attach event listener to the dropdown on page load
        commissionType.addEventListener('change', handleSelection);

        // Optional: Call handleSelection initially to handle initial state
        handleSelection();
    </script>

</body>

</html>