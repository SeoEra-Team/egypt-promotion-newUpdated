<form
    action="{{ route('tour.index', ['categorySlug' => $subCategory->category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
    method="GET">
    <div class="filters clearfix">
        <div class="sort-by">
            <div class="drop-list-one">
                <div class="inner clearfix">
                    <div class="dropdown-outer open">
                        <form id="pricefilterForm" method="GET" action="">
                            <select id="sortBy" class="nice-sel" role="form" name="sortBy">
                                <option value="" selected="" disabled="">
                                    {{ __('category.sort_by') }}
                                </option>
                                <option value="">
                                    {{ __('category.all') }}
                                </option>
                                <option value="Newestontop">
                                    {{ __('category.newest_on_top') }}
                                </option>
                                <option value="Oldestontop">
                                    {{ __('category.oldest_on_top') }}
                                </option>
                                <option value="PriceLowtoHigh">
                                    {{ __('category.price_low_to_high') }}
                                </option>
                                <option value="PriceHightoLow">
                                    {{ __('category.price_high_to_low') }}
                                </option>
                            </select>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
