@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('about_meta_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('about_meta_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('about_meta_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('about_section_banner')),
        'schema' => nova_get_setting('about_schema'),
    ])
@endsection

@section('extraStyles')
    <link rel="stylesheet" href="{{ asset('assets/css/Favourite.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ Storage::url(nova_get_setting('about_section_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('about_title', env('APP_NAME')) }}
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
                                    {{ nova_get_setting_translate('about_title', env('APP_NAME')) }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('home.partials.services_section')
    @include('home.partials.about_section')



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