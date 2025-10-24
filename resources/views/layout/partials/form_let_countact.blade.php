<form action="{{ route('contactus.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12 ">

            <div
                lass="tour-details-package-box position-relative d-flex align-items-center justify-content-between mt-3">
                <label>
                    {{ __('home.name') }}
                </label>
                <input type="text" name="name" required="">
            </div>
        </div>

        <div class="col-md-6 col-6">

            <div
                class="tour-details-package-box position-relative d-flex align-items-center justify-content-between mt-3">
                <label>
                    {{ __('home.email') }}
                </label>
                <input type="email" name="email" required="">
            </div>
        </div>

        <div class="col-md-6  col-6">
            <div class="form-item  mt-3">
                <select name="nationality" class="form-select" aria-label="Default select example">
                    @include('layout.partials.countries')
                </select>
            </div>
        </div>

        <div class="col-md-6  col-6">
            <div class="tour-details-package-box position-relative mt-3">
                <label>
                    {{ __('home.code') }}
                </label>
                <div class="phone-code">
                    <select name="code" class="form-select telcode" aria-label="Default select example">
                        @include('layout.partials.code-phone')
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6  col-6">
            <div class="tour-details-package-box position-relative w-100 mt-3">
                <label>
                    {{ __('home.phone') }}
                </label>
                <input type="number" name="phone" required="">
            </div>
        </div>

        <div class="col-md-6 col-6">
            <div class="form-floating  mt-3">
                <input name="name" required="" type="text" id="Pickup" class="name flatpickr-input "
                    placeholder="Pickup Date" readonly="readonly">
            </div>
        </div>
        <div class="col-md-6 col-6">
            <div class="form-floating  mt-3">
                <input name="name" required="" type="text" id="Departure" class="name flatpickr-input active"
                    placeholder="Departure Date" readonly="readonly">
            </div>
        </div>

        <div class="col-lg-4 col-4">
            <div class="adult-counter">
                <p>
                    {{ __('home.adult') }}
                </p>
                <div class="counter-controls">
                    <button type="button" class="decrease-btn" data-target="adults">-</button>
                    <input type="number" name="adults" data-type="adults" min="0" value="0" data-price="1"
                        class="quantity-input">
                    <button type="button" class="increase-btn" data-target="adults">+</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-4">
            <div class="adult-counter">
                <p>
                    {{ __('home.children') }}
                </p>
                <div class="counter-controls">
                    <button type="button" class="decrease-btn" data-target="children">-</button>
                    <input type="number" name="children" data-type="Children" min="0" value="0"
                        data-price="1" class="quantity-input">
                    <button type="button" class="increase-btn" data-target="children">+</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-4">
            <div class="adult-counter">
                <p>
                    {{ __('home.infants') }}
                </p>
                <div class="counter-controls">
                    <button type="button" class="decrease-btn" data-target="infants">-</button>

                    <input type="number" name="infants" data-type="Infants" min="0" value="0"
                        data-price="1" class="quantity-input">
                    <button type="button" class="increase-btn" data-target="infants">+</button>
                </div>
            </div>
        </div>

        <div class="tour-details-package-box position-relative mt-3">
            <textarea name="message" required="" rows="1" class="message" placeholder=""></textarea>
            <label>
                {{ __('home.message') }}
            </label>
        </div>

        <div class="tour-details-package-total">
            <div class="tour-details-package-proceed text-center">
                <button type="submit" class="theme-btn btn__three mt-2 w-75 mx-auto">
                    <span>
                        {{ __('home.send') }}
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>
