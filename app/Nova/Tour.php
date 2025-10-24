<?php

namespace App\Nova;

use App\Helpers\Constants\MediaHelper;
use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use App\Nova\Filters\TourStatus;
use App\Nova\Metrics\ActiveTours;
use App\Nova\Metrics\InactiveTours;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use Spatie\TagsField\Tags;
use Yassi\NestedForm\NestedForm;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Whitecube\NovaFlexibleContent\Flexible;
use OptimistDigital\MultiselectField\Multiselect;
use Waynestate\Nova\CKEditor;
use NovaAjaxSelect\AjaxSelect;
use NovaField\Rating\Rating;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Tour extends Resource
{
    use HasSortableRows;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Tour::class;

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
        'short_description',
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

            new Panel('Main Information', [
                BelongsTo::make(__('SubCategory'), 'category', SubCategory::class)
                    ->withoutTrashed(),


                TextWithSlug::make(__('Name'), 'name')
                    ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                    ->slug()->translatable(),

                Text::make(__('Heading'), 'heading')
                    ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                    ->hideFromIndex()->translatable(),

                FieldsHelper::image(true, MediaHelper::TOUR_MEDIA_PATH, 'Image', true),
                FieldsHelper::image(false, MediaHelper::TOUR_BANNER_MEDIA_PATH, 'Banner', true),
                FieldsHelper::image(true, MediaHelper::TOUR_GALLERY_MEDIA_PATH, 'Gallery', false),

                Select::make(__('Type'), 'type')
                    ->rules([...RulesHelper::REQUIRED_SMALL_STRING_VALIDATION, ...['In:tour,package,nile-cruise']])
                    ->options([
                        'tour' => 'Tour',
                        'package' => 'Package',
                        'nile-cruise' => 'Nile Cruise',
                    ]),


                Currency::make(__('Original Price'), 'price')
                    ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION),




                Number::make('discount')->default(0)
                    ->rules(RulesHelper::NULLABLE_NUMERIC_VALIDATION)
                    ->hideFromDetail()
                    ->hideWhenCreating()
                    ->hideWhenUpdating()
                    ->hideFromIndex(),

                Currency::make('Discount', 'discount', fn() => !is_null($this->discount) ? number_format($this->discount, ',') : 0)->default(0)
                    ->rules(RulesHelper::NULLABLE_VALIDATION)->hideFromIndex(),

                Select::make('Discount Type', 'discount_type')->options([
                    'number' => 'Number',
                    'percentage' => 'Percentage'
                ])->default('number')->rules(RulesHelper::NULLABLE_STRING_VALIDATION)->hideFromIndex(),
            ]),

            new Panel('Main Data', [
                Textarea::make(__('Short Description'), 'short_description')
                    ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                    ->hideFromIndex()->translatable(),


                CKEditor::make(__('Overview'), 'overview')
                    ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                    ->translatable()->hideFromIndex(),

                CKEditor::make(__('Highlights'), 'highlights')
                    ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                    ->translatable()->hideFromIndex(),

                CKEditor::make(__('Inclusion'), 'inclusion')
                    ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                    ->translatable()->hideFromIndex(),

                CKEditor::make(__('Exclusion'), 'exclusion')
                    ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                    ->translatable()->hideFromIndex(),

                CKEditor::make(__('Notes'), 'notes')
                    ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                    ->translatable()->hideFromIndex(),
                NovaDependencyContainer::make([
                    CKEditor::make(__('Price Notes'), 'price_notes')
                        ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                        ->translatable()->hideFromIndex(),
                ])->dependsOnNot('type', 'package'),
            ]),



            new Panel('Pricing', [
                NovaDependencyContainer::make([
                    Flexible::make('Prices', 'pricing')
                        ->addLayout('Group', 'group', [
                            Number::make('From', 'from')->step(1)->min(1)->rules(RulesHelper::NULLABLE_INTEGER_VALIDATION),
                            // Text::make('Persons','from')
                            //     ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION),
                            Number::make('To', 'to')->step(1)->min(1)->rules(RulesHelper::NULLABLE_INTEGER_VALIDATION),
                            Currency::make('Final Price', 'price')->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)->step(1),

                        ]),
                ])->dependsOn('type', 'tour'),

                NovaDependencyContainer::make([
                    Flexible::make('Prices', 'pricing')
                        ->addLayout('Group', 'group', [
                            Text::make('Title')
                                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                                ->placeholder('Ex: Luxury Hotels')
                                ->translatable(),

                            // CkEditor::make(__('Description'), 'description')
                            //     ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                            //     ->translatable(),

                            Text::make('Solo', 'solo1')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),
                            Text::make('May-Sep', 'may-sep1')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price1')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Solo', 'solo2')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('Oct-April', 'oct-april2')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price2')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            //Double
                            Text::make('Double', 'double3')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('May-Sep', 'may-sep3')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price3')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Double', 'double4')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('Oct-April', 'oct-april4')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price4')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            //Triple
                            Text::make('Triple', 'triple5')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('May-Sep', 'may-sep5')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price5')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Triple', 'triple6')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('Oct-April', 'oct-april6')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price6')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),



                        ])
                ])->dependsOn('type', 'package'),

                NovaDependencyContainer::make([
                    Flexible::make('Prices', 'pricing')
                        ->addLayout('Group', 'group', [
                            //Solo
                            Text::make('Solo', 'solo1')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('4 Days/ 3 Nights', '4days-3nights1')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price1')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Solo', 'solo2')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('5 Days/ 4 Nights', '5days-4nights2')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price2')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Solo', 'solo3')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('8 Days/ 7 Nights', '8days-7nights3')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price3')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            //Double
                            Text::make('Double', 'double4')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('4 Days/ 3 Nights', '4days-3nights4')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price4')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Double', 'double5')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('5 Days/ 4 Nights', '5days-4nights5')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price5')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Double', 'double6')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('8 Days/ 7 Nights', '8days-7nights6')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price6')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),


                            //Triple
                            Text::make('Triple', 'triple7')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('4 Days/ 3 Nights', '4days-3nights7')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price7')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Triple', 'triple8')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('5 Days/ 4 Nights', '5days-4nights8')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price8')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),

                            Text::make('Triple', 'triple9')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Text::make('8 Days/ 7 Nights', '8days-7nights9')
                                ->withMeta(['extraAttributes' => [
                                    'readonly' => true
                                ]]),

                            Currency::make('Price', 'price9')
                                ->rules(RulesHelper::NULLABLE_NUMBER_VALIDATION)
                                ->step(0.01)->min(0),
                        ])->limit(1)
                ])->dependsOn('type', 'nile-cruise'),
            ]),

            NestedForm::make(__('Itineraries'), 'itineraries', Itinerary::class),
            HasMany::make(__('Itineraries'), 'itineraries', Itinerary::class),


            new Panel('Other Information', [
                Text::make(__('Duration'), 'duration')
                    ->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION)
                    ->hideFromIndex()->translatable(),

                Text::make(__('Location'), 'location')
                    ->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION)
                    ->hideFromIndex()->translatable(),

                Text::make(__('Tour Availability'), 'tour_availability')
                    ->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION)
                    ->hideFromIndex()->translatable(),

                Text::make(__('Tour Runs'), 'tour_runs')
                    ->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION)
                    ->hideFromIndex()->translatable(),

                
            ]),



            new Panel(__('Sections Visibility'), [
                Toggle::make(__('Status'), 'status')
                    ->trueValue(true)->falseValue(false)
                    ->editableIndex(),


                Toggle::make(__('First'), 'first')
                    ->trueValue(true)->falseValue(false)
                    ->editableIndex(),

                Toggle::make(__('Second'), 'second')
                    ->trueValue(true)->falseValue(false)
                    ->editableIndex(),

                Toggle::make(__('Third'), 'third')
                    ->trueValue(true)->falseValue(false)
                    ->editableIndex(),


                // Toggle::make(__('offer'), 'offer')
                //     ->trueValue(true)->falseValue(false)
                //     ->editableIndex(),
            ]),


            new Panel(__('SEO'), FieldsHelper::seoFields('tours')),



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
        return [
            (new DownloadExcel)->withHeadings(),
        ];
    }
}
