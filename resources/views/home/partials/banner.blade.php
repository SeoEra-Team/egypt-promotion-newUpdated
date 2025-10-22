<header class="hero-header" style="background-image: url({{ Storage::url(nova_get_setting('home_banner_img')) }});">
    <!-- overlay -->
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-info d-flex align-items-center justify-content-center">
                    <div class="header-text">
                        <h1 class="clip-text" style="color: #fff"> 
                            {{ nova_get_setting_translate('home_banner_title') }}
                        </h1>
                        <p class="small-header">

                            {{ nova_get_setting_translate('home_banner_sub_title') }}


                        </p>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="shape1">
        <img src="{{ asset('assets/images/hero-shape-Bn9G2E4k.png') }}" alt="">
    </div>
</header>
