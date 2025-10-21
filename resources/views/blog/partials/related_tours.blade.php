<section class="  Related_Tour padtobo-40"
    style="background-color:#F3EEEA;
    background-image: url({{ asset('assets/images/blog_bg_1.png') }});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">
                    <span class="section-title-span">
                        {{ __('article.tours') }}
                    </span>
                    <h2>
                        {{ __('article.related_tours') }}
                    </h2>
                    <div class="desc ">
                        <p>
                            {{ __('article.related_tours_description') }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="travel-shape-two">
                <img src="{{ asset('assets/images/world-theme.png') }}" alt="shape">
            </div>
            <div class="travel-shape-one">
                <img src="{{ asset('assets/images/shape-3.png') }}" alt="shape">
            </div>
        </div>


        <div class="row align-items-stretch">
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($related_tours as $tour)
                        <div class="swiper-slide">
                            @include('layout.partials.tour_box', ['tour' => $tour])
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>
            </div>


        </div>

    </div>
</section>
