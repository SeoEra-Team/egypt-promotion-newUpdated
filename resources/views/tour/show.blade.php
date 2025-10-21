@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $tour->meta_title ?? env('APP_NAME'),
        'description' => $tour->meta_description ?? env('APP_NAME'),
        'keywords' => $tour->meta_keywords ?? env('APP_NAME'),
        'image' => $tour->getFirstMediaUrlOrDefault(MediaHelper::CATEGORY_MEDIA_PATH, 'webp')['url'],
        'schema' => $tour->meta_other ?? '',
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/tour-details.css') }}" />
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- LightGallery CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />
@endsection

@section('content')
    <section class="Breadcrumb-cover">
        <div class="container">
            <nav aria-label="breadcrumb text-center" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="{{ route('home') }}">
                            <span itemprop="name">
                                {{ __('general.home') }}
                            </span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item"
                            href="{{ route('tour.category', ['categorySlug' => $tour->category->category->slug]) }}">
                            <span itemprop="name">
                                {{ $tour->category->category->name }}
                            </span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item"
                            href="{{ route('tour.index', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug]) }}">
                            <span itemprop="name">
                                {{ $tour->category->name }}
                            </span>
                        </a>
                        <meta itemprop="position" content="3" />
                    </li>
                    <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <span itemprop="name">
                            {{ $tour->heading }}
                        </span>
                        <meta itemprop="position" content="4" />
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="tour-details-wrappers">
        <div class="container">
            <div class="tour-heading mt-20">
                <h1>
                    {{ $tour->name }}
                </h1>
                <div class="heading__cart">
                    <div class="tour_card mt-2">
                        <div class="trip-info-one__address">
                            <i class="icon fa-solid fa-location-dot"></i>
                            <span class="value">
                                {{ $tour->location }}
                            </span>
                        </div>

                        <div class="tg-tour-details-video-ratings">
                            @for ($index = 0; $index < $tour->rate; $index++)
                                <span><i class="fa-sharp fa-solid fa-star"></i></span>
                            @endfor
                            <span class="review">({{ $tour->counter_rate }} {{ __('tour.reviews') }})</span>
                        </div>

                    </div>
                    <div class="sidebar-price-total">

                        <p>{{ __('tour.from') }}:
                            @if ($tour->discount > 0)
                                <del>
                                    {{ App\Helpers\Classes\Currency::display($tour->price) }}
                                </del>
                            @endif
                            <span>
                                {{ Currency::display($tour->final_price) }}
                            </span>
                            / {{ __('tour.person') }}
                        </p>

                    </div>

                </div>

            </div>
            <div class="tour-gallery has-layout mt-3 " id="lightgallery"
                data-count="{{ $tour->getMedia(MediaHelper::TOUR_GALLERY_MEDIA_PATH)->count() }}">
                @foreach ($tour->getMedia(MediaHelper::TOUR_GALLERY_MEDIA_PATH) as $galleryImage)
                    <a href="{{ $galleryImage->getUrl('large') }}" class="tour-img">
                        <img src="{{ $galleryImage->getUrl('large') }}"
                            alt="{{ json_decode($galleryImage->img_alt)->{app()->getLocale()} ?? null }}"
                            title="{{ json_decode($galleryImage->img_title)->{app()->getLocale()} ?? null }}">
                    </a>
                @endforeach
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <section class="tour_details mt-5">
                        <div class="tour-card-info ">
                            <div class="tour-card-item">
                                <img src="{{ asset('assets/images/icon (1).svg') }}" alt="tour-card-imf-1">
                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.duration') }}
                                    </p>
                                    <span>
                                        {{ $tour->duration }}
                                    </span>
                                </div>
                            </div>
                            <div class="tour-card-item">
                                <img src="{{ asset('assets/images/icon.(2).svg') }}" alt="tour-card-imf-1">


                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.location') }}
                                    </p>
                                    <span>
                                        {{ $tour->location }}
                                    </span>
                                </div>
                            </div>
                            <div class="tour-card-item">

                                <img src="{{ asset('assets/images/icon.svg (4).svg') }}" alt="tour-card-imf-1">

                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.tour_availability') }}
                                    </p>
                                    <span>
                                        {{ $tour->tour_availability }}
                                    </span>
                                </div>
                            </div>
                            <div class="tour-card-item">

                                <img src="{{ asset('assets/images/guide.svg') }}" alt="tour-card-imf-1">

                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.live_tour_guide') }}
                                    </p>
                                    <span>
                                        {{ $tour->live_tour_guide }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="nav-wrapper">
                            <div class="tour-details-nav" style="top: 7%;">
                                <h3><a href="#tourOverview">
                                        {{ __('tour.overview') }}
                                    </a>
                                </h3>
                                <h3>
                                    <a href="#itineraryAccordion">
                                        {{ __('tour.itinerary') }}
                                    </a>
                                </h3>
                                <h3>
                                    <a href="#include">
                                        {{ __('tour.include') }}
                                    </a>
                                </h3>
                                <h3>
                                    <a href="#Exclude">
                                        {{ __('tour.exclude') }}
                                    </a>
                                </h3>
                                <h3>
                                    <a href="#highlights">
                                        {{ __('tour.highlights') }}
                                    </a>
                                </h3>
                                <h3><a href="#Notes">
                                        {{ __('tour.notes') }}
                                    </a>
                                </h3>
                                <h3>
                                    <a href="#prices">
                                        {{ __('tour.price_table') }}
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <div class="tour-details-section show" id="tourOverview">
                            <h3>
                                {{ __('tour.tour_overview') }}
                            </h3>
                            <div class="tour-details-section-content">

                                {!! $tour->overview !!}
                            </div>
                        </div>

                        <div class="itinerary-section">
                            <div class="itinerary-header">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="m-0" style="font-size:1.5rem;font-weight:600;">
                                        {{ __('tour.itinerary') }}
                                    </h3>
                                    <button class="expand-all-btn" id="expandAllBtn">
                                        {{ __('tour.expand_all') }}
                                    </button>
                                </div>
                            </div>

                            <div class="itinerary-timeline accordion" id="itineraryAccordion">
                                @foreach ($tour->itineraries as $itinerary)
                                    <div class="timeline-item accordion-item">
                                        <div
                                            class="timeline-marker {{ $loop->first ? 'start-marker' : '' }} {{ $loop->last ? 'end-marker' : '' }}">
                                            @if ($loop->first)
                                                <span class="marker-icon"><i class="fa-solid fa-location-dot"></i></span>
                                            @elseif ($loop->last)
                                                <span class="marker-icon"><i class="fa-solid fa-flag"></i></span>
                                            @else
                                                <span class="marker-dot"></span>
                                            @endif
                                        </div>
                                        <div class="timeline-content">
                                            <div class="day-item accordion-header" id="heading{{ $loop->index + 1 }}">
                                                <button class="accordion-button day-header-inline collapsed"
                                                    type="button" data-bs-target="#collapse{{ $loop->index + 1 }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $loop->index + 1 }}">
                                                    <span class="day-label">{{ __('tour.day') }} {{ $itinerary->day }}
                                                    </span>
                                                    <span class="day-title">
                                                        {{ $itinerary->heading }}
                                                    </span>

                                                </button>

                                                <div id="collapse{{ $loop->index + 1 }}"
                                                    class="accordion-collapse day-details collapse {{ $loop->first ? 'show' : '' }}"
                                                    aria-labelledby="heading{{ $loop->index + 1 }}">
                                                    <div class="accordion-body">
                                                        <div class="activity-item">
                                                            {!! $itinerary->description !!}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Day 1 -->

                                {{-- <!-- Day 2 -->
                                <div class="timeline-item accordion-item">
                                    <div class="timeline-marker">
                                        <span class="marker-dot"></span>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="day-item accordion-header" id="heading2">
                                            <button class="accordion-button day-header-inline collapsed" type="button"
                                                data-bs-target="#collapse2" aria-expanded="false"
                                                aria-controls="collapse2">
                                                <span class="day-label">Day 2</span>
                                                <span class="day-title">Cairo Pyramids Giza Memphis Saqqara</span>

                                            </button>
                                            <div id="collapse2" class="accordion-collapse day-details collapse"
                                                aria-labelledby="heading2">
                                                <div class="accordion-body">
                                                    <div class="activity-item">
                                                        Visit one of the Seven Wonders of the World! Your guide will
                                                        take you to the 5000-year old necropolis in Giza. Stand at the
                                                        foot of the Great Pyramids, built for Cheops, Chefren and
                                                        Mykerinus, and guarded by the Great Sphinx. Everyone who visits
                                                        Egypt needs to see the Pyramids.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Day 6 -->
                                <div class="timeline-item accordion-item">
                                    <div class="timeline-marker end-marker">
                                        <span class="marker-icon"><i class="fa-solid fa-flag"></i></span>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="day-item accordion-header" id="heading6">
                                            <button class="accordion-button day-header-inline collapsed" type="button"
                                                data-bs-target="#collapse6" aria-expanded="false"
                                                aria-controls="collapse6">
                                                <span class="day-label">Day 6</span>
                                                <span class="day-title">Luxor sightseeing and departure</span>

                                            </button>
                                            <div id="collapse6" class="accordion-collapse day-details collapse"
                                                aria-labelledby="heading6">
                                                <div class="accordion-body">
                                                    <div class="activity-item">
                                                        Visit one of the Seven Wonders of the World! Your guide will
                                                        take you to the 5000-year old necropolis in Giza. Stand at the
                                                        foot of the Great Pyramids, built for Cheops, Chefren and
                                                        Mykerinus, and guarded by the Great Sphinx. Everyone who visits
                                                        Egypt needs to see the Pyramids.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="tour-details-section show" id="include">
                            <h3>
                                {{ __('tour.include') }}
                            </h3>
                            <div class="tour-details-section-content">
                                <div class="include_exclude_container">
                                    <div class="include-wrapper">
                                        <ul>
                                            {!! $tour->inclusion !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tour-details-section show" id="Exclude">
                            <h3> {{ __('tour.exclude') }}</h3>
                            <div class="tour-details-section-content">
                                <div class="include_exclude_container">
                                    <div class="exclude-wrapper">
                                        <ul>
                                            {!! $tour->exclusion !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tour-details-section show" id="highlights">
                            <h3> {{ __('tour.highlights') }} </h3>

                            <div class="tour-details-section-content">
                                <div class="highlights_container">
                                    <div class="important-wrapper">

                                        <ul>
                                            {!! $tour->highlights !!}
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tour-details-section show" id="Notes">
                            <h3> {{ __('tour.notes') }} </h3>

                            <div class="tour-details-section-content">
                                <div class="highlights_container">

                                    <div class="extraInfo-wrapper">

                                        <ul>
                                            {!! $tour->notes !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tour-details-section tour_prices show" id="prices">
                            <h2>
                                <span class="me-2 mb-4"></span>
                                {{ __('tour.price_table') }}
                            </h2>
                            <div class="row g-4  mt-2">

                                <div class="price-policy">
                                    <div class="row  mt-2">
                                        @if ($tour->type == 'tour')
                                            @include('tour.partials.price_table_tour', ['tour' => $tour])
                                        @elseif($tour->type == 'package')
                                            @include('tour.partials.price_table_package', [
                                                'tour' => $tour,
                                            ])
                                        @else
                                            @include('tour.partials.price_table_nile_cruise', [
                                                'tour' => $tour,
                                            ])
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                    </section>
                </div>
                <div class="col-lg-4">
                    @include('tour.partials.reservation_tour_form', ['tour' => $tour])
                </div>

            </div>

        </div>
    </section>
    @if ($relatedTours->count() > 0)
        <section class="  Related_Tour padtobo-40"
            style="background-color:#F3EEEA;background-image: url({{ asset('assets/images/blog_bg_1.png') }});">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="section-title text-center ">
                        <div class="col-12">
                            <span class="section-title-span">
                                {{ __('tour.tours') }}
                            </span>
                            <h2>
                                {{ __('tour.related_tours') }}
                            </h2>
                            <div class="desc ">
                                <p>
                                    {{ __('tour.related_tours_desc') }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="travel-shape-two">
                        <img src="{{ asset('assets/images/world-theme.png') }}" alt="shape">
                    </div>
                    <div class="travel-shape-one">
                        <img src="{{ asset('assets/images/shape-3.png') }}" alt="shape">
                    </div>
                </div>


                <div class="row align-items-stretch">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($relatedTours as $tour)
                                <div class="swiper-slide">
                                    @include('layout.partials.tour_box', ['tour' => $tour])
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>


                </div>

            </div>
        </section>
    @endif
    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection

@section('extraScripts')
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/js/tourdetails.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- @if (request()->routeIs('tour.show')) --}}
    @if (session()->has('errors'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif
@endsection
