<section class="about-section section-padding pb-0 fix mt-" id="about">
    <div class="container">
        <div class="row g-4">

            <div class="col-xl-6 col-lg-6">
                <div class="row justify-content-center">
                    <div class="section-title text-left">
                        <div class="col-12">
                            <span class="section-title-span">
                                {{ nova_get_setting_translate('about_section_label') }}
                            </span>
                            <h2>
                                <span class="section-title-head">
                                    {{ nova_get_setting_translate('about_section_title') }}
                                </span>
                            </h2>
                            <ul class="about-us-features">
                                {!! nova_get_setting_translate('about_section_description') !!}
                            </ul>

                            
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="row justify-content-center">
                    <div class="about-image-item about-image-item-style-1">
                        <div class="counter-content">
                            <h2><span class="count">
                                    {{ nova_get_setting_translate('about_section_experience_number') }}    
                            </span></h2>
                            <p>
                                {{ nova_get_setting_translate('about_section_experience_title') }}
                            </p>
                        </div>


                        <div class="about-image">

                            <div class="about-image-1">
                                <img src="{{ Storage::url(nova_get_setting('about_section_side_image_1')) }}" alt="img"
                                    class=" img-custom-anim-right animated">
                            </div>
                            <div class="about-box d-flex align-items-center gap-10 float-bob-y">
                                <div class="icon">
                                    <i class="fa-solid fa-headphones"></i>
                                </div>
                                <div class="content">
                                    <span>
                                        {{ __('general.need_your_help') }}
                                    </span>
                                    <h4>
                                        <a href="tel:{{ nova_get_setting('site_phone') }}"> {{ nova_get_setting('site_phone') }} </a>
                                    </h4>
                                </div>
                            </div>

                            <div class="about-image-2">
                                <img src="{{ Storage::url(nova_get_setting('about_section_side_image_2')) }}" alt="img"
                                    class=" img-custom-anim-right animated">
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
</section>
{{-- <br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br> --}}
