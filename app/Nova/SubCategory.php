<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Laravel\Nova\Fields\HasMany;

class SubCategory extends Resource
{
    use HasSortableRows;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SubCategory::class;

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
        'name',
        'heading',
        'slug'
    ];

    public static $perPageViaRelationship = 100;

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

            BelongsTo::make(__('Category Parent'), 'category', Category::class)
                ->withoutTrashed(),

            TextWithSlug::make(__('Name'), 'name')
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                ->slug()->translatable(),


            Text::make(__('Heading'), 'heading')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable()->hideFromIndex(),
                
            Textarea::make(__('Short Description'), 'short_description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex()->translatable(),
            CKEditor::make(__('Description'), 'description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable()->hideFromIndex(),


            FieldsHelper::image(true, MediaHelper::SUB_CATEGORY_MEDIA_PATH, 'Image', true),
            FieldsHelper::image(true, MediaHelper::SUB_CATEGORY_BANNER_MEDIA_PATH, 'Banner', true),
            FieldsHelper::image(true, MediaHelper::SUB_CATEGORY_SUBIMG_MEDIA_PATH, 'sub img', true),

            Toggle::make(__('Status'), 'status')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),

            Toggle::make(__('Show in Header'), 'header')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),


            new Panel(__('SEO'), FieldsHelper::seoFields('sub_categories')),


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
