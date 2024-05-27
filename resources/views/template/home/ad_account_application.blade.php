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
                <h4 class="mb-3">New Ad Account Application</h4>
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

                    <!-- <div>
                        <label class="col-form-label">Facebook Page Link:</label>
                        <input type="text" name="fb_link" placeholder="Facebook Page Link" class="form-control rounded">
                    </div> -->

                    <div>
                        <label class="col-form-label">Facebook Page Link:</label>
                        <div class="d-flex mb-2">
                            <input type="text" placeholder="Facebook Page Link (You can add maximum 5)" class="form-control rounded">
                            <p onclick="handlePlus1()" id="plus-1" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>

                        </div>

                        <div id="fb-link-2" class="d-none mb-2">
                            <div class="d-flex">
                                <input type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                <p onclick="handlePlus2()" id="plus-2" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                            </div>
                        </div>

                        <div id="fb-link-3" class="d-none mb-2">
                            <div class="d-flex">
                                <input type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                <p onclick="handlePlus3()" id="plus-3" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                            </div>
                        </div>

                        <div id="fb-link-4" class="d-none mb-2">
                            <div class="d-flex">
                                <input type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                <p onclick="handlePlus4()" id="plus-4" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                            </div>
                        </div>

                        <div id="fb-link-5" class="d-none">
                            <input type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                        </div>


                    </div>

                    <div>
                        <label class="col-form-label">Domain:</label>
                        <div class="d-flex mb-2">
                            <input type="text" placeholder="Domain (You can add maximum 3)" class="form-control rounded">
                            <p onclick="handleAdd1()" id="add-1" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another domain">+</p>

                        </div>

                        <div id="domain-2" class="d-none mb-2">
                            <div class="d-flex">
                                <input type="text" placeholder="Another Domain" class="form-control rounded">
                                <p onclick="handleAdd2()" id="add-2" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another domain">+</p>
                            </div>
                        </div>

                        <div id="domain-3" class="d-none">
                            <input type="text" placeholder="Another Domain" class="form-control rounded">
                        </div>


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

    <script>
        const add_1 = document.getElementById('add-1');
        const add_2 = document.getElementById('add-2');
        
        const plus_1 = document.getElementById('plus-1');
        const plus_2 = document.getElementById('plus-2');
        const plus_3 = document.getElementById('plus-3');
        const plus_4 = document.getElementById('plus-4');

        const domain_2 = document.getElementById('domain-2');
        const domain_3 = document.getElementById('domain-3');
        
        const fb_link_2 = document.getElementById('fb-link-2');
        const fb_link_3 = document.getElementById('fb-link-3');
        const fb_link_4 = document.getElementById('fb-link-4');
        const fb_link_5 = document.getElementById('fb-link-5');

        const handleAdd1 = () => {
            domain_2.classList.remove("d-none");
            add_1.classList.add("d-none");
        }
        const handleAdd2 = () => {
            domain_3.classList.remove("d-none");
            add_2.classList.add("d-none");
        }
        
        const handlePlus1 = () => {
            fb_link_2.classList.remove("d-none");
            plus_1.classList.add("d-none");
        }
        const handlePlus2 = () => {
            fb_link_3.classList.remove("d-none");
            plus_2.classList.add("d-none");
        }
        const handlePlus3 = () => {
            fb_link_4.classList.remove("d-none");
            plus_3.classList.add("d-none");
        }
        const handlePlus4 = () => {
            fb_link_5.classList.remove("d-none");
            plus_4.classList.add("d-none");
        }
    </script>

</body>

</html>