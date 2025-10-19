<section class="Breadcrumb-cover">
    <div class="breadcrumb-box position-relative">
        @php
            $media = $breadcrumb->getFirstMediaUrlOrDefault($path, 'webp');
            $mediaUrl = is_array($media) ? ($media['url'] ?? $media) : $media;
            $mediaTitle = is_array($media) ? ($media['title'] ?? '') : '';
            $mediaAlt = is_array($media) ? ($media['alt'] ?? 'Breadcrumb Background') : 'Breadcrumb Background';
        @endphp
        <img src="{{ $mediaUrl }}"
             title="{{ $mediaTitle }}"
             alt="{{ $mediaAlt }}"
             width="1920"
             height="350"
             class="breadcrumb-img">
        <div class="overlay"></div>
        <div class="category-info d-flex align-items-center justify-content-center">
            <div class="hero-cap">
                <h1>
                    {{ $breadcrumb->name ?? $name }}
                </h1>
            </div>
        </div>
        <nav aria-label="breadcrumb text-center" class="breadcrumb-nav">
            <ol class="breadcrumb">
                @foreach ($LINKS as $key => $link)
                    {!! $link !!}
                @endforeach
            </ol>
        </nav>
    </div>
</section>