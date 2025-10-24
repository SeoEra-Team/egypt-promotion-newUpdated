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
    <div class="breadcrumb-area bg-peach position-relative z-1">
        <!-- <img src="./assets/images/br-bg-shape.png" alt="Shape" class="br-bg-shape position-absolute bottom-0 start-0"> -->
        <div class="container breadcrumb_text">
            <!-- <h1 class="section-title style-two">Egypt Excursions</h1> -->
            <ul class="br-menu list-unstyled mb-0">
                <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                <li>
                    {{ $category->heading }}
                </li>
            </ul>
        </div>
    </div>


    <section class="Recommend-tours collection-banner  ">
        <div class="container">

            <div class="row justify-content-center">
                <div class="section-title text-center mb-3">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ $category->name }}
                        </span>
                        <h2>
                            {{ $category->title ?? '' }}
                        </h2>
                        <div class="descc mb-3">
                            {!! $category->description !!}
                        </div>
                        <div class="extra-nav d-flex justify-content-center">
                            <button class="theme-btn showMore-Btn">
                                {{ __('category.show_more') }}
                            </button>

                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                @foreach ($category->children as $subCategory)
                    <div class="col-lg-4">
                        <a
                            href="{{ route('tour.index', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}">
                            <div class="collection-card mb-2">
                                <div class="thumb">
                                    <a
                                        href="{{ route('tour.index', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}">
                                        <img src="{{ $subCategory->getFirstMediaUrlOrDefault(MediaHelper::SUB_CATEGORY_MEDIA_PATH, 'webp')['url'] }}"
                                            alt="collection-img"></a>
                                    <div class="content">
                                        <h3>
                                            {{ $subCategory->name }}
                                        </h3>
                                        <p>
                                            {{ Str::limit($subCategory->short_description, 100) }}
                                        </p>
                                        <a href="{{ route('tour.index', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
                                            class="btn-effect"><span>
                                                {{ __('category.explore') }}
                                            </span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    @include('layout.partials.faqs', ['faqs' => $faqs])
@endsection
{{-- @foreach ($category->children as $subCategory)
    @include('layout.partials.sub_category_box', ['subCategory' => $subCategory])
@endforeach --}}
