<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
    @include('template.home.custom_styles.custom_style')
</head>

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body p-4">
        <div class="container">
            <div class="card text-black">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h4 class="card-title mr-4 mt-2">Details of {{ $adAccount->ad_acc_name }}</h4>
                        <div>
                            <a href="{{ route('refill.refill', $adAccount->id) }}">
                                <button class="btn btn-sm btn-primary">Refill<i class="fa-solid fa-fill m-r-5 ml-2"></i></button>
                            </a>
                            @if(auth()->user()->role == 'admin')
                            <!-- Transfer Button -->
                            <button class="btn btn-sm btn-secondary text-white ml-2" data-toggle="modal" data-target="#transferModal">Transfer<i class="fa-solid fa-exchange-alt m-r-5 ml-2"></i></button>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="w-50 mr-5">
                            <div class="row">
                                <b class="col-5">Client Name:</b>
                                <p class="col-7">{{ $adAccount->client->name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Ad Account Name:</b>
                                <p class="col-7">{{ $adAccount->ad_acc_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Business Manager ID:</b>
                                <p class="col-7">{{ $adAccount->bm_id }}</p>
                            </div>

                            <div class="row">
                                <b class="col-5">Ad Account ID:</b>
                                <p class="col-7 ">{{ $adAccount->ad_acc_id }}</p>
                            </div>

                            <div class="row">
                                <b class="col-5">Dollar Rate:</b>
                                <p class="col-7">৳{{ $adAccount->dollar_rate }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Total Refill Amount:</b>
                                <p class="col-7">${{ $totalAmountUsd }}</p>
                            </div>
                            <div class="row">
                                <b class="col-5">Status:</b>
                                <p class="col-7">
                                    @if ($adAccount->status == 'pending')
                                    <span class="badge badge-primary">Pending</span>
                                    @endif

                                    @if ($adAccount->status == 'in-review')
                                    <span class="badge badge-info">In Review</span>
                                    @endif

                                    @if ($adAccount->status == 'approved')
                                    <span class="badge custom-badge-success">Approved</span>
                                    @endif

                                    @if ($adAccount->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif

                                    @if ($adAccount->status == 'canceled')
                                    <span class="badge badge-warning">Canceled</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="w-50">
                            @if(isset($adAccount->fb_link1) && $adAccount->fb_link1 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 1:</b>
                                <p class="col-8">{{ $adAccount->fb_link1 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link2) && $adAccount->fb_link2 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 2:</b>
                                <p class="col-8">{{ $adAccount->fb_link2 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link3) && $adAccount->fb_link3 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 3:</b>
                                <p class="col-8">{{ $adAccount->fb_link3 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link4) && $adAccount->fb_link4 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 4:</b>
                                <p class="col-8">{{ $adAccount->fb_link4 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->fb_link5) && $adAccount->fb_link5 !== '')
                            <div class="row">
                                <b class="col-4">Facebook Link 5:</b>
                                <p class="col-8">{{ $adAccount->fb_link5 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->domain1) && $adAccount->domain1 !== '')
                            <div class="row">
                                <b class="col-4">Domain 1:</b>
                                <p class="col-8">{{ $adAccount->domain1 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->domain2) && $adAccount->domain2 !== '')
                            <div class="row">
                                <b class="col-4">Domain 2:</b>
                                <p class="col-8">{{ $adAccount->domain2 }}</p>
                            </div>
                            @endif

                            @if(isset($adAccount->domain3) && $adAccount->domain3 !== '')
                            <div class="row">
                                <b class="col-4">Domain 3:</b>
                                <p class="col-8">{{ $adAccount->domain3 }}</p>
                            </div>
                            @endif

                            <div class="row">
                                <b class="col-4">Agency:</b>
                                <p class="col-8">{{ $adAccount->agency->agency_name }}</p>
                            </div>
                            <div class="row">
                                <b class="col-4">Ad Account Type:</b>
                                <p class="col-8">{{ $adAccount->ad_acc_type }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Refills History</h2>

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount (Taka)</th>
                                    <th>Amount (USD)</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                                @foreach($refills as $Refill)
                                @if( $Refill->status == 'approved')
                                <tr class="data-row">
                                    <td>{{ $Refill->created_at }}</td>
                                    <td>{{ $Refill->amount_taka }}</td>
                                    <td>{{ $Refill->amount_dollar }}</td>
                                    <td>{{ $Refill->payment_method }}</td>
                                    <td>{{ $Refill->status }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" id="seeAllBtn">See All</button>

                    </div>
                </div>
            </div>

            <a href="{{ route('my-account.index') }}" class="btn btn-sm btn-secondary text-white mt-3">Back</a>
        </div>
    </div>
    @if(auth()->user()->role == 'admin')
    <!-- Transfer Modal -->
    <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transferModalLabel">Transfer USD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="POST" action="{{ route('ad_account.transfer', $adAccount->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="transfer_amount">Amount (USD)</label>
                            <input type="number" class="form-control" id="transfer_amount" name="transfer_amount" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient_account">Recipient Account</label>
                            <select class="form-control" id="recipient_account" name="recipient_account" required>
                                @foreach($otherAdAccounts as $otherAdAccount)
                                <option value="{{ $otherAdAccount->id }}">{{ $otherAdAccount->ad_acc_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Transfer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @include('template.home.layouts.footer')

    @include('template.home.layouts.scripts')
    @include('template.home.custom_scripts.myaccountshow_script')

</body>

</html>