<div class="d-block d-md-none d-lg-none d-xl-none">
    <div class="menu-mobile-fixed d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}">
            <img loading="lazy" alt="mobile-contact" src="{{ asset('assets/images/call-center.svg') }}" />
            <p>
                {{ __('general.home') }}
            </p>
        </a>


        <a href="http://wa.me/+{{ nova_get_setting('site_phone') }}" target="_blank">
            <img loading="lazy" alt="mobile-whatsapp" src="{{ asset('assets/images/whatsapp.svg') }}" />
            <p>
                {{ __('general.whatsapp') }}
            </p>
        </a>
        <a href="tel:+{{ nova_get_setting('site_phone') }}">
            <img loading="lazy" alt="mobile-call" src="{{ asset('assets/images/phone (1).svg') }}" />
            <p>
                {{ __('general.call_us') }}
            </p>
        </a>

        <a href="{{ route('tailorMade') }}"> <img loading="lazy" src="{{ asset('assets/images/tailor-footer.svg') }}"
                alt="tailor-footer" />
            <p>
                {{ __('general.tailor_made') }}
            </p>
        </a>
    </div>
</div>

