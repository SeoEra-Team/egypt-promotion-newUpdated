<div class="blognavigation center mb-3" itemscope itemtype="https://schema.org/BreadcrumbList">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            @if ($pagination['previous'])
                <li class="page-item">
                    <a class="page-numbers prev" href="{{ $pagination['previous'] }}" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem" rel="prev">
                        <span itemprop="name">Previous</span>
                        <meta itemprop="position" content="1" />
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-hidden="true">
                    <span class="page-link">Previous</span>
                </li>
            @endif

            @foreach ($pagination['pages'] as $page => $url)
                @if ($page == $pagination['current_page'])
                    <li class="page-item active" aria-current="page">
                        <span class="page-numbers current" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <span itemprop="name">{{ $page }}</span>
                            <meta itemprop="position" content="{{ $loop->iteration + 1 }}" />
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-numbers" href="{{ $url }}" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <span itemprop="name">{{ $page }}</span>
                            <meta itemprop="position" content="{{ $loop->iteration + 1 }}" />
                        </a>
                    </li>
                @endif
            @endforeach

            @if ($pagination['next'])
                <li class="page-item">
                    <a class="page-numbers next" href="{{ $pagination['next'] }}" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem" rel="next">
                        <span itemprop="name">Next</span>
                        <meta itemprop="position" content="{{ count($pagination['pages']) + 2 }}" />
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-hidden="true">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>>
