<section class="chooseus mt-5">
    <div class="container">
        <div class="blog-wrap">
            <div class="row justify-content-center">
                <div class="section-title text-center">
                    <div class="col-12">
                        <h2>
                            {{ nova_get_setting_translate('book_amazing_section_title') }}
                        </h2>
                        <div class="descc mb-3">
                            <p>
                                {!! nova_get_setting_translate('book_amazing_section_description') !!}
                            </p>
                        </div>
                        <div class="extra-nav  d-flex justify-content-center">
                            <button class="theme-btn showMore-Btn">
                                {{ __('home.show_more') }}
                            </button>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row cs_gap_y_40  mt-5">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-lg-3 col-sm-6 mb-2">
                        <div class="cs_iconbox services-boxs">
                            <div class="cs_iconbox_icon cs_radius_15 cs_center">
                                <img src="{{ Storage::url(nova_get_setting('featured_img_' . $i)) }}" alt="Featured Icon">
                            </div>
                            <h2 class="services-boxs-title mb-3">
                                {{ nova_get_setting_translate('featured_title_' . $i) }}
                            </h2>
                            <p class="cs_iconbox_subtitle mb-0">
                                {!! nova_get_setting_translate('featured_description_' . $i) !!}
                            </p>
                        </div>
                    </div>
                @endfor

            </div>
            <div class="xb-blog-bg" style="background-image:url(./assets/images/blog_bg.png)"></div>
        </div>
    </div>
</section>
