@if (count($tour->pricing))
    @foreach ($tour->pricing as $row)
        <div class="price-card">
            <h2 class="card-header">
                <i class="fa-solid fa-calendar-days"></i>
                {{ __('tour.price_table_nile_cruise') }} 
            </h2>
            <div class="price__card">
                <table class="table table-bordered">
                    <tr>
                        <th scope="col"> {{ __('tour.number_of_persons') }} </th>
                        <th scope="col">{{ __('tour.4days_3nights') }}</th>
                        <th scope="col">{{ __('tour.5days_4nights') }}</th>
                        <th scope="col">{{ __('tour.8days_7nights') }}</th>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('tour.solo') }}</th>
                        <td>{{ Currency::display($row['attributes']['price1']) }}</td>
                        <td>{{ Currency::display($row['attributes']['price2']) }}</td>
                        <td>{{ Currency::display($row['attributes']['price3']) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('tour.double') }}</th>
                        <td>{{ Currency::display($row['attributes']['price4']) }}</td>
                        <td>{{ Currency::display($row['attributes']['price5']) }}</td>
                        <td>{{ Currency::display($row['attributes']['price6']) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('tour.triple') }}</th>
                        <td>{{ Currency::display($row['attributes']['price7']) }}</td>
                        <td>{{ Currency::display($row['attributes']['price8']) }}</td>
                        <td>{{ Currency::display($row['attributes']['price9']) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    @endforeach
@endif
