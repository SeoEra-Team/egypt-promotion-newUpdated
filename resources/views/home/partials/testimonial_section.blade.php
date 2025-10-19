<section class="tab-section padtobo-40 testimonials"
    style="background-image: url({{ asset('assets/images/travel-bg.jpg') }}); ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">

                    <h2>
                        {{ nova_get_setting_translate('testimonials_section_title') }}

                    </h2>
                    <p>
                        {!! nova_get_setting_translate('testimonials_section_description') !!}
                    </p>
                </div>
            </div>
        </div>


        <div class="container mt-5">
            <div class="row g-4">


                <div class="col-md-9">
                    <div class="swiper testimonialSwiper swiper-initialized swiper-horizontal swiper-backface-hidden"
                        itemscope itemtype="https://schema.org/Review">
                        <div class="swiper-wrapper" id="swiper-wrapper-c9df02f265a8727d" aria-live="off"
                            style="transition-duration: 0ms; transform: translate3d(-437px, 0px, 0px); transition-delay: 0ms;">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4"
                                    data-swiper-slide-index="0" style="width: 422px; margin-right: 15px;">
                                    <div class="testimonial-item active">
                                        <div class="testimonials-head">
                                            <div class="testimonials-title">
                                                <div class="testimonials-card__ratings">
                                                    @for ($index = 0; $index < $testimonial->rate ; $index++)
                                                        <i class="fa-solid fa-star"></i>
                                                    @endfor
                                                    
                                                </div>
                                                <h3>
                                                    {{  $testimonial->name }}
                                                </h3>
                                                <p><i class="fa-solid fa-user"></i>
                                                    {{  $testimonial->traveler_from }}
                                                </p>
                                            </div>
                                            <img src="{{ $testimonial->getFirstMediaUrlOrDefault(MediaHelper::TESTIMONIAL_MEDIA_PATH, 'webp')['url'] }}" alt="testimonial-img">
                                        </div>
                                        <div class="testimonials-content">
                                            <p>
                                                {!!  $testimonial->description !!}
                                            </p>
                                        </div>
                                        <!-- <div class="quote-shape">
                                            <img src="assets/images/quote-icon.png" alt="quote-shape">
                                        </div> -->
                                    </div>
                                </div>
                            @endforeach




                        </div>
                        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-c9df02f265a8727d"></div>
                        <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-c9df02f265a8727d"></div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="featured-image">
                        <img class="img-fluid lazy" title="Our Travelers Testimonials" alt="Our Travelers Testimonials"
                            src="{{ Storage::url(nova_get_setting('testimonials_section_image')) }}">
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>
