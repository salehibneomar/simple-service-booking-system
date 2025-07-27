<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
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

//Booking Related Routes
Route::controller(BookingController::class)
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::middleware('role:'.UserRole::ADMIN->value)
            ->prefix('admin/bookings')
            ->name('admin.booking.')
            ->group(function () {
                Route::get('/', 'getAll')->name('index');
                Route::put('/{id}', 'update')->name('update');
        });

       Route::middleware('role:'.UserRole::CUSTOMER->value)
            ->prefix('bookings')
            ->name('customer.booking.')
            ->group(function () {
                Route::get('/', 'getCustomerBookings')->name('index');
                Route::post('/', 'store')->name('store');
            });
    });
