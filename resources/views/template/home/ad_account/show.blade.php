<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>BizMappers</title>
    <!-- Favicon icon -->
    <link rel="icon" type="../../template/image/png" sizes="16x16" href="../../template/images/favicon.png">
    <!-- Pignose Calender -->
    <link href="../../template/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="../../template/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../../template/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="../../template/css/style.css" rel="stylesheet">
    <link href="../../template/css/style.css" rel="stylesheet">

    <style>
        .text-black {
            color: black;
        }

        .font-sm {
            font-size: 13px;
        }
    </style>


    <script src="https://kit.fontawesome.com/eabba84056.js" crossorigin="anonymous"></script>

</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container-fluid">

            <div class="row text-black">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-5">
                                <h4 class="card-title mr-4 mt-2">Details of {{ $adAccount->ad_acc_name }}</h4>
                                <a href="{{ route('ad-account.edit', $adAccount->id) }}">
                                    <button class="btn btn-secondary">Edit Info<i class="fa fa-pencil color-muted m-r-5 ml-3"></i></button>
                                </a>

                            </div>

                            <div class="row">
                                <b class="col-4">Ad Account Name:</b>
                                <p class="col-8 ">{{ $adAccount->ad_acc_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Business Manager ID:</b>
                                <p class="col-8 ">{{ $adAccount->bm_id }}</p>
                            </div>

                            @if(isset($adAccount->fb_link1) && $adAccount->fb_link1 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 1:</b>
                                <p class="col-8 ">{{ $adAccount->fb_link1 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link2) && $adAccount->fb_link2 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 2:</b>
                                <p class="col-8 ">{{ $adAccount->fb_link2 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link3) && $adAccount->fb_link3 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 3:</b>
                                <p class="col-8 ">{{ $adAccount->fb_link3 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link4) && $adAccount->fb_link4 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 4:</b>
                                <p class="col-8 ">{{ $adAccount->fb_link4 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link5) && $adAccount->fb_link5 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 5:</b>
                                <p class="col-8 ">{{ $adAccount->fb_link5 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->domain1) && $adAccount->domain1 !== '')
                            <div class="row">
                                <b class="col-4">Domain 1:</b>
                                <p class="col-8 ">{{ $adAccount->domain1 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->domain2) && $adAccount->domain2 !== '')
                            <div class="row">
                                <b class="col-4">Domain 2:</b>
                                <p class="col-8 ">{{ $adAccount->domain2 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->domain3) && $adAccount->domain3 !== '')
                            <div class="row">
                                <b class="col-4">Domain 3:</b>
                                <p class="col-8 ">{{ $adAccount->domain3 }}</p>
                            </div>
                            @endif

                            <div class="row">
                                <b class="col-4">Agency:</b>
                                <p class="col-8 ">{{ $adAccount->agency->agency_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Ad Account Type:</b>
                                <p class="col-8 ">{{ $adAccount->ad_acc_type }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Dollar Rate:</b>
                                <p class="col-8 ">{{ $adAccount->dollar_rate }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Status:</b>
                                <select name="status" class="form-control rounded col-3">
                                    <option value="pending" {{ $adAccount->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="in-review" {{ $adAccount->status == 'in-review' ? 'selected' : '' }}>In Review
                                    </option>
                                    </option>
                                    </option>
                                    <option value="rejected" {{ $adAccount->status == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body font-sm">

                            <h4 class="card-title mb-5">Clients' Information</h4>
                            <div class="row">
                                <b class="col-5">Client Name:</b>
                                <p class="col-7">{{ $adAccount->client->name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Phone Number:</b>
                                <p class="col-7">{{ $adAccount->client->phone }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Email:</b>
                                <p class="col-7">{{ $adAccount->client->email }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Type:</b>
                                <p class="col-7">{{ $adAccount->client->business_type }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Name:</b>
                                <p class="col-7">{{ $adAccount->client->business_name }}</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <a href="{{ route('ad-account.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')

</body>

</html>