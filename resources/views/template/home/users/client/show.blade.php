<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container-fluid">

            <div class="row text-black">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="card-title mr-4 mt-2">Detailed user information of
                                    {{ $user->name }}
                                </h4>
                                @if(auth()->user()->role == 'admin')
                                <a href="{{ route('client.edit', $user->id) }}">
                                    <button class="btn btn-sm btn-secondary text-white">Edit Info<i class="fa fa-pencil color-muted m-r-5 ml-2"></i></button>
                                </a>
                                @endif
                            </div>

                            <div class="row">
                                <b class="col-5">Client Name:</b>
                                <p class="col-7">{{ $user->name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Phone Number:</b>
                                <p class="col-7">{{ $user->phone }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Email:</b>
                                <p class="col-7">{{ $user->email }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Type:</b>
                                <p class="col-7">{{ $user->business_type }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Name:</b>
                                <p class="col-7">{{ $user->business_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5 font-sm">
                    <div class="card">
                        <div class="card-body font-sm">

                            <h4 class="card-title mb-3">Ad Account List</h4>
                            
                            <div class="basic-list-group">
                                    <ul class="list-group">
                                        @foreach ($adAccounts as $adAccount)
                                        <li class="list-group-item">
                                            {{ $adAccount->ad_acc_name }}
                                            
                                        </li>
                                        @endforeach

                                    </ul>

                                </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('template.home.layouts.footer')
    @include('template.home.layouts.scripts')
    @include('template.home.custom_scripts.search_script')

</body>

</html>