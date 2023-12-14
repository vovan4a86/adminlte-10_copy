<?php

use Adminlte3\Http\Controllers\AdminCatalogController;
use Adminlte3\Http\Controllers\AdminMainController;
use Adminlte3\Http\Controllers\AdminNewsCategoriesController;
use Adminlte3\Http\Controllers\AdminNewsController;
use Adminlte3\Http\Controllers\AdminPagesController;
use Adminlte3\Http\Controllers\AdminReviewsController;
use Adminlte3\Http\Controllers\AdminSettingsController;
use Adminlte3\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Adminlte3\Http\Controllers\DarkModeController;

//-----------------------------------------------------------------------------
// Dark Mode routes.
//-----------------------------------------------------------------------------

Route::post('/darkmode/toggle', [DarkModeController::class, 'toggle'])
    ->name('darkmode.toggle');


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [AdminMainController::class, 'getIndex'])->name('index');
    Route::get('/users', [AdminMainController::class, 'getUsers'])
        ->name('users');

    Route::prefix('user')->name('user')->group(function () {
        Route::get('edit/{id?}', [AdminUserController::class, 'getEdit'])
            ->name('.edit');
        Route::any('save', [AdminUserController::class, 'postSave'])
            ->name('.save');
        Route::post('delete/{id?}', [AdminUserController::class, 'postDelete'])
            ->name('.delete');
    });

    Route::prefix('pages')->name('pages')->group(function () {
        Route::get('/', [AdminPagesController::class, 'getIndex']);

        Route::post('save', [AdminPagesController::class, 'postSave'])
            ->name('.save');

        Route::get('edit/{id?}', [AdminPagesController::class, 'getEdit'])
            ->name('.edit');

        Route::post('edit/{id?}', [AdminPagesController::class, 'postEdit'])
            ->name('.edit');

        Route::post('reorder', [AdminPagesController::class, 'postReorder'])
            ->name('.reorder');

        Route::post('delete/{id}', [AdminPagesController::class, 'postDelete'])
            ->name('.delete');

        Route::post('delete-image/{id?}', [AdminPagesController::class, 'postDeleteImage'])
            ->name('.delete-image');

        Route::get('get-pages-tree', [AdminPagesController::class, 'getPagesTree']);
    });

    Route::prefix('catalog')->name('catalog')->group(function () {
        Route::get('/', [AdminCatalogController::class, 'getIndex'])
        ->name('.index');

        Route::get('search', [AdminCatalogController::class, 'postSearch'])
            ->name('.search');

        Route::post('save', [AdminCatalogController::class, 'postSave'])
            ->name('.save');

        Route::get('edit/{id?}', [AdminCatalogController::class, 'getEdit'])
            ->name('.edit');

        Route::post('edit/{id?}', [AdminCatalogController::class, 'postEdit'])
            ->name('.edit');

        Route::post('reorder', [AdminCatalogController::class, 'postReorder'])
            ->name('.reorder');

        Route::post('update-catalog-filter', [AdminCatalogController::class, 'postUpdateCatalogFilter'])
            ->name('.update-catalog-filter');


        Route::post('delete/{id}', [AdminCatalogController::class, 'postDelete'])
            ->name('.delete');

        Route::post('delete-image/{id?}', [AdminCatalogController::class, 'postDeleteImage'])
            ->name('.delete-image');

        Route::get('get-catalog-tree', [AdminCatalogController::class, 'getCatalogTree']);

        Route::get('products/{id?}', [AdminCatalogController::class, 'getProducts'])
            ->name('.products');

        Route::get('product-edit/{id?}', [AdminCatalogController::class, 'getProductEdit'])
            ->name('.product-edit');

        Route::post('product-save', [AdminCatalogController::class, 'postProductSave'])
            ->name('.product-save');

        Route::post('product-reorder', [AdminCatalogController::class, 'postProductReorder'])
            ->name('.product-reorder');

        Route::post('update-order/{id}', [AdminCatalogController::class, 'postUpdateOrder'])
            ->name('.update-order');

        Route::post('product-delete/{id}', [AdminCatalogController::class, 'postProductDelete'])
            ->name('.product-delete');

        //images
        Route::post('product-image-upload/{id}', [AdminCatalogController::class, 'postProductImageUpload'])
            ->name('.product-image-upload');

        Route::post('product-image-delete/{id}', [AdminCatalogController::class, 'postProductImageDelete'])
            ->name('.product-image-delete');

        Route::post('product-image-order', [AdminCatalogController::class, 'postProductImageOrder'])
            ->name('.product-image-order');

        //chars
//        Route::post('product-add-char/{id}', [AdminCatalogController::class, 'postProductAddChar'])
//            ->name('.product-add-char');
//
//        Route::post('product-del-char/{id}', [AdminCatalogController::class, 'postProductDelChar'])
//            ->name('.product-del-char');
//
//        Route::post('product-order-chars', [AdminCatalogController::class, 'postProductOrderChars'])
//            ->name('.product-order-chars');

        Route::post('product-delete-char/{id}', [AdminCatalogController::class, 'postProductDeleteChar'])
            ->name('.product-delete-char');

        Route::post('product-update-order-char', [AdminCatalogController::class, 'postProductUpdateOrderChar'])
            ->name('.product-update-order-char');

        Route::post('product-update-order-filter', [AdminCatalogController::class, 'postProductUpdateOrderFilter'])
            ->name('.product-update-order-filter');

        //product doc
        Route::post('product-add-doc/{id}', [AdminCatalogController::class, 'postProductAddDoc'])
            ->name('.product-add-doc');

        Route::post('product-del-doc/{id}', [AdminCatalogController::class, 'postProductDelDoc'])
            ->name('.product-del-doc');

        Route::post('product-edit-doc/{id}', [AdminCatalogController::class, 'postProductEditDoc'])
            ->name('.product-edit-doc');

        Route::post('product-save-doc/{id}', [AdminCatalogController::class, 'postProductSaveDoc'])
            ->name('.product-save-doc');

        Route::post('product-update-order-doc', [AdminCatalogController::class, 'postProductUpdateOrderDoc'])
            ->name('.product-update-order-doc');

        //mass
        Route::post('move-products', [AdminCatalogController::class, 'postMoveProducts'])
            ->name('.move-products');

        Route::post('delete-products', [AdminCatalogController::class, 'postDeleteProducts'])
            ->name('.delete-products');

        Route::post('delete-products-image', [AdminCatalogController::class, 'postDeleteProductsImage'])
            ->name('.delete-products-image');
    });

    Route::prefix('news')->name('news')->group(function () {
        Route::get('/', [AdminNewsController::class, 'getIndex'])
            ->name('.index');

        Route::post('save', [AdminNewsController::class, 'postSave'])
            ->name('.save');

        Route::get('edit/{id?}', [AdminNewsController::class, 'getEdit'])
            ->name('.edit');

        Route::post('edit/{id?}', [AdminNewsController::class, 'postEdit'])
            ->name('.edit');

        Route::post('reorder', [AdminNewsController::class, 'postReorder'])
            ->name('.reorder');

        Route::post('delete/{id}', [AdminNewsController::class, 'postDelete'])
            ->name('.delete');

        Route::post('delete-image/{id?}', [AdminNewsController::class, 'postDeleteImage'])
            ->name('.delete-image');

        Route::post('add-tag/{id}', [AdminNewsController::class, 'postAddTag'])
            ->name('.add-tag');
    });

    Route::prefix('news-categories')->name('news-categories')->group(function () {
        Route::get('/', [AdminNewsCategoriesController::class, 'getIndex']);

        Route::post('save', [AdminNewsCategoriesController::class, 'postSave'])
            ->name('.save');

        Route::get('edit/{id?}', [AdminNewsCategoriesController::class, 'getEdit'])
            ->name('.edit');

        Route::post('edit/{id?}', [AdminNewsCategoriesController::class, 'postEdit'])
            ->name('.edit');

        Route::post('reorder', [AdminNewsCategoriesController::class, 'postReorder'])
            ->name('.reorder');

        Route::post('delete/{id}', [AdminNewsCategoriesController::class, 'postDelete'])
            ->name('.delete');
    });

    Route::prefix('settings')->name('settings')->group(function () {
        Route::get('/', [AdminSettingsController::class, 'getIndex'])
            ->name('.index');

        Route::post('save', [AdminSettingsController::class, 'postSave'])
            ->name('.save');

        Route::any('edit/{id?}', [AdminSettingsController::class, 'anyEditSetting'])
            ->name('.edit');

        Route::get('group-items/{id?}', [AdminSettingsController::class, 'getGroupItems'])
            ->name('.groupItems');

        Route::post('group-save', [AdminSettingsController::class, 'postGroupSave'])
            ->name('.groupSave');

        Route::post('group-delete/{id}', [AdminSettingsController::class, 'postGroupDelete'])
            ->name('.groupDelete');

        Route::post('clear-value/{id}', [AdminSettingsController::class, 'postClearValue'])
            ->name('.clearValue');

        Route::any('block-params', [AdminSettingsController::class, 'anyBlockParams'])
            ->name('.blockParams');

        Route::post('edit-setting-save', [AdminSettingsController::class, 'postEditSettingSave'])
            ->name('.editSave');
    });

    Route::prefix('reviews')->name('reviews')->group(function () {
        Route::get('/', [AdminReviewsController::class, 'getIndex'])
            ->name('.index');

        Route::get('edit/{id?}', [AdminReviewsController::class, 'getEdit'])
            ->name('.edit');

        Route::post('save', [AdminReviewsController::class, 'postSave'])
            ->name('.save');

        Route::post('reorder', [AdminReviewsController::class, 'postReorder'])
            ->name('.reorder');

        Route::post('delete/{id}', [AdminReviewsController::class, 'postDelete'])
            ->name('.delete');
    });
});
