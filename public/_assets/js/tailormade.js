
document.addEventListener('DOMContentLoaded', function () {
    const formDataKey = 'travelFormData';
    let currentStep = 1;

    const check_in = document.getElementById('check_in');
    const check_out = document.getElementById('check_out');
    const month_select = document.getElementById('month_select');
    const days_select = document.getElementById('days_select');
    const full_name = document.getElementById('full_name');
    const input_email = document.getElementById('input_email');
    const phone_code = document.getElementById('phone_code');
    const phone_number = document.getElementById('phone_number');
    const hotel_input = document.getElementById('hotel-input');
    const adult_count = document.getElementById('adult_count');
    const children_count = document.getElementById('children_count');
    const infant_count = document.getElementById('infant_count');
    const price_min = document.getElementById('price_min');
    const price_max = document.getElementById('price_max');
    const confirmName = document.querySelector('.confirm-name');

    const selectCity = document.getElementById('selectCity');
    const selectedDates = document.getElementById('selectedDates');
    const selectedDays = document.getElementById('selectedDays');
    const fullName = document.getElementById('travelerFullName');
    const email = document.getElementById('travelerEmail');
    const phoneNumber = document.getElementById('travelerPhoneNumber');
    const travelerPlaces = document.getElementById('travelerPlaces');
    const hotels = document.getElementById('hotels');
    const travelerNumbers = document.getElementById('travelerNumbers');
    const travelerPrices = document.getElementById('travelerPrices');

    // ======================== Functions ========================
    function showStep(step) {
        document.querySelectorAll('.form-step').forEach(el => el.classList.add('d-none'));
        document.querySelector(`.step-${step}-content`).classList.remove('d-none');

        document.querySelectorAll('.step-nav div').forEach(el => el.classList.remove('active'));
        const activeTab = document.querySelector(`.step-nav .step-${step}`);
        if (activeTab) activeTab.classList.add('active');

        activeTab?.scrollIntoView({ behavior: "smooth", inline: "center", block: "nearest" });
        validateStepFields();
    }

    function areFieldsFilled(fields) {
        return [...fields].every(field => {
            if (field.type === "radio") {
                const group = document.querySelectorAll(`input[name="${field.name}"]`);
                return [...group].some(radio => radio.checked);
            }
            return field.value && field.value.trim() !== '';
        });
    }

    function getRequiredFieldsForCurrentStep() {
        if (currentStep === 2) {
            const activeBox = document.querySelector('.tab-box:not(.d-none)');
            return activeBox ? activeBox.querySelectorAll('.required-field') : [];
        } else {
            const currentStepEl = document.querySelector(`.step-${currentStep}-content`);
            return currentStepEl.querySelectorAll('.required-field');
        }
    }

    function updateSelectedCities() {
        const checkedCityInputs = document.querySelectorAll('.city-box input[type="checkbox"]:checked');
        const selectedCities = Array.from(checkedCityInputs)
            .map(input => input.value || input.nextElementSibling?.textContent?.trim() || 'Unknown City')
            .join(', ');

        if (selectCity) selectCity.textContent = selectedCities || "No city selected";
        saveFormData();
        return selectedCities;
    }

    function saveFormData() {
        const checkedCityInputs = document.querySelectorAll('.city-box input[type="checkbox"]:checked');
        const selectedCities = Array.from(checkedCityInputs)
            .map(input => input.value || input.nextElementSibling?.textContent?.trim() || 'Unknown City');

        const data = {
            check_in: check_in.value,
            check_out: check_out.value,
            month_select: month_select.value,
            days_select: days_select.value,
            full_name: full_name.value,
            input_email: input_email.value,
            phone_code: phone_code.value,
            phone_number: phone_number.value,
            selected_cities: selectedCities,
            hotel_input: hotel_input.value,
            adult_count: adult_count.value,
            children_count: children_count.value,
            infant_count: infant_count.value,
            price_min: price_min.value,
            price_max: price_max.value
        };
        updateSummary(data);
    
    }

    function loadFormData() {
        
        const savedData = {}; 

        check_in.value = savedData.check_in || '';
        check_out.value = savedData.check_out || '';
        month_select.value = savedData.month_select || '';
        days_select.value = savedData.days_select || '';
        full_name.value = savedData.full_name || '';
        input_email.value = savedData.input_email || '';
        phone_code.value = savedData.phone_code || '';
        phone_number.value = savedData.phone_number || '';
        hotel_input.value = savedData.hotel_input || '';
        adult_count.value = savedData.adult_count || '0';
        children_count.value = savedData.children_count || '0';
        infant_count.value = savedData.infant_count || '0';
        price_min.value = savedData.price_min || '0';
        price_max.value = savedData.price_max || '0';

        // Restore cities
        if (savedData.selected_cities && Array.isArray(savedData.selected_cities)) {
            const cityInputs = document.querySelectorAll('.city-box input[type="checkbox"]');
            cityInputs.forEach(input => {
                const cityValue = input.value || input.nextElementSibling?.textContent?.trim();
                if (savedData.selected_cities.includes(cityValue)) {
                    input.checked = true;
                    input.closest('.city-box')?.classList.add('active');
                }
            });
        }
        updateSummary(savedData);
        updateSelectedCities();
    }

    function setSummaryValue(el, value) {
        if (value && value.trim() !== "") {
            el.parentElement.style.display = "flex";
            el.textContent = value;
            return true;
        } else {
            el.parentElement.style.display = "none";
            return false;
        }
    }

    function updateSummary(data) {
        if (!data) return;

        let hasData = false;

        if (data.selected_cities && data.selected_cities.length > 0) {
            if (setSummaryValue(selectCity, data.selected_cities.join(', '))) hasData = true;
        }

        if (data.check_in && data.check_out) {
            selectedDates.textContent = `${data.check_in} to ${data.check_out}`;
            selectedDates.parentElement.style.display = "flex";
            hasData = true;
        } else if (data.month_select) {
            selectedDates.textContent = data.month_select;
            selectedDates.parentElement.style.display = "flex";
            hasData = true;
        } else {
            selectedDates.parentElement.style.display = "none";
        }

        if (setSummaryValue(selectedDays, data.days_select)) hasData = true;
        if (setSummaryValue(fullName, data.full_name)) hasData = true;
        if (setSummaryValue(email, data.input_email)) hasData = true;

        let phoneVal = `${data.phone_code || ""} ${data.phone_number || ""}`.trim();
        if (setSummaryValue(phoneNumber, phoneVal)) hasData = true;
        if (setSummaryValue(hotels, data.hotel_input)) hasData = true;

        let numbers = [];
        if (data.adult_count && data.adult_count !== "0") numbers.push(`<i class="fa-solid fa-user"></i> ${data.adult_count} Adults <br/>`);
        if (data.children_count && data.children_count !== "0") numbers.push(`<i class="fa-solid fa-child"></i>  ${data.children_count} Children <br/>`);
        if (data.infant_count && data.infant_count !== "0") numbers.push(`<i class="fa-solid fa-baby-carriage"></i>  ${data.infant_count} Infants <br/>`);

        if (numbers.length) {
            travelerNumbers.innerHTML = numbers.join(", ");
            travelerNumbers.parentElement.style.display = "flex";
            hasData = true;
        } else {
            travelerNumbers.parentElement.style.display = "none";
        }

        if ((data.price_min && data.price_min !== "0") || (data.price_max && data.price_max !== "0")) {
            travelerPrices.innerHTML = `${data.price_min} USD - ${data.price_max} USD`;
            travelerPrices.parentElement.style.display = "flex";
            hasData = true;
        } else {
            travelerPrices.parentElement.style.display = "none";
        }

        // Show/hide summary
        if (currentStep === 1) {
            const hasSelectedCities = data.selected_cities && data.selected_cities.length > 0;
            document.getElementById('trip-initial').style.display = hasSelectedCities ? 'none' : 'block';
            document.getElementById('trip-summary').style.display = hasSelectedCities ? 'block' : 'none';
        } else {
            document.getElementById('trip-initial').style.display = hasData ? 'none' : 'block';
            document.getElementById('trip-summary').style.display = hasData ? 'block' : 'none';
        }
    }

    function validateStepFields() {
        const nextBtn = document.querySelector(`.step-${currentStep}-content .custom-btn`);
        if (!nextBtn) return;

        if (currentStep === 1) {
            const checkedCityInputs = document.querySelectorAll('.city-box input[type="checkbox"]:checked');
            if (checkedCityInputs.length > 0) {
                nextBtn.removeAttribute("disabled");
                document.getElementById("trip-initial").style.display = "none";
                document.getElementById("trip-summary").style.display = "block";
            } else {
                nextBtn.setAttribute("disabled", true);
                document.getElementById("trip-initial").style.display = "block";
                document.getElementById("trip-summary").style.display = "none";
            }
            updateSelectedCities();

        } else if (currentStep === 2) {
            const radios = document.querySelectorAll('input[name="time_option"]');
            const selected = [...radios].some(r => r.checked);
            if (!selected) { nextBtn.setAttribute("disabled", true); return; }

            const activeBox = document.querySelector(".tab-box:not(.d-none)");
            if (activeBox) {
                const requiredFields = activeBox.querySelectorAll(".required-field");
                if ([...requiredFields].every(f => f.value.trim() !== "")) nextBtn.removeAttribute("disabled");
                else nextBtn.setAttribute("disabled", true);
            } else nextBtn.removeAttribute("disabled");

        } else {
            const requiredFields = getRequiredFieldsForCurrentStep();
            if (areFieldsFilled(requiredFields)) nextBtn.removeAttribute("disabled");
            else nextBtn.setAttribute("disabled", "disabled");
        }
    }

    window.nextStep = function () {
        const requiredFields = getRequiredFieldsForCurrentStep();
        if (!areFieldsFilled(requiredFields)) { alert("Please fill all required fields."); return; }

        if (currentStep < 5) {
            currentStep++;
            showStep(currentStep);
            saveFormData();
            updateSummary();
            validateStepFields();
        }
        if (currentStep === 5) confirmName.textContent = full_name.value;
    };

    window.prevStep = function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            updateSummary();
        }
    };

    // ======================== Event Listeners ========================
    document.querySelectorAll('#check_in, #check_out, #month_select, #days_select, #full_name, #input_email, #phone_code, #phone_number, #prefer_places, #hotel-input, #adult_count, #children_count, #infant_count, #price_min, #price_max')
        .forEach(el => {
            el.addEventListener('input', () => { saveFormData(); validateStepFields(); });
            el.addEventListener('change', () => { saveFormData(); validateStepFields(); });
        });

    document.querySelectorAll('.pickup-times .nav-link').forEach(tab => {
        tab.addEventListener('click', () => setTimeout(validateStepFields, 100));
    });

    document.querySelectorAll('.city-box input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', function () {
            if (this.checked) this.closest('.city-box')?.classList.add('active');
            else this.closest('.city-box')?.classList.remove('active');
            validateStepFields();
            updateSelectedCities();
        });
    });

    document.querySelectorAll('.city-box label').forEach(label => {
        label.addEventListener('click', () => {
            setTimeout(() => {
                const checkbox = label.previousElementSibling || label.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    if (checkbox.checked) label.closest('.city-box')?.classList.add('active');
                    else label.closest('.city-box')?.classList.remove('active');
                    validateStepFields();
                    updateSelectedCities();
                }
            }, 10);
        });
    });

    loadFormData();
    showStep(currentStep);
    updateSelectedCities();
});

