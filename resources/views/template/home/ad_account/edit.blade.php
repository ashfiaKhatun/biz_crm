<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="w-75 mx-auto my-5 p-5 border rounded bg-white shadow-lg">
            <h4 class="mb-3">Edit Ad Account Application</h4>

            <form method="post" action="{{ route('ad-account.update', $adAccount->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <label class="col-form-label">Client Name:</label>
                    <select name="client_name" class="form-control rounded">
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $adAccount->client_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="col-form-label">Ad Account Name:</label>
                    <input type="text" name="ad_acc_name" value="{{ $adAccount->ad_acc_name }}" class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Business Manager Id:</label>
                    <input type="text" name="bm_id" value="{{ $adAccount->bm_id }}" class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Facebook Page Link:</label>

                    <div class="d-flex">
                        @if (isset($adAccount->fb_link1) && $adAccount->fb_link1 !== '')
                        <input type="text" name="fb_link1" value="{{ $adAccount->fb_link1 }}" placeholder="Facebook Page Link (You can add maximum 5)" class="form-control rounded">
                        @endif

                        @if ($adAccount->fb_link2 == '')
                        <p onclick="handlePlus1()" id="plus-1" class="btn btn-primary border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                        @endif
                    </div>

                    <div id="fb-link-2" class=" @if ($adAccount->fb_link2 == '') d-none @endif my-2">
                        <div>
                            <div class="d-flex">

                                <input id="fb-input-2" name="fb_link2" @if (isset($adAccount->fb_link2) && $adAccount->fb_link2 !== '') value="{{ $adAccount->fb_link2 }}" @endif type="text" placeholder="Another Facebook Page Link" class="form-control rounded">

                                @if ($adAccount->fb_link3 == '')
                                <p onclick="handlePlus2()" id="plus-2" class="btn btn-primary border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div id="fb-link-3" class="@if ($adAccount->fb_link3 == '') d-none @endif mb-2">
                        <div>
                            <div class="d-flex">

                                <input id="fb-input-3" type="text" name="fb_link3" @if (isset($adAccount->fb_link3) && $adAccount->fb_link3 !== '') value="{{ $adAccount->fb_link3 }}" @endif placeholder="Another Facebook Page Link" class="form-control rounded">

                                @if ($adAccount->fb_link4 == '')
                                <p onclick="handlePlus3()" id="plus-3" class="btn btn-primary border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div id="fb-link-4" class="@if ($adAccount->fb_link4 == '') d-none @endif mb-2">
                        <div>
                            <div class="d-flex">

                                <input id="fb-input-4" type="text" name="fb_link4" @if (isset($adAccount->fb_link4) && $adAccount->fb_link4 !== '') value="{{ $adAccount->fb_link4 }}" @endif placeholder="Another Facebook Page Link" class="form-control rounded">

                                @if ($adAccount->fb_link5 == '')
                                <p onclick="handlePlus4()" id="plus-4" class="btn btn-primary border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another fb link">+</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div id="fb-link-5" class="@if ($adAccount->fb_link5 == '') d-none @endif">
                        <div class="d-flex">

                            <input id="fb-input-5" type="text" name="fb_link5" @if (isset($adAccount->fb_link5) && $adAccount->fb_link5 !== '') value="{{ $adAccount->fb_link5 }}" @endif placeholder="Another Facebook Page Link" class="form-control rounded">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="col-form-label">Domain:</label>
                    <div class="d-flex">
                        <input type="text" name="domain1" @if (isset($adAccount->domain1) && $adAccount->domain1 !== '') value="{{ $adAccount->domain1 }}" @endif placeholder="Domain (You can add maximum 3)" class="form-control rounded">

                        @if ($adAccount->domain2 == '')
                        <p onclick="handleAdd1()" id="add-1" class="btn btn-primary border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another domain">+</p>
                        @endif
                    </div>

                    <div id="domain-2" class=" @if ($adAccount->domain2 == '') d-none @endif my-2">
                        <div>
                            <div class="d-flex">
                                <input id="domain-input-2" name="domain2" @if (isset($adAccount->domain2) && $adAccount->domain2 !== '') value="{{ $adAccount->domain2 }}" @endif type="text" placeholder="Another Domain" class="form-control rounded">

                                @if ($adAccount->domain3 == '')
                                <p onclick="handleAdd2()" id="add-2" class="btn btn-primary border mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add another domain">+</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div id="domain-3" class=" @if ($adAccount->domain3 == '') d-none @endif">
                        <div class="d-flex">
                            <input id="domain-input-3" name="domain3" @if (isset($adAccount->domain3) && $adAccount->domain3 !== '') value="{{ $adAccount->domain3 }}" @endif type="text" placeholder="Another Domain" class="form-control rounded">

                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between">
                    <div class="w-50 mr-2">
                        <label class="col-form-label">Select Agency:</label>
                        <select name="agency" class="form-control rounded" id="agency-select">
                            @foreach ($agencies as $agency)
                            <option value="{{ $agency->id }}" data-ad-account-type="{{ $agency->ad_account_type }}" {{ $adAccount->agency_id == $agency->id ? 'selected' : '' }}>
                                {{ $agency->agency_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-50">
                        <label class="col-form-label">Ad Account Type:</label>
                        <input type="text" name="ad_acc_type" class="form-control rounded" id="ad-account-type" readonly value="{{ $adAccount->ad_acc_type }}">
                        <select name="ad_acc_type_select" class="form-control rounded d-none" id="ad-account-type-select">
                            <option value="Credit Line" {{ $adAccount->ad_acc_type == 'Credit Line' ? 'selected' : '' }}>Credit Line</option>
                            <option value="Card Line" {{ $adAccount->ad_acc_type == 'Card Line' ? 'selected' : '' }}>
                                Card Line</option>
                            <option value="Both" {{ $adAccount->ad_acc_type == 'Both' ? 'selected' : '' }}>Both
                            </option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="col-form-label">Dollar Rate:</label>
                    <input type="text" name="dollar_rate" value="{{ $adAccount->dollar_rate }}" class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Status:</label>
                    <select name="status" class="form-control rounded">
                        <option value="pending" {{ $adAccount->status == 'pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="approved" {{ $adAccount->status == 'approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="rejected" {{ $adAccount->status == 'rejected' ? 'selected' : '' }}>Rejected
                        </option>
                    </select>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    @include('template.home.layouts.footer')

    @include('template.home.custom_scripts.update_ad_account_application_script')

    @include('template.home.layouts.scripts')

</body>

</html>