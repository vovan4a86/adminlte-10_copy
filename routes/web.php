<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
