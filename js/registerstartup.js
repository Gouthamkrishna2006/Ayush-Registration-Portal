document.addEventListener('DOMContentLoaded', function () {
    const stateSelect = document.getElementById('state');
    const districtSelect = document.getElementById('district');

    const data = {
        'Maharashtra': ['Mumbai', 'Pune', 'Nagpur'],
        'Karnataka': ['Bengaluru', 'Mysuru', 'Hubli'],
        'Andaman and Nicobar Islands': ["Nicobars", "North and Middle Andaman", "South Andamans"]
    };

    function populateStateDropdown() {
        for (const state in data) {
            const option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);
        }
    }

    function populateDistrictDropdown(state) {
        districtSelect.innerHTML = '<option value="">Select District</option>';
        districtSelect.disabled = !state;

        if (data[state]) {
            for (const district of data[state]) {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            }
        }
    }

    stateSelect.addEventListener('change', function () {
        populateDistrictDropdown(this.value);
    });

    populateStateDropdown();
});

const fileInput = document.getElementById('file-upload');
const fileNameDisplay = document.getElementById('file-name');

fileInput.addEventListener('change', function() {
    if (fileInput.files.length > 0) {
        fileNameDisplay.textContent = `Selected file: ${fileInput.files[0].name}`;
    } else {
        fileNameDisplay.textContent = 'No file chosen';
    }
});
