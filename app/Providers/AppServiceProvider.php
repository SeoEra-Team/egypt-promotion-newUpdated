<?php

namespace App\Providers;

use App\Helpers\Classes\Currency;
use App\View\Composers\BlogComposer;
use App\View\Composers\FAQComposer;
use App\View\Composers\FirstTourComposer;
use App\View\Composers\GeneralComposer;
use App\View\Composers\PartenerComposer;
use App\View\Composers\SecondTourComposer;
use App\View\Composers\subCategoryComposer;
use App\View\Composers\TestimonialComposer;
use App\View\Composers\ThirdTourComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.custom');
        View()->composer('*', function ($view) {
            $favoriteToursIds = session('favorite_tours', []);
            $view->with('favoriteToursIds', $favoriteToursIds);
        });
        try {
            Currency::setDefault();
            
            view()->composer('layout.master', GeneralComposer::class);
            view()->composer('home.partials.sub_category_section', subCategoryComposer::class);
            view()->composer('home.partials.first_tour_section', FirstTourComposer::class);
            view()->composer('home.partials.second_tour_section', SecondTourComposer::class);
            view()->composer('home.partials.third_tour_section', ThirdTourComposer::class);
            view()->composer('home.partials.blog_section', BlogComposer::class);
            view()->composer('home.partials.testimonial_section', TestimonialComposer::class);
            view()->composer('layout.partials.faqs', FAQComposer::class);
            view()->composer('layout.partials.partners', PartenerComposer::class);
            
        } catch (\Exception $exception) {
        }
    }
}
