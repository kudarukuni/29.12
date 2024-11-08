<?php

use App\Http\Controllers\registration\RegistrationController;
use App\Http\Controllers\settings\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(RegistrationController::class)->prefix('registration')->group(function () {
   Route::post('', 'storeAPI');
   Route::get('', 'indexAPI');
   Route::post('/reference', 'getStageAPI');
});

Route::controller(AddressController::class)->prefix('address')->group(function () {
    Route::get('/towns', [AddressController::class, 'getTowns']);
    Route::post('/suburbs/{townCode}', [AddressController::class, 'getSuburbs']);
    Route::post('/streets/{suburbCode}', [AddressController::class, 'getStreets']);
});
