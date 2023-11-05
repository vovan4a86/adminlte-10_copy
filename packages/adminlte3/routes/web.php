<?php

use Adminlte3\Http\Controllers\AdminMainController;
use Adminlte3\Http\Controllers\AdminPageController;
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
    Route::get('/', [AdminMainController::class, 'index']);
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
        Route::get('/', [AdminPageController::class, 'getPages']);
        Route::post('save', [AdminPageController::class, 'postSave'])
            ->name('save');
        Route::get('edit/{id?}', [AdminPageController::class, 'getEdit'])
            ->name('edit');
        Route::post('edit/{id?}', [AdminPageController::class, 'postEdit'])
            ->name('edit');
        Route::post('delete-image/{id?}', [AdminPageController::class, 'postDeleteImage'])
            ->name('delete-image');
        Route::get('get-pages-tree', [AdminPageController::class, 'getPagesTree'])
            ->name('getPagesTree');
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
