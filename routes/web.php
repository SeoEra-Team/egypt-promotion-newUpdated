<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\DirectPaymentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\page\PageController;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\TravelStyle\TravelStyleController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::post('switchCurrency', [IndexController::class, 'switchCurrency'])->name('currency.switch');
Route::get('add-favorite/{id}', [IndexController::class, 'addFavorite'])->name('favorite.add');
Route::get('remove-favorite/{id}', [IndexController::class, 'removeFavorite'])->name('favorite.remove');
Route::get('/fetch-meta', [IndexController::class, 'fetchMeta'])->name('fetch-meta');
Route::get('wishlist', [IndexController::class, 'wishlist'])->name('wishlist.index');
Route::get('about/{slug}', [IndexController::class, 'about'])->name('about.index');
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

        
    }
);
