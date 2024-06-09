<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

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
                <h4 class="mb-3">Update Client Information</h4>

                <form method="POST" action="{{ route('client.update', $client->id) }}" class="my-3 login-input">


                    @csrf
                    @method('PUT')

                    <div class="">
                        <label class="col-form-label">Client Name:</label>
                        <input value="{{ $client->name }}" class="form-control rounded" type="text" name="name" placeholder="Client Name" required />
                    </div>

                    <div class="">
                        <label class="col-form-label">User Name:</label>
                        <input value="{{ $client->name }}" class="form-control rounded" type="text" name="username" placeholder="Username" required />
                    </div>

                    <div class="">
                        <label class="col-form-label">Email:</label>
                        <input value="{{ $client->email }}" class="form-control rounded" type="email" name="email" placeholder="Client Email" required />
                    </div>

                    <div class="">
                        <label class="col-form-label">Phone:</label>
                        <input value="{{ $client->phone }}" class="form-control rounded" type="text" name="phone" placeholder="Phone" required />
                    </div>

                    <div>
                        <label class="col-form-label">Business Type:</label>
                        <select id="business_type" class="form-control rounded" name="business_type" required>
                            <option {{ $client->business_type == 'retail' ? 'selected' : '' }} value="retail">Retail</option>
                            <option {{ $client->business_type == 'service' ? 'selected' : '' }} value="service">Service</option>
                            <option {{ $client->business_type == 'manufacturing' ? 'selected' : '' }} value="manufacturing">Manufacturing</option>
                            <option {{ $client->business_type == 'Other' ? 'selected' : '' }} value="other">Other</option>
                        </select>
                    </div>

                    <div class="">
                        <label class="col-form-label">Business Name:</label>
                        <input value="{{ $client->business_name }}" class="form-control rounded" type="text" name="business_name" placeholder="Business Name" required />
                    </div>

                    <div class="">
                        <label class="col-form-label">Update Password:</label>
                        <input value="{{ $client->password }}" class="form-control rounded" type="password" name="password" placeholder="Update Password" required />
                    </div>


                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Update Client" class="btn btn-primary">
                    </div>
                </form>
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