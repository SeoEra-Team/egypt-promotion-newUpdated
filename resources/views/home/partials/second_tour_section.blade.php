
@if (isset($secondTours) && count($secondTours) > 0)
    
<div class="w-100 travel-tour-second travel-tour_second mt-5 hotel-section ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">
                    <span class="section-title-span">
                        {{ nova_get_setting_translate('second_section_label') }}
                    </span>
                    <h2>
                        {{ nova_get_setting_translate('second_section_title') }}
                    </h2>
                    <div class="desc ">
                        <p>
                            {!! nova_get_setting_translate('second_section_description') !!}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Swiper -->
            <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-3503ce012ebf8da8" aria-live="polite"
                    style="transition-duration: 0ms; transform: translate3d(-900px, 0px, 0px); transition-delay: 0ms;">

                    @foreach ($secondTours as $tour)
                        <div class="swiper-slide" role="group" aria-label="1 / 9" data-swiper-slide-index="0"
                            style="width: 420px; margin-right: 30px;">
                            @include('layout.partials.tour_box', ['style' => 'second' , 'tour' => $tour])
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>

            </div>
        </div>
    </div>
</div>
@endif
