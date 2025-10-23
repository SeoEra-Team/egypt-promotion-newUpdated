<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Waynestate\Nova\CKEditor;

class ArticleCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ArticleCategory::class;

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
        'slug',
        'author_name',
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

            Text::make(__('Heading'), 'heading')
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                ->translatable()
                ->hideFromIndex(),
                
            Text::make(__('Author Name'), 'author_name')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable()
                ->hideFromIndex(),

            Date::make(__('Date'), 'date')
                ->rules(RulesHelper::NULLABLE_DATE_VALIDATION)->hideFromIndex(),

            Textarea::make(__('Short Description'), 'short_description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable()->hideFromIndex(),

            CKEditor::make(__('Description'), 'description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex()
                ->translatable(),

            FieldsHelper::image(true, MediaHelper::ARTICLE_CATEGORY_MEDIA_PATH, 'Image', true),
            FieldsHelper::image(true, MediaHelper::ARTICLE_CATEGORY_BANNER_MEDIA_PATH, 'Banner', true),

            Toggle::make(__('Status'), 'status')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),

            new Panel(__('SEO'), FieldsHelper::seoFields('article_categories')),
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
