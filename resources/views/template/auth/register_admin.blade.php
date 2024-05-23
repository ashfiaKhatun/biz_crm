<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BizMappers</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="template/css/style.css" rel="stylesheet">

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
                                <a class="text-center" href="index.html">
                                    <h4>BizMappers</h4>
                                </a>

                                <form method="POST" action="{{ route('register.admin') }}" class="mt-5 mb-5 login-input">

                                    @csrf

                                    <div class="form-group">
                                        <x-text-input id="name" class="form-control pl-2" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>


                                    <div class="form-group">
                                        <x-text-input id="email" class="form-control pl-2" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="form-group">
                                        <x-text-input id="password" class="form-control pl-2" type="password" name="password" placeholder="Password" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="form-group">
                                        <x-text-input id="password_confirmation" class="form-control pl-2" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <x-primary-button class="ms-4">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </form>
                                <p class="mt-5 login-form__footer">Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a> here</p>
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
    <script src="template/plugins/common/common.min.js"></script>
    <script src="template/js/custom.min.js"></script>
    <script src="template/js/settings.js"></script>
    <script src="template/js/gleek.js"></script>
    <script src="template/js/styleSwitcher.js"></script>
</body>

</html>