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
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ $subCategory->getFirstMediaUrlOrDefault(MediaHelper::SUB_CATEGORY_BANNER_MEDIA_PATH, 'webp')['url'] }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ $subCategory->name }}
                        </h1>
                        <ul class="breadcrumb-link">
                            <li><a href="{{ route('home') }}">
                                    {{ __('general.home') }}
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li><a href="{{ route('tour.category', $subCategory->category->slug) }}">
                                    {{ $subCategory->category->name }}
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>

                            <li>
                                {{ $subCategory->heading }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" padtobo-40" style="background-color:#F3EEEA; background-image: url({{ asset('assets/images/blog_bg_1.png') }});;">
        <div class="container">

            <div>
                <div class="travel-shape-two">
                    <img src="{{ asset('assets/images/world-theme.png') }}" alt="shape">
                </div>
                <div class="travel-shape-one">
                    <img src="{{ asset('assets/images/shape-3.png') }}" alt="shape">
                </div>
            </div>

            @include('tour.partials.filters')


            <div class="row align-items-stretch">
                @foreach ($tours as $tour)
                    <div class="col-lg-3">
                        @include('layout.partials.tour_box', ['tour' => $tour])
                    </div>
                @endforeach

            </div>

        </div>
    </section>

    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
