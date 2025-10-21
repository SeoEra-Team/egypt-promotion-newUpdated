@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('article_category_meta_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('article_category_meta_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('article_category_meta_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('article_category_banner')),
        'schema' => nova_get_setting('article_category_schema'),
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
@endsection

@section('content')
    <section class="page-hero-banner bg_cover" style="background-image: url({{ Storage::url(nova_get_setting('article_category_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('article_category_name') }}
                        </h1>
                        <ul class="breadcrumb-link">
                            <li><a href="{{ route('home') }}">
                                    {{ __('general.home') }}
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li>
                                {{ nova_get_setting_translate('article_category_heading') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <section class="blogs padtobo-40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ nova_get_setting_translate('article_category_name') }}
                        </span>
                        <h2>
                            {{ nova_get_setting_translate('article_category_title') }}
                        </h2>
                        <p>
                            {!! nova_get_setting_translate('article_category_description') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="posts">
                <div class="row">

                    @foreach ($categories as $category)
                        <div class="col-lg-4">
                            <a href="{{ route('blog.get.articles', ['slugCategory' => $category->slug]) }}"
                                class="post-card">
                                <div class="img">
                                    <img loading="lazy"
                                        src="{{ $category->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH, 'webp')['url'] }}"
                                        alt="{{ $category->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH, 'webp')['title'] }}"
                                        title="{{ $category->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH, 'webp')['title'] }}"
                                        class="img-cover">
                                </div>
                                <div class="info-box">
                                    <div class="date"> <span class="date">
                                            {{ Carbon\Carbon::parse($category->created_at)->format('d M Y') }} </span>
                                    </div>

                                    <div class="cont">
                                        <h3 class="post-title">
                                            {{ $category->name }}
                                        </h3>
                                        @if (!empty($category->author_name))
                                            <span class="author-blog">
                                                <i class="fa-regular fa-user"></i>
                                                {{ $category->author_name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach



                </div>

            </div>
        </div>

        <div class="lines">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </section>


    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
@section('sub_schema')

<script type="application/ld+json">
    {!! $jsonBreadcrumb !!}
</script>
@endsection