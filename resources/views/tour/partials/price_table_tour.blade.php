<div class="col-12 col-md-6 col-lg-12">
    @if (isset($tour->pricing) && count($tour->pricing))
        <div class="price-card">
            <h2 class="card-header">
                <i class="fa-solid fa-calendar-days"></i>
                {{ __('tour.price_table') }} 
            </h2>
            <div class="price__card">
                <table class="table table-bordered">
                    <tr>
                        <th>{{ __('tour.persons') }} </th>
                        <th>{{ __('tour.prices') }} </th>
                    </tr>
                    @foreach ($tour->pricing as $row)
                        <tr>
                            <td><i class="fa-solid fa-user-group"></i>
                                @if ($row['attributes']['from'] == '1')
                                    {{ $row['attributes']['from'] }}
                                    - 
                                    {{ $row['attributes']['to'] }}
                                    {{ __('tour.person') }}
                                @else
                                    {{ $row['attributes']['from'] }}
                                    - 
                                    {{ $row['attributes']['to'] }}
                                    {{ __('tour.persons') }}
                                @endif
                            </td>
                            <td>
                                @if (isset($tour->discount) && $tour->discount > 0)
                                    @if ($tour->discount_type === 'number')
                                        @php
                                            $newPrice = $row['attributes']['price'] - $tour->discount;
                                            $newPrice = $newPrice < 0 ? 0 : $newPrice;
                                        @endphp
                                        {{ Currency::display($newPrice) }}
                                    @elseif($tour->discount_type === 'percentage')
                                        @php
                                            $newPrice =
                                                $row['attributes']['price'] -
                                                $row['attributes']['price'] * ($tour->discount / 100);
                                            $newPrice = $newPrice < 0 ? 0 : $newPrice;
                                        @endphp
                                        {{ Currency::display($newPrice) }}
                                    @endif
                                @else
                                    {{ Currency::display($row['attributes']['price']) }}
                                @endif

                                {{ __('tour.per_person') }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    @endif
</div>
