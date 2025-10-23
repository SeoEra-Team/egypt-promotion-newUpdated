@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('thanks_page_meta_title'),
        'description' => nova_get_setting_translate('thanks_page_meta_description'),
        'keywords' => nova_get_setting_translate('thanks_page_meta_keywords'),
        'image' => Storage::url(nova_get_setting('thanks_page_banner')),
        'schema' => nova_get_setting('travel_style_schema'),
    ])
@endsection
@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/free page.css') }}" />
@endsection
@section('content')
    <div class="breadcrumb-area bg-peach position-relative z-1">
        <!-- <img src="./assets/images/br-bg-shape.png" alt="Shape" class="br-bg-shape position-absolute bottom-0 start-0"> -->
        <div class="container breadcrumb_text">
            <!-- <h1 class="section-title style-two">Thank You</h1> -->
            <ul class="br-menu list-unstyled mb-0">
                <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                <li>
                    {{ nova_get_setting_translate('thanks_page_title') }}
                </li>
            </ul>
        </div>
    </div>
    <div class="container">

        <div class="wrap mt-5" role="main" aria-live="polite">
            <div class="hero">
                <div class="confetti" id="confetti"></div>
                <div class="left">
                    <h2 class="title"> {{ nova_get_setting_translate('thanks_page_title') }}</h2>
                    <p class="subtitle">
                        {!! nova_get_setting_translate('thanks_page_sub_title') !!}
                    </p>

                    <p class="subtitle">
                        {!! nova_get_setting_translate('thanks_page_description') !!}
                    </p>

                    <div class="extra-nav  d-none d-sm-block">
                        <a href="{{ route('home') }}" class="theme-btn">
                            <i class="fa-solid fa-paper-plane"></i>

                            {{ nova_get_setting_translate('thanks_page_button_title') }}
                        </a>

                    </div>
                </div>

                <div class="right" aria-hidden="true">
                    <div class="orb">
                        <figure class="check">
                            <svg viewBox="0 0 120 120" width="120" height="120" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="60" cy="60" r="50" stroke="rgba(255,255,255,0.12)"
                                    stroke-width="6">
                                </circle>
                                <path d="M36 62 L52 78 L86 44" stroke="#fff" stroke-width="6" stroke-linecap="round"
                                    stroke-linejoin="round" fill="none" />
                            </svg>
                        </figure>
                    </div>


                </div>
            </div>
        </div>

    </div>


    @include('layout.partials.faqs')
@endsection
