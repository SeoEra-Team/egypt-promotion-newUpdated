@if (isset($style) && $style == 'first')
    <div class="tour-card">
        <a href="./tour-details.html">
            <h3 class="card-title">
                {{ $tour->name }}
            </h3>
        </a>
        <div class="tour-img hotel-card">
            <div class="hotel-img">
                <a href="./tour-details.html">

                    <img src="{{ $tour->img_first }}" alt="Cairo">
                    <img src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}"
                        alt="Cairo">
                </a>
            </div>
            <div class="tour-date mb-2 small">
                <i class="fa-solid fa-calendar"></i> <span>
                    {{ $tour->duration }}
                </span>
            </div>

        </div>
        <div class="card-body">

            <div class="tour-para">
                <p class="three-line">
                    {{ $tour->short_description }}


                </p>
            </div>
            <div class="tour-footer bottom-area">
                <div class="tour-price">
                    <span class="tour-footer-from">{{ __('home.from') }}:</span>
                    <span class="tour-footer-price">
                        {{ App\Helpers\Classes\Currency::display($tour->final_price) }}
                    </span>
                </div>
                <a href="./tour-details.html">
                    {{ __('home.book_trip') }}

                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12"
                            fill="none">
                            <path d="M2.07617 8.73272L12.1899 2.89355" stroke-linecap="round">
                            </path>
                            <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105" stroke-linecap="round"></path>
                        </svg>
                    </span>
                </a>

            </div>
        </div>
    </div>
@elseif (isset($style) && $style == 'second')
    <div class="hotel-card">

        <div class="hotel-img">
            <a href="./tour-details.html">
                <img src="{{ $tour->img_first }}" alt="Cairo">
                <img src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}"
                    alt="Cairo">
            </a>

        </div>
        <div class="hotel-details">
            <div class="hotel-title"> <a href="./tour-details.html">
                    {{ $tour->name }}
                </a>
            </div>
            <div class="hotel-meta">
                <div class="hotel-star">
                    <span><i class="fa-regular fa-clock"></i> {{ $tour->duration }}</span>
                </div>
                <div class="hotel-level">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <span> Cairo, Aswan, Luxor, Alexandria, Siwa</span>
                </div>
            </div>
            <p>
                {{ $tour->short_description }}
            </p>
            <div class="tour-card-footer d-flex align-items-center justify-content-between">
                <div class="tour-price position-relative">
                    <span class="tour-price-title">From :</span>
                    @if ($tour->discount > 0)
                        <del class="deleted-price mr-3">
                            {{ App\Helpers\Classes\Currency::display($tour->price) }}
                        </del>
                    @endif
                    <span class="price-value">
                        {{ App\Helpers\Classes\Currency::display($tour->final_price) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@elseif (isset($style) && $style == 'third')
    <div class="blog-card one mb-3">
        <div class="blog-card-img-wrap blog--card">
            <a href="./tour-details.html" class="card-img card__img">
                <img src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}"
                    alt="">
            </a>

        </div>
        <div class="blog-card-content blog__card">

            <h5><a href="./tour-details.html">
                    {{ $tour->name }}
                </a></h5>
            <div class="blog-date">

                <span class="price--main--tour">
                    <i class="fa-solid fa-money-bill-1-wave"></i>
                    {{ App\Helpers\Classes\Currency::display($tour->final_price) }}
                    <strong> {{ __('home.start_from') }} </strong>
                </span>
            </div>

        </div>

    </div>
@endif
