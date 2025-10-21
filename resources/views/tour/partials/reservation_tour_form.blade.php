<div class="sidebar position-relative h-100 mt-5" id="Book">

    <div class="sidebar-content_Book sidebar-content ">
        <div class="sidebar-heading">
            <p>
                {{ __('tour.book_this_package') }}
            </p>
        </div>
        <form action="{{ route('tour.reservation', $tour->id) }}" method="post">
            @csrf
            <div class="tour-details-package-content">


                <div class="row">

                    <div
                        class="tour-details-package-box position-relative d-flex align-items-center justify-content-between mt-3">
                        <label>
                            {{ __('tour.name') }}
                        </label>
                        <input type="text" name="name" >
                        <!-- <i class="fa-regular fa-pen-to-square"></i> -->
                    </div>

                    <div
                        class="tour-details-package-box position-relative d-flex align-items-center justify-content-between mt-3">
                        <label>
                            {{ __('tour.email') }}
                        </label>
                        <input type="email" name="email" >
                        <!-- <i class="fa-regular fa-envelope"></i> -->
                    </div>
                    <div class="phone-number-box d-flex gap-4 mt-3">
                        <div class="tour-details-package-box position-relative">
                            <label>
                                {{ __('tour.country_code') }}
                            </label>
                            <div class="phone-code">
                                <select name="code" class="form-select telcode" aria-label="Default select example">
                                    @include('layout.partials.code-phone')
                                </select>
                            </div>
                        </div>
                        <div class="tour-details-package-box position-relative w-100">
                            <label>
                                {{ __('tour.phone') }}
                            </label>
                            <input type="number" name="phone_number" >
                            <!-- <i class="fa-solid fa-phone"></i> -->
                        </div>
                    </div>


                    <div class="col-lg-12 ">
                        <div
                            class="tour-details-package-box position-relative d-flex align-items-center justify-content-between mt-3">
                            <label>
                                {{ __('tour.date') }}
                            </label>
                            <input type="text" name="date" class="flatpickr-input"
                                placeholder="Select Date" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="adult-counter">
                            <p>
                                {{ __('tour.adults') }}
                            </p>
                            <div class="counter-controls">
                                <button type="button" class="decrease-btn" data-target="adults">-</button>

                                <input type="number" name="adults" data-type="adults" min="1" value="1"
                                    data-price="1" class="quantity-input">
                                <button type="button" class="increase-btn" data-target="adults">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="adult-counter">
                            <p>
                                {{ __('tour.children') }}
                            </p>
                            <div class="counter-controls">
                                <button type="button" class="decrease-btn" data-target="children">-</button>

                                <input type="number" name="children" data-type="Children" min="0" value="0"
                                    data-price="1" class="quantity-input">
                                <button type="button" class="increase-btn" data-target="children">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="adult-counter">
                            <p>
                                {{ __('tour.infants') }}
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
                        <textarea name="message"  rows="1" class="message" placeholder=""></textarea>
                        <label>
                            {{ __('tour.message') }}
                        </label>
                    </div>




                    <div class="tour-details-package-total">
                        <div class="tour-details-package-proceed text-center">
                            <button type="submit" class="theme-btn btn__three mt-2 w-75 mx-auto">
                                <span>
                                    {{ __('tour.send_request') }}
                                </span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </form>


    </div>

</div>
