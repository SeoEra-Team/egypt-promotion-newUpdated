<footer class="main-footer pt-5">
    <div class="container">
        <div class="row">

            <div class=" col-md-6 col-xl-2">
                <div class="footer-widget footer-widget--links">
                    <p class="footer-widget__title ">{{ __('footer.useful_links') }}</p>
                    <img src="{{ asset('assets/images/under-lines.webp')}} " alt="footer-widget-line">
                    <ul class="list-unstyled footer-widget__links">
                        <li><a href="./freepage.html"> {{ __('footer.our_mission') }}</a></li>
                        <li><a href="./freepage.html"> {{ __('footer.our_vision') }} </a></li>
                        <li><a href="./freepage.html"> {{ __('footer.policy_privacy') }}</a></li>
                        <li><a href="./freepage.html"> {{ __('footer.terms_conditions') }}</a></li>
                        <li><a href="./freepage.html"> {{ __('footer.payment_cancelation') }} </a></li>

                    </ul>
                </div>

            </div>
            <div class=" col-md-6 col-xl-2">
                <div class="footer-widget footer-widget--links">
                    <p class="footer-widget__title ">{{ __('footer.useful_links') }}</p>
                    <img src="{{ asset('assets/images/under-lines.webp')}} " alt="footer-widget-line">
                    <ul class="list-unstyled footer-widget__links">
                        <li><a href="./Specialoffers.html"> {{ __('footer.special_offers') }}</a></li>

                        <li><a href="./contact-us.html"> {{ __('footer.contact_us') }}</a></li>
                        <li><a href="./article_Category.html"> {{ __('footer.blogs') }}</a></li>
                        <li><a href="./freepage.html"> {{ __('footer.about_us') }}</a></li>
                    </ul>

                </div>
            </div>


            @foreach ($footerCategories as $footerCategory)
                <div class=" col-md-6 col-xl-2">
                    <div class="footer-widget footer-widget--links-two">
                        <p class="footer-widget__title ">{{ $footerCategory->name }}</p>
                        <img src="{{ asset('assets/images/under-lines.webp')}} " alt="footer-widget-line">
                        <ul class="list-unstyled footer-widget__links">
                            @foreach ($footerCategory->children as $subCategory) 
                                <li><a href="./Tour.html"> {{ $subCategory->name }} </a></li>
                                
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach



            <div class="col-md-6 col-xl-3">
                <div class="footer-widget footer-widget--links-two">
                    <p class="footer-widget__title mt-3">
                        {{ __('footer.contact_us') }}
                    </p>
                    <img src="{{ asset('assets/images/under-lines.webp')}} " alt="footer-widget-line">
                    <div class="contact-footer mb-2" itemscope="" itemtype="https://schema.org/Organization">
                        <a href="mailto:{{ nova_get_setting('site_email') }}" itemprop="email">
                            <img loading="lazy" src="{{ asset('assets/images/envlope.svg') }}" alt="Email icon">
                            <span>{{ nova_get_setting('site_email') }}</span>
                        </a>
                        <a href="tel:{{ nova_get_setting('site_phone') }}" itemprop="telephone">
                            <img loading="lazy" src="{{ asset('assets/images/phone (1).svg') }}" alt="Phone icon">
                            <span> {{ nova_get_setting('site_phone') }}</span>
                        </a>
                        <a href="https://maps.app.goo.gl/oeDh6e2Daxtzt9fR8" itemprop="telephone">
                            <img loading="lazy" src="{{ asset('assets/images/location.svg') }}" alt="Phone icon">
                            <span> {{ nova_get_setting_translate('site_address') }} </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer__bottom">
        <div class="container">
            <div class="main-footer__bottom__inner">
                <p class="main-footer__copyright">
                    Copyright © <span id="csyear">2025</span>
                    <a href="https://www.seoera.net/" target="_blank">SeoEra</a>
                    All Right Reserved
                </p>

                <ul class="social-media-navbar">
                    <img src="./assets/images/share.svg" style="width: 38px;">
                    <li>
                        <a href="https://www.facebook.com/egyptpromotion1/" class="facebook"
                            aria-label="facebook-account" target="_blank">
                            <img src="./assets/images/facebook.svg">
                        </a>
                    </li>
                    <li>
                        <a href="" class="twitter" aria-label="twitter-account" target="_blank">
                            <img src="./assets/images/x.com.svg">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/user/egypttourgate/videos" class="youtube" target="_blank"
                            aria-label="linkedin-account">
                            <img src="./assets/images/youtube.svg">

                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/ibrahim-elaref-611055b8/?originalSubdomain=eg"
                            target="_blank" class="linkedin" aria-label="linkedin-account">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="" class="tripadvisor" aria-label="tripadvisor-account" target="_blank">
                            <img src="./assets/images/tripadvisor.svg">

                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/egyptpromotion/" class="instagram"
                            aria-label="instagram-account" target="_blank">
                            <img src="./assets/images/instagram.svg">

                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</footer>
@include('layout.partials.mobile-menu')
