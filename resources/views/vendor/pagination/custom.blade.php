@if ($paginator->hasPages())
    <div class="col-md-12" itemscope itemtype="https://schema.org/BreadcrumbList">
        <div class="blognavigation center mb-3">
            @if ($paginator->onFirstPage())
                <a class="prev page-numbers" tabindex="-1" aria-disabled="true" aria-label="@lang('pagination.previous')"
                    itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" rel="prev">
                    <span itemprop="name">
                        @lang('pagination.previous')
                    </span>
                    <meta itemprop="position" content="1" />
                </a>
            @else
                <a class=" page-numbers" href="{{ $paginator->previousPageUrl() }}" tabindex="-1"
                    aria-disabled="false" aria-label="@lang('pagination.previous')" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" rel="prev">
                    <span itemprop="name">
                        @lang('pagination.previous')
                    </span>
                    <meta itemprop="position" content="1" />
                </a>
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item"><a class="page-link " >{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="page-numbers prev" itemprop="itemListElement" itemscope
                                itemtype="https://schema.org/ListItem">
                                <span itemprop="name">{{ $page }}</span>
                                <meta itemprop="position" content="{{ $page }}" />
                            </a>
                        @else
                            <a class="page-numbers" href="{{ $url }}" itemprop="itemListElement" itemscope
                                itemtype="https://schema.org/ListItem">
                                <span itemprop="name">{{ $page }}</span>
                                <meta itemprop="position" content="{{ $page }}" />
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" rel="next">
                    <span itemprop="name">
                        @lang('pagination.next')
                    </span>
                    <meta itemprop="position" content="{{ count($elements) + 1 }}" />
                </a>
            @else
                <a class=" page-numbers" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem" rel="next">
                    <span itemprop="name">
                        @lang('pagination.next')
                    </span>
                    <meta itemprop="position" content="{{ count($elements) + 1 }}" />
                </a>
            @endif


        </div>
    </div>
@endif
