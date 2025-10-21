@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('contactus_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('contactus_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('contactus_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('contactus_banner')),
        'schema' => nova_get_setting('contactus_schema'),
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ Storage::url(nova_get_setting('contactus_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('contactus_title', env('APP_NAME')) }}
                        </h1>
                        <ul class="breadcrumb-link" itemscope itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="{{ url('/') }}">
                                    <span itemprop="name">
                                        {{ __('general.home') }}
                                    </span>
                                </a>
                                <meta itemprop="position" content="1" />
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active"
                                aria-current="page">
                                <span itemprop="name">
                                    {{ nova_get_setting_translate('contactus_title', env('APP_NAME')) }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page padtobo-40" >
        <div class="container">

            <div class="row justify-content-center ">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <h2>
                            {{ nova_get_setting_translate('contactus_sub_title', env('APP_NAME')) }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form id="contact-form" class="contact-info contact-form contact-box" action="{{ route('contactus.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control border-0" id="name"
                                        placeholder="Your Name" name="name">
                                    <label for="name">
                                        {{ __('general.full_name') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0 mb-4" id="email"
                                        placeholder=" Email  " name="email">
                                    <label for="email">
                                        {{ __('general.email') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-item mb-4">
                                    <select class="form-select" aria-label="Default select example" name="code">
                                        <option selected="">
                                            {{ __('general.code') }}
                                        </option>
                                        @include('layout.partials.code-phone')
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="phone" class="form-control border-0 mb-4" id="namphonee"
                                        placeholder=" Phone" name="phone_number">
                                    <label for="phone">
                                        {{ __('general.phone') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-5">
                                    <textarea class="form-control border-0" placeholder="Message" id="message" style="height: 160px" name="message"></textarea>
                                    <label for="message">
                                        {{ __('general.message') }}
                                    </label>
                                </div>
                                <!-- <a href="#" class="btn main-btn main-btn--scroll Send_Now mb-2 ">
                            Send message
                          </a> -->
                                <div class="tailor-made d-flex justify-content-center">
                                    <button type="submit" class="theme-btn btn__three">
                                        {{ __('general.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="contact-sidebar">
                        <h3 class="contact-fullname"></h3>
                        <div class="contact-info-box">
                            <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                            <a href="https://maps.app.goo.gl/ohKzK6D6BHnd1wbP8" target="_blank">
                                <div class="info-title">
                                    {{ __('general.location') }}
                                </div>
                                <div class="info-text">
                                    <span itemprop="streetAddress">
                                        {{ nova_get_setting_translate('site_address') }}
                                    </span>,
                                    <span itemprop="addressLocality">
                                        {{ nova_get_setting_translate('site_city') }}
                                    </span>,
                                    <span itemprop="addressCountry">
                                        {{ nova_get_setting_translate('site_country') }}
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="contact-info-box">
                            <div class="icon"><i class="fas fa-envelope"></i></div>
                            <a href="mailto:{{ nova_get_setting('site_email') }}">
                                <div class="info-title">
                                    {{ __('general.email') }}
                                </div>
                                <div class="info-text">
                                    {{ nova_get_setting('site_email') }}
                                </div>
                            </a>
                        </div>
                        <div class="contact-info-box">
                            <div class="icon"> <i class="fa-brands fa-whatsapp"></i></div>
                            <a href="https://wa.me/{{ nova_get_setting('site_whatsapp') }}">
                                <div class="info-title">
                                    {{ __('general.whatsapp') }}
                                </div>
                                <div class="info-text">
                                    {{ nova_get_setting('site_whatsapp') }}
                                </div>
                            </a>
                        </div>

                        <div class="contact-info-box">
                            <div class="icon"> <i class="fa-solid fa-phone"></i></div>
                            <a href="tel:{{ nova_get_setting('site_phone') }}">
                                <div class="info-title">
                                    {{ __('general.phone') }}
                                </div>
                                <div class="info-text">
                                    {{ nova_get_setting('site_phone') }}
                                </div>
                            </a>
                        </div>


                    </div>
                </div>






            </div>





            <div class="col-lg-12">
                <div class="contact-sidebar">
                    {!! nova_get_setting('ifram_location') !!}
                </div>
            </div>
        </div>
    </section>


    @include('layout.partials.faqs')
@endsection
@section('extraScripts')
    <script type="text/javascript"></script>
    {{-- @include('layout.partials.notification')    --}}
@endsection
