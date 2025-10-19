<div class="container mt-5 trustpilot_rev">
    <div class="row g-4">
        {{-- for i = 0 to 4 --}}
        @for ($i = 1; $i <= 4; $i++)
            <div class="col-6 col-md-3">
                <div class="platform-card">
                    <div class="platform-logo" itemscope itemtype="https://schema.org/TravelAgency">
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <img class="lazy" title="{{ nova_get_setting_translate('reviews_section_title_' . $i) }}" alt="{{ nova_get_setting_translate('reviews_section_title_' . $i) }}" width="40" height="40"
                                src="{{ Storage::url(nova_get_setting('reviews_section_img_' . $i)) }}">
                        </a>
                    </div>
                    <div class="platform-rating" temprop="aggregateRating" itemscope
                        itemtype="https://schema.org/AggregateRating">
                        <a href="{{ nova_get_setting('reviews_section_link_' . $i) }}" target="_blank" rel="noopener noreferrer">
                            <span class="platform-name" style="color: black;">
                                {{ nova_get_setting_translate('reviews_section_title_' . $i) }}
                            </span>
                            <div class="platform-stars">
                                <span class="platform-score">
                                    {{ nova_get_setting('reviews_section_rate_' . $i) }} / 5
                                </span>
                                @php
                                    $rate = (int) nova_get_setting('reviews_section_rate_' . $i);
                                    for ($j = 0; $j < $rate; $j++) {
                                        echo '★';
                                    }
                                @endphp                                
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endfor

    </div>
</div>
