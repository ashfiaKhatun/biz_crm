<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
@include('template.home.layouts.head')

</head>

<body class="h-100">

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


    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form my-5    ">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html">
                                    <h4>BizMappers</h4>
                                </a>

                                <form method="POST" action="{{ route('registerClient') }}" class="my-3 login-input">

                                    @csrf

                                    <div>
                                        <label class="col-form-label">Client Name:</label>
                                        <input id="name" class="form-control rounded" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus autocomplete="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Username:</label>
                                        <input id="username" class="form-control rounded" type="text" name="username" :value="old('username')" placeholder="Username" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Email:</label>
                                        <input id="email" class="form-control rounded" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Phone:</label>
                                        <input id="phone" class="form-control rounded" type="tel" name="phone" :value="old('phone')" placeholder="Phone" required autocomplete="phone" />
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Business Type:</label>
                                        <select id="business_type" class="form-control rounded" name="business_type" required>
                                            <option value="" disabled selected>Business Type</option>
                                            <option value="retail">Retail</option>
                                            <option value="service">Service</option>
                                            <option value="manufacturing">Manufacturing</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('business_type')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Business Name:</label>
                                        <input id="business_name" class="form-control rounded" type="text" name="business_name" :value="old('business_name')" placeholder="Business Name" required autocomplete="business_name" />
                                        <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
                                    </div>


                                    <div>
                                        <label class="col-form-label">Password:</label>
                                        <input id="password" class="form-control rounded" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label class="col-form-label">Confirm Password:</label>
                                        <input id="password_confirmation" class="form-control rounded" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <input type="submit" name="submit" value="Add Client" class="btn btn-primary">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    @include('template.home.layouts.scripts')
</body>

</html>