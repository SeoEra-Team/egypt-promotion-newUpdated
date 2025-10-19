<div class="special-card">
    <div class="special-card-img">
        <a href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' =>$tour->slug ]) }}" class="fav-tour-img">
            <img src="{{ $tour->getFirstMediaUrlOrDefault(MediaHelper::TOUR_MEDIA_PATH, 'webp')['url'] }}"
                alt="special-card-img-1">
        </a>
        <div class="heart-icon wishlist-icon">
            <a class="addfavorite" data-href="{{ route('favorite.add', $tour->id) }}" aria-label="Add to Favorites">
                <i class="fa-{{ in_array($tour->id, $favoriteToursIds) ? 'solid' : 'regular' }} fa-heart"></i>
            </a>

        </div>

        <ul class="listing-card-four__meta list-unstyled">
            <li>
                <a href="tour-listing-details-2">
                    <span class="listing-card-four__meta__icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    {{ $tour->location }}
                </a>
            </li>
            <li>
                <a href="tour-listing-details-2">
                    <span class="listing-card-four__meta__icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </span>
                    {{ $tour->duration }}
                </a>

        </ul>


    </div>
    <div class="special-card-content">
        <a 
        href="{{route('tour.show',['categorySlug'=> $tour->category->category->slug,'subCategorySlug' => $tour->category->slug,'tourSlug'=>$tour->slug])}}">
            <h3>
                {{ $tour->name }}
            </h3>
        </a>

        <p>
            {{ $tour->short_description }}
        </p>
        <div class="pkg-btn-con d-flex align-items-center justify-content-between">
            <span class="person d-inline-block p-0 m-0">
                <span class="price d-inline-block p-0 m-0">
                    {{ App\Helpers\Classes\Currency::display($tour->final_price) }}

                </span>
                <br>
                / {{ __('general.person') }}
            </span>
            <div class="grey-btn d-inline-block">

                <a href="{{ route('tour.show', ['categorySlug' => $tour->category->category->slug, 'subCategorySlug' => $tour->category->slug, 'tourSlug' =>$tour->slug ]) }}">
                    <i class="fa-solid fa-arrow-right  me-2"></i>
                    {{ __('general.book_now') }}
                </a>
            </div>
        </div>

    </div>
</div>
