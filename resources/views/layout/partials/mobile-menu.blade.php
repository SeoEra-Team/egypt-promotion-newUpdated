<div class="d-block d-md-none d-lg-none d-xl-none">
    <div class="menu-mobile-fixed d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}">
        <img loading="lazy" alt="mobile-contact" src="{{ asset('assets/images/call-center.svg') }}" />
            <p>
                {{ __('general.home') }}
            </p>
        </a>


        <a href="http://wa.me/+201270496896" target="_blank">
            <img loading="lazy" alt="mobile-whatsapp" src="{{ asset('assets/images/whatsapp.svg') }}" />
            <p>
                {{ __('general.whatsapp') }}
            </p>
        </a>
        <a href="tel:+201270496896">
            <img loading="lazy" alt="mobile-call" src="{{ asset('assets/images/phone (1).svg') }}" />
            <p>
                {{ __('general.call_us') }}
            </p>
        </a>

        <a href="{{ route('tailorMade') }}"> <img loading="lazy" src="{{ asset('assets/images/tailor-footer.svg') }}" alt="tailor-footer" />
            <p>
                {{ __('general.tailor_made') }}
            </p>
        </a>
    </div>
</div>
<div class="contact-floatbox d-none d-sm-block">
    <a href="https://api.whatsapp.com/send/?phone={{ nova_get_setting('site_whatsapp') }}&amp;text=i+found+your+No+on+website&amp;type=phone_number&amp;app_absent=0"
        target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="whatsapp ">
        <img src="https://new.golavitatravel.com/assets/images/whatsapp.svg" alt="whatsapp-icon" alt="whatsapp-icon"
            title="whatsapp-icon" />
    </a>
    <a href="tel:{{ nova_get_setting('site_whatsapp') }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="phone-call"
        class="phone_call">
        <img loading="lazy" src="https://new.golavitatravel.com/assets/images/call.png" alt="phone_call"
            title="  phone_call" style="height: 50px;width: 50px;">
    </a>
</div>
