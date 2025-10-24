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
    <link rel="stylesheet" href="{{ asset('assets/css/tourdetails.css') }}" />
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- LightGallery CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />
@endsection

@section('content')
    <div class="breadcrumb-area bg-peach position-relative z-1">
        <!-- <img src="./assets/images/br-bg-shape.png" alt="Shape" class="br-bg-shape position-absolute bottom-0 start-0"> -->
        <div class="container breadcrumb_text">
            <!-- <h1 class="section-title style-two">Egypt Excursions</h1> -->
            <ul class="br-menu list-unstyled mb-0">
                <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                <li>
                    <a href="{{ route('tour.category', ['categorySlug' => $tour->category->category->slug]) }}">
                        {{ $tour->category->category->heading }}
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('tour.index', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug]) }}">
                        {{ $tour->category->heading }}
                    </a>
                </li>
                <li>
                    {{ $tour->heading }}
                </li>
            </ul>
        </div>
    </div>



    <section class="tour-details-wrappers">
        <div class="container">

            <div class="tour-heading mt-2">
                <h1>
                    {{ $tour->name }}
                </h1>
                <div class="tour_card mt-2">
                    <div class="trip-info-one__address">
                        <i class="icon fa-solid fa-location-dot"></i>
                        <span class="value"> {{ $tour->location }}</span>
                    </div>
                    <div class="sidebar-price-total">
                        <div class="extra-nav  d-none d-sm-block">
                            <a href="#" class="theme-btn">
                                <i class="far fa-file-pdf"></i>
                                {{ __('tour.download_pdf') }}
                            </a>

                        </div>
                        <p>{{ __('tour.from') }}:
                            <span>{{ Currency::display($tour->final_price) }} </span>
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



                    <section class="tour_details mt-2">
                        <div class="tour-card-info ">


                            <div class="tour-card-item">
                                <img src="{{ asset('assets/images/tag.png') }}" alt="tour-card-imf-1">
                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.price') }}
                                    </p>
                                    <span>
                                        {{ Currency::display($tour->final_price) }}
                                    </span>
                                </div>
                            </div>

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

                                <img src="{{ asset('assets/images/travel-and-tourism.png') }}" alt="tour-card-imf-1">

                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.type') }}
                                    </p>
                                    <span>

                                        {{ $tour->tour_availability }}
                                    </span>
                                </div>
                            </div>
                            <div class="tour-card-item">

                                <img src="{{ asset('assets/images/schedule.webp') }}" alt="tour-card-imf-1">

                                <div class="tour-card--content">
                                    <p>
                                        {{ __('tour.tour_runs') }}
                                    </p>
                                    <span>
                                        {{ $tour->tour_runs }}
                                    </span>
                                </div>
                            </div>


                        </div>

                        <div class="nav-wrapper">
                            <div class="tour-details-nav " style="top: 7%;">
                                <h3 class=""><a href="#tourOverview">
                                        {{ __('tour.overview') }}
                                    </a></h3>
                                <h3 class="">
                                    <a href="#itineraryAccordion">
                                        {{ __('tour.itinerary') }}
                                    </a>
                                </h3>
                                <h3 class="">
                                    <a href="#include">
                                        {{ __('tour.include') }}
                                    </a>
                                </h3>
                                <h3 class=""><a href="#Exclude">{{ __('tour.exclude') }}</a></h3>

                                <h3 class=""><a href="#Notes">{{ __('tour.notes') }} </a></h3>
                                <h3 class="active"><a href="#prices">{{ __('tour.price_table') }}</a></h3>
                            </div>
                        </div>

                        <div class="tour-details-section show" id="tourOverview">
                            <h3>
                                {{ __('tour.overview') }}
                            </h3>
                            <div class="tour-details-section-content">
                                {!! $tour->overview !!}

                            </div>
                        </div>

                        <div class="itinerary-section">
                            <div class="itinerary-header">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="m-0" style="font-size:1.5rem;font-weight:600;">
                                        {{ __('tour.itinerary') }}</h3>
                                    <button class="expand-all-btn" id="expandAllBtn">{{ __('tour.expand_all') }}</button>
                                </div>
                            </div>

                            <div class="itinerary-timeline accordion" id="itineraryAccordion">
                                @foreach ($tour->itineraries as $itinerary)
                                    <div class="timeline-item accordion-item">

                                        <div class="timeline-content">
                                            <div class="day-item accordion-header" id="heading1">
                                                <button class="accordion-button day-header-inline collapsed" type="button"
                                                    data-bs-target="#collapse1" aria-expanded="true"
                                                    aria-controls="collapse1">
                                                    <span class="day-label">{{ __('tour.day') }}
                                                        {{ $itinerary->day }}</span>
                                                    <span class="day-title">
                                                        {{ $itinerary->heading }}
                                                    </span>

                                                </button>
                                                <div id="collapse1" class="accordion-collapse day-details collapse show"
                                                    aria-labelledby="heading1">
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


                        <div class="tour-details-section show" id="Notes">
                            <h3> {{ __('tour.notes') }} </h3>

                            <div class="tour-details-section-content">
                                <div class="highlights_container">

                                    <div class="extraInfo-wrapper">
                                        {!! $tour->notes !!}

                                    </div>
                                </div>
                            </div>
                        </div>


                </div>

                <div class="col-lg-4">

                    @include('tour.partials.reservation_tour_form')


                </div>

            </div>


        </div>
    </section>

    @if ($relatedTours->count() > 0)
        <div class="w-100 travel-tour-second travel-tour_second  hotel-section mt-5">
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
                <div class="row">
                    <!-- Swiper -->
                    <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-backface-hidden">
                        <div class="swiper-wrapper" id="swiper-wrapper-3503ce012ebf8da8" aria-live="polite"
                            style="transition-duration: 0ms; transform: translate3d(-900px, 0px, 0px); transition-delay: 0ms;">
                            @foreach ($relatedTours as $tour)
                                <div class="swiper-slide" role="group" aria-label="{{ $loop->index + 1 }} / {{ $relatedTours->count() }}" data-swiper-slide-index="{{ $loop->index }}"
                                    style="width: 420px; margin-right: 30px;">
                                    @include('layout.partials.tour_box', ['style' => 'show_tour' , 'tour' => $tour])
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>
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
