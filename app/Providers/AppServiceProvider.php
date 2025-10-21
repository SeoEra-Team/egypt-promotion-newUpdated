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
       
        try {
            Currency::setDefault();
            view()->composer('layout.master', GeneralComposer::class);
            
            
        } catch (\Exception $exception) {
        }
    }
}
