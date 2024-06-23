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
                <h4 class="mb-3">Add New Admin</h4>

                <form method="POST" action="{{ route('register.admin') }}" class="my-3 login-input">


                    @csrf

                    <div class="">
                        <label class="col-form-label">Admin Name:</label>
                        <input id="name" class="form-control rounded" type="text" name="name" :value="old('name')" placeholder="Admin Name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label class="col-form-label">Username:</label>
                        <input id="username" class="form-control rounded" type="text" name="username" :value="old('username')" placeholder="Username" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div class="">
                        <label class="col-form-label">Admin Email:</label>
                        <input id="email" class="form-control rounded" type="email" name="email" :value="old('email')" placeholder="Admin Email" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="">
                        <label class="col-form-label">Password:</label>
                        <input id="password" class="form-control rounded" type="password" name="password" placeholder="Password" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="">
                    <label class="col-form-label">Confirm Password:</label>
                        <input id="password_confirmation" class="form-control rounded" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-primary">
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