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

            Text::make(__('Banner Title'), 'home_banner_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Text::make(__('Banner Sub Title'), 'home_banner_sub_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),

            Heading::make(__('Sub Category Section')),
            Text::make(__('Label'), 'sub_category_section_label')->translatable(),
            Text::make(__('Title'), 'sub_category_section_title')->translatable(),
            CKEditor::make(__('Description'), 'sub_category_section_description')->translatable(),


            Heading::make(__('First Tour Section')),
            Text::make(__('Label'), 'first_tour_section_label')->translatable(),
            Text::make(__('Title'), 'first_tour_section_title')->translatable(),
            CKEditor::make(__('Description'), 'first_tour_section_description')->translatable(),


            

            Heading::make(__('Second Tour Section')),
            Text::make(__('Label'), 'second_section_label')->translatable(),
            Text::make(__('Title'), 'second_section_title')->translatable(),
            CKEditor::make(__('Description'), 'second_section_description')->translatable(),
            

            Heading::make(__('Third Tour Section')),
            Text::make(__('Label'), 'third_tour_section_label')->translatable(),
            Text::make(__('Title'), 'third_tour_section_title')->translatable(),
            CKEditor::make(__('Description'), 'third_tour_section_description')->translatable(),

            Heading::make(__('blog Section')),
            Text::make(__('Label'), 'blog_section_label')->translatable(),
            Text::make(__('Title'), 'blog_section_title')->translatable(),
            CKEditor::make(__('Description'), 'blog_section_description')->translatable(),

            Heading::make(__('Book Amazing Egypt Trips')),
            Text::make(__('Title'), 'testimonials_section_title')->translatable(),
            CKEditor::make(__('Description'), 'testimonials_section_description')->translatable(),


            

            Heading::make(__('faq Section')),
            Text::make(__('Label'), 'faq_section_label')->translatable(),
            Text::make(__('Title'), 'faq_section_title')->translatable(),
            CKEditor::make(__('Description'), 'faq_section_description')->translatable(),
            

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

    public static function wishlist(): array
    {
        return [
            Text::make(__('wishlist Title'), 'wishlist_section_title')->translatable(),
            Text::make(__('wishlist heading'), 'wishlist_section_heading')->translatable(),
            Image::make(__('wishlist banner image'), 'wishlist_section_banner')->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Heading::make(__('SEO')),
            Text::make(__('wishlist Title'), 'wishlist_title')->translatable(),
            Text::make(__('wishlist Description'), 'wishlist_description')->translatable(),
            Text::make(__('wishlist Keywords'), 'wishlist_keywords')->translatable(),
            Code::make(__('wishlist Schema'), 'wishlist_schema')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),
        ];
    }

    public static function about(): array
    {
        return [
            Heading::make(__('About Section')),
            Image::make(__('Side Image 1'), 'about_section_side_image_1')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Image::make(__('Side Image 2'), 'about_section_side_image_2')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Image::make(__('about banner image'), 'about_section_banner')->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Text::make(__('Label'), 'about_section_label')->translatable(),
            Text::make(__('Title'), 'about_section_title')->translatable(),
            Text::make(__('Number Experience'), 'about_section_experience_number')->translatable(),
            Text::make(__('Title Experience'), 'about_section_experience_title')->translatable(),
            CKEditor::make(__('Description'), 'about_section_description')->translatable(),
            Heading::make(__('SEO')),
            Text::make(__('about Slug'), 'about_slug')->translatable(),
            Text::make(__('about Title'), 'about_title')->translatable(),
            Text::make(__('about Description'), 'about_description')->translatable(),
            Text::make(__('about Keywords'), 'about_keywords')->translatable(),
            Code::make(__('about Schema'), 'about_schema')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),
        ];
    }


    public static function thankYouPage(): array
    {
        return [
            Image::make(__('Banner'), 'thanks_page_banner')
                ->maxWidth(200)
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),

            Text::make(__('Banner Alt'), 'thanks_page_banner_alt')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),
            Text::make(__('Banner Title'), 'thanks_page_banner_title')
                ->rules(RulesHelper::NULLABLE_STRING_VALIDATION)
                ->translatable(),


            Text::make(__('Title'), 'thanks_page_title')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable(),

            Text::make(__('Name'), 'thanks_page_name')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable(),


            CKEditor::make(__('Description'), 'thanks_page_text')
                ->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->translatable(),

            Heading::make(__('SEO')),
            Text::make(__('Meta Title'), 'thanks_page_meta_title')->translatable(),
            Text::make(__('Meta Description'), 'thanks_page_meta_description')->translatable(),
            Text::make(__('Meta Keywords'), 'thanks_page_meta_keywords')->translatable(),
            Code::make(__('Schema'), 'thanks_page_schema')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),
        ];
    }

    public static function travelStyle(): array
    {
        return [
            Image::make(__('banner'), 'travel_style_banner')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Text::make(__('Title'), 'travel_style_title')->translatable(),
            Text::make(__('Sub Title'), 'travel_style_sub_title')->translatable(),
            Text::make(__('Heading'), 'travel_style_heading')->translatable(),
            Textarea::make(__('short description'), 'travel_style_short_description')->translatable(),
            CKEditor::make(__('description'), 'travel_style_description')->translatable(),
        ];
    }
    public static function pageTailor(): array
    {
        return [
            Heading::make(__('Tailor Made')),
            Image::make(__('Banner'), 'tailor_made_banner')
                ->maxWidth(200)
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Image::make(__('Img'), 'tailor_made_img')
                ->maxWidth(200)
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Text::make(__('Tailor Made Title'), 'tailor_made_title')->translatable(),
            Text::make(__('Tailor Made Sub Title'), 'tailor_made_sub_title')->translatable(),
            CKEditor::make(__('Tailor Made  description'), 'tailor_made_short_description')->translatable(),
        ];
    }

    public static function contactus(): array
    {
        return [
            Heading::make(__('contact us')),
            Image::make(__('Banner'), 'contactus_banner')
                ->maxWidth(200)
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            // Image::make(__('Img'), 'contactus_img')
            //     ->maxWidth(200)
            //     ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Text::make(__('contactus Title'), 'contactus_title')->translatable(),
            Text::make(__('contactus Sub Title'), 'contactus_sub_title')->translatable(),
            Text::make(__('ifram location'), 'ifram_location'),
            // CKEditor::make(__('contactus short description'), 'contactus_short_description')->translatable(),

        ];
    }

    public static function specialOffers(): array
    {
        return [
            Heading::make(__('Special offerse')),
            Text::make(__('Title'), 'offer_section_title')->translatable(),
            Text::make(__('Main Title'), 'offer_section_main_title')->translatable(),
            Text::make(__('Label'), 'offer_section_label_title')->translatable(),
            Text::make(__('Sub Title'), 'offer_section_sub_title')->translatable(),

            Text::make(__('descount title'), 'offer_section_descount_title')->translatable(),

            Text::make(__('descount number'), 'offer_section_descount_number')->translatable(),



            Text::make(__('Day'), 'offer_section_date_deadline')
                ->help('Enter date and time in YYYY-MM-DD format (e.g., 2025-08-20)')
                ->rules('nullable', 'date_format:Y-m-d'),

            Text::make(__('Button Text'), 'offer_section_btn_text')->translatable(),
            Text::make(__('Button Link'), 'offer_section_btn_link')->rules(RulesHelper::NULLABLE_URL_VALIDATION),
            CKEditor::make(__('Description'), 'offer_section_description')->translatable(),
            Image::make(__('Side Image'), 'offer_section_side_image')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Image::make(__('Image background'), 'offer_section_bg_image'),
            Image::make(__('Banner'), 'offer_section_banner'),



        ];
    }

    public static function articleCategories(): array
    {
        return [
            Image::make(__('banner'), 'article_category_banner')
                ->rules(RulesHelper::NULLABLE_IMAGE_VALIDATION),
            Text::make(__('Sub Title'), 'article_category_name')->translatable(),
            Text::make(__('Title'), 'article_category_title')->translatable(),
            Text::make(__('Heading'), 'article_category_heading')->translatable(),
            Textarea::make(__('short description'), 'article_category_short_description')->translatable(),
            CKEditor::make(__('description'), 'article_category_description')->translatable(),
            Heading::make(__('SEO')),
            Text::make(__('article category Title'), 'article_category_title')->translatable(),
            Text::make(__('article category Description'), 'article_category_description')->translatable(),
            Text::make(__('article category Keywords'), 'article_category_keywords')->translatable(),
            Code::make(__('article category Schema'), 'article_category_schema')->rules(RulesHelper::NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),
        ];
    }
}
