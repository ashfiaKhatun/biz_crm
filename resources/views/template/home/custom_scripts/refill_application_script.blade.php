<script>
        const takaInput = document.getElementById('taka-input');
        const dollarInput = document.getElementById('dollar-input');

        const conversionRate = 115; // Adjust this value as needed

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

        takaInput.addEventListener('input', () => {
            updateDollar(takaInput.value);
        });

        dollarInput.addEventListener('input', () => {
            updateTaka(dollarInput.value);
        });
    </script>