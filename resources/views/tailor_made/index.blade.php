@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('tailor_made_meta_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('tailor_made_meta_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('tailor_made_meta_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('tailor_made_section_banner')),
        'schema' => nova_get_setting('tailor_made_schema'),
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailorMade.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ Storage::url(nova_get_setting('tailor_made_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('tailor_made_title', env('APP_NAME')) }}
                        </h1>
                        <ul class="breadcrumb-link" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="{{ url('/') }}">
                                    <span itemprop="name">
                                        {{ __('general.home') }}
                                    </span>
                                </a>
                                <meta itemprop="position" content="1" />
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active"
                                aria-current="page">
                                <span itemprop="name">
                                    {{ nova_get_setting_translate('tailor_made_title', env('APP_NAME')) }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tailor-made-steps padtobo-40">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">
                    <div class="transfer-form-wrapper">
                        <div class="step-nav">
                            <div class="step-1 active">
                                <i class="fa-solid fa-check"></i>
                                <span>
                                    {{ __('tailorMade.city') }}
                                </span>
                            </div>
                            <div class="step-2">
                                <i class="fa-solid fa-check"></i>
                                <span> {{ __('tailorMade.date') }} </span>
                            </div>
                            <!-- <div class="step-3">
                                                                    <i class="fa-solid fa-check"></i>
                                                                    <span>Price Customization</span>
                                                                </div> -->
                            <div class="step-3">
                                <i class="fa-solid fa-check"></i>
                                <span>
                                    {{ __('tailorMade.price_customization') }}
                                </span>

                            </div>

                            <div class="step-4">
                                <i class="fa-solid fa-check"></i>
                                <span>{{ __('tailorMade.confirmation') }}</span>
                            </div>
                        </div>
                        <form id="transferForm" action="{{ route('tailorMade.store') }}" method="POST">
                            @csrf
                            <!-- Step 1 -->
                            <div class="form-step step-1-content">

                                <div class="city-wrapper">
                                    @foreach ($cities as $city)
                                        <div class="city-box">
                                            <input type="checkbox" value="{{ $city->name }}" id="{{ $city->name }}"
                                                class="city-check" name="cities[]">
                                            <label for="{{ $city->name }}" class="nice-label">
                                                <img src="{{ $city->getFirstMediaUrlOrDefault(MediaHelper::CITY_MEDIA_PATH, 'webp')['url'] }}"
                                                    alt="city Icon">
                                                <p class="mb-0">{{ $city->name }}</p>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-end">
                                    <button type="button" class="custom-btn" disabled onclick="nextStep()">
                                        {{ __('tailorMade.next') }}
                                    </button>
                                </div>
                            </div>
                            <!-- Step 2 -->
                            <div class="form-step step-2-content d-none">

                                <ul class="nav nav-tabs tab-buttons mb-3 pickup-times nav_form-step" role="tablist">

                                    <!-- Exact Time -->
                                    <li class="nav-item ">
                                        <label class="nav-link">
                                            <input type="radio" name="time_option" class=" option-radio required-field"
                                                data-target="#exact-time-box" value="exact_time">
                                            <img src="assets/images/stop-watch.svg" alt="exact-time">
                                            <span>
                                                {{ __('tailorMade.exact_time') }}
                                            </span>
                                        </label>


                                        <div id="exact-time-box" class="exact-date tab-box tab_box d-none mt-3">
                                            <div class="input-box exact-date">
                                                <input type="date" id="check_in" class="required-field"
                                                    name="start_date">
                                                <label for="check_in">
                                                    {{ __('tailorMade.check_in_date') }}
                                                </label>
                                            </div>
                                            <div class="input-box exact-date">
                                                <input type="date" id="check_out" class="required-field" name="end_date">
                                                <label for="check_out">
                                                    {{ __('tailorMade.check_out_date') }}
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Approximate Month -->
                                    <li class="nav-item ">
                                        <label class="nav-link">
                                            <input type="radio" name="time_option" class=" option-radio required-field"
                                                data-target="#month-box" value="approximate_month">
                                            <img src="assets/images/approximate.svg" alt="approximate">
                                            <span>
                                                {{ __('tailorMade.approximate_month') }}
                                            </span>
                                        </label>
                                        <div id="month-box" class="tab-box d-none mt-3">
                                            <div class="input-box">
                                                <!-- <input type="date" name="return_time" id="month_select"
                                                                        class="required-field" required
                                                                        title="Select your approximate return month"> -->

                                                <input type="text" name="month" id="month_select"
                                                    class="required-field flatpickr-input active" required=""
                                                    title="Select your approximate return month" readonly="readonly">
                                                <label for="month_select">
                                                    {{ __('tailorMade.return_time') }}
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Not Sure Yet -->
                                    <li class="nav-item  ">
                                        <label class="nav-link">
                                            <input type="radio" name="time_option" class=" option-radio required-field"
                                                data-target="#days-box" value="not_sure_yet">
                                            <img src="assets/images/not-sure-yet.svg" alt="not-sure">
                                            <span>
                                                {{ __('tailorMade.not_sure_yet') }}
                                            </span>
                                        </label>
                                        <div id="days-box" class="tab-box d-none mt-3">
                                            <div class="input-box">
                                                <input type="number" name="days" id="days_select"
                                                    class="required-field">
                                                <label for="days_select">
                                                    {{ __('tailorMade.select_number_of_vacation_days') }}
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                </ul>

                                <div class="steps-cta">
                                    <button type="button" class="custom_btn" onclick="prevStep()">
                                        {{ __('tailorMade.back') }}
                                    </button>
                                    <button type="button" class="custom-btn" disabled onclick="nextStep()">
                                        {{ __('tailorMade.next') }}
                                    </button>
                                </div>
                            </div>
                            <!-- Step 3 -->
                            <div class="form-step step-3-content d-none">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-box mb-3">
                                            <input type="text" name="full_name" id="full_name" class="required-field"
                                                placeholder="Enter your full name" maxlength="100" title="Your full name"
                                                required>
                                            <label class="form-label" for="full_name">
                                                {{ __('tailorMade.full_name') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-box mb-3">
                                            <input type="email" name="email" id="input_email" class="required-field"
                                                placeholder="Enter your email address" maxlength="100"
                                                title="Your email address" required>
                                            <label class="form-label" for="input_email">
                                                {{ __('tailorMade.email') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="phone-number">
                                            <select name="phone_code" id="phone_code" class="form-select"
                                                aria-label="Select your country phone code" title="Country phone code">
                                                @include('layout.partials.code-phone')
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="phone-number">

                                            <div class="input-box">
                                                <input type="number" name="phone_number" id="phone_number"
                                                    class="required-field" placeholder="Enter your phone number"
                                                    minlength="7" maxlength="15" title="Your phone number" required>
                                                <label class="form-label" for="phone_number">
                                                    {{ __('tailorMade.phone_number') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-box mb-3">
                                            <div class="form-item mb-20">
                                                <select name="nationality" id="nationality" class="form-select"
                                                    aria-label="Select your nationality" title="Your nationality">
                                                    @include('layout.partials.countries')
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-box mb-3">
                                            <div class="form-item mb-20">
                                                <select name="hotel" id="hotel-input" class="form-select"
                                                    aria-label="Select your hotel" title="Your hotel">
                                                    <option value="" selected disabled>
                                                        {{ __('tailorMade.hotel') }}
                                                    </option>
                                                    <option value="{{ __('tailorMade.hotel_5_stars') }}">
                                                        {{ __('tailorMade.hotel_5_stars') }}
                                                    </option>
                                                    <option value="{{ __('tailorMade.hotel_4_stars') }}">
                                                        {{ __('tailorMade.hotel_4_stars') }}
                                                    </option>
                                                    <option value="{{ __('tailorMade.hotel_3_stars') }}">
                                                        {{ __('tailorMade.hotel_3_stars') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="price-table">
                                    <div class="guest-count">
                                        <div class="tailor-adult">
                                            <div class="guest-adult-option">
                                                <span>
                                                    {{ __('tailorMade.adult') }}
                                                </span>
                                                <div class="counter">

                                                    <button type="button" class="minus">-</button>
                                                    <input type="number" class="count" name="adult"
                                                        data-type="adult" id="adult_count" value="0" min="0"
                                                        max="10" aria-label="Adults">
                                                    <button type="button" class="plus">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tailor-children">
                                            <div class="guest-children-option">
                                                <span>
                                                    {{ __('tailorMade.children') }}
                                                </span>
                                                <div class="counter">

                                                    <button type="button" class="minus">-</button>
                                                    <input type="number" class="count" name="children"
                                                        id="children_count" data-type="children" value="0"
                                                        min="0" max="10" aria-label="Children">
                                                    <button type="button" class="plus">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tailor-infant">
                                            <div class="guest-infant-option">
                                                <span>
                                                    {{ __('tailorMade.infant') }}
                                                </span>
                                                <div class="counter">

                                                    <button type="button" class="minus">-</button>
                                                    <input type="number" class="count" name="infant"
                                                        data-type="infant" id="infant_count" value="0"
                                                        min="0" max="10" aria-label="Infants">
                                                    <button type="button" class="plus">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrapper">
                                        <h3>
                                            {{ __('tailorMade.price_range') }}
                                        </h3>
                                        <div class="price-input">
                                            <div class="field">
                                                <span>
                                                    {{ __('tailorMade.min') }}
                                                </span>
                                                <input type="number" id="price_min" class="input-min" value=""
                                                    aria-label="Minimum price">
                                            </div>
                                            <div class="separator">-</div>
                                            <div class="field">
                                                <span>
                                                    {{ __('tailorMade.max') }}
                                                </span>
                                                <input type="number" id="price_max" class="input-max" value=""
                                                    aria-label="Maximum price">
                                            </div>
                                        </div>
                                        <div class="slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" class="range-min" id="price_range_min"
                                                name="price_range_min" min="0" max="10000" value="2500"
                                                step="100" aria-label="Price range minimum">
                                            <input type="range" class="range-max" id="price_range_max"
                                                name="price_range_max" min="0" max="10000" value="7500"
                                                step="100" aria-label="Price range maximum">
                                        </div>
                                    </div>
                                </div>

                                <div class="input-box mb-3">
                                    <textarea name="notes" id="additional_info" cols="30" rows="4"
                                        placeholder="{{ __('tailorMade.additional_info_placeholder') }}" maxlength="500"
                                        title="Additional trip information"></textarea>
                                    <label class="form-label" for="additional_info">
                                        {{ __('tailorMade.additional_info') }}
                                    </label>
                                </div>
                                <div class="steps-cta">
                                    <button type="button" class="custom_btn" onclick="prevStep()">
                                        {{ __('tailorMade.back') }}
                                    </button>
                                    <button type="button" class="custom-btn" disabled onclick="nextStep()">
                                        {{ __('tailorMade.next') }}
                                    </button>
                                </div>
                            </div>
                            <!-- Step 4 -->
                            <div class="form-step step-4-content d-none">
                                <p>
                                    {{ __('tailorMade.confirmation') }}
                                </p>
                                <p class="confirm-message">
                                    {{ __('tailorMade.confirmation_message') }}
                                    <span class="confirm-name"></span>
                                    {{ __('tailorMade.confirmation_message2') }}
                                </p>
                                <div class="steps-cta">
                                    <button type="button" class="custom-btn btn-effect" onclick="prevStep()">
                                        {{ __('tailorMade.back') }}
                                    </button>
                                    <button type="submit" class="custom-btn">
                                        {{ __('tailorMade.submit') }}
                                    </button>
                                </div>
                            </div>
                            <div class="error-message">

                            </div>
                    </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="tailor-made-sidebar">
                        <div id="trip-initial" class="trip-initial trip_initial">
                            <div class="trip-init-img">
                                <img loading="lazy" src="{{ Storage::url(nova_get_setting('tailor_made_img')) }}"
                                    alt="trip-init-img">
                                <div class="trip-init-img-overlay">
                                    <!-- <img loading="lazy" src="assets/images/tailor-travel.svg" alt="tailor-trip"> -->
                                    <span>
                                        {{ nova_get_setting_translate('tailor_made_title') }}
                                    </span>
                                </div>
                            </div>
                            <p>
                                {!! nova_get_setting_translate('tailor_made_short_description') !!}
                            </p>
                        </div>
                        <div id="trip-summary" class="trip-summary" style=" display: none;">
                            <div class="summary-heading">
                                <img src="{{ Storage::url(nova_get_setting('tailor_made_img')) }}" alt="travel-trip"
                                    title="travel-trip">
                                <div class="summary-title">
                                    <h3 class="summary-head">
                                        {{ nova_get_setting_translate('tailor_made_title') }}
                                    </h3>
                                </div>
                            </div>
                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-calendar-day"></i>
                                    {{ __('tailorMade.selected_city') }} :</span>
                                <span id="selectCity">
                                    {{ __('tailorMade.no_city') }}
                                </span>
                            </div>
                            {{-- Exact Time
                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-calendar-day"></i>
                                    {{ __('tailorMade.dates') }}:</span>
                                <span id="selectedmonth">
                                    {{ __('tailorMade.no_date') }}
                                </span>
                            </div>
                              Approximate Month

                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-calendar-day"></i>
                                    {{ __('tailorMade.dates') }}:</span>
                                <span id="selectedDates">
                                    {{ __('tailorMade.no_date') }}
                                </span>
                            </div>
                             Not Sure Yet


                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-calendar-alt"></i>
                                    {{ __('tailorMade.number_of_days') }}:</span>
                                <span id="selectedDays">
                                    {{ __('tailorMade.no_days') }}
                                </span>
                            </div> --}}

                            {{--  Exact Time  --}}
                            <div class="summary-box">
                                <span class="summary-item">
                                    <i class="fas fa-calendar-day"></i>
                                    {{ __('tailorMade.dates') }}:
                                </span>
                                <span id="selectedDates">
                                    {{ __('tailorMade.no_date') }}
                                </span>
                            </div>

                            {{--  Approximate Month  --}}
                            <div class="summary-box">
                                <span class="summary-item">
                                    <i class="fas fa-calendar-day"></i>
                                    {{ __('tailorMade.month') }}:
                                </span>
                                <span id="selectedmonth">
                                    {{ __('tailorMade.no_date') }}
                                </span>
                            </div>

                            {{--  Not Sure Yet  --}}
                            <div class="summary-box">
                                <span class="summary-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ __('tailorMade.number_of_days') }}:
                                </span>
                                <span id="selectedDays">
                                    {{ __('tailorMade.no_days') }}
                                </span>
                            </div>



                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-user"></i>
                                    {{ __('tailorMade.full_name') }}:</span>
                                <span id="travelerFullName">
                                    {{ __('tailorMade.no_name') }}
                                </span>
                            </div>
                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-envelope"></i>
                                    {{ __('tailorMade.travelers_email') }}:</span>
                                <span id="travelerEmail">
                                    {{ __('tailorMade.not_selected') }}
                                </span>
                            </div>
                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-phone"></i>
                                    {{ __('tailorMade.phone_number') }}</span>
                                <span id="travelerPhoneNumber">
                                    {{ __('tailorMade.not_selected') }}
                                </span>
                            </div>


                            <div class="summary-box">
                                <span class="summary-item">
                                    {{ __('tailorMade.nationality') }}
                                </span>
                                <span id="summary_nationality">
                                    {{ __('tailorMade.not_selected') }}
                                </span>
                            </div>

                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-hotel"></i>
                                    {{ __('tailorMade.hotel') }}
                                </span>
                                <span id="hotels">
                                    {{ __('tailorMade.not_selected') }}
                                </span>
                            </div>
                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-users"></i>
                                    {{ __('tailorMade.number_of_travelers') }}
                                </span>
                                <span id="travelerNumbers">1 {{ __('tailorMade.person') }}</span>
                            </div>
                            <div class="summary-box">
                                <span class="summary-item"><i class="fas fa-dollar-sign"></i>
                                    {{ __('tailorMade.price_range') }}
                                </span>
                                <span id="travelerPrices">
                                    {{ __('tailorMade.not_selected') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('layout.partials.faqs')
@endsection
@section('extraScripts')
    <script type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <script src="{{ asset('assets/js/tailorMade.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rangeInput = document.querySelectorAll(".range-input input"),
                priceInput = document.querySelectorAll(".price-input input"),
                progress = document.querySelector(".slider .progress"),
                priceDisplay = document.getElementById("travelerPrices");

            let priceGap = 500;

            function updateProgress(min, max) {
                const minPercent = (min / rangeInput[0].max) * 100;
                const maxPercent = (max / rangeInput[1].max) * 100;
                progress.style.left = minPercent + "%";
                progress.style.right = 100 - maxPercent + "%";
                priceDisplay.textContent = `$${min} - $${max}`;
            }

            priceInput.forEach((input) => {
                input.addEventListener("input", (e) => {
                    let minVal = parseInt(priceInput[0].value),
                        maxVal = parseInt(priceInput[1].value);

                    if (maxVal - minVal >= priceGap && maxVal <= rangeInput[1].max) {
                        if (e.target.classList.contains("input-min")) {
                            rangeInput[0].value = minVal;
                            updateProgress(minVal, maxVal);
                        } else {
                            rangeInput[1].value = maxVal;
                            updateProgress(minVal, maxVal);
                        }
                    }
                });
            });


            rangeInput.forEach((input) => {
                input.addEventListener("input", (e) => {
                    let minVal = parseInt(rangeInput[0].value),
                        maxVal = parseInt(rangeInput[1].value);

                    if (maxVal - minVal < priceGap) {
                        if (e.target.classList.contains("range-min")) {
                            rangeInput[0].value = maxVal - priceGap;
                        } else {
                            rangeInput[1].value = minVal + priceGap;
                        }
                    } else {
                        priceInput[0].value = minVal;
                        priceInput[1].value = maxVal;
                        updateProgress(minVal, maxVal);
                    }
                });
            });

            // تحديث البداية
            updateProgress(parseInt(priceInput[0].value), parseInt(priceInput[1].value));
        });


        document.addEventListener("DOMContentLoaded", () => {
            // ====== COUNTERS (Adults, Children, Infants) ======
            const counters = document.querySelectorAll(".counter");
            const travelerNumbers = document.getElementById("travelerNumbers");

            function updateTravelerNumbers() {
                const adults = parseInt(document.getElementById("adult_count").value) || 0;
                const children = parseInt(document.getElementById("children_count").value) || 0;
                const infants = parseInt(document.getElementById("infant_count").value) || 0;

                let text = [];
                if (adults > 0) text.push(`${adults} Adult${adults > 1 ? "s" : ""}`);
                if (children > 0) text.push(`${children} Child${children > 1 ? "ren" : ""}`);
                if (infants > 0) text.push(`${infants} Infant${infants > 1 ? "s" : ""}`);

                travelerNumbers.textContent = text.length > 0 ? text.join(", ") : "0 Traveler";
            }

            counters.forEach(counter => {
                const minusBtn = counter.querySelector(".minus");
                const plusBtn = counter.querySelector(".plus");
                const input = counter.querySelector("input.count");
                const min = parseInt(input.min);
                const max = parseInt(input.max);

                minusBtn.addEventListener("click", () => {
                    let value = parseInt(input.value);
                    if (value > min) {
                        input.value = value - 1;
                        updateTravelerNumbers();
                    }
                });

                plusBtn.addEventListener("click", () => {
                    let value = parseInt(input.value);
                    if (value < max) {
                        input.value = value + 1;
                        updateTravelerNumbers();
                    }
                });

                input.addEventListener("input", () => {
                    let value = parseInt(input.value);
                    if (isNaN(value) || value < min) input.value = min;
                    else if (value > max) input.value = max;
                    updateTravelerNumbers();
                });
            });

            // ====== PRICE RANGE SLIDER ======
            const rangeInput = document.querySelectorAll(".range-input input"),
                priceInput = document.querySelectorAll(".price-input input"),
                progress = document.querySelector(".slider .progress"),
                priceDisplay = document.getElementById("travelerPrices");

            let priceGap = 500;

            function updateProgress(min, max) {
                const minPercent = (min / rangeInput[0].max) * 100;
                const maxPercent = (max / rangeInput[1].max) * 100;
                progress.style.left = minPercent + "%";
                progress.style.right = 100 - maxPercent + "%";
                priceDisplay.textContent = `$${min} - $${max}`;
            }

            priceInput.forEach((input) => {
                input.addEventListener("input", (e) => {
                    let minVal = parseInt(priceInput[0].value),
                        maxVal = parseInt(priceInput[1].value);

                    if (maxVal - minVal >= priceGap && maxVal <= rangeInput[1].max) {
                        if (e.target.classList.contains("input-min")) {
                            rangeInput[0].value = minVal;
                            updateProgress(minVal, maxVal);
                        } else {
                            rangeInput[1].value = maxVal;
                            updateProgress(minVal, maxVal);
                        }
                    }
                });
            });

            rangeInput.forEach((input) => {
                input.addEventListener("input", (e) => {
                    let minVal = parseInt(rangeInput[0].value),
                        maxVal = parseInt(rangeInput[1].value);

                    if (maxVal - minVal < priceGap) {
                        if (e.target.classList.contains("range-min")) {
                            rangeInput[0].value = maxVal - priceGap;
                        } else {
                            rangeInput[1].value = minVal + priceGap;
                        }
                    } else {
                        priceInput[0].value = minVal;
                        priceInput[1].value = maxVal;
                        updateProgress(minVal, maxVal);
                    }
                });
            });

            // تحديث البداية
            updateProgress(parseInt(priceInput[0].value), parseInt(priceInput[1].value));
            updateTravelerNumbers(); // تحديث المسافرين مباشرة عند التحميل
        });
    </script>
    @include('layout.partials.notification')
@endsection
@section('schema')
    <script type="application/ld+json">
    {!! $jsonBreadcrumb !!}
</script>
@endsection
