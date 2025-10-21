@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $tag->meta_title ?? env('APP_NAME'),
        'description' => $tag->meta_description ?? env('APP_NAME'),
        'keywords' => $tag->meta_keywords ?? env('APP_NAME'),
        'image' => $tag->getFirstMediaUrlOrDefault(MediaHelper::TAG_MEDIA_PATH, 'webp')['url'],
        'schema' => $tag->meta_other ?? '',
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/tour.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ $tag->getFirstMediaUrlOrDefault(MediaHelper::TAG_BANNER_MEDIA_PATH, 'webp')['url'] }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ $tag->name }}
                        </h1>
                        <ul class="breadcrumb-link">
                            <li><a href="{{ route('home') }}">
                                    {{ __('general.home') }}
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li>
                                {{ $tag->heading }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" padtobo-40" style="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <h2>
                            {{ $tag->name }}

                        </h2>
                        <p>
                            {!! $tag->description !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row align-items-stretch">
                @foreach ($tag->tours as $tour)
                    <div class="col-lg-3">
                        @include('layout.partials.tour_box', ['tour' => $tour])
                    </div>
                @endforeach
            </div>




        </div>
    </section>
    <section class=" padtobo-40"
        style="background-color:#F3EEEA; background-image: url({{ asset('assets/images/blog_bg_1.png') }});;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <h2>
                            {{ __('tag.related_articles') }}

                        </h2>
                        <p>
                            {{ __('tag.related_articles_description') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row ">
                {{-- @dd($articles) --}}
                @foreach ($articles as $article)
                    <div class="blog__section col-lg-4">
                        <div class="blog-card one mb-3 w-100">
                            <div class="blog-card-img-wrap blog--card w-100">
                                <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}"
                                    aria-label="{{ $article->name }}" class="card-img card__img"
                                    aria-label=" {{ $article->name }}">
                                    <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                                        alt="">
                                </a>

                            </div>
                            <div class="blog-card-content blog__card">

                                <h3><a
                                        href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ $article->name }}</a>
                                </h3>

                                <p class="blog__card-text">
                                    {{ Str::limit($article->short_description, 100) }}

                                </p>
                                <div class="blog-date">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span>
                                        {{ $article->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <div class="bottom-area mt-3">

                                    <a
                                        href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ __('general.read_more') }}
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"
                                                viewBox="0 0 14 12" fill="none">
                                                <path d="M2.07617 8.73272L12.1899 2.89355" stroke-linecap="round">
                                                </path>
                                                <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105"
                                                    stroke-linecap="round">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>




        </div>
    </section>
@endsection
