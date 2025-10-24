@if (isset($articles) && count($articles) > 0)
    <div class="blog--section mt-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="section-title text-center ">
                    <div class="col-12">
                        <span class="section-title-span">
                            {{ nova_get_setting_translate('blog_section_label') }}
                        </span>
                        <h2>
                            {{ nova_get_setting_translate('blog_section_title') }}
                        </h2>
                        <p>
                            {!! nova_get_setting_translate('blog_section_description') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-4">
                    <div class="blog-card  mb-3">
                        <div class="blog-card-img-wrap ">
                            <a href="" class="card-img card__img card--img cardimg">
                                <img src="{{ $FirstArticle->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                                    alt="">
                            </a>

                        </div>
                        <div class="blog-card-content ">

                            <h5><a href="">
                                    {{ $FirstArticle->name }}
                                </a>
                            </h5>
                            <p class="blog__card-text">
                                {{ $FirstArticle->short_description }}
                            </p>
                            <div class="blog-date">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span> {{ $FirstArticle->date->format('d M Y') }}</span>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__section">

                        @foreach ($articles->skip(1)->take(2) as $article)
                            <div class="col-lg-6">
                                @include('layout.partials.article_box', ['style' => 'home_style', 'article' => $article])
                            </div>
                        @endforeach




                    </div>
                    @if (count($articles) > 3)
                        <div class="blog__section">
                            @foreach ($articles->skip(3)->take(2) as $article)
                                <div class="col-lg-6">
                                    @include('layout.partials.article_box', ['style' => 'home_style', 'article' => $article])
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
