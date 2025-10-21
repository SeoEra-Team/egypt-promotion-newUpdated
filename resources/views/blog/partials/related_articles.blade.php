<div class="blog-section padtobo-40">
    <div class="container">

        <div class="row justify-content-center">
            <div class="section-title text-center ">
                <div class="col-12">
                    <h2>
                        {{ __('article.related_articles') }}

                    </h2>
                    <p>
                        {{ __('article.related_articles_description') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="row g-lg-4 gy-5">
            @foreach ($related_articles as $article)
                <div class="col-lg-3">
                    <div class="blog-card-three blog-list-card mb-3">
                        <div class="blog__card">
                            <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}" class="blog__card-img" aria-label="{{ $article->name }}">
                                <img src="{{ $article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url'] }}" alt="Things to do in Luxor"
                                    title="Things to do in Luxor">
                            </a>
                            <div class="blog__card-content">
                                <ul class="blog__card-meta">
                                    <li>
                                        <span class="blog__card-meta-icon">
                                            <i class="fa-solid fa-user"></i></span>
                                        <span class="blog__card-meta-author">
                                            {{ $article->created_at->format('M d, Y') }}
                                        </span>
                                    </li>
                                </ul>
                                <h3 class="blog__card-title">
                                    <a href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">
                                        {{ $article->name }} </a>
                                </h3>

                                <p>
                                    {{ Str::limit($article->short_description, 100) }}
                                </p>

                                <a class="xb-item--link" href="{{ route('blog.show', ['slugCategory' => $article->category->slug, 'slug' => $article->slug]) }}">
                                    {{__('article.read_more')}}
                                    <span>
                                        <img alt="right_arrow"
                                            src="https://www.golavitatravel.com/assets/images/right_arrow.e0def2b7.svg"
                                            width="24" height="24" decoding="async" data-nimg="1" loading="lazy"
                                            style="color:transparent">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
