@extends('layout.master')
@section('meta')
    @include('layout.partials.seo', [
        'title' => nova_get_setting_translate('offer_section_main_title', env('APP_NAME')),
        'description' => nova_get_setting_translate('offer_section_description', env('APP_NAME')),
        'keywords' => nova_get_setting_translate('offer_section_keywords', env('APP_NAME')),
        'image' => Storage::url(nova_get_setting('offer_section_section_banner')),
        'schema' => nova_get_setting('offer_section_schema'),
    ])
@endsection

@section('extraStyles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/librairies/swiper-bundle.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/tour.css') }}" />
@endsection

@section('content')
    <section class="page-hero-banner bg_cover"
        style="background-image: url({{ Storage::url(nova_get_setting('offer_section_banner')) }});">
        <div class="text-bg bg_cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Content ===-->
                    <div class="page-content">
                        <h1 class="page-title">
                            {{ nova_get_setting_translate('offer_section_main_title', env('APP_NAME')) }}
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
                                    {{ nova_get_setting_translate('offer_section_main_title', env('APP_NAME')) }}
                                </span>
                                <meta itemprop="position" content="2" />
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 travel-tour-second padtobo-40 Special_offers " style="    background-color: #f9f3ee;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="section-title text-center mb-0">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ nova_get_setting_translate('offer_section_label') }}
                        </span>

                        <h2>
                            {{ nova_get_setting_translate('Special offers for you') }}
                        </h2>
                        <p class="mx-auto mt-20 section-title-para">
                            {!! nova_get_setting_translate('offer_section_description') !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row ">

                <div class="time-wepper" data-deadline-date="{{ nova_get_setting('offer_section_date_deadline') }}">
                    <div class="time-wepper__item text-center">
                        <h4 class="days">0</h4>
                        <span class="time-wepper__item__text">
                            {{ __('general.days') }}
                        </span>
                    </div>
                    <div class="time-wepper__item text-center">
                        <h4 class="hours">0</h4>
                        <span class="time-wepper__item__text">
                            {{ __('general.hours') }}
                        </span>
                    </div>
                    <div class="time-wepper__item text-center">
                        <h4 class="minutes">0</h4>
                        <span class="time-wepper__item__text">
                            {{ __('general.minutes') }}
                        </span>
                    </div>
                    <div class="time-wepper__item text-center">
                        <h4 class="seconds">0</h4>
                        <span class="time-wepper__item__text">
                            {{ __('general.seconds') }}
                        </span>
                    </div>
                </div>
                @foreach ($tours as $tour)
                    <div class="col-md-3 mb-2 text-center ">
                        <div class="tab-content">
                            <div class="item">
                                <div class="package-box">

                                    <h6>
                                        <a
                                            href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' => $tour->slug]) }}">
                                            {{ $tour->name }}
                                        </a>
                                    </h6>

                                    <a
                                        href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' => $tour->slug]) }}">
                                        <img class="img-fluid" alt="image"
                                            src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}">
                                    </a>

                                    <div class="meta-lable">
                                        @if ($tour->discount > 0)
                                            <div class="featured-text">
                                                {{ $tour->discount }}
                                                {{ $tour->discount_type == 'percentage' ? '%' : session()->get(App\Helpers\Constants\GeneralHelper::CURRENCY_SESSION)['symbol'] }}

                                                {{ __('general.off') }}
                                            </div>
                                        @endif
                                        @if ($tour->featured == 1)
                                            <div class="item_info_price_discount">
                                                {{ __('general.featured') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="pkg-btn-con d-flex align-items-center justify-content-between">
                                        <span class="person d-inline-block p-0 m-0">
                                            @if ($tour->discount > 0)
                                                <del>
                                                    {{ App\Helpers\Classes\Currency::display($tour->price) }}
                                                </del>
                                            @endif
                                            <span class="price d-inline-block p-0 m-0">
                                                {{ App\Helpers\Classes\Currency::display($tour->final_price) }}

                                            </span>
                                            /
                                            {{ __('general.person') }}
                                        </span>
                                        <div class="grey-btn d-inline-block">

                                            <a
                                                href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' => $tour->slug]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                                    <path d="M7 7h8.586L5.293 17.293l1.414 1.414L17 8.414V17h2V5H7v2z" />
                                                </svg>

                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </section>
    <section class="travel-tour-second Related Catagories ">
        <div class="container">
            <div class="row">
                <div class="row justify-content-center">
                    <div class="section-title text-center">
                        <div class="col-12">
                            <span class="section-title-span">
                                {{ nova_get_setting_translate('blog_section_label') }}
                            </span>
                            <h2>
                                {{ __('article.related_blog') }}
                            </h2>
                        </div>
                    </div>
                </div>


                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">

                        @foreach ($articles as $article)
                            <div class="swiper-slide">
                                <div class="blog-card-three blog-list-card mb-3">
                                    <div class="blog__card">
                                        <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}"
                                            class="blog__card-img">
                                            <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                                                alt="Things to do in Luxor" title="Things to do in Luxor">
                                        </a>
                                        <div class="blog__card-content">
                                            <ul class="blog__card-meta">
                                                <li>
                                                    <span class="blog__card-meta-icon">
                                                        <i class="fa-solid fa-user"></i></span>
                                                    <span class="blog__card-meta-author">
                                                        {{ $article->created_at->format('d M Y') }}
                                                    </span>
                                                </li>
                                            </ul>
                                            <h3 class="blog__card-title">
                                                <a
                                                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">
                                                    {{ $article->name }}
                                                </a>
                                            </h3>

                                            <p>{{ Str::limit($article->short_description, 100) }}</p>

                                            <a class="xb-item--link"
                                                href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">
                                                {{ __('general.read_more') }}
                                                <span>
                                                    <img alt="right_arrow"
                                                        src="https://www.golavitatravel.com/assets/images/right_arrow.e0def2b7.svg"
                                                        width="24" height="24" decoding="async" data-nimg="1"
                                                        loading="lazy" style="color:transparent">
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="swiper-pagination"></div>
                </div>



            </div>
        </div>


    </section>
    @include('layout.partials.faqs')
@endsection
@section('extraScripts')
    <script>
        var swiper = new Swiper(" .Catagories .mySwiper", {
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

    @include('layout.partials.timer')
    <!-- OfferCatalog Schema -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "OfferCatalog",
  "name": "Special Offers",
  "description": "Discover our special offers and Egypt travel deals. Save on Nile cruises, day tours, and vacation packages.",
  "url": "https://www.yoursite.com/special-offers",
  "itemListElement": [
    {
      "@type": "Offer",
      "name": "Nile Cruise Special Offer",
      "description": "Enjoy a luxury Nile Cruise with 20% discount.",
      "url": "https://www.yoursite.com/special-offers/nile-cruise"
    },
    {
      "@type": "Offer",
      "name": "Cairo Day Tour Discount",
      "description": "Book a guided Cairo day tour and save 15%.",
      "url": "https://www.yoursite.com/special-offers/cairo-tour"
    }
  ]
}
</script>

    <!-- Breadcrumb Schema -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://era-app.com/demo2/New%20travel/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Special Offers",
      "item": "https://era-app.com/demo2/New%20travel/Specialoffers.html"
    }
  ]
}
</script>
@endsection
