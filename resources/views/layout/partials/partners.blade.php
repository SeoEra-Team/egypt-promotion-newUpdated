{{-- <section class="partners ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center">
                <div class="col-12">
                    <span class="section-title-span"></span>

                    <h2>
                        {{ nova_get_setting_translate('partner_section_title') }}
                    </h2>
                    <p>
                        {!! nova_get_setting_translate('partner_section_description') !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-12">

                <!-- Swiper -->
                <div class="swiper mySwiper partners__content">
                    <div class="swiper-wrapper">
                        
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
    </div>
</section> --}}
<section class="partners mt-3 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center">
                <div class="col-12">
                    <span class="section-title-span"></span>
                    <h2>
                        {{ nova_get_setting_translate('partner_section_title') }}
                    </h2>
                    <p>
                        {!! nova_get_setting_translate('partner_section_description') !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row  justify-content-center">

            <div class="col-xl-12">


                <div class="swiper mySwiper partners__content ">
                    <div class="swiper-wrapper">
                        @foreach ($partners as $partner)
                            <div class="swiper-slide">
                                <img src="{{ $partner->getFirstMediaUrlOrDefault(MediaHelper::PARTNER_MEDIA_PATH, 'webp')['url'] }}" alt="" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>




        </div>
    </div>
</section>
