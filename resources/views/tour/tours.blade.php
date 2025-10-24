@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $subCategory->meta_title ?? env('APP_NAME'),
        'description' => $subCategory->meta_description ?? env('APP_NAME'),
        'keywords' => $subCategory->meta_keywords ?? env('APP_NAME'),
        'image' => $subCategory->getFirstMediaUrlOrDefault(MediaHelper::SUB_CATEGORY_MEDIA_PATH, 'webp')['url'],
        'schema' => $subCategory->meta_other ?? '',
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/tour.css') }}" />
@endsection

@section('content')
    <div class="breadcrumb-area bg-peach position-relative z-1">
        <!-- <img src="./assets/images/br-bg-shape.png" alt="Shape" class="br-bg-shape position-absolute bottom-0 start-0"> -->
        <div class="container breadcrumb_text">
            <!-- <h1 class="section-title style-two">Egypt Excursions</h1> -->
            <ul class="br-menu list-unstyled mb-0">
                <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                <li>
                    <a href="{{ route('tour.category', ['categorySlug' => $subCategory->category->slug]) }}">
                        {{ $subCategory->category->heading }}
                    </a>
                </li>
                <li>
                    {{ $subCategory->heading }}
                </li>
            </ul>
        </div>
    </div>

    <section class="w-100 travel-tour-second travel-tour_second  hotel-section  ">
        <div class="container">

            <div class="row justify-content-center">
                <div class="section-title text-center mb-3">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ $subCategory->name }}
                        </span>
                        <h2>
                            {{ $subCategory->title ?? '' }}
                        </h2>
                        <div class="descc ">

                            {!! $subCategory->description !!}

                        </div>
                        <div class="extra-nav d-flex justify-content-center ">
                            <button class="theme-btn showMore-Btn">
                                {{ __('category.show_more') }}
                            </button>

                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="filter-row">
                        <div class="clearfix">
                            <div class="s-info">
                                {{ __('category.showing') }}
                                <strong>
                                    {{ $tours->count() }}    
                                </strong> 
                                {{ __('category.items') }}
                            </div>
                            @include('tour.partials.filters')
                            
                        </div>
                    </div>
                    <div class="row" id="productList" itemscope="">
                        @foreach ($tours as $tour)  
                        <div class="col-lg-6">
                            @include('layout.partials.tour_box', ['style' => 'card_category_tour', 'tour' => $tour])
                        </div>
                        @endforeach
                        {{-- <div class="col-lg-6">
                            
                        </div> --}}
                        
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">


                    <div class="sidebar ">

                        <div class=" sidebar-content ">
                            <div class="sidebar-heading">
                                <p>
                                    {{ __('home.let_us_help_you') }}
                                </p>
                                <p>
                                    {{ __('home.des_contact_us') }}
                                </p>
                            </div>
                            <div class="tour-details-package-content">

                                @include('layout.partials.form_let_countact')
                            </div>


                        </div>


                        <div class="categories mt-3">
                            <h2 class="tour-listing-details__title">
                                {{ __('category.need_help') }}
                            </h2>
                            <p>
                                {{ __('category.need_help_description') }}
                            </p>

                            <div class="row g-2 Provider">
                                <div class="col-sm-6 Provider">
                                    <a href="http://wa.me/{{ nova_get_setting('site_phone') }}" target="_blank"
                                        class="btn-2 btn d-flex align-items-center justify-content-center">
                                        <span>
                                            <i class="fa-brands fa-whatsapp me-2"></i>{{ __('general.whatsapp') }}
                                        </span>

                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="tel:{{ nova_get_setting('site_whatsapp') }}"
                                        class="btn-2 btn d-flex align-items-center justify-content-center">
                                        <span>
                                            <i class="fa-solid fa-phone-volume me-2"></i>
                                            {{ __('general.call_us') }}
                                        </span>

                                    </a>
                                </div>
                            </div>

                            <div class="tour-details-package-total">
                                <div class="tour-details-package-proceed text-center">
                                    <a href="./tailorMade.html" class="theme-btn btn__three  w-75 mx-auto">
                                        <span>
                                            {{ __('general.customize_your_trip') }}
                                        </span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>


            </div>
        </div>
        </div>
    </section>

    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
