<div class="newsletter-section position-relative fix padtobo-40">
    <div class="container">
        <div class="newsletter-wrap" style="background-image: url({{ Storage::url(nova_get_setting('offer_section_bg_image')) }});">

            <div class="col-lg-6">

                <div class="cta-two__content__inner">
                    <div class="sec-title ">
                        <div class="section-title text-center ">
                            <div class="col-12">
                                <span class="section-title-span">
                                    {{ nova_get_setting_translate('offer_section_title') }}
                                </span>
                                <div class="desc-special-offer">
                                    {!! nova_get_setting_translate('offer_section_description') !!}
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="time_wepper" data-deadline-date="{{ nova_get_setting('offer_section_date_deadline') }}">
                        <div class="time-wepper__item text-center">
                            <h4 id="days">00</h4>
                            <span class="time-wepper__item__text">
                                {{ __('general.days') }}
                            </span>
                        </div>
                        <div class="time-wepper__item text-center">
                            <h4 id="hours">00</h4>
                            <span class="time-wepper__item__text">
                                {{ __('general.hours') }}
                            </span>
                        </div>
                        <div class="time-wepper__item text-center">
                            <h4 id="minutes">00</h4>
                            <span class="time-wepper__item__text">
                                {{ __('general.minutes') }}
                            </span>
                        </div>
                        <div class="time-wepper__item text-center">
                            <h4 id="seconds">00</h4>
                            <span class="time-wepper__item__text">
                                {{ __('general.seconds') }}
                            </span>
                        </div>
                    </div>

                    <div class="tailor-made mt-5 ">
                        <a href="{{ route('offers') }}" class="theme-btn btn-style-three">
                            {{ nova_get_setting_translate('offer_section_btn_text') }}
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="subscribe-img d-none d-lg-block">.
                    <img src="{{ Storage::url(nova_get_setting('offer_section_side_image')) }}" alt="newsletter" class="shake">


                </div>

                <div class="offer-two__thumb__element"></div>


                <div class="sale-banner">

                    <div class="circle-text" id="circle-text">

                    </div>

                    <div class="circle">
                        <!-- <div class="small-label">UP TO</div> -->
                        <div class="percent">
                            {{ nova_get_setting_translate('offer_section_descount_number') }}
                        </div>
                        <div class="off">
                            {{ nova_get_setting_translate('offer_section_descount_title') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('layout.partials.timer')