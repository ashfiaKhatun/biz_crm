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
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="card-title mr-4 mt-2">Refill Applications</h4>

                    @if (auth()->user()->role == 'customer')
                        <a href="{{ route('refills.newRefill', auth()->user()->id) }}">
                            <button class="btn btn-sm btn-secondary text-white">New Refill<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                        </a>
                    @else
                        <a href="#" data-toggle="modal" data-target="#refillModal">
                            <button class="btn btn-sm btn-secondary text-white">New Refill<i class="fa fa-plus color-muted m-r-5 ml-2"></i></button>
                        </a>
                    @endif
                </div>

                <!-- Search Field -->
                <div class="mb-3 w-25">
                    <input type="text" id="searchInput" class="form-control rounded" placeholder="Search...">
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-striped verticle-middle" id="refillTable">
                        <thead>
                            <tr>
                                <th>Date || Time</th>
                                <th>Ad Account Name</th>
                                <th>Dollar Rate</th>
                                <th>Amount (Dollar)</th>
                                <th>Amount (Taka)</th>
                                <th>Method</th>
                                <th>Responsible</th>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'employee')
                                    <th></th>
                                @endif
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @include('template.home.refill_application.load_more_data')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('template.home.layouts.footer')
        @include('template.home.layouts.scripts')
        @include('template.home.custom_scripts.refill_application_script')
        @include('template.home.custom_scripts.search_script')

        <script>
            $(document).on('click', '.load-more', function() {
                var page = $(this).data('page');
                loadMoreData(page);
            });

            function loadMoreData(page) {
                $.ajax({
                    url: "/refills?page=" + page,
                    type: "get",
                    beforeSend: function() {
                        $('.load-more').html('Loading...');
                    }
                }).done(function(data) {
                    if (data.html == "") {
                        $('.load-more').html('No more records found');
                        return;
                    }
                    $('.load-more').remove();
                    $('#table-body').append(data);
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Server error');
                });
            }
        </script>
    </div>
</body>

</html>
