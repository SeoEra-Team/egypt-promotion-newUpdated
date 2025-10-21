@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $category->meta_title ?? env('APP_NAME'),
        'description' => $category->meta_description ?? env('APP_NAME'),
        'keywords' => $category->meta_keywords ?? env('APP_NAME'),
        'image' => $category->getFirstMediaUrlOrDefault(
            App\Helpers\Constants\MediaHelper::ARTICLE_MEDIA_PATH,
            'webp')['url'],
        'schema' => $category->meta_other ?? '',
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ $category->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_BANNER_MEDIA_PATH, 'webp')['url'] }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ $category->name }}
                        </h1>
                        <ul class="breadcrumb-link">
                            <li>
                                <a href="{{ route('home') }}">
                                    {{ __('general.home') }}
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li>
                                {{ $category->heading }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="blog-section padtobo-40" style="background-image: url({{ asset('assets/images/dot-element.png') }})">
        <div class="container">

            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ $category->name }}
                        </span>
                        <h2>
                            {{ $category->title  ?? ''}}
                        </h2>
                        <p>
                            {!! $category->description !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-lg-4 gy-5">

                <div class="col-lg-12">
                    <div class="blog__section">


                        @foreach ($firstArticle as $key => $article)
                            <div class="col-lg-6">
                                <div class="blog-card one mb-3">
                                    <div class="blog-card-img-wrap blog--card">
                                        <a href="{{ route('blog.show', ['slugCategory' => $category->slug, 'slug' => $article->slug]) }}"
                                            class="card-img card__img" aria-label=" {{ $article->name }}">
                                            <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                                                alt="">
                                        </a>

                                    </div>
                                    <div class="blog-card-content blog__card">

                                        <h3>
                                            <a
                                                href="{{ route('blog.show', ['slugCategory' => $category->slug, 'slug' => $article->slug]) }}">
                                                {{ $article->name }}
                                            </a>
                                        </h3>

                                        <p class="blog__card-text">
                                            {{ Str::limit($article->short_description, 100) }}
                                        </p>
                                        <div class="blog-date">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span> {{ $article->created_at->format('M d, Y') }}</span>
                                        </div>


                                        <div class="bottom-area mt-3">

                                            <a
                                                href="{{ route('blog.show', ['slugCategory' => $category->slug, 'slug' => $article->slug]) }}">{{ __('general.read_more') }}
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"
                                                        viewBox="0 0 14 12" fill="none">
                                                        <path d="M2.07617 8.73272L12.1899 2.89355" stroke-linecap="round">
                                                        </path>
                                                        <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105"
                                                            stroke-linecap="round"></path>
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


                <hr>

                <div class="row col-lg-12">
                    @if ($articles->count() > 2)
                        @foreach ($articles->skip(2) as $key => $article)
                            <div class="blog__section col-lg-4">
                                @include('layout.partials.article_box', ['article' => $article, 'style' => 'articles'])
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-12" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            {{ $articles->links() }}
                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </div>



    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
