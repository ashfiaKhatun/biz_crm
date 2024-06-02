<script>
    //agency type select start
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

    // agency type select end

    const add_1 = document.getElementById('add-1');
    const add_2 = document.getElementById('add-2');

    const remove_2 = document.getElementById('remove-2');
    const remove_3 = document.getElementById('remove-3');

    const domain_2 = document.getElementById('domain-2');
    const domain_3 = document.getElementById('domain-3');

    const domain_input_2 = document.getElementById('domain-input-2');
    const domain_input_3 = document.getElementById('domain-input-3');



    const plus_1 = document.getElementById('plus-1');
    const plus_2 = document.getElementById('plus-2');
    const plus_3 = document.getElementById('plus-3');
    const plus_4 = document.getElementById('plus-4');

    const minus_2 = document.getElementById('minus-2');
    const minus_3 = document.getElementById('minus-3');
    const minus_4 = document.getElementById('minus-4');
    const minus_5 = document.getElementById('minus-5');

    const fb_link_2 = document.getElementById('fb-link-2');
    const fb_link_3 = document.getElementById('fb-link-3');
    const fb_link_4 = document.getElementById('fb-link-4');
    const fb_link_5 = document.getElementById('fb-link-5');

    const fb_input_2 = document.getElementById('fb-input-2');
    const fb_input_3 = document.getElementById('fb-input-3');
    const fb_input_4 = document.getElementById('fb-input-4');
    const fb_input_5 = document.getElementById('fb-input-5');

    const handleAdd1 = () => {
        domain_2.classList.remove("d-none");
        add_1.classList.add("d-none");
    }
    const handleRemove2 = () => {
        domain_2.classList.add("d-none");
        add_1.classList.remove("d-none");
        domain_input_2.value = "";
    }
    const handleAdd2 = () => {
        remove_2.classList.add("d-none");
        domain_3.classList.remove("d-none");
        add_2.classList.add("d-none");
    }
    const handleRemove3 = () => {
        remove_2.classList.remove("d-none");
        domain_3.classList.add("d-none");
        add_2.classList.remove("d-none");
        domain_input_3.value = "";
    }



    const handlePlus1 = () => {
        fb_link_2.classList.remove("d-none");
        plus_1.classList.add("d-none");
    }
    const handleMinus2 = () => {
        fb_link_2.classList.add("d-none");
        plus_1.classList.remove("d-none");
        fb_input_2.value = "";
    }

    const handlePlus2 = () => {
        minus_2.classList.add("d-none");
        fb_link_3.classList.remove("d-none");
        plus_2.classList.add("d-none");
    }
    const handleMinus3 = () => {
        minus_2.classList.remove("d-none");
        fb_link_3.classList.add("d-none");
        plus_2.classList.remove("d-none");
        fb_input_3.value = "";
    }

    const handlePlus3 = () => {
        minus_3.classList.add("d-none");
        fb_link_4.classList.remove("d-none");
        plus_3.classList.add("d-none");
    }
    const handleMinus4 = () => {
        minus_3.classList.remove("d-none");
        fb_link_4.classList.add("d-none");
        plus_3.classList.remove("d-none");
        fb_input_4.value = "";
    }

    const handlePlus4 = () => {
        minus_4.classList.add("d-none");
        fb_link_5.classList.remove("d-none");
        plus_4.classList.add("d-none");
    }
    const handleMinus5 = () => {
        minus_4.classList.remove("d-none");
        fb_link_5.classList.add("d-none");
        plus_4.classList.remove("d-none");
        fb_input_5.value = "";
    }
</script>