document.addEventListener("DOMContentLoaded", function () {
    const inputDate = document.querySelectorAll(".exact-date input")
    inputDate.forEach(input => {
        input.addEventListener('change', function (e) {
            nextInput = input.parentElement.nextElementSibling?.querySelector('input')
            nextInput.flatpickr().open();
        });
    }
    )
});

const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);

        if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
            if (e.target.className === "input-min") {
                rangeInput[0].value = minPrice;
                range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
            } else {
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if (e.target.className === "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("input[type='date']").forEach(function (el) {
        flatpickr(el, {
            minDate: "today"
        });
    });
    document.querySelectorAll("#month-box input").forEach(function (el) {
        flatpickr(el, {
            plugins: [
                new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "F Y",
                    altFormat: "F Y",
                    theme: "light"
                })
            ]
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const minusBtn = counter.querySelector('.minus');
        const plusBtn = counter.querySelector('.plus');
        const input = counter.querySelector('.count');
        const min = parseInt(input.getAttribute('min'));
        const max = parseInt(input.getAttribute('max'));

        function updateButtons() {
            const value = parseInt(input.value);
            minusBtn.disabled = value <= min;
            plusBtn.disabled = value >= max;
        }

        function animateValue() {
            input.classList.add('changed');
            setTimeout(() => {
                input.classList.remove('changed');
            }, 300);
        }

        minusBtn.addEventListener('click', function () {
            const currentValue = parseInt(input.value);
            if (currentValue > min) {
                input.value = currentValue - 1;
                updateButtons();
                animateValue();
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        plusBtn.addEventListener('click', function () {
            const currentValue = parseInt(input.value);
            if (currentValue < max) {
                input.value = currentValue + 1;
                updateButtons();
                animateValue();
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        updateButtons();
    });

});

document.querySelectorAll('.option-radio').forEach(radio => {
    radio.addEventListener('change', function () {
        document.querySelectorAll('.tab-box').forEach(box => box.classList.add('d-none'));
        if (this.checked) {
            const target = document.querySelector(this.dataset.target);
            target.classList.remove('d-none');
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[name="time_option"]');
    const nextBtn = document.querySelector('.step-2-content .custom-btn');

    radios.forEach(radio => {
        radio.addEventListener("change", function () {n
            nextBtn.disabled = false;
        });
    });
    radios.forEach(radio => {
        radio.addEventListener("change", function () {
            nextBtn.disabled = false;
        });
    });

});


function areFieldsFilled(fields) {
    return [...fields].every(field => {
        if (field.type === "radio") {
            const group = document.querySelectorAll(`input[name="${field.name}"]`);
            return [...group].some(radio => radio.checked);
        }
        return field.value && field.value.trim() !== '';
    });
}


document.addEventListener("DOMContentLoaded", function () {
    const step2NextBtn = document.querySelector(".step-2-content .custom-btn");
    const radios = document.querySelectorAll('input[name="time_option"]');

    function validateStep2() {
        const selectedRadio = document.querySelector('input[name="time_option"]:checked');
        if (!selectedRadio) {
            step2NextBtn.setAttribute("disabled", true);
            return;
        }

        const activeBox = document.querySelector('.tab-box:not(.d-none)');
        if (activeBox) {
            const requiredFields = activeBox.querySelectorAll(".required-field");
            const allFilled = [...requiredFields].every(field => field.value.trim() !== "");
            if (allFilled) {
                step2NextBtn.removeAttribute("disabled");
            } else {
                step2NextBtn.setAttribute("disabled", true);
            }
        } else {
            step2NextBtn.removeAttribute("disabled");
        }
    }


    radios.forEach(radio => radio.addEventListener("change", validateStep2));
    document.querySelectorAll(".tab-box .required-field").forEach(input => {
        input.addEventListener("input", validateStep2);
        input.addEventListener("change", validateStep2);
    });

    validateStep2();
});




        flatpickr("#month-picker", {
            dateFormat: "Y-m", // القيمة التي تُرسل

            plugins: [
                new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: "m-Y",
                    altFormat: "F Y"
                })
            ]
        });
    