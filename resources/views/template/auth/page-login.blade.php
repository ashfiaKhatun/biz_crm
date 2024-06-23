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
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <div class="text-center">
                                    <img src="template/images/favicon.png" width="48">
                                    <h4 class="mt-3">BizMappers</h4>
                                </div>

                                <form method="POST" action="{{ route('login') }}" class="mt-5 mb-5 login-input">

                                    @csrf

                                    <div class="form-group">
                                        <x-text-input id="login" class="form-control pl-2" type="text" name="login" :value="old('login')" placeholder="Username/ Email" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>


                                    <div class="form-group">
                                        <x-text-input id="password" class="form-control pl-2" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                        @endif

                                        <x-primary-button class="ms-3 mt-3">
                                            {{ __('Log in') }}
                                        </x-primary-button>
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