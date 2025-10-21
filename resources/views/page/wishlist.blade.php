@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('wishlist_meta_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('wishlist_meta_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('wishlist_meta_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('wishlist_section_banner')),
        'schema' => nova_get_setting('wishlist_schema'),
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/Favourite.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ Storage::url(nova_get_setting('wishlist_section_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('wishlist_section_title', env('APP_NAME')) }}
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
                                    {{ nova_get_setting_translate('wishlist_section_title', env('APP_NAME')) }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="favourite-section padtobo-30">
        <div class="container">
            @foreach ($data['favoriteTours'] as $tour)
                <div class="fav-tour-card">
                    <div class="fav-tour-img">
                        <img src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}"
                            alt="Tour Image">
                        <div class="heart-icon">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                    <div class="fav-tour-details">
                        <h3 class="fav-tour-title">
                            <a href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' => $tour->slug]) }}">
                                {{ $tour->name }}
                            </a>
                        </h3>
                        <p class="two-line">{{ $tour->short_description }}</p>
                        <div class="tour-info-box">
                            <div class="tour-info-row">
                                <span class="tour-info-label"><i class="fa-solid fa-calendar-days"></i> 
                                    
                                    {{ __('general.duration') }}:</span>
                                <span class="tour-info-value">
                                    {{ $tour->duration }}
                                </span>
                            </div>
                            <div class="tour-info-row">
                                <span class="tour-info-label"> <i class="fa-solid fa-clock"></i> {{ __('general.schedule') }}:</span>
                                <span class="tour-info-value">
                                    {{ $tour->tour_availability }}
                                </span>
                            </div>
                            <div class="tour-info-row">
                                <span class="tour-info-label"> <i class="fa-solid fa-location-dot"></i> {{ __('general.location') }}:</span>
                                <span class="tour-info-value"> {{ $tour->location }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="fav-tour-actions">

                        <span class="person d-inline-block p-0 m-0">
                            <span class="price d-inline-block p-0 m-0">
                                {{ Currency::display($tour->final_price) }}

                            </span>
                            /{{ __('general.person') }}
                        </span>



                        <a href="{{ route('favorite.remove', $tour->id) }}" class="favBtn theme-btn">
                            <i class="fa-solid fa-xmark"></i> 
                            {{ __('general.remove_from_favorites') }}
                        </a>


                    </div>
                </div>
            @endforeach


        </div>
    </section>


    @include('layout.partials.faqs')
@endsection
@section('extraScripts')
    <script type="text/javascript"></script>
@endsection
@section('schema')
<script type="application/ld+json">
    {!! $jsonBreadcrumb ?? '' !!}
</script>

@endsection