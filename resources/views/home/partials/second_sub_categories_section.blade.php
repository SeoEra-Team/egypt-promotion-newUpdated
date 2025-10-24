@if ( isset($subCategories) && count($subCategories) > 0)
    <section class="tab-section tab-section_tour mt-5">
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
                        <p>
                            {!! nova_get_setting_translate('third_tour_section_description') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 d-flex justify-content-center position-relative">
                    <button class="scroll-btn right-btn" aria-label="Scroll Right">></button>
                    <ul class="nav nav-tabs nav nav-tabs align-items-center mb-40 travel-tab tab-container position-relative"
                        id="myTab" role="tablist">
                        @foreach ($subCategories as $subCategory)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link travel-tab-btn {{ $loop->first ? 'active' : '' }}"
                                    id="subcat-{{ $loop->iteration }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#subcat-{{ $loop->iteration }}" type="button" role="tab"
                                    aria-controls="subcat-{{ $loop->iteration }}" aria-selected="true">
                                    <i class="fa-solid fa-map-location-dot"></i> {{ $subCategory->name }}
                                </button>
                            </li>
                        @endforeach

                    </ul>
                    <button class="scroll-btn left-btn" aria-label="Scroll Left">
                        < </button>
                </div>

                <div class="tab-content mt-3" id="myTabContent">
                    @foreach ($subCategories as $subCategory)
                        <div class="tab-pane TravelStyle TravelStyle_tour fade {{ $loop->first ? 'show active' : '' }}"
                            id="subcat-{{ $loop->iteration }}" role="tabpanel"
                            aria-labelledby="subcat-{{ $loop->iteration }}-tab">
                            <div class="row ">
                                @foreach ($subCategory->tours->take(6) as $tour)
                                    <div class="col-lg-4 col-sm-6">
                                        @include('layout.partials.tour_box', [
                                            'style' => 'third',
                                            'tour'  => $tour
                                        ])
                                    </div>
                                @endforeach


                            </div>

                        </div>
                    @endforeach


                </div>

            </div>


        </div>
    </section>
@endif
