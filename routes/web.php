<?php

use App\Http\Controllers\AjaxController;
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

});


Route::get('/', [WelcomeController::class, 'index'])->name('main');

Route::prefix('catalog')->name('catalog')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('.index');
    Route::get('/{alias}', [CatalogController::class, 'view'])->name('.view')
        ->where('alias', '([A-Za-z0-9\-\/_]+)');
});

Route::prefix('news')->name('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('.index');
    Route::get('/{alias}', [NewsController::class, 'item'])->name('.item')
        ->where('alias', '([A-Za-z0-9\-\/_]+)');
});

Route::get('cart', [App\Http\Controllers\HomeController::class, 'index'])->name('cart');

Route::any('search',[App\Http\Controllers\HomeController::class, 'index'])->name('search');

Route::get('policy', [App\Http\Controllers\HomeController::class, 'index'])->name('policy');


//Route::any('{alias}', [PageController::class, 'page'])
//    ->where('alias', '([A-Za-z0-9\-\/_]+)');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('news.item');
