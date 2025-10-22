<?php

namespace App\Providers;

use App\Helpers\Constants\RulesHelper;
use App\Helpers\Nova\FieldsHelper;
use App\Nova\Category;
use App\Nova\SubCategory;
use App\Nova\Tour;
use Bernhardh\NovaTranslationEditor\NovaTranslationEditor;
use ClassicO\NovaMediaLibrary\NovaMediaLibrary;
use Crayon\NovaLanguageEditor\NovaLanguageEditor;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSettings\NovaSettings;
use CodencoDev\NovaGridSystem\NovaGridSystem;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::style('custom', public_path('assets/css/nova.css'));

        try {
            NovaSettings::addSettingsFields([
                new Panel(__('Main Settings'), FieldsHelper::mainSettings()),
            ], [
                'social_media' => 'array',
                'home_services' => 'array'
            ]);

            NovaSettings::addSettingsFields([
                new Panel(__('Home Settings'), FieldsHelper::homeSettings()),
                
            ], ['info_list' => 'array', 'faq_service_items' => 'array'], __('Home Settings'));

            NovaSettings::addSettingsFields([
                new Panel(__('Mail Settings'), FieldsHelper::mailSettings())
            ], [], __('Mail Settings'));

            NovaSettings::addSettingsFields([
                new Panel(__('wishlist'), FieldsHelper::wishlist()),
            ], [], __('wishlist'));

            NovaSettings::addSettingsFields([
                new Panel(__('thank you page'), FieldsHelper::thankYouPage()),
            ], [], __('thank you page'));

            NovaSettings::addSettingsFields([
                new Panel(__('About'), FieldsHelper::about()),
            ], [], __('About'));

            NovaSettings::addSettingsFields([
                new Panel(__('Travel Style'), FieldsHelper::travelStyle()),
            ], [], __('Travel Style'));

            NovaSettings::addSettingsFields([
                new Panel(__('Page tailor'), FieldsHelper::pageTailor()),
            ], [], __('Page tailor'));

            // NovaSettings::addSettingsFields([
            //     new Panel(__('contact us'), FieldsHelper::contactus()),
            // ], [], __('contact us'));
            // NovaSettings::addSettingsFields([
            //     new Panel(__('special offers'), FieldsHelper::specialOffers()),
            // ], [], __('Special offers'));
            // NovaSettings::addSettingsFields([
            //     new Panel(__('Article Categories'), FieldsHelper::articleCategories()),
            // ], [], __('Article Categories'));

        
            Nova::serving(function (ServingNova $event) {
                app()->setLocale('en');
            });
        } catch (\Exception $exception) {
            Log::error(sprintf("Something went wrong in NovaServiceProvider @ boot \n %s",  $exception->getMessage()));
        }
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    private function redirect301(): array
    {
        return [
            SimpleRepeatable::make('Redirect', 'redirect', [
                Text::make('From')->rules(RulesHelper::REQUIRED_STRING_VALIDATION),
                Text::make('To')->rules(RulesHelper::REQUIRED_STRING_VALIDATION)
            ])->canAddRows(true)->canDeleteRows(true),
        ];
    }
    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->can('access dashboard');
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards(): array
    {
        return [
            // new Articles,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            new CollapsibleResourceManager([
                'navigation' => [
                    
                    TopLevelResource::make([
                        'label' => 'Tours',
                        'expanded' => true,
                        'resources' => [
                            Category::class,
                            SubCategory::class,
                            Tour::class,
                        ]
                    ])->icon('<i class="fa fa-money"></i>'),
                    
                    
                ]
            ]),
            NovaLanguageEditor::make()
                ->canSee(fn() => auth()->user()->can('manage languages')),
            NovaTranslationEditor::make()
                ->canSee(fn() => auth()->user()->can('edit translations')),
            NovaMediaLibrary::make()
                ->canSee(fn() => auth()->user()->can('manage media')),
            // NovaPermissionTool::make()
            //     ->rolePolicy(RolePolicy::class)
            //     ->permissionPolicy(PermissionPolicy::class),
            NovaSettings::make()
                ->canSee(fn() => auth()->user()->can('edit settings')),
            // BackupTool::make()
            //     ->canSee(fn() => auth()->user()->email === env('ADMIN_EMAIL')),
            // RouteViewer::make()
            //     ->canSee(fn() => auth()->user()->email === env('ADMIN_EMAIL')),
            // NovaBreadcrumbs::make(),
            new NovaGridSystem
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
