<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\DirectPaymentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\page\PageController;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\TravelStyle\TravelStyleController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::post('switchCurrency', [IndexController::class, 'switchCurrency'])->name('currency.switch');

Route::get('/fetch-meta', [IndexController::class, 'fetchMeta'])->name('fetch-meta');

Route::get('/manifest.json', function () {
    return response()->view('layout.partials.manifest')
        ->header('Content-Type', 'application/json');
});
try {
    foreach (json_decode(nova_get_setting('redirect')) as $redirect) {
        Route::permanentRedirect($redirect->from, $redirect->to);
    }
} catch (Exception $e) {
}

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', [IndexController::class, 'index'])->name('home');

        Route::get('thank-you', [IndexController::class, 'thanks'])->name('thanks');
        Route::post('subscribe', [IndexController::class, 'savesubscribe'])->name('subscribe.post');
        Route::get('/tailorMade', [FormController::class, 'tailorMade'])->name('tailorMade');
        Route::post('/tailorMade/store', [FormController::class, 'saveTailorMade'])->name('tailorMade.store');
        Route::get('/contact-us', [FormController::class, 'contactUs'])->name('contactus');
        Route::post('/contact-us/store', [FormController::class, 'saveContactUs'])->name('contactus.store');



        Route::group(['as' => 'tour.'], function () {

            Route::post('/tour/reservation/{id}', [TourController::class, 'reservation'])->name('reservation');

            Route::get('{categorySlug}/{subCategorySlug}/{tourSlug}', [TourController::class, 'show'])
                ->where('categorySlug', '^(?!admin_panel|nova-api|nova-vendor).*$')->name('show');

            Route::get('{categorySlug}/{subCategorySlug}', [TourController::class, 'tours'])
                ->where('categorySlug', '^(?!admin_panel|nova-api|nova-vendor).*$')->name('index');


            Route::get('{categorySlug}', [TourController::class, 'getSubCategories'])
                ->where('categorySlug', '^(?!admin_panel|nova-api|nova-vendor).*$')->name('category');
        });
    }
);
