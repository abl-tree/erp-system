<?php

use App\Http\Controllers\Api\V1\User\MeController;
use App\Http\Controllers\Api\V1\User\AccountController;
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

        Route::prefix('department')
            ->group(function () {
                Route::resource('/', 'DepartmentController');
            });

        Route::prefix('employment')
            ->group(function () {
                Route::get('/types', 'EmploymentController@types');
                Route::get('/shifts', 'EmploymentController@shifts');
            });
        
        Route::prefix('business')
            ->group(function () {
                Route::post('/create', 'BusinessDetailsController@createBusiness');
                Route::post('/user/update', 'BusinessDetailsController@updateUser');
                Route::post('/user/create', 'BusinessDetailsController@createUser');
                Route::post('/user/disable', 'BusinessDetailsController@disableUser');
                Route::get('/users', 'BusinessDetailsController@getUsers');
                Route::get('/types', 'BusinessDetailsController@businessTypes');
                Route::get('/features/{id?}', 'BusinessDetailsController@businessFeatures');
            });
        
        Route::prefix('jobs')
            ->group(function () {
                Route::get('/roles', 'JobsController@jobRoles');
            });

        Route::prefix('address')
            ->group(function () {
                Route::get('/countries', 'AddressController@getCountries');
                Route::get('/states', 'AddressController@getStates');
                Route::get('/cities', 'AddressController@getCities');
            });

        Route::prefix('account')
            ->group(function () {
                Route::get('/roles', [AccountController::class, 'getRoles']);
                Route::get('/roles/{id}', [AccountController::class, 'getSubRoles']);
                Route::get('/status', [AccountController::class, 'getStatuses']);
            });
    });
