<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::post('callback', [AjaxController::class, 'postCallback'])->name('callback');
    Route::get('show-popup-cities', [AjaxController::class, 'showCitiesPopup'])->name('show-popup-cities');
    Route::post('free-request', 'AjaxController@postFreeRequest')->name('free-request');

    //cart
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::post('add', [AjaxController::class, 'postCartAdd'])->name('add');
        Route::post('remove', [AjaxController::class, 'postCartRemove'])->name('remove');
        Route::post('update', [AjaxController::class, 'postCartUpdate'])->name('update');
        Route::post('purge', [AjaxController::class, 'postCartPurge'])->name('purge');
        Route::post('checkout', [AjaxController::class, 'postCartCheckout'])->name('checkout');
        Route::get('success', [AjaxController::class, 'getSuccess'])->name('success');
    });

    //compare & favorites
    Route::post('compare', [AjaxController::class, 'postCompare'])->name('compare');
    Route::post('compare-delete', [AjaxController::class, 'postCompareDelete'])->name('compare-delete');
    Route::post('favorite', [AjaxController::class, 'postFavorite'])->name('favorite');
    Route::post('favorite-delete', [AjaxController::class, 'postFavoriteDelete'])->name('favorite-delete');

});


Route::get('/', [WelcomeController::class, 'index'])->name('main');

Route::prefix('catalog')->name('catalog')->group(function () {
    Route::get('/', [CatalogController::class, 'index']);
    Route::get('/{alias}', [CatalogController::class, 'view'])->name('.view')
        ->where('alias', '([A-Za-z0-9\-\/_]+)');
});

Route::prefix('news')->name('news')->group(function () {
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/{alias}', [NewsController::class, 'item'])->name('.item')
        ->where('alias', '([A-Za-z0-9\-\/_]+)');
});

Route::prefix('cart')->name('cart')->group(function () {
    Route::get('/', [CartController::class, 'getIndex']);
    Route::get('checkout', [CartController::class, 'getCartCheckout'])->name('.checkout');
});

Route::any('favorites',[PageController::class, 'getFavoritesList'])->name('favorites');
Route::any('compare',[PageController::class, 'getCompareList'])->name('compare');

Route::any('search',[App\Http\Controllers\HomeController::class, 'index'])->name('search');

Route::get('policy', [App\Http\Controllers\HomeController::class, 'index'])->name('policy');


//Route::any('{alias}', [PageController::class, 'page'])
//    ->where('alias', '([A-Za-z0-9\-\/_]+)');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('news.item');
