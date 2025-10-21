@if ($style == 'articles')
    <div class="blog-card one mb-3 w-100">
        <div class="blog-card-img-wrap blog--card w-100">
            <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}"
                aria-label="{{ $article->name }}" class="card-img card__img" aria-label=" {{ $article->name }}">
                <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                    alt="">
            </a>

        </div>
        <div class="blog-card-content blog__card">

            <h3><a
                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ $article->name }}</a>
            </h3>

            <p class="blog__card-text">
                {{ Str::limit($article->short_description, 100) }}

            </p>
            <div class="blog-date">
                <i class="fa-solid fa-calendar-days"></i>
                <span>
                    {{ $article->created_at->format('M d, Y') }}
                </span>
            </div>
            <div class="bottom-area mt-3">

                <a
                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ __('general.read_more') }}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12"
                            fill="none">
                            <path d="M2.07617 8.73272L12.1899 2.89355" stroke-linecap="round">
                            </path>
                            <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105" stroke-linecap="round">
                            </path>
                        </svg>
                    </span>
                </a>
            </div>

        </div>

    </div>
@elseif($style == 'categories')
    <div class="blog-card one mb-3 w-100">
        <div class="blog-card-img-wrap blog--card w-100">
            <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}"
                aria-label="{{ $article->name }}" class="card-img card__img" aria-label=" {{ $article->name }}">
                <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                    alt="">
            </a>

        </div>
        <div class="blog-card-content blog__card">

            <h3><a
                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ $article->name }}</a>
            </h3>

            <p class="blog__card-text">
                {{ Str::limit($article->short_description, 100) }}

            </p>
            <div class="blog-date">
                <i class="fa-solid fa-calendar-days"></i>
                <span>
                    {{ $article->created_at->format('M d, Y') }}
                </span>
            </div>
            <div class="bottom-area mt-3">

                <a
                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ __('general.read_more') }}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12"
                            fill="none">
                            <path d="M2.07617 8.73272L12.1899 2.89355" stroke-linecap="round">
                            </path>
                            <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105" stroke-linecap="round">
                            </path>
                        </svg>
                    </span>
                </a>
            </div>

        </div>

    </div>
@elseif($style == 'tags')
@else
    <div class="blog-card one mb-3 w-100">
        <div class="blog-card-img-wrap blog--card w-100">
            <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}"
                aria-label="{{ $article->name }}" class="card-img card__img" aria-label=" {{ $article->name }}">
                <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}"
                    alt="">
            </a>

        </div>
        <div class="blog-card-content blog__card">

            <h3><a
                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ $article->name }}</a>
            </h3>

            <p class="blog__card-text">
                {{ Str::limit($article->short_description, 100) }}

            </p>
            <div class="blog-date">
                <i class="fa-solid fa-calendar-days"></i>
                <span>
                    {{ $article->created_at->format('M d, Y') }}
                </span>
            </div>
            <div class="bottom-area mt-3">

                <a
                    href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">{{ __('general.read_more') }}
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12"
                            fill="none">
                            <path d="M2.07617 8.73272L12.1899 2.89355" stroke-linecap="round">
                            </path>
                            <path d="M10.412 7.59764L12.1908 2.89295L7.22705 2.08105" stroke-linecap="round">
                            </path>
                        </svg>
                    </span>
                </a>
            </div>

        </div>

    </div>
@endif
