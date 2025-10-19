<footer class="main-footer">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-xl-6">
                <div class="footer-widget footer-widget--about">
                    <div itemscope itemtype="http://schema.org/Organization">

                        <a href="{{ route('home') }}" class="footer-widget__logo" itemprop="url">
                            <img loading="lazy" src="{{ Storage::url(nova_get_setting('logo_white')) }}" alt="logo"
                                itemprop="logo" width="185" alt="footer-widget">
                        </a>
                    </div>
                    <p class="footer-widget__text">
                        {!! nova_get_setting_translate('footer_description') !!}
                    </p>

                </div>
            </div>


            <div class="col-md-6 col-xl-6">
                <div class="newsletter_wrap">

                    <form action="{{ route('subscribe.post') }}" method="post">
                        @csrf
                        <img src="{{ Storage::url(nova_get_setting('footer_top_img')) }}" alt="img">
                        <input type="email" placeholder="{{ nova_get_setting_translate('footer_top_placeholder') }}"
                            name="email">
                        <button type="submit" class="subscribe">
                            {{ nova_get_setting_translate('footer_top_title') }}
                        </button>
                    </form>
                </div>
                @if (isset($socialMedia) && count($socialMedia))
                    <ul class="social-media-navbar mt-4 mb-4">
                        <i class="fas fa-share fa-2x text-white me-2" aria-hidden="true"></i>
                        @foreach ($socialMedia as $social_row)
                            @if ($social_row['platform'] == 'tripadvisor')
                                <li>
                                    <a href="{{ $social_row['link'] }}" class="tripadvisor"
                                        aria-label="tripadvisor-account" itemprop="sameAs">
                                        <svg style="width: 25px !important;" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" id="tripadvisor">
                                            <g fill="none" stroke="#FFF" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="6" cy="13" r=".5"></circle>
                                                <circle cx="6" cy="13" r="2.5"></circle>
                                                <circle cx="6" cy="13" r="5.5"></circle>
                                                <circle cx="18" cy="13" r=".5"></circle>
                                                <circle cx="18" cy="13" r="2.5"></circle>
                                                <circle cx="18" cy="13" r="5.5"></circle>
                                                <path
                                                    d="M4.38 7.5a15.52 15.52 0 0 1 15.24 0M5.5 7.5h-5a5.64 5.64 0 0 1 1.09 2.22M18.5 7.5h5a5.64 5.64 0 0 0-1.09 2.22M10.54 16.1 12 18.5l1.46-2.4">
                                                </path>
                                            </g>
                                        </svg>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $social_row['link'] }}" target="_blank"
                                        aria-label="Visit our social Pages" class="{{ $social_row['platform'] }}"
                                        aria-label="{{ $social_row['platform'] }}-account" itemprop="sameAs">
                                        <i class="fa-brands fa-{{ $social_row['icon'] }}"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif

            </div>


            <hr>


            <div class=" col-md-6 col-xl-3">
                <div class="footer-widget footer-widget--links">
                    <p class="footer-widget__title ">
                        {{ __('footer.useful_links') }}
                    </p>
                    <img src="{{ asset('assets/images/under-lines.webp') }}" alt="footer-widget-line">
                    <ul class="list-unstyled footer-widget__links">
                        <li>
                            <a href="{{ route('about.index', nova_get_setting_translate('about_slug') ?? 'about-us') }}">
                                {{ __('footer.about_us') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('offers') }}">
                                {{ __('footer.offers') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}">
                                {{ __('footer.blogs') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contactus') }}">
                                {{ __('footer.contact_us') }}
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            @foreach ($footerCategories as $footerCategory)
                <div class=" col-md-6 col-xl-3">
                    <div class="footer-widget footer-widget--links-two">
                        <p class="footer-widget__title mt-3">
                            {{ $footerCategory->name }}
                        </p>
                        <img src="{{ asset('assets/images/under-lines.webp') }}" alt="footer-widget-line">
                        <ul class="list-unstyled footer-widget__links">
                            @foreach ($footerCategory->children as $child)
                                <li>
                                    <a href="{{ route('tour.index', ['categorySlug' => $footerCategory->slug, 'subCategorySlug' => $child->slug]) }}">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach






            <div class="col-md-6 col-xl-3">
                <div class="footer-widget footer-widget--links-two">
                    <p class="footer-widget__title mt-3">
                        {{ __('footer.get_in_touch') }}
                    </p>
                    <img src="{{ asset('assets/images/under-lines.webp') }}" alt="footer-widget-line">
                    <div class="contact-footer mb-2" itemscope itemtype="https://schema.org/Organization">
                        <a href="mailto:{{ nova_get_setting('site_email') }}" itemprop="email">
                            <img loading="lazy" src="{{ asset('assets/images/envlope.svg') }}" alt="Email icon">
                            <span>{{ nova_get_setting('site_email') }}</span>
                        </a>
                        <a href="tel:+{{ nova_get_setting('site_phone') }}" itemprop="telephone">
                            <img loading="lazy" src="{{ asset('assets/images/phone.svg') }}" alt="Phone icon">
                            <span>{{ nova_get_setting('site_phone') }}</span>
                        </a>
                        <a href="{{ nova_get_setting('site_link_address') }}" itemprop="telephone">
                            <img loading="lazy" src="{{ asset('assets/images/location.svg') }}" alt="Phone icon">
                            <span>
                                <span itemprop="streetAddress">
                                    {{ nova_get_setting_translate('site_address') }}
                                </span>,
                                <span itemprop="addressLocality">
                                    {{ nova_get_setting_translate('site_city') }}
                                </span>,
                                <span itemprop="addressCountry">
                                    {{ nova_get_setting_translate('site_country') }}
                                </span>
                            </span>
                        </a>


                    </div>

                    <div class="payment-method mt-4">
                        <p class="footer-widget__title mb-2">
                            {{ __('footer.payment_methods') }}
                        </p>
                        <img src="{{ asset('assets/images/under-lines.webp') }}" alt="footer-widget-line">
                        <div class="payment-photos d-flex gap-2">
                            <img loading="lazy" src="{{ asset('assets/images/asset 18.png') }}"
                                alt="payment-photo-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer__bottom">
        <div class="container">
            <div class="main-footer__bottom__inner">
                <p class="main-footer__copyright">
                    {{ nova_get_setting_translate('footer_copyright_text') }} © <span id="csyear">2025</span>
                    <a href="https://www.seoera.net/" target="_blank">SeoEra</a>
                    {{ nova_get_setting_translate('footer_copyright_text2') }}
                </p>
            </div>
        </div>
    </div>
</footer>



    @include('layout.partials.mobile-menu')
