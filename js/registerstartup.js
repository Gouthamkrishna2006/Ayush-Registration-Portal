
document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const districtSelect = document.getElementById('district');

    const data = {
        'India': {
            'Andaman and Nicobar Islands' : ["Nicobars", "North and Middle Andaman", "South Andamans"],
            'Maharashtra': ['Mumbai', 'Pune', 'Nagpur'],
            'Karnataka': ['Bengaluru', 'Mysuru', 'Hubli']
        }
    };

    function populateCountryDropdown() {
        for (const country in data) {
            const option = document.createElement('option');
            option.value = country;
            option.textContent = country;
            countrySelect.appendChild(option);
        }
    }

    function populateStateDropdown(country) {
        stateSelect.innerHTML = '<option value="">Select State</option>'; 
        districtSelect.innerHTML = '<option value="">Select District</option>';
        districtSelect.disabled = true;
        stateSelect.disabled = !country;

        if (data[country]) {
            for (const state in data[country]) {
                const option = document.createElement('option');
                option.value = state;
                option.textContent = state;
                stateSelect.appendChild(option);
            }
        }
    }

    function populateDistrictDropdown(state) {
        districtSelect.innerHTML = '<option value="">Select District</option>';
        districtSelect.disabled = !state;

        const country = countrySelect.value;
        if (data[country] && data[country][state]) {
            for (const district of data[country][state]) {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            }
        }
    }

    countrySelect.addEventListener('change', function () {
        populateStateDropdown(this.value);
    });

    stateSelect.addEventListener('change', function () {
        populateDistrictDropdown(this.value);
    });

    populateCountryDropdown();
});
