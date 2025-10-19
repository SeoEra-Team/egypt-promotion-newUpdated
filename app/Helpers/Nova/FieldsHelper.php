<?php

namespace App\Helpers\Nova;

use App\Helpers\Constants\RulesHelper;
use Benjaminhirsch\NovaSlugField\Slug;
use DmitryBubyakin\NovaMedialibraryField\Fields\GeneratedConversions;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Image;
use Mostafaznv\NovaVideo\Video;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use Waynestate\Nova\CKEditor;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use AlexAzartsev\Heroicon\Heroicon;
use App\Models\Currency;
use Laravel\Nova\Panel;
use Whitecube\NovaFlexibleContent\Flexible;
use NovaField\Rating\Rating;

class FieldsHelper
{
    /**
     * @param string $table
     * @return array
     */
    public static function seoFields(string $table): array
    {
        return [
            Slug::make(__('Slug'), 'slug')
                ->disableAutoUpdateWhenUpdating()
                ->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
                ->creationRules(sprintf("unique:%s,slug", $table))
                ->updateRules(sprintf("unique:%s,slug,{{resourceId}}", $table))
                ->hideFromIndex()
                ->translatable()

                ->readonly(function (Request $request) {
                    return !auth()->user()->can('update slug');
                }),

            Text::make(__('Meta Title'), 'meta_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable()
                ->hideFromIndex(),

            Textarea::make(__('Meta Description'), 'meta_description')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable()
                ->hideFromIndex(),

            Textarea::make(__('Meta Keywords'), 'meta_keywords')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable()
                ->hideFromIndex(),

            Code::make(__('Schema'), 'schema')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),
        ];
    }

    /**
     * @param bool $isRequired
     * @param string $mediaCollection
     * @param string $name
     * @param bool $single
     * @param string|null $helpText
     * @return Medialibrary
     */
    public static function image(bool $isRequired, string $mediaCollection, string $name = 'Image', bool $single = true, string $helpText = null): Medialibrary
    {
        // dd($mediaCollection, $name, $single);
        $image = Medialibrary::make($name, $mediaCollection)->fields(function () {
            return [
                Text::make('File Name', 'file_name')->rules('required', 'min:2'),
                Text::make('Image Title', 'img_title')->translatable()->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION),
                Text::make('Image Alt', 'img_alt')->translatable()->rules(RulesHelper::NULLABLE_MID_STRING_VALIDATION),
                GeneratedConversions::make('Conversions')->withTooltips(),
            ];
        })->attachRules($isRequired ? RulesHelper::REQUIRED_IMAGE_VALIDATION : RulesHelper::NULLABLE_IMAGE_VALIDATION)
            ->accept('image/*')
            ->autouploading()->sortable()->attachOnDetails()
            ->hideFromIndex()->attachExisting($mediaCollection)
            ->croppable('cropper')
            ->help($helpText);

        if ($single)
            $image->single();

