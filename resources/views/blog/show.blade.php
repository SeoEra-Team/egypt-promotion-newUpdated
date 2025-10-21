@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $article->meta_title ?? env('APP_NAME'),
        'description' => $article->meta_description ?? env('APP_NAME'),
        'keywords' => $article->meta_keywords ?? env('APP_NAME'),
        'image' => $article->getFirstMediaUrlOrDefault(
            App\Helpers\Constants\MediaHelper::ARTICLE_MEDIA_PATH,
            'webp')['url'],
        'schema' => $article->meta_other ?? '',
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_BANNER_MEDIA_PATH, 'webp')['url'] }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ $article->name }}
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
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemprop="item"
                                    href="{{ route('blog.index', ['categorySlug' => $article->category->slug]) }}">
                                    <span itemprop="name">
                                        {{ $article->category->name }}
                                    </span>
                                </a>
                                <meta itemprop="position" content="1" />
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active"
                                aria-current="page">
                                <span itemprop="name">
                                    {{ $article->name }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-details-wrapper mt-5 mb-5">
        <div class="container">
            <div class="row blog__details">
                <div class="col-lg-8">
                    <div class="blog-page-content">
                        <div class="page-blog-post blog-post-detail">
                            <div class="blog-img-box">
                                <div class="blog-img back-img position-relative">
                                    <img loading="lazy"
                                        src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                                        alt="Anim labore dolor mollit esse do labore adipisicing fugiat"
                                        title="Anim labore dolor mollit esse do labore adipisicing fugiat">
                                    <div class="blog-date">
                                        <a href="#"
                                            title="{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }}">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }}
                                        </a>
                                        <a href="#" class="by-admin" title="By Admin">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            {{ $article->author_name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- <h3 class="h3-title mt-5">How to Enjoy A Luxury Vacation in Egypt </h3> -->

                            <div class="page-blog-text">
                                {!! $article->description !!}
                            </div>

                            @if (count($article_details) > 0)
                                @foreach ($article_details as $article_detail)
                                    <div class="page-blog-text">
                                        <h3 class="h3-title mt-4" id="{{ $loop->iteration }}">
                                            {{ $article_detail['title'] }}
                                        </h3>
                                        {!! $article_detail['description'] !!}
                                    </div>
                                @endforeach
                            @endif



                        </div>
                    </div>

                    <div class="article-footer">
                        <div class="article-tags-share">
                            <div class="article-tags">
                                <span class="Share">{{ __('article.tags') }}:</span>
                                @foreach ($article->tags as $tag)
                                    <a href="{{ route('tag.index', $tag->slug) }}" class="tag-item">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                            <div class="article-share">
                                <span class="Share">{{ __('article.share') }}:</span>
                                @if (isset($socialMedia) && count($socialMedia))
                                    <ul class="social-media-navbar mt-4 mb-4">
                                        @foreach ($socialMedia as $social_row)
                                            @if ($social_row['platform'] == 'tripadvisor')
                                                <li>
                                                    <a href="{{ $social_row['link'] }}" target="_blank" class="tripadvisor"
                                                        aria-label="tripadvisor-account" itemprop="sameAs">
                                                        <svg style="width: 25px !important;"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            id="tripadvisor">
                                                            <g fill="none" stroke="#FFF" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <circle cx="6" cy="13" r=".5"></circle>
                                                                <circle cx="6" cy="13" r="2.5"></circle>
                                                                <circle cx="6" cy="13" r="5.5"></circle>
                                                                <circle cx="18" cy="13" r=".5"></circle>
                                                                <circle cx="18" cy="13" r="2.5"></circle>
                                                                <circle cx="18" cy="13" r="5.5"></circle>
                                                                <path
                                                                    d="M4.38 7.5a15.52 15.52 0 0 1 15.24 0M5.5 7.5h-5a5.64 5.64 0 0 1 1.09 2.22M18.5 7.5h5a5.64 5.64 0 0 0-1.09 2.22M10.54 16.1 12 18.5l1.46-2.4">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $social_row['link'] }}" target="_blank"
                                                        aria-label="Visit our social Pages"
                                                        class="{{ $social_row['platform'] }}"
                                                        aria-label="{{ $social_row['platform'] }}-account"
                                                        itemprop="sameAs">
                                                        <i class="fa-brands fa-{{ $social_row['icon'] }}"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="recent-post">
                        <h3 class="sidebar-title">{{ __('article.scopri_i_nostri') }}:</h3>
                        <h3 class="text_blog">
                            {{ $article->name }}
                        </h3>
                        <blockquote class="vs-blockquote">
                            @if (count($article_details) > 0)
                                <ul class="list-unstyled blockquote_list">
                                    @foreach ($article_details as $article_detail)
                                        <li class="title">
                                            <a href="#{{ $loop->iteration }}" class="smooth-scroll">
                                                {{ $article_detail['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </blockquote>

                    </div>

                </div>
            </div>
    </section>

    {{-- related articles --}}
    @if ($related_articles->count() > 0)
        @include('blog.partials.related_articles', ['related_articles' => $related_articles])
    @endif

    {{-- related tours --}}
    @if ($related_tours->count() > 0)
        @include('blog.partials.related_tours', ['related_tours' => $related_tours])
    @endif


    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
@section('extraScripts')
    <script>
        var swiper = new Swiper(".Related_Tour .mySwiper", {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1, // موبايل
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 2, // تابلت
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4, // ديسكتوب
                    spaceBetween: 30,
                },
            },
        });
    </script>
    <script>
        document.querySelectorAll('.blockquote_list .title a').forEach(link => {
            link.addEventListener('click', function() {

                document.querySelectorAll('.blockquote_list .title a')
                    .forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
@endsection
@section('sub_schema')
    <script type="application/ld+json">
    {!! $jsonBreadcrumb !!}
    {!! $jsonArticle !!}
</script>
@endsection
