@if ( isset($subCategories) && count($subCategories) > 0)

    <section class="Recommend-tours collection-banner  ">
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
                                {!! nova_get_setting_translate('sub_category_section_description') !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">


                @foreach ($subCategories as $subCategory)
                    <div class="col-lg-4">
                        <div class="collection-card mb-2">
                            <div class="thumb">
                                <a href="#">
                                    <img src="{{ $subCategory->getFirstMediaUrlOrDefault(MediaHelper::SUB_CATEGORY_MEDIA_PATH, 'webp')['url'] }}"
                                        alt="collection-img"></a>
                                <div class="content">
                                    <h3>
                                        {{ $subCategory->name }}
                                    </h3>
                                    <p>
                                        {{ $subCategory->short_description }}
                                    </p>
                                    <a href="#" class="btn-effect"><span>
                                            {{ __('home.view_collection') }}
                                        </span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach




            </div>
        </div>

    </section>
@endif
