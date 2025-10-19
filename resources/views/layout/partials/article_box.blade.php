@if($style == 'articles')
<div class="blog-card-three blog-list-card">
    <div class="blog__card">
      <a href="{{ route('blog.show', [$article->category->slug, $article->slug]) }}" class="blog__card-img">
        <img loading="lazy"
        src="{{$article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH, 'webp')['url']}}"
        alt="{{$article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH)['alt']}}"
        title="{{$article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_MEDIA_PATH)['title']}}"
        />
        <div class="blog__card-date">
          <h4 class="blog__card-date-number">{{ \Carbon\Carbon::parse($article->created_at)->format('d') }}</h4>
          <p class="blog__card-date-month">{{ \Carbon\Carbon::parse($article->created_at)->format('F Y') }}</p>
        </div>
        <!-- /.blog__card-date --> </a
      ><!-- /.blog__card-img -->
      <div class="blog__card-content">
        <ul class="blog__card-meta">
          <li>
            <span class="blog__card-meta-icon">
              <i class="fa-solid fa-user"></i
            ></span>
            <span class="blog__card-meta-author">{{__('article.by')}} {{ $article->author_name }}</span>
          </li>
        </ul>
        <!-- /.blog__card-meta -->
        <h3 class="blog__card-title">
          <a href="{{ route('blog.show', [$article->category->slug, $article->slug]) }}">{{ $article->name }}</a>
        </h3>
        <div class="blog-para">
          <p class="blog__card-text">
            {{ Str::limit($article->short_description, 100) }}
          </p>
        </div>
        <a href="{{ route('blog.show', [$article->category->slug, $article->slug]) }}" class="btn-effect">
            {{__('general.read_more')}}
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </a>
      </div>
      <!-- /.blog-details__card-content -->
    </div>
    <!-- /.blog-details__card -->
  </div>


@elseif($style == 'categories')
<div class="blog-card-three blog-list-card">
    <div class="blog__card">
      <a href="{{route('blog.index', $article->slug)}}" class="blog__card-img">
        <img loading="lazy"
        src="{{$article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH, 'webp')['url']}}"
        alt="{{$article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH)['alt']}}"
        title="{{$article->getFirstMediaUrlOrDefault(MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH)['title']}}"
        />

        <!-- /.blog__card-date --> </a
      ><!-- /.blog__card-img -->
      <div class="blog__card-content">
        <!-- /.blog__card-meta -->
        <h3 class="blog__card-title">
          <a href="{{route('blog.index', $article->slug)}}">{{ $article->name }}</a>
        </h3>
        <div class="blog-para">
          <p class="blog__card-text">
            {{ Str::limit($article->short_description, 100) }}
          </p>
        </div>
        <a href="{{route('blog.index', $article->slug)}}" class="btn-effect">
            {{__('general.read_more')}}
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </a>
      </div>
      <!-- /.blog-details__card-content -->
    </div>
    <!-- /.blog-details__card -->
  </div>

@else
@endif

