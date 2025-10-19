<?php

namespace App\Nova;

use App\Helpers\Constants\RulesHelper;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Mdixon18\Fontawesome\Fontawesome;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Currency extends Resource
{
    use HasSortableRows;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Currency>
     */
    public static $model = \App\Models\Currency::class;

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
        'name', 'code', 'symbol'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('Name'), 'name')
                ->rules(RulesHelper::REQUIRED_SMALL_STRING_VALIDATION)
                ->translatable(),

            Text::make(__('Code'), 'code')
                ->rules([...RulesHelper::REQUIRED_SMALL_STRING_VALIDATION, ...['unique:currencies,code,'.$this->id]]),

            Text::make(__('symbol'), 'symbol')
                ->rules(RulesHelper::REQUIRED_SMALL_STRING_VALIDATION),

            Number::make(__('Rate'), 'rate')
                ->rules(RulesHelper::REQUIRED_NUMBER_VALIDATION)
                ->min(0)->step(0.000000000001),

            Toggle::make(__('Status'), 'status')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),
        ];
    }

    public function authorizedToDelete(Request $request)
    {
        if($this->id == 1)
            return false;
        return true;
    }

    public function authorizedToForceDelete(Request $request)
    {
        if($this->id == 1)
            return false;
        return true;
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
