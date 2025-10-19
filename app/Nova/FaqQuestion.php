<?php

namespace App\Nova;

use App\Helpers\Constants\RulesHelper;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;

class FaqQuestion extends Resource
{
    use HasSortableRows;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\FaqQuestion::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'question';

    public static $perPageViaRelationship = 100;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'question', 'answer'
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

            MorphTo::make('Model')->types([
                Category::class,
                SubCategory::class,
                Tour::class,
                Article::class,
                ArticleCategory::class,
            ])->withoutTrashed()->nullable(),

            Text::make(__('Question'), 'question')
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                ->translatable(),

            CKEditor::make(__('Answer'), 'answer')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex()
                ->translatable(),

            Toggle::make(__('Status'), 'status')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),
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
