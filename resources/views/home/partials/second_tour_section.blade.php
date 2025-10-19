@if (count($secondTours) > 0)

    <section class="w-100 travel-tour-second padtobo-40 Special_offers "
        style="background-image: url({{ asset('assets/images/news-mask.png') }});">
        <div class="container">

            <div class="row justify-content-center">
                <div class="section-title text-center mb-0">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ nova_get_setting_translate('second_section_label') }}
                        </span>

                        <h2>
                            {{ nova_get_setting_translate('second_section_title') }}
                        </h2>
                        <p class="mx-auto mt-20 section-title-para">
                            {!! nova_get_setting_translate('second_section_description') !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-lg-4 gy-5">
                <a class="col-md-4 text-center" href="{{ route('offers') }}">

                    <div >
                        <div class="offer-one">

                            <div class="cta-two__content__inner">

                                <div class="typing d-flex align-items-center justify-content-center h-100">
                                    <h2>
                                        <span class="myname"
                                            style="background-image: url( {{ Storage::url(nova_get_setting('second_section_bg_image')) }} )">
                                            {{ nova_get_setting_translate('second_section_descount_number') }} <br>
                                            {{ nova_get_setting_translate('second_section_descount_title') }}
                                        </span>
                                    </h2>

                                </div>

                                <div class="time-wepper"
                                    data-deadline-date="{{ nova_get_setting('offer_section_date_deadline') }}">
                                    <div class="time-wepper__item text-center">
                                        <h4 class="days">0</h4>
                                        <span class="time-wepper__item__text">
                                            {{ __('general.days') }}
                                        </span>
                                    </div>
                                    <div class="time-wepper__item text-center">
                                        <h4 class="hours">0</h4>
                                        <span class="time-wepper__item__text">
                                            {{ __('general.hours') }}
                                        </span>
                                    </div>
                                    <div class="time-wepper__item text-center">
                                        <h4 class="minutes">0</h4>
                                        <span class="time-wepper__item__text">
                                            {{ __('general.minutes') }}
                                        </span>
                                    </div>
                                    <div class="time-wepper__item text-center">
                                        <h4 class="seconds">0</h4>
                                        <span class="time-wepper__item__text">
                                            {{ __('general.seconds') }}
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </a>

                <div class="col-md-8 text-center ">

                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($secondTours as $secondTour)
                                <div class="swiper-slide" style="height: 100%">
                                    <div class="tab-content">

                                        <div class="item">
                                            <div class="package-box">

                                                <h6>
                                                    <a
                                                        href="{{ route('tour.show', ['categorySlug' => $secondTour->category->category->slug, 'subCategorySlug' => $secondTour->category->slug, 'tourSlug' => $secondTour->slug]) }}">
                                                        {{ $secondTour->name }}
                                                    </a>
                                                </h6>

                                                <a
                                                    href="{{ route('tour.show', ['categorySlug' => $secondTour->category->category->slug, 'subCategorySlug' => $secondTour->category->slug, 'tourSlug' => $secondTour->slug]) }}">
                                                    <img class="img-fluid" alt="image"
                                                        src="{{ $secondTour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}">
                                                </a>

                                                <div class="heart__icon wishlist-icon">
                                                    <a class="addfavorite"
                                                        data-href="{{ route('favorite.add', $secondTour->id) }}"
                                                        aria-label="Add to Favorites">
                                                        <i
                                                            class="fa-{{ in_array($secondTour->id, $favoriteToursIds) ? 'solid' : 'regular' }} fa-heart"></i>
                                                    </a>

                                                </div>
                                                <div class="meta-lable">
                                                    @if ($secondTour->discount > 0)
                                                        <div class="featured-text">
                                                            {{ $secondTour->discount }}
                                                            {{ $secondTour->discount_type == 'percentage' ? '%' : session()->get(App\Helpers\Constants\GeneralHelper::CURRENCY_SESSION)['symbol'] }}

                                                            {{ __('general.off') }}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div
                                                    class="pkg-btn-con d-flex align-items-center justify-content-between">
                                                    <span class="person d-inline-block p-0 m-0">
                                                        <span class="price d-inline-block p-0 m-0">
                                                            {{ App\Helpers\Classes\Currency::display($secondTour->final_price) }}

                                                        </span>
                                                        /
                                                        {{ __('general.person') }}
                                                    </span>
                                                    <div class="grey-btn d-inline-block">

                                                        <a
                                                            href="{{ route('tour.show', ['categorySlug' => $secondTour->category->category->slug, 'subCategorySlug' => $secondTour->category->slug, 'tourSlug' => $secondTour->slug]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24">
                                                                <path
                                                                    d="M7 7h8.586L5.293 17.293l1.414 1.414L17 8.414V17h2V5H7v2z" />
                                                            </svg>

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>


            </div>

        </div>

    </section>
@endif
