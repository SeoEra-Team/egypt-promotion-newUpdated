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

@endsection
@section('content')


 <section class="page-hero-banner bg_cover"  style="background-image: url({{ Storage::url(nova_get_setting('about_section_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
 
                        {{ nova_get_setting_translate('thanks_page_name') }}
                    </h1>    
                 
                        <ul class="breadcrumb-link" itemscope="" itemtype="https://schema.org/BreadcrumbList">
                            <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="{{ route('home') }}">
                                    <span itemprop="name">
                                        {{ __('general.home') }}
                                    </span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem" class="active" aria-current="page">
                                <span itemprop="name">
                                   {{ nova_get_setting_translate('thanks_page_name') }}
                                </span>
                                <meta itemprop="position" content="2">
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="thanke-you position-relative" style="background-image: url(https://era-app.com/demo2/lmholiday/assets/images/shapes/about-us-pattern-bg.png);">
        <div class="container">
            <div class="row">
                <div class="thanke-you-box">
                    <div class="checkmark">
                        <svg viewBox="0 0 52 52">
                            <path d="M14,27 L22,35 L38,19"></path>
                        </svg>
                    </div>
                        <h2>{{ nova_get_setting_translate('thanks_page_title') }}</h2>
                        <p class="footer-text">
                            {!! nova_get_setting_translate('thanks_page_text') !!}     
                        </p>
                </div>


            </div>
        </div>
        <div class="right-side-girl-shape">
            <img src="https://demo.qzency.com/html/tripfy/preview/assets/image/banner-img/why-choose-us-four-girl.png" alt="">
        </div>



    </section>
    <!--<div class="breadcramb-box w-100 position-relative">-->
    <!--    <div class="container">-->
    <!--        <nav aria-label="breadcrumb text-center">-->
    <!--            <ol class="breadcrumb">-->
    <!--                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>-->
    <!--                <li class="breadcrumb-item"><a href="#">{{ nova_get_setting_translate('thanks_page_name') }}</a>-->
    <!--                </li>-->
    <!--            </ol>-->
    <!--        </nav>-->
    <!--    </div>-->
    <!--</div>-->


    <!--<section class="contact-page" style="background-image: url({{asset('assets/images/bg-top.png')}})">-->
    <!--    <div class="container">-->
            <!--<div class="row">-->
            <!--    <div class="category-cover-title">-->
            <!--        <div class="hero-cap">-->
            <!--            <h1>{{ nova_get_setting_translate('thanks_page_name') }}</h1>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="category-cover-img">-->
            <!--        <img loading="lazy" src="{{ Storage::url(nova_get_setting('thanks_page_banner')) }}" alt="category-img" />-->
            <!--    </div>-->
            <!--</div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12 text-center">-->
    <!--                <h2>{{ nova_get_setting_translate('thanks_page_title') }}</h2>-->

    <!--                    {!! nova_get_setting_translate('thanks_page_text') !!}-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->


    @include('layout.partials.faqs')
@endsection
