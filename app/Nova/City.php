<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Http\Request;

use Laravel\Nova\Fields\ID;


class City extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\City::class;

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
        'name'
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

            TextWithSlug::make(__('Name'), 'name')
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                ->slug()->translatable(),
            FieldsHelper::image(true, MediaHelper::CITY_MEDIA_PATH, 'Image', true),

        ];
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
        return [];
    }
}
