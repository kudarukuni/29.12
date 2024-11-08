<?php

use App\Http\Controllers\settings\StageController;
use App\Http\Controllers\settings\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('sidemenu:settings')->group(function () {
        Route::prefix('settings')->group(function () {
            Route::prefix('user')->group(function () {
                Route::controller(UserController::class)->group(function () {
                    Route::get('', 'index')->name('settings.user.index');
                    Route::post('store', 'store')->name('settings.user.store');
                    Route::post('update', 'update')->name('settings.user.update');
                    Route::get('toggle/{user}', 'toggle')->name('settings.user.toggle');
                    Route::get('reset/{user}', 'resetUser')->name('settings.user.reset');
                });
            });
            Route::prefix('stages')->group(function () {
                Route::controller(StageController::class)->group(function () {
                    Route::get('', 'index')->name('settings.stage.index');
                    Route::post('store', 'store')->name('settings.stage.store');
                    Route::post('update', 'update')->name('settings.stage.update');
                    Route::get('{stage}', 'toggle')->name('settings.stage.toggle');
                });
            });
        });
    });
});
