@if (count($blogs) > 0)

    <div class="blog-section padtobo-40" style="background-image: url({{ asset('assets/images/dot-element.png') }})">
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

                <div class="col-lg-12">
                    <div class="blog__section">
                        @foreach ($blogs->take(2) as $blog)
                            <div class="col-lg-6">
                                <div class="blog-card one mb-3">
                                    <div class="blog-card-img-wrap blog--card">
                                        <a href="{{ route('blog.show', ['slugCategory' => $blog->category->slug, 'slug' => $blog->slug]) }}"
                                            class="card-img card__img">
                                            <img src="{{ $blog->getFirstMediaUrlOrDefault(App\Helpers\Constants\MediaHelper::ARTICLE_MEDIA_PATH)['url'] }}"
                                                alt="">
                                        </a>

                                    </div>
                                    <div class="blog-card-content blog__card">

                                        <h5><a
                                                href="{{ route('blog.show', ['slugCategory' => $blog->category->slug, 'slug' => $blog->slug]) }}">
                                                {{ $blog->name }}
                                            </a>
                                        </h5>

                                        <p class="blog__card-text">
                                            {{ Str::limit($blog->short_description, 100) }}


                                        </p>
                                        <div class="blog-date">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span>
                                                {{ $blog->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <div class="bottom-area mt-3">

                                            <a
                                                href="{{ route('blog.show', ['slugCategory' => $blog->category->slug, 'slug' => $blog->slug]) }}">
                                                {{ __('article.view_posts') }}
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                        height="12" viewBox="0 0 14 12" fill="none">
                                                        <path d="M2.07617 8.73272L12.1899 2.89355"
                                                            stroke-linecap="round">
                                                        </path>
                                                        <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105"
                                                            stroke-linecap="round"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
                @if (count($blogs) > 2)
                    <div class="col-lg-12">
                        <div class="blog__section">
                            @foreach ($blogs->skip(2) as $blog)
                                <div class="col-lg-6">
                                    <div class="blog-card one mb-3">
                                        <div class="blog-card-img-wrap blog--card">
                                            <a href="{{ route('blog.show', ['slugCategory' => $blog->category->slug, 'slug' => $blog->slug]) }}"
                                                class="card-img card__img">
                                                <img src="{{ $blog->getFirstMediaUrlOrDefault(App\Helpers\Constants\MediaHelper::ARTICLE_MEDIA_PATH)['url'] }}"
                                                    alt="">
                                            </a>

                                        </div>
                                        <div class="blog-card-content blog__card">

                                            <h5><a
                                                    href="{{ route('blog.show', ['slugCategory' => $blog->category->slug, 'slug' => $blog->slug]) }}">
                                                    {{ $blog->name }}
                                                </a>
                                            </h5>

                                            <p class="blog__card-text">
                                                {{ Str::limit($blog->short_description, 100) }}


                                            </p>
                                            <div class="blog-date">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span>
                                                    {{ $blog->created_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                            <div class="bottom-area mt-3">

                                                <a
                                                    href="{{ route('blog.show', ['slugCategory' => $blog->category->slug, 'slug' => $blog->slug]) }}">
                                                    {{ __('article.view_posts') }}
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="12" viewBox="0 0 14 12" fill="none">
                                                            <path d="M2.07617 8.73272L12.1899 2.89355"
                                                                stroke-linecap="round">
                                                            </path>
                                                            <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105"
                                                                stroke-linecap="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>
@endif
