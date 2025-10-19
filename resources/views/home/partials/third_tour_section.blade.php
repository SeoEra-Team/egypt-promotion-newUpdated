
@if (count($thirdTours) > 0 )
    
<section class=" padtobo-40"
    style="background-color:#F3EEEA;background-image: url({{ asset('assets/images/blog_bg_1.png') }});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">
                    <span class="section-title-span">
                        {{ nova_get_setting_translate('third_tour_section_label') }}
                    </span>
                    <h2>
                        {{ nova_get_setting_translate('third_tour_section_title') }}
                    </h2>
                    <div class="desc ">
                        <p>
                            {!! nova_get_setting_translate('third_tour_section_description') !!}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="travel-shape-two">
                <img src="{{ asset('assets/images/world-theme.png') }}" alt="shape">
            </div>
            <!-- <div class="travel-shape-one">
                    <img src="./assets/images/shape-logo.jpeg" alt="shape">
                </div> -->
        </div>


        <div class="row align-items-stretch">
            @foreach ($thirdTours as $thirdTour)
                <div class="col-lg-3">
                    @include('layout.partials.tour_box', ['tour' => $thirdTour])
                </div>
            @endforeach



        </div>

    </div>
</section>
@endif
