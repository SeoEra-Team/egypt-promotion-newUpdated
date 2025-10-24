@if ( isset($firstTours) && count($firstTours) > 0)
    <section class="blogs Offers hotel-section mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ nova_get_setting_translate('first_tour_section_label') }}
                        </span>
                        <h2>
                            {{ nova_get_setting_translate('first_tour_section_title') }}
                        </h2>
                        <div class="desc ">
                            <p>
                                {!! nova_get_setting_translate('first_tour_section_description') !!}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tour-wrapper ">
                <div class="row g-4">
                    @foreach ($firstTours as $tour)
                        <div class="col-lg-4">
                            @include('layout.partials.tour_box', ['style' => 'first' , 'tour' => $tour])
                        </div>
                    @endforeach


                </div>
            </div>

        </div>
    </section>
@endif
