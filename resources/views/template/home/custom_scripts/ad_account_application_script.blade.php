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

    const domain_input_1 = document.getElementById('domain-input-1');
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

    const fb_input_1 = document.getElementById('fb-input-1');
    const fb_input_2 = document.getElementById('fb-input-2');
    const fb_input_3 = document.getElementById('fb-input-3');
    const fb_input_4 = document.getElementById('fb-input-4');
    const fb_input_5 = document.getElementById('fb-input-5');

    add_1.disabled = true;
    domain_input_1.addEventListener('input', () => {
        if (domain_input_1.value.trim() !== '') {
            add_1.disabled = false;
            domain_input_2.disabled = false;
            add_1.addEventListener('click', () => {
                domain_2.classList.remove("d-none");
                add_1.classList.add("d-none");
            })
        } else {
            domain_input_2.disabled = true;
            add_1.disabled = true;
        }
    });
    const handleAdd1 = () => {
        if (domain_input_1.value.trim() === '') {
            alert('Please enter a Domain before adding another.');
        }
    }

    const handleRemove2 = () => {
        domain_2.classList.add("d-none");
        add_1.classList.remove("d-none");
        domain_input_2.value = "";
    }

    add_2.disabled = true;
    domain_input_2.addEventListener('input', () => {
        if (domain_input_2.value.trim() !== '') {
            add_2.disabled = false;
            domain_input_3.disabled = false;
            add_2.addEventListener('click', () => {
                remove_2.classList.add("d-none");
                domain_3.classList.remove("d-none");
                add_2.classList.add("d-none");
            })
        } else {
            domain_input_3.disabled = true;
            add_2.disabled = true;
        }
    });
    const handleAdd2 = () => {
        if (domain_input_2.value.trim() === '') {
            alert('Please enter a Domain before adding another.');
        }
    }
    
    const handleRemove3 = () => {
        remove_2.classList.remove("d-none");
        domain_3.classList.add("d-none");
        add_2.classList.remove("d-none");
        domain_input_3.value = "";
    }


    plus_1.disabled = true;

    fb_input_1.addEventListener('input', () => {
        if (fb_input_1.value.trim() !== '') {
            plus_1.disabled = false;
            fb_input_2.disabled = false;
            plus_1.addEventListener('click', () => {
                fb_link_2.classList.remove("d-none");
                plus_1.classList.add("d-none");
            })
        } else {
            fb_input_2.disabled = true;
            plus_1.disabled = true;
        }
    });
    const handlePlus1 = () => {
        if (fb_input_1.value.trim() === '') {
            alert('Please enter a Facebook Page Link before adding another.');
        }
    }

    const handleMinus2 = () => {
        fb_link_2.classList.add("d-none");
        plus_1.classList.remove("d-none");
        fb_input_2.value = "";
    }

    plus_2.disabled = true;
    fb_input_2.addEventListener('input', () => {
        if (fb_input_2.value.trim() !== '') {
            fb_input_3.disabled = false;
            plus_2.disabled = false;
            plus_2.addEventListener('click', () => {
                minus_2.classList.add("d-none");
                fb_link_3.classList.remove("d-none");
                plus_2.classList.add("d-none");
            })
        } else {
            fb_input_3.disabled = true;
            plus_2.disabled = true;
        }
    });
    const handlePlus2 = () => {
        if (fb_input_2.value.trim() === '') {
            alert('Please enter a Facebook Page Link before adding another.');
        }
    }

    const handleMinus3 = () => {
        minus_2.classList.remove("d-none");
        fb_link_3.classList.add("d-none");
        plus_2.classList.remove("d-none");
        fb_input_3.value = "";
    }

    plus_3.disabled = true;
    fb_input_3.addEventListener('input', () => {
        if (fb_input_3.value.trim() !== '') {
            fb_input_4.disabled = false;
            plus_3.disabled = false;
            plus_3.addEventListener('click', () => {
                minus_3.classList.add("d-none");
                fb_link_4.classList.remove("d-none");
                plus_3.classList.add("d-none");
            })
        } else {
            fb_input_4.disabled = true;
            plus_3.disabled = true;
        }
    });
    const handlePlus3 = () => {
        if (fb_input_3.value.trim() === '') {
            alert('Please enter a Facebook Page Link before adding another.');
        }
    }
    const handleMinus4 = () => {
        minus_3.classList.remove("d-none");
        fb_link_4.classList.add("d-none");
        plus_3.classList.remove("d-none");
        fb_input_4.value = "";
    }

    plus_4.disabled = true;
    fb_input_4.addEventListener('input', () => {
        if (fb_input_4.value.trim() !== '') {
            fb_input_5.disabled = false;
            plus_4.disabled = false;
            plus_4.addEventListener('click', () => {
                minus_4.classList.add("d-none");
                fb_link_5.classList.remove("d-none");
                plus_4.classList.add("d-none");
            })
        } else {
            fb_input_5.disabled = true;
            plus_4.disabled = true;
        }
    });
    const handlePlus4 = () => {
        if (fb_input_4.value.trim() === '') {
            alert('Please enter a Facebook Page Link before adding another.');
        }
    }
    const handleMinus5 = () => {
        minus_4.classList.remove("d-none");
        fb_link_5.classList.add("d-none");
        plus_4.classList.remove("d-none");
        fb_input_5.value = "";
    }
</script>