<section class="why-choose-us">
    <div class="container">
        <div class="row">

            @for ($i = 0; $i < 4; $i++)
                <div class="col-lg-3 col-md-6">
                    <div class="choose-us-item">
                        <div class="choose-us-head">
                            <div class="choose-us-icon">
                                <img src="{{ Storage::url(nova_get_setting('home_service_icon_'. $i + 1)) }}" alt="Customize Trip" class="icon-svg">
                            </div>
                            <div class="choose-us-content">
                                <h4 class="choose-us-title">
                                    {{ nova_get_setting_translate('home_service_title_'. $i + 1) }}
                                </h4>
                                <p class="choose-us-description">
                                    {{ nova_get_setting_translate('home_service_description_'. $i + 1) }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>