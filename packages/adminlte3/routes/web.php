<?php

use Adminlte3\Http\Controllers\AdminCatalogController;
use Adminlte3\Http\Controllers\AdminMainController;
use Adminlte3\Http\Controllers\AdminPagesController;
use Adminlte3\Http\Controllers\AdminSettingsController;
use Adminlte3\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Adminlte3\Http\Controllers\DarkModeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your package. These
| routes are loaded by your package ServiceProvider within a group which
| contains the "web" middleware group.
|
*/

//-----------------------------------------------------------------------------
// Dark Mode routes.
//-----------------------------------------------------------------------------

Route::post('/darkmode/toggle', [DarkModeController::class, 'toggle'])
    ->name('darkmode.toggle');


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [AdminMainController::class, 'index'])
        ->name('index');
    Route::get('/users', [AdminMainController::class, 'getAllUsers'])
        ->name('users');
    Route::get('/profile', [AdminMainController::class, 'profile'])
        ->name('profile');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('edit/{id?}', [AdminUserController::class, 'getEdit'])
            ->name('edit');
        Route::any('save', [AdminUserController::class, 'postSave'])
            ->name('save');
        Route::post('delete/{id?}', [AdminUserController::class, 'postDelete'])
            ->name('delete');
    });

    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [AdminPagesController::class, 'getIndex'])->name('index');
        Route::post('save', [AdminPagesController::class, 'postSave'])
            ->name('save');
        Route::get('edit/{id?}', [AdminPagesController::class, 'getEdit'])
            ->name('edit');
        Route::post('edit/{id?}', [AdminPagesController::class, 'postEdit'])
            ->name('edit');
        Route::post('reorder', [AdminPagesController::class, 'postReorder'])
            ->name('.reorder');
        Route::post('delete/{id}', [AdminPagesController::class, 'postDelete'])
            ->name('.delete');
        Route::post('delete-image/{id?}', [AdminPagesController::class, 'postDeleteImage'])
            ->name('delete-image');
        Route::get('get-pages-tree', [AdminPagesController::class, 'getPagesTree'])
            ->name('getPagesTree');
    });

    Route::prefix('catalog')->name('catalog.')->group(function () {
        Route::get('/', [AdminCatalogController::class, 'getIndex'])->name('index');

        Route::post('save', [AdminCatalogController::class, 'postSave'])
            ->name('save');

        Route::get('edit/{id?}', [AdminCatalogController::class, 'getEdit'])
            ->name('edit');

        Route::post('edit/{id?}', [AdminCatalogController::class, 'postEdit'])
            ->name('edit');

        Route::post('reorder', [AdminCatalogController::class, 'postReorder'])
            ->name('.reorder');

        Route::post('delete/{id}', [AdminCatalogController::class, 'postDelete'])
            ->name('.delete');

        Route::post('delete-image/{id?}', [AdminCatalogController::class, 'postDeleteImage'])
            ->name('delete-image');

        Route::get('get-catalog-tree', [AdminCatalogController::class, 'getCatalogTree'])
            ->name('get-catalog-tree');

        Route::get('products/{id?}', [AdminCatalogController::class, 'getProducts'])
            ->name('products');

        Route::get('product-edit/{id?}', [AdminCatalogController::class, 'getProductEdit'])
            ->name('product-edit');

        Route::post('product-save', [AdminCatalogController::class, 'postProductSave'])
            ->name('product-save');

        Route::post('product-reorder', [AdminCatalogController::class, 'postProductReorder'])
            ->name('product-reorder');

        Route::post('update-order/{id}', [AdminCatalogController::class, 'postUpdateOrder'])
            ->name('update-order');

        Route::post('product-delete/{id}', [AdminCatalogController::class, 'postProductDelete'])
            ->name('product-delete');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminSettingsController::class, 'getIndex']);

        Route::post('save', [AdminSettingsController::class, 'postSave'])
            ->name('save');

        Route::any('edit/{id?}', [AdminSettingsController::class, 'anyEditSetting'])
            ->name('edit');

        Route::get('group-items/{id?}', [AdminSettingsController::class, 'getGroupItems'])
            ->name('groupItems');

        Route::post('group-save', [AdminSettingsController::class, 'postGroupSave'])
            ->name('groupSave');

        Route::post('group-delete/{id}', [AdminSettingsController::class, 'postGroupDelete'])
            ->name('groupDelete');

        Route::post('clear-value/{id}', [AdminSettingsController::class, 'postClearValue'])
            ->name('clearValue');

        Route::any('block-params', [AdminSettingsController::class, 'anyBlockParams'])
            ->name('blockParams');

        Route::post('edit-setting-save', [AdminSettingsController::class, 'postEditSettingSave'])
            ->name('editSave');
    });


});
