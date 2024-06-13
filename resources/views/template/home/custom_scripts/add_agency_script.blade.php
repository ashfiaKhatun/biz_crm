<script>
    const dollar = document.getElementById('dollar_rate');
    const percentage = document.getElementById('percentage_rate');
    const dollarInput = document.getElementById('dollar_input');
    const percentageInput = document.getElementById('percentage_input');
    const commissionType = document.getElementById('commission_type');

    const handleSelection = () => {
        const selectedValue = commissionType.value;
        if (selectedValue === "Dollar Rate") {
            dollar.classList.remove("d-none");
            percentage.classList.add("d-none");
            percentageInput.value = "";
        } else if (selectedValue === "Percentage") {
            percentage.classList.remove("d-none");
            dollar.classList.add("d-none");
            dollarInput.value = "";
        } else {
            // Hide both inputs if "Select" is chosen
            dollar.classList.add("d-none");
            percentage.classList.add("d-none");

        }
    };

    // Attach event listener to the dropdown on page load
    commissionType.addEventListener('change', handleSelection);

    // Optional: Call handleSelection initially to handle initial state
    handleSelection();

    const checkbox = document.querySelector('.form-check-input');
    const commissionTypeSelect = document.getElementById('commission-type-sect');

    // Initial state based on checkbox checked state (optional)
    commissionTypeSelect.style.display = checkbox.checked ? 'none' : 'block';

    checkbox.addEventListener('click', () => {
        commissionTypeSelect.style.display = checkbox.checked ? 'none' : 'block';
        dollarInput.value = "";
        percentageInput.value = "";
        commissionType.value = "";
        dollar.classList.add("d-none");
        percentage.classList.add("d-none");
    });
</script>