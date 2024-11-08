<?php

use App\Http\Controllers\registration\RegistrationController2;
use App\Http\Controllers\registration\StageController2;
use App\Http\Controllers\reports\ReportController2;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('sidemenu:registration2')->group(function () {
        Route::prefix('registration2')->controller(RegistrationController2::class)->group(function () {
            Route::get('/', 'index')->name('registration2.index');
            Route::prefix('stage')->controller(StageController2::class)->group(function () {
                Route::get('/', 'index')->name('registration2.stage.index');
                Route::post('decision', 'makeDecision')->name('registration2.stage.decision');
                Route::get('completed', 'showCompleted')->name('registration2.stage.completed');
                Route::get('/{stage}', 'view')->name('registration2.stage.view');
            });
        });
        Route::prefix('reports')->controller(ReportController2::class)->group(function () {
        Route::get('/application2', 'showApplicationReport')->name('registration2.report.application');
       });
   });
});
