<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Enums\UserRole;

//Separation of auth routes
require __DIR__.'/auth.php';

//Service Related Routes
Route::controller(ServiceController::class)
    ->name('service.')
    ->prefix('services')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::middleware(['role:'.UserRole::ADMIN->value])->group((function (){
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('delete');
            Route::put('/{id}', 'update')->name('update');
        }));

        Route::get('/', 'index')->name('index');
    });
