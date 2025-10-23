<?php

namespace App\Providers;

use App\Helpers\Classes\Currency;
use App\View\Composers\BlogComposer;
use App\View\Composers\FAQComposer;
use App\View\Composers\FirstSubCategoryComposer;
use App\View\Composers\FirstTourComposer;
use App\View\Composers\GeneralComposer;
use App\View\Composers\PartenerComposer;
use App\View\Composers\SecondSubCategoryComposer;
use App\View\Composers\SecondTourComposer;
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
       
        try {
            Currency::setDefault();
            view()->composer('layout.master', GeneralComposer::class);
            view()->composer('home.partials.first_sub_categories_section', FirstSubCategoryComposer::class);
            view()->composer('home.partials.second_sub_categories_section', SecondSubCategoryComposer::class);
            view()->composer('home.partials.first_tour_section', FirstTourComposer::class);
            view()->composer('home.partials.second_tour_section', SecondTourComposer::class);
            view()->composer('home.partials.articles_section', BlogComposer::class);
            view()->composer('layout.partials.faqs', FAQComposer::class);
            view()->composer('layout.partials.partners', PartenerComposer::class);
            
            
        } catch (\Exception $exception) {
        }
    }
}
