<?php

use App\Http\Controllers\registration\RegistrationController;
use App\Http\Controllers\registration\StageController;
use App\Http\Controllers\reports\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
   Route::middleware('sidemenu:registration')->group(function () {
      Route::prefix('registration')->controller(RegistrationController::class)->group(function () {
          Route::get('/', 'index')->name('registration.index');
          Route::prefix('stage')->controller(StageController::class)->group(function () {
              Route::get('/', 'index')->name('registration.stage.index');
              Route::post('decision', 'makeDecision')->name('registration.stage.decision');
              Route::get('completed', 'showCompleted')->name('registration.stage.completed');
              Route::get('/{stage}', 'view')->name('registration.stage.view');
          });
      });
       Route::prefix('reports')->controller(ReportController::class)->group(function () {
           Route::get('/application', 'showApplicationReport')->name('registration.report.application');

       });

   });
});
