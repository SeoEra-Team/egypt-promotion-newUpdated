<div class="category-item">
    <a href="{{ route('tour.index', ['categorySlug' => $subCategory->category->slug, 'subCategorySlug' => $subCategory->slug]) }}">
        <img src="{{ $subCategory->getFirstMediaUrlOrDefault('sub-category', 'webp')['url'] }}" alt="category-item-1">
        <div class="category-content">
            <div class="category-content-title">
                <h3>
                    {{ $subCategory->name }}
                </h3>

            </div>
            <div class="category-pricing">
                <span>
                    {{ count($subCategory->tours) }}
                    {{ __('general.tours') }}
                </span>

            </div>
        </div>
    </a>
</div>
