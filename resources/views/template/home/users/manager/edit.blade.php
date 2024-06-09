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
                <h4 class="mb-3">Update Manager Information</h4>

                <form method="POST" action="{{ route('manager.update', $manager->id) }}" class="my-3 login-input">


                    @csrf
                    @method('PUT')

                    <div class="">
                        <label class="col-form-label">Manager Name:</label>
                        <input value="{{ $manager->name }}" class="form-control rounded" type="text" name="name" placeholder="manager Name" required />
                    </div>

                    <div class="">
                        <label class="col-form-label">Manager Email:</label>
                        <input value="{{ $manager->email }}" id="email" class="form-control rounded" type="email" name="email" placeholder="manager Email" required />
                    </div>

                    <div class="">
                        <label class="col-form-label">Update Password:</label>
                        <input value="{{ $manager->password }}" id="password" class="form-control rounded" type="password" name="password" placeholder="Password" />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Update Manager" class="btn btn-primary">
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