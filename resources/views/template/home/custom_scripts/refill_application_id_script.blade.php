<script>
    function updateTakaInput() {
        const dollarRate = parseFloat(document.getElementById("dollar-rate-input").value);
        const dollarValue = parseFloat(document.getElementById("dollar-input").value);

        if (!isNaN(dollarRate) && !isNaN(dollarValue)) {
            const takaValue = dollarValue * dollarRate;
            document.getElementById("taka-input").value = takaValue.toFixed(2);
        } else {
            // Handle invalid input gracefully
            document.getElementById("taka-input").value = "";
        }
    }

    function updateDollarInput() {
        const dollarRate = parseFloat(document.getElementById("dollar-rate-input").value);
        const takaValue = parseFloat(document.getElementById("taka-input").value);

        if (!isNaN(dollarRate) && !isNaN(takaValue)) {
            const dollarValue = takaValue / dollarRate;
            document.getElementById("dollar-input").value = dollarValue.toFixed(2);
        } else {
            // Handle invalid input gracefully
            document.getElementById("dollar-input").value = "";
        }
    }

    // Attach event listeners to both input fields
    document.getElementById("dollar-input").addEventListener("input", updateTakaInput);
    document.getElementById("taka-input").addEventListener("input", updateDollarInput);

    // Optionally, handle initial values if dollar-rate-input is pre-populated
    const initialDollarRate = parseFloat(document.getElementById("dollar-rate-input").value);
    if (!isNaN(initialDollarRate)) {
        updateTakaInput(); // Update taka-input based on initial dollar rate
    }


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

    // show screenshot file name

    const screenshotInput = document.getElementById('screenshot');
    const screenshotLabel = document.querySelector('.custom-file-label');

    screenshotInput.addEventListener('change', (event) => {
        const fileName = event.target.files[0].name;
        screenshotLabel.textContent = fileName;
    });
</script>