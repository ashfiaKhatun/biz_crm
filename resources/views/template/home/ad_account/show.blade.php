<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container my-5">
            <h2>Ad Account Application Details</h2>
            
            <div class="card">
                <div class="card-body">
                    
                    <p><strong>Client Name:</strong> {{ $adAccount->client->name }}</p>
                    <p><strong>Ad Account Name:</strong> {{ $adAccount->ad_acc_name }}</p>
                    <p><strong>Business Manager ID:</strong> {{ $adAccount->bm_id }}</p>

                    <p><strong>Facebook Link 1:</strong> {{ $adAccount->fb_link1 }}</p>
                    <p><strong>Facebook Link 2:</strong> {{ $adAccount->fb_link2 }}</p>
                    <p><strong>Facebook Link 3:</strong> {{ $adAccount->fb_link3 }}</p>
                    <p><strong>Facebook Link 4:</strong> {{ $adAccount->fb_link4 }}</p>
                    <p><strong>Facebook Link 5:</strong> {{ $adAccount->fb_link5 }}</p>


                    <p><strong>Domain 1:</strong> {{ $adAccount->domain1 }}</p>
                    <p><strong>Domain 2:</strong> {{ $adAccount->domain2 }}</p>
                    <p><strong>Domain 3:</strong> {{ $adAccount->domain3 }}</p>
                    
                    
                    
                    <p><strong>Agency:</strong> {{ $adAccount->agency->agency_name }}</p>
                    <p><strong>Ad Account Type:</strong> {{ $adAccount->ad_acc_type }}</p>
                    <p><strong>Dollar Rate:</strong> {{ $adAccount->dollar_rate }}</p>
                    <p><strong>Status:</strong> {{ $adAccount->status }}</p>
                </div>
            </div>

            <a href="{{ route('ad-account.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>

    @include('template.home.layouts.footer')

</body>

</html>
