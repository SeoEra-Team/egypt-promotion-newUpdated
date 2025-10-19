<?php

namespace App\Nova;

use App\Helpers\Constants\RulesHelper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Reservation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Reservation::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email', 'phone_number'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Tour', 'tour')
                ->withoutTrashed(),


            Text::make('Name', 'name')
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION),

            Text::make('Email', 'email')
                ->rules(RulesHelper::REQUIRED_MID_STRING_VALIDATION),


            Text::make('Phone', 'phone_number')
                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION),


            Date::make('Date', 'date'),


            Number::make('Adults', 'adults')
                ->rules(RulesHelper::REQUIRED_NUMBER_VALIDATION)
                ->hideFromIndex(),

            Number::make('Children', 'children')
                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                ->hideFromIndex(),

            Number::make('Infants', 'infants')
                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                ->hideFromIndex(),

            Textarea::make('Message'),
        ];
    }

    /**
     * @param Request $request
     * @return bool
     */
    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function authorizedToUpdate(Request $request): bool
    {
        return false;
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new DownloadExcel)->withHeadings(),
        ];
    }
}
