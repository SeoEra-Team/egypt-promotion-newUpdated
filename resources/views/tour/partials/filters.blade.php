<form
    action="{{ route('tour.index', ['categorySlug' => $subCategory->category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
    method="GET">
    <div class="filter-bar mb-4 mt-3">

        <!-- Enter Dates -->
        {{-- <div class="filter_Dates ">

            <button id="selectDateBtn" class="filter-btn" type="button">
                <i class="fa fa-calendar me-2"></i> {{ __('tour.enter_dates') }}
            </button>
            <input type="text" id="datePickerInput" style="display: none;" class="flatpickr-input" readonly="readonly">
        </div> --}}
        <!-- Locations -->
        <div class="category-dropdown">
            <!-- <i class="fa-solid fa-language"></i> -->
            <select class="category-select" name="city">
                <option disabled selected> {{ __('tour.locations') }} </option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

        </div>
        <!-- Tour Budget -->

        <!-- <div class="category-dropdown">
                    <i class="fa-solid fa-language"></i>
                    <select class="category-select" name="type">
                        <option disabled selected> Tour Budget </option>
                        <option>$300</option>
                        <option>$500</option>
                        <option>$600</option>
                        <option>$700</option>
                    </select>

                </div> -->

        <!-- Types -->
        <div class="filter_Dates ">
            <div class="category-dropdown">
                <i class="fa-solid fa-earth-americas"></i>
                <select class="category-select" name="type">
                    <option disabled="" selected=""> {{ __('tour.types') }} </option>
                    @foreach ($travelStyles as $travelStyle)
                        <option value="{{ $travelStyle->id }}">
                            {{ $travelStyle->name }}
                        </option>
                    @endforeach

                </select>

            </div>
        </div>

        <!-- Destinations -->
        <div class="filter_Dates ">
            <div class="category-dropdown">
                <i class="fa-solid fa-map-location"></i>
                <select class="category-select" name="destination">
                    <option disabled="" selected=""> {{ __('tour.popular_destinations') }} </option>
                    @foreach ($destinations as $destination)
                        <option value="{{ $destination->id }}">
                            {{ $destination->name }}
                        </option>
                    @endforeach
                </select>

            </div>

        </div>





        <!-- Filter Price -->
        <div class="category-dropdown">

            <select class="category-select" name="price">
                <option disabled selected> {{ __('tour.filter_price') }} </option>
                <option value="desc">
                    {{ __('tour.price_high_to_low') }}
                </option>
                <option value="asc">
                    {{ __('tour.price_low_to_high') }}
                </option>

            </select>

        </div>

        <div class="filter_Dates ">
            <button class="search-btn" type="submit">
                <i class="fa fa-search"></i> {{ __('tour.search') }}
            </button>
            {{-- <a href="{{ route('tour.index', ['categorySlug' => $subCategory->category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
                class="btn btn-secondary mt-3 w-100"
                style="height: 50px;display: flex;justify-content: center;align-items: center;">
                {{ __('tour.reset_filters') }}
            </a> --}}
        </div>

        <div class="filter_Dates ">
            {{-- <button class="search-btn" type="submit">
                <i class="fa fa-search"></i> {{ __('tour.search') }}
            </button> --}}
            <a href="{{ route('tour.index', ['categorySlug' => $subCategory->category->slug, 'subCategorySlug' => $subCategory->slug]) }}"
                class="btn search-btn reset_filters">
                {{ __('tour.reset_filters') }}
            </a>
        </div>


        <!-- Search -->

    </div>
</form>
