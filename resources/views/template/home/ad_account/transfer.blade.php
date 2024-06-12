<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.home.layouts.head')
</head>

<body>

@include('template.home.layouts.navbar')
@include('template.home.layouts.sidebar')

<div class="content-body p-4">
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transfer USD from {{ $adAccount->ad_acc_name }}</h4>

                <form method="POST" action="{{ route('ad_account.transfer', $adAccount->id) }}">
                    @csrf
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
                    <button type="submit" class="btn btn-primary">Transfer</button>
                    <a href="{{ route('ad-account.show', $adAccount->id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>
</div>

@include('template.home.layouts.footer')
@include('template.home.layouts.scripts')

</body>

</html>
