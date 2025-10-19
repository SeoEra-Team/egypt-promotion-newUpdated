<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Waynestate\Nova\CKEditor;

class Page extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Page::class;

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
        'id',
        'heading'
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

            Text::make(__('Heading'), 'heading')
                ->rules(RulesHelper::REQUIRED_MID_STRING_VALIDATION)
                ->translatable(),

            Text::make(__('Sub Heading'), 'sub_heading')
                ->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION)
                ->translatable()
                ->hideFromIndex(),

            CKEditor::make(__('Content'), 'content')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable()
                ->hideFromIndex(),

            Select::make(__('Type'), 'type')
                ->rules([...RulesHelper::REQUIRED_SMALL_STRING_VALIDATION, ...['In:about,other,wishlist']])
                ->options([
                    'about'     => 'About',
                    'wishlist'  => 'wishlist',
                    'other'     => 'Other',
                ]),


            FieldsHelper::image(true, MediaHelper::PAGE_BANNER_MEDIA_PATH, 'Banner', true),


            Toggle::make(__('Show in Header'), 'show_in_header')
                ->trueValue(true)
                ->falseValue(false)
                ->editableIndex(),

            Toggle::make(__('Show in Footer'), 'show_in_footer')
                ->trueValue(true)
                ->falseValue(false)
                ->editableIndex(),

            Toggle::make(__('Status'), 'status')
                ->trueValue(true)
                ->falseValue(false)
                ->editableIndex(),

            new Panel(__('SEO'), FieldsHelper::seoFields('pages', '/page'))
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
