<div class="container padtobo-40">

    <section class="offer-one offer_one" style="background-image:url(./assets/images/bg-17.png)">
        <div class="container">
            <div class="typing d-flex align-items-center h-100 text-center">
                <h2>
                    <span class="myname" style="background-image: url(./assets/images/text-bg.jpg)">
                        {{ nova_get_setting_translate('home_midBanner_title') }}
                    </span>
                </h2>
            </div>
            <div class="offer-one__content sec-title">

                <p class="offer-one__top-title">

                    {{ nova_get_setting_translate('home_midBanner_sub_title') }}

                </p>
                <h2 class="offer-one__heading sec-title__heading mt-3">
                    {!! nova_get_setting_translate('home_midBanner_section_description') !!}
                </h2>
                <div class="tailor-made">
                    <a href="{{ nova_get_setting('home_midBanner_btn_link') }}" class="theme-btn btn-style-three" target="_blank">
                        {{ __('general.plan_your_trip') }}
                    </a>
                </div>



            </div>
        </div>
        <div class="shape-2">
            <img src="{{ asset('assets/images/boat.png') }}" alt="img">
        </div>

        <div class="cta-image wow img-custom-anim-left animated"
            style="visibility: visible; animation-name: img-anim-left;">
            <img src="{{ asset('assets/images/shape-5.png') }}" alt="img">
        </div>
    </section>
</div>
