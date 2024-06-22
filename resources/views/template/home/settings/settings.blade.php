<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

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
        <div class="content-body p-4">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Settings</h4>
                    <!-- Nav tabs -->
                    <div class="default-tab">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dollar">Default Dollar Rate</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#refill">Refill Payment Method</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vendor">Vendors</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="dollar" role="tabpanel">
                                @if (isset($defaultRate))
                                <div class="text-black row">
                                    <b class="col-2">Default Dollar Rate: </b>
                                    <p class="col-10">{{ $defaultRate->value }} Taka</p>
                                </div>
                                @endif

                                <form action="{{ isset($defaultRate) ? route('setting.updateDollar', $defaultRate->id) : route('setting.storeDollar') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if(isset($defaultRate))
                                    @method('PUT')
                                    @endif

                                    <div class="p-t-15">
                                        <label class="col-form-label">Default Dollar Rate:</label>
                                        <input value="{{ isset($defaultRate) ? $defaultRate->value : '' }}" type="text" name="dollar_rate" placeholder="Default Dollar Rate" class="form-control rounded w-25">
                                    </div>
                                    <div class="mt-4">
                                        <input type="submit" name="submit" value="{{ isset($defaultRate) ? 'Update' : 'Save' }}" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="refill">
                                <b class="text-black">Refill Payment Methods: </b>
                                <div class="basic-list-group">
                                    <ul class="list-group w-25 my-3">
                                        @foreach ($values as $value)
                                        @if($value->setting_name == 'Refill Payment Method')
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $value->value }}
                                            <form action="{{ route('setting.destroyPaymentMethod', $value->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-transparent" onclick="return confirm('Are you sure you want to delete this Payment Method?')"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                        </li>
                                        
                                        @endif
                                        @endforeach

                                    </ul>

                                </div>
                                <form action="{{ route('setting.storePaymentMethod') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-t-15">
                                        <label class="col-form-label">Add Refill Payment Method:</label>
                                        <input type="text" name="payment_method" placeholder="Refill Payment Method" class="form-control rounded w-25">
                                    </div>
                                    <div class="mt-4">
                                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="vendor">
                                <b class="text-black">Vendors: </b>
                                <div class="basic-list-group">
                                    <ul class="list-group w-25 my-3">
                                        @foreach ($values as $value)
                                        @if($value->setting_name == 'Vendor')
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $value->value }}
                                            <form action="{{ route('setting.destroyVendor', $value->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-transparent" onclick="return confirm('Are you sure you want to delete this Vendor?')"><i class="fa-solid fa-xmark"></i></button>
                                        </li>
                                        @endif
                                        @endforeach

                                    </ul>

                                </div>
                                <form action="{{ route('setting.storeVendor') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-t-15">
                                        <label class="col-form-label">Vendor:</label>
                                        <input type="text" name="vendor" placeholder="Vendor" class="form-control rounded w-25">
                                    </div>
                                    <div class="mt-4">
                                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
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


    @include('template.home.custom_scripts.refill_application_script')
</body>

</html>