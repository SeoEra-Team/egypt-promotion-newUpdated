@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('travel_style_meta_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('travel_style_meta_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('travel_style_meta_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('travel_style_section_banner')),
        'schema' => nova_get_setting('travel_style_schema'),
    ])
@endsection

@section('extraStyles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/travelStyle.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/TravelStyle.css') }}">

@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ Storage::url(nova_get_setting('travel_style_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('travel_style_name', env('APP_NAME')) }}
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
                                    {{ nova_get_setting_translate('travel_style_heading', env('APP_NAME')) }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="destination-gallery-section mb-4 mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center">
                    <div class="col-12">
                        <h2>
                            {{ nova_get_setting_translate('travel_style_title', env('APP_NAME')) }}
                        </h2>
                        <p class=" mx-auto mt-2">
                            {!! nova_get_setting_translate('travel_style_description', env('APP_NAME')) !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-lg-4 gy-5 mb-70">


                @foreach ($travelStyles as $travelStyle)
                    <div class="col-lg-3 col-sm-6">
                        <div class="destination-card">
                            <a href="{{ route('travel_styles.travelStyle', $travelStyle->slug) }}">
                                <img src="{{ $travelStyle->getFirstMediaUrlOrDefault(MediaHelper::TRAVEL_STYLE_MEDIA_PATH, 'webp')['url'] }}"
                                    alt="destination-card">

                            </a>
                            <div class="overlay"></div>
                            <div class="content">
                                <a href="{{ route('travel_styles.travelStyle', $travelStyle->slug) }}">
                                    <h3 class="text-travel-to">
                                        {{ $travelStyle->name }}
                                    </h3>
                                </a>
                                <a href="{{ route('travel_styles.travelStyle', $travelStyle->slug) }}"
                                    class="details-btn mt-5">
                                    {{ __('general.read_more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="col-md-12">
                    <div class="col-md-12" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                {{ $travelStyles->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.partials.faqs')
@endsection
@section('extraScripts')
    <script type="text/javascript"></script>
@endsection
@section('schema')
<script type="application/ld+json">
    {!! $jsonBreadcrumb !!}
</script>

@endsection