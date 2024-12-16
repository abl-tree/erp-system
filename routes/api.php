<?php

use App\Http\Controllers\Api\V1\User\MeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')
    ->namespace('\App\Http\Controllers\Api\V1')
    ->group(function () {
        Route::middleware(['auth:sanctum', 'verified'])
            ->group(function () {
                Route::get('/me', MeController::class);
            });
        
        Route::prefix('business')
            ->group(function () {
                Route::get('/types', 'BusinessDetailsController@businessTypes');
                Route::get('/features/{id?}', 'BusinessDetailsController@businessFeatures');
            });

        Route::prefix('address')
            ->group(function () {
                Route::post('/states', 'AddressController@getStates');
            });
    });
