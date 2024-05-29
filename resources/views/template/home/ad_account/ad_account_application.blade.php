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
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach

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
                        <div>
                            <input type="text" placeholder="Facebook Page Link (You can add maximum 5)" class="form-control rounded">

                            <p onclick="handlePlus1()" id="plus-1" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                        </div>

                        <div id="fb-link-2" class="d-none my-2">
                            <div>
                                <div class="d-flex">
                                    <input id="fb-input-2" type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                    <p onclick="handleMinus2()" id="minus-2" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove fb link">-</p>
                                </div>

                                <p onclick="handlePlus2()" id="plus-2" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                            </div>
                        </div>

                        <div id="fb-link-3" class="d-none mb-2">
                            <div>
                                <div class="d-flex">
                                    <input id="fb-input-3" type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                    <p onclick="handleMinus3()" id="minus-3" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove fb link">-</p>
                                </div>

                                <p onclick="handlePlus3()" id="plus-3" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                            </div>
                        </div>

                        <div id="fb-link-4" class="d-none mb-2">
                            <div>
                                <div class="d-flex">
                                    <input id="fb-input-4" type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                    <p onclick="handleMinus4()" id="minus-4" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove fb link">-</p>
                                </div>

                                <p onclick="handlePlus4()" id="plus-4" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                            </div>
                        </div>

                        <div id="fb-link-5" class="d-none">
                            <div class="d-flex">
                                <input id="fb-input-5" type="text" placeholder="Another Facebook Page Link" class="form-control rounded">
                                <p onclick="handleMinus5()" id="minus-5" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove fb link">-</p>
                            </div>
                        </div>
                    </div>


                    <div>
                        <label class="col-form-label">Domain:</label>
                        <div class="d-flex mb-2">
                            <input type="text" placeholder="Domain (You can add maximum 3)" class="form-control rounded">

                            <p onclick="handleAdd1()" id="add-1" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another domain">+</p>
                        </div>

                        <div id="domain-2" class="d-none mb-2">
                            <div>
                                <div class="d-flex">
                                    <input id="domain-input-2" type="text" placeholder="Another Domain" class="form-control rounded">

                                    <p onclick="handleRemove2()" id="remove-2" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove Domain">-</p>
                                </div>
                                
                                <p onclick="handleAdd2()" id="add-2" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another domain">+</p>
                            </div>
                        </div>

                        <div id="domain-3" class="d-none">
                            <div class="d-flex">
                                <input id="domain-input-3" type="text" placeholder="Another Domain" class="form-control rounded">

                                <p onclick="handleRemove3()" id="remove-3" class="btn border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove Domain">-</p>

                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="w-50 mr-2">
                            <label class="col-form-label">Select Agency:</label>
                            <select name="agency" class="form-control rounded">
                                <option>Select</option>
                                @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}">{{ $agency->agency_name }}</option>
                                @endforeach
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
    
    @include('template.home.ad_account.ad_account_application_script')

</body>

</html>