@if (count($tour->pricing))
    @foreach ($tour->pricing as $row)
        <div class="{{ count($tour->pricing) > 1 ? 'col-lg-6' : 'col-lg-12' }}">

            <div class="price-card w-100">
                <h2 class="card-header">
                    <i class="fa-solid fa-calendar-days"></i>
                    {{ array_key_exists(LaravelLocalization::getCurrentLocale(), $row['attributes']['title']) ? $row['attributes']['title'][LaravelLocalization::getCurrentLocale()] : $row['attributes']['title'][array_key_first($row['attributes']['title'])] }}
                    {{-- {{ __('tour.price_table') }}  --}}
                </h2>
                <div class="price__card">
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col"> {{ __('tour.accommodation_type') }} </th>
                            @if ($row['attributes']['price1'] != 0 && $row['attributes']['price3'] != 0 && $row['attributes']['price5'] != 0)
                                <th scope="col">{{ __('tour.may_sep') }}</th>
                            @endif
                            @if ($row['attributes']['price4'] != 0)
                                <th scope="col">{{ __('tour.oct_april') }}</th>
                            @endif
                        </tr>
                        @if ($row['attributes']['price2'] != 0 || $row['attributes']['price1'] != 0)
                            <tr>
                                <th scope="row">{{ __('tour.solo') }}</th>
                                @if ($row['attributes']['price1'] != 0 && $row['attributes']['price3'] != 0 && $row['attributes']['price5'] != 0)
                                    <td>{{ Currency::display($row['attributes']['price1']) }}</td>
                                @endif
                                @if ($row['attributes']['price2'] != 0)
                                    <td>{{ Currency::display($row['attributes']['price2']) }}</td>
                                @endif
                            </tr>
                        @endif
                        @if ($row['attributes']['price4'] != 0 || $row['attributes']['price3'] != 0)
                            <tr>
                                <th scope="row">{{ __('tour.double') }}</th>
                                @if ($row['attributes']['price1'] != 0 && $row['attributes']['price3'] != 0 && $row['attributes']['price5'] != 0)
                                    <td>{{ Currency::display($row['attributes']['price3']) }}</td>
                                @endif
                                @if ($row['attributes']['price4'] != 0)
                                    <td>{{ Currency::display($row['attributes']['price4']) }}</td>
                                @endif
                            </tr>
                        @endif
                        @if ($row['attributes']['price6'] != 0 || $row['attributes']['price5'] != 0)
                            <tr>
                                <th scope="row">{{ __('tour.triple') }}</th>
                                @if ($row['attributes']['price1'] != 0 && $row['attributes']['price3'] != 0 && $row['attributes']['price5'] != 0)
                                    <td>{{ Currency::display($row['attributes']['price5']) }}</td>
                                @endif
                                @if ($row['attributes']['price6'] != 0)
                                    <td>{{ Currency::display($row['attributes']['price6']) }}</td>
                                @endif
                            </tr>
                        @endif
                    </table>
                </div>

            </div>
        </div>
    @endforeach
@endif
