<div class=" padtobo-40" style="background-image: url({{ asset('assets/images/adjustment-bg-quck.png') }})">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">
                    <span class="section-title-span">

                        {{ nova_get_setting_translate('sub_category_section_label') }}
                    </span>
                    <h2>
                        {{ nova_get_setting_translate('sub_category_section_title') }}
                    </h2>
                    <div class="desc ">
                        <p>
                            {!! nova_get_setting_translate('sub_category_section_Description') !!}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="blogs-wrapper">

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper category-wrapper">

                    @foreach ($subCategories as $subCategory)
                        <div class="swiper-slide">
                            <div class="swiper-slide ">
                                @include('layout.partials.sub_category_box', ['subCategory' => $subCategory])
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
