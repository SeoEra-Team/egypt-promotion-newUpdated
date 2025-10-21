@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => $category->meta_title ?? env('APP_NAME'),
        'description' => $category->meta_description ?? env('APP_NAME'),
        'keywords' => $category->meta_keywords ?? env('APP_NAME'),
        'image' => $category->getFirstMediaUrlOrDefault(MediaHelper::CATEGORY_MEDIA_PATH, 'webp')['url'],
        'schema' => $category->meta_other ?? '',
    ])
@endsection

@section('extraStyles')
    
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ $category->getFirstMediaUrlOrDefault(MediaHelper::CATEGORY_BANNER_MEDIA_PATH, 'webp')['url'] }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">{{ $category->name }}</h1>
                        <ul class="breadcrumb-link">
                            <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li>{{ $category->heading }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class=" padtobo-40" style="background-image: url(./assets/images/adjustment-bg-quck.png)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <span class="section-title-span">

                            {{ $category->name }}
                        </span>
                        <h2>
                            {{ $category->menu_title }}
                        </h2>
                        <div class="desc ">
                            <p>
                                {!!$category->description !!}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="blogs-wrapper">

                <div class="row ">
                    @foreach ($category->children->where('status', 1) as $subCategory)
                        <div class="col-md-3 mb-2  ">
                            @include('layout.partials.sub_category_box', ['subCategory' => $subCategory])
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
{{-- @foreach ($category->children as $subCategory)
    @include('layout.partials.sub_category_box', ['subCategory' => $subCategory])
@endforeach --}}