        if ($isRequired)
            $image->rules('required');
        // dd($image);
        return $image;
    }


    public static function mainSettings(): array
    {
        return [
            Heading::make(__('General Info')),

            Text::make(__('Site Name'), 'site_name'),
            Text::make(__('Site Title'), 'site_title')->translatable(),
            Text::make(__('Site Email'), 'site_email'),
            Text::make(__('Site Phone'), 'site_phone'),
            Text::make(__('Site Whatsapp'), 'site_whatsapp'),
            Text::make(__('Site Address'), 'site_address')->translatable(),
            Text::make(__('Site Address in google maps'), 'site_link_address'),
            Text::make(__('Site Country'), 'site_country')->translatable(),
            Text::make(__('Site City'), 'site_city')->translatable(),
            Text::make(__('ifram location'), 'ifram_location'),

            Select::make(__('Default Currency'), 'default_currency')
                ->rules(RulesHelper::REQUIRED_NUMBER_VALIDATION)
                ->options(Currency::whereStatus(true)->pluck('name', 'id')),


            Heading::make(__('Social Media')),
            SimpleRepeatable::make(__('Social Media'), 'social_media', [
                Select::make(__('Platform'), 'platform')->options([
                    'facebook' => 'facebook',
                    'instagram' => 'instagram',
                    'linkedin' => 'linkedIn',
                    'twitter' => 'twitter',
                    'tripadvisor' => 'tripadvisor',
                ])->displayUsingLabels(),
                Select::make(__('Icon'), 'icon')->options([
                    'facebook-f' => 'fab fa-facebook-f',
                    'instagram' => 'fab fa-instagram',
                    'linkedin-in' => 'fab fa-linkedin-in',
                    'twitter' => 'fab fa-twitter',
                    'tripadvisor' => 'tripadvisor',
                ])->displayUsingLabels(),
                Text::make(__('Link'), 'link'),
            ])->canAddRows(true),



            Heading::make(__('Media')),
            Image::make(__('Logo'), 'logo')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Image::make(__('ًWhite Logo'), 'logo_white')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Text::make(__('Logo Alt'), 'logo_alt')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Logo Title'), 'logo_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),


            Image::make(__('Favicon'), 'favicon')
                // ->maxWidth(16)
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Heading::make(__('Footer Data')),


            CKEditor::make(__('Footer Description'), 'footer_description')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Heading::make(__('Footer Top Area')),
            Image::make(__('Footer Top Image'), 'footer_top_img')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Footer top Title'), 'footer_top_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Footer top button'), 'footer_top_button')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Footer Placeholder'), 'footer_top_placeholder')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Heading::make(__('Footer Payment Methods')),
            Image::make(__('Footer Payment Image'), 'footer_payment_img')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Footer Payment Method Title'), 'footer_payment_method_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Heading::make(__('Footer Copyrights')),

            Text::make(__('Footer Copyright Title'), 'footer_copyright_text')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Footer All Right Reserved Title'), 'footer_copyright_text2')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            // DateTime::make('Created At', 'home_date_time')->rules(RulesHelper::NULLABLE_DATE_TIME_VALIDATION),

        ];
    }

    public static function homeSettings(): array
    {
        return [
            // Banner Section

            Heading::make(__('Banner Section')),
            Image::make(__('Banner Image'), 'home_banner_img')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Image::make(__('Image Left Side'), 'home_left_side_img')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Image::make(__('Image right Side up'), 'home_right_side_up_img')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Image::make(__('Image right Side down'), 'home_right_side_down_img')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Banner Title'), 'home_banner_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Text::make(__('Banner Sub Title'), 'home_banner_sub_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Heading::make(__('Services Section')),
            // service 4 home_service_title_1, honme_service_description, home_service_icon *4 

            Text::make(__('Title 1'), 'home_service_title_1')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Description 1'), 'home_service_description_1')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Image::make(__('Icon 1'), 'home_service_icon_1')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Title 2'), 'home_service_title_2')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Description 2'), 'home_service_description_2')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Image::make(__('Icon 2'), 'home_service_icon_2')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Title 3'), 'home_service_title_3')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Description 3'), 'home_service_description_3')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Image::make(__('Icon 3'), 'home_service_icon_3')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Title 4'), 'home_service_title_4')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Description 4'), 'home_service_description_4')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Image::make(__('Icon 4'), 'home_service_icon_4')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),






            Heading::make(__('First Tour Section')),
            Text::make(__('Label'), 'first_tour_section_label')->translatable(),
            Text::make(__('Title'), 'first_tour_section_title')->translatable(),
            CKEditor::make(__('Description'), 'first_tour_section_description')->translatable(),


            Heading::make(__('Category Section')),
            Text::make(__('Label'), 'sub_category_section_label')->translatable(),
            Text::make(__('Title'), 'sub_category_section_title')->translatable(),
            CKEditor::make(__('Description'), 'sub_category_section_description')->translatable(),


            Heading::make(__('Second Tour Section')),
            Text::make(__('Label'), 'second_section_label')->translatable(),
            Text::make(__('Title'), 'second_section_title')->translatable(),
            CKEditor::make(__('Description'), 'second_section_description')->translatable(),
            Image::make(__('Image background'), 'second_section_bg_image'),
            Text::make(__('descount title'), 'second_section_descount_title')->translatable(),
            Text::make(__('descount number'), 'second_section_descount_number')->translatable(),
            Text::make(__('Day'), 'second_section_date_deadline')
                ->help('Enter date and time in YYYY-MM-DDformat (e.g., 2025-08-20)')
                ->rules('nullable', 'date_format:Y-m-d'),
            Text::make(__('Button Link'), 'second_section_btn_link')->rules(RulesHelper::NULLABLE_STRING_VALIDATION),


            Heading::make(__('Mid Banner')),

            Image::make(__('Image Banner'), 'home_midBanner_image')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Image Title'), 'home_midBanner_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Text::make(__('Sub Title'), 'home_midBanner_sub_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Button Text'), 'home_midBanner_btn_text')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Text::make(__('Button Link'), 'home_midBanner_btn_link')->rules(RulesHelper::NULLABLE_STRING_VALIDATION),
            Text::make(__('Description'), 'home_midBanner_section_description')->translatable(),


            Heading::make(__('Third Tour Section')),
            Text::make(__('Label'), 'third_tour_section_label')->translatable(),
            Text::make(__('Title'), 'third_tour_section_title')->translatable(),
            CKEditor::make(__('Description'), 'third_tour_section_description')->translatable(),

            Heading::make(__('blog Section')),
            Text::make(__('Label'), 'blog_section_label')->translatable(),
            Text::make(__('Title'), 'blog_section_title')->translatable(),
            CKEditor::make(__('Description'), 'blog_section_description')->translatable(),

            Heading::make(__('Testimonials Section')),
            Text::make(__('Title'), 'testimonials_section_title')->translatable(),
            Image::make(__('Image background'), 'testimonials_section_image'),
            CKEditor::make(__('Description'), 'testimonials_section_description')->translatable(),


            Heading::make(__('Reviews Section')),

            // Review 1
            Text::make(__('Title 1'), 'reviews_section_title_1')->translatable(),
            Text::make(__('Link 1'), 'reviews_section_link_1'),
            Number::make('Rate 1', 'reviews_section_rate_1'),
            Image::make(__('Image 1'), 'reviews_section_img_1')->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            // Review 2
            Text::make(__('Title 2'), 'reviews_section_title_2')->translatable(),
            Text::make(__('Link 2'), 'reviews_section_link_2'),
            Number::make('Rate 2', 'reviews_section_rate_2'),
            Image::make(__('Image 2'), 'reviews_section_img_2')->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            // Review 3
            Text::make(__('Title 3'), 'reviews_section_title_3')->translatable(),
            Text::make(__('Link 3'), 'reviews_section_link_3'),
            Number::make('Rate 3', 'reviews_section_rate_3'),
            Image::make(__('Image 3'), 'reviews_section_img_3')->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            // Review 4
            Text::make(__('Title 4'), 'reviews_section_title_4')->translatable(),
            Text::make(__('Link 4'), 'reviews_section_link_4'),
            Number::make('Rate 4', 'reviews_section_rate_4'),
            Image::make(__('Image 4'), 'reviews_section_img_4')->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),


            Heading::make(__('faq Section')),
            Text::make(__('Label'), 'faq_section_label')->translatable(),
            Text::make(__('Title'), 'faq_section_title')->translatable(),
            CKEditor::make(__('Description'), 'faq_section_description')->translatable(),
            SimpleRepeatable::make('Faq Items', 'faq_service_items', [
                Text::make(__('Title'), 'title')
                    ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                    ->translatable(),
                Heroicon::make(__('Icon'), 'icon')
                    ->rules(RulesHelper::NULLABLE_ICON_VALIDATION),
                Text::make(__('Description'), 'description')
                    ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                    ->translatable(),
            ]),

            Heading::make(__('Partner Section')),
            Text::make(__('Title'), 'partner_section_title')->translatable(),
            CKEditor::make(__('Description'), 'partner_section_description')->translatable(),

            Heading::make(__('SEO')),
            Text::make(__('Site Title'), 'site_title')->translatable(),
            Text::make(__('Site Description'), 'site_description')->translatable(),
            Text::make(__('Site Keywords'), 'site_keywords')->translatable(),
            Code::make(__('Site Schema'), 'site_schema')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),

        ];
    }
    public static function mailSettings(): array
    {
        return [
            SimpleRepeatable::make('TailorMade Mails', 'tailor_mails', [
                Text::make(__('Mails'), 'mails')
                    ->rules(RulesHelper::REQUIRED_EMAIL_VALIDATION),
            ])->canAddRows(),

            SimpleRepeatable::make('Reservation Mails', 'reservation_mails', [
                Text::make(__('Mails'), 'mails')
                    ->rules(RulesHelper::REQUIRED_EMAIL_VALIDATION),
            ])->canAddRows(),

            SimpleRepeatable::make('Contact Mails', 'contact_mails', [
                Text::make(__('Mails'), 'mails')
                    ->rules(RulesHelper::REQUIRED_EMAIL_VALIDATION),
            ])->canAddRows(),
        ];
    }

    
}
