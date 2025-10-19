<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use NovaAttachMany\AttachMany;
use Superlatif\NovaTagInput\Tags;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class Article extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Article::class;

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
        'name', 'author_name', 'short_description', 'slug'
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


            // BelongsToManyField::make('Tours', 'tours', Tour::class)
            //     ->optionsLabel('name.'.app()->getLocale())->hideFromIndex(),

            BelongsToManyField::make('tag', 'tags', Tag::class)
                ->optionsLabel('name.' . app()->getLocale())->hideFromIndex(),


            TextWithSlug::make(__('Name'), 'name')
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                ->slug()->translatable(),

            Text::make(__('Author Name'), 'author_name')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION),

            Textarea::make('Short Description', 'short_description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex()
                ->translatable(),

            CKEditor::make(__('Description'), 'description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex()->translatable(),

            FieldsHelper::image(true, MediaHelper::ARTICLE_MEDIA_PATH, 'Image', true),
            FieldsHelper::image(true, MediaHelper::ARTICLE_BANNER_MEDIA_PATH, 'Banner', true),

            Toggle::make(__('Status'), 'status')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),

            Toggle::make(__('show in offer page'), 'offer')
                ->trueValue(true)->falseValue(false)
                ->editableIndex(),


            new Panel(__('Travel Packages'), [
                Flexible::make('Travel Packages', 'travel_packages')
                    ->addLayout('Group', 'group', [
                        Text::make('Title', 'title')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)->translatable(),
                        CkEditor::make('Description', 'description')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)->translatable(),
                    ]),
            ]),


            new Panel(__('SEO'), FieldsHelper::seoFields('articles')),
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
