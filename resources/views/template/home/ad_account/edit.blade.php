<!DOCTYPE html>
<html lang="en">

@include('template.home.layouts.head')

<body>

    @include('template.home.layouts.navbar')
    @include('template.home.layouts.sidebar')

    <div class="content-body">
        <div class="container my-5">
            <h2>Edit Ad Account Application</h2>

            <form method="post" action="{{ route('ad-account.update', $adAccount->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <label class="col-form-label">Client Name:</label>
                    <select name="client_name" class="form-control rounded">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ $adAccount->client_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="col-form-label">Ad Account Name:</label>
                    <input type="text" name="ad_acc_name" value="{{ $adAccount->ad_acc_name }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Business Manager Id:</label>
                    <input type="text" name="bm_id" value="{{ $adAccount->bm_id }}" class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Facebook Page Link1:</label>
                    <input type="text" name="fb_link1" value="{{ $adAccount->fb_link1 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Facebook Page Link2:</label>
                    <input type="text" name="fb_link2" value="{{ $adAccount->fb_link2 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Facebook Page Link3:</label>
                    <input type="text" name="fb_link3" value="{{ $adAccount->fb_link3 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Facebook Page Link4:</label>
                    <input type="text" name="fb_link4" value="{{ $adAccount->fb_link4 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Facebook Page Link5:</label>
                    <input type="text" name="fb_link5" value="{{ $adAccount->fb_link5 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Domain 1:</label>
                    <input type="text" name="domain1" value="{{ $adAccount->domain1 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Domain 2:</label>
                    <input type="text" name="domain2" value="{{ $adAccount->domain2 }}"
                        class="form-control rounded">
                </div>

                <div>
                    <label class="col-form-label">Domain 1:</label>
                    <input type="text" name="domain3" value="{{ $adAccount->domain3 }}"
                        class="form-control rounded">
                </div>



                <div class="d-flex justify-content-between">
                    <div class="w-50 mr-2">
                        <label class="col-form-label">Select Agency:</label>
                        <select name="agency" class="form-control rounded" id="agency-select">
                            @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}"
                                    data-ad-account-type="{{ $agency->ad_account_type }}"
                                    {{ $adAccount->agency_id == $agency->id ? 'selected' : '' }}>
                                    {{ $agency->agency_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-50">
                        <label class="col-form-label">Ad Account Type:</label>
                        <input type="text" name="ad_acc_type" class="form-control rounded d-none"
                            id="ad-account-type" readonly value="{{ $adAccount->ad_acc_type }}">
                        <select name="ad_acc_type_select" class="form-control rounded d-none"
                            id="ad-account-type-select">
                            <option value="Credit Line"
                                {{ $adAccount->ad_acc_type == 'Credit Line' ? 'selected' : '' }}>Credit Line</option>
                            <option value="Card Line" {{ $adAccount->ad_acc_type == 'Card Line' ? 'selected' : '' }}>
                                Card Line</option>
                            <option value="Both" {{ $adAccount->ad_acc_type == 'Both' ? 'selected' : '' }}>Both
                            </option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="col-form-label">Dollar Rate:</label>
                    <input type="text" name="dollar_rate" value="{{ $adAccount->dollar_rate }}"
                        class="form-control rounded">
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

    <script>
        const maxFbLinks = 5;
        const maxDomains = 3;

        function addFbLink() {
            const fbLinks = document.getElementById('fb-links');
            const fbLinkCount = fbLinks.querySelectorAll('input').length;

            if (fbLinkCount < maxFbLinks) {
                const newFbLink = document.createElement('div');
                newFbLink.classList.add('d-flex', 'mb-2');
                newFbLink.innerHTML = `
                    <input type="text" name="fb_links[]" placeholder="Facebook Page Link" class="form-control rounded">
                    <button type="button" class="btn border mt-1" onclick="removeElement(this)">-</button>
                `;
                fbLinks.appendChild(newFbLink);
            }
        }

        function addDomain() {
            const domains = document.getElementById('domains');
            const domainCount = domains.querySelectorAll('input').length;

            if (domainCount < maxDomains) {
                const newDomain = document.createElement('div');
                newDomain.classList.add('d-flex', 'mb-2');
                newDomain.innerHTML = `
                    <input type="text" name="domains[]" placeholder="Domain" class="form-control rounded">
                    <button type="button" class="btn border mt-1" onclick="removeElement(this)">-</button>
                `;
                domains.appendChild(newDomain);
            }
        }

        function removeElement(button) {
            button.parentElement.remove();
        }

        const agencySelect = document.getElementById('agency-select');
        const adAccountTypeInput = document.getElementById('ad-account-type');
        const adAccountTypeSelect = document.getElementById('ad-account-type-select');

        agencySelect.addEventListener('change', function() {
            const selectedOption = agencySelect.options[agencySelect.selectedIndex];
            const adAccountType = selectedOption.getAttribute('data-ad-account-type');

            if (adAccountType === 'Both') {
                adAccountTypeInput.classList.add('d-none');
                adAccountTypeSelect.classList.remove('d-none');
            } else {
                adAccountTypeSelect.classList.add('d-none');
                adAccountTypeInput.classList.remove('d-none');
                adAccountTypeInput.value = adAccountType;
            }
        });
    </script>

</body>

</html>
