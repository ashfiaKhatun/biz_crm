<script>
    // ad account load

    document.getElementById('client-select').addEventListener('change', function() {
        const clientId = this.value;
        const adAccountSelect = document.getElementById('ad-account-select');

        // Clear existing options
        adAccountSelect.innerHTML = '<option>Select</option>';

        if (clientId) {
            fetch(`/ad-account/${clientId}/accounts`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(account => {
                        const option = document.createElement('option');
                        option.value = account.id;
                        option.textContent = account.ad_acc_name;
                        adAccountSelect.appendChild(option);
                    });
                });
        }
    });

    // payment method details

    document.getElementById('payment_method').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var details = selectedOption.getAttribute('data-details');
        var detailsParagraph = document.getElementById('payment_details');
        if (details) {
            detailsParagraph.textContent = details;
            document.getElementById('details').classList.remove('d-none');
        } else {
            detailsParagraph.textContent = '';
            document.getElementById('details').classList.add('d-none');
        }
    });

    // Second part: Handling taka to dollar conversion and vice versa
    const takaInput = document.getElementById('taka-input');
    const dollarInput = document.getElementById('dollar-input');
    const dollarRateInput = document.getElementById('dollar-rate-input');

    let conversionRate = dollarRateInput.value; // Default value

    function updateDollar(takaValue) {
        if (isNaN(takaValue)) {
            dollarInput.value = ''; // Clear dollar input if taka is not a number
        } else {
            dollarInput.value = (takaValue / conversionRate).toFixed(2);
        }
    }

    function updateTaka(dollarValue) {
        if (isNaN(dollarValue)) {
            takaInput.value = ''; // Clear taka input if dollar is not a number
        } else {
            takaInput.value = (dollarValue * conversionRate).toFixed(2);
        }
    }

    // First part: Handling ad account selection and fetching dollar rate
    document.getElementById('ad-account-select').addEventListener('change', function() {
        const accountId = this.value;
        const dollarRateInput = document.getElementById('dollar-rate-input');

        // Clear existing value
        dollarRateInput.value = '';
        takaInput.value = '';
        dollarInput.value = '';

        if (accountId) {
            fetch(`/ad-account/${accountId}/details`)
                .then(response => response.json())
                .then(data => {
                    dollarRateInput.value = data.dollar_rate;
                    conversionRate = parseFloat(data.dollar_rate); // Update conversion rate
                });
        }
    });

    takaInput.addEventListener('input', () => {
        updateDollar(takaInput.value);
    });

    dollarInput.addEventListener('input', () => {
        updateTaka(dollarInput.value);
    });


    const screenshotInput = document.getElementById('screenshot');
    const screenshotLabel = document.querySelector('.custom-file-label');

    screenshotInput.addEventListener('change', (event) => {
        const fileName = event.target.files[0].name;
        screenshotLabel.textContent = fileName;
    });
</script>