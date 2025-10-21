@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $travelStyle->meta_title,
        'description' => $travelStyle->meta_description,
        'keywords' => $travelStyle->meta_keywords,
        'image' => $travelStyle->getFirstMediaUrlOrDefault(MediaHelper::TRAVEL_STYLE_MEDIA_PATH, 'webp')['url'],
        'schema' => $travelStyle->schema,
    ])
@endsection
@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/tour.css') }}" />
@endsection
@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ $travelStyle->getFirstMediaUrlOrDefault(MediaHelper::TRAVEL_STYLE_BANNER_MEDIA_PATH, 'webp')['url'] }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ $travelStyle->name }}
                        </h1>
                        <ul class="breadcrumb-link">
                            <li>
                                <a href="{{ route('home') }}">
                                    {{ __('general.home') }}
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li>{{ $travelStyle->heading }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="packages-section bg-light mt-5 pt-3 pb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center">
                    <div class="col-12">
                        <h2>
                            {{ $travelStyle->title }}
                        </h2>
                        <p class=" mx-auto mt-2">
                            {!! $travelStyle->description !!}
                        </p>

                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($travelStyle->tours as $tour)
                    <div class="col-lg-4 col-md-6 col-12 package-block mb-2">
                        <div class="inner-box style-inner-box">
                            <div class="image-box img-block-recc">
                                <div class="image">
                                    <a href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' =>$tour->slug ]) }}">
                                        <img class=" ls-is-cached lazyloaded" alt="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['title'] }}"
                                            title="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['title'] }}" src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}">
                                    </a>

                                </div>

                                <div class="price--main--tour">
                                    <span>
                                          <del>
                                                14000$
                                            </del>
                                        {{ Currency::display($tour->final_price) }}
                                        <i> {{ __('tour.per_person') }} </i> </span>
                                </div>
                            </div>

                            <div class="lower-box style-inner-box">

                                <div class="location">
                                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i> {{ $tour->location }}
                                </div>
                                <h3 class="style-three-Tour"><a href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' =>$tour->slug ]) }}">
                                        {{ $tour->name }}
                                    </a>
                                </h3>

                                <div class="bottom-box clearfix">
                                    <div class="rating ">
                                        <p>
                                            <i class="fa-solid fa-calendar-plus"></i>
                                            <strong>
                                                {{ $tour->duration }}
                                            </strong>
                                        </p>
                                        <a class="xb-item--link" href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' =>$tour->slug ]) }}">
                                            {{ __('tour.view_details') }}

                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    @include('layout.partials.faqs', ['faqs' => $travelStyle->FAQs])
@endsection
