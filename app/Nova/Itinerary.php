<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Waynestate\Nova\CKEditor;
use Benjacho\BelongsToManyField\BelongsToManyField;

class Itinerary extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Itinerary::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'heading';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'heading'
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

            BelongsTo::make(__('Tour'), 'tour', Tour::class),

            Number::make(__('Day'), 'day')
                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION),

            Text::make(__('Heading'), 'heading')
                ->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION)
                ->translatable(),

            CKEditor::make(__('Description'), 'description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex()
                ->translatable(),
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
