<?php

use Adminlte3\Auth\Controllers\AuthController;

Route::any('auth', [AuthController::class, 'index'])->name('auth');
