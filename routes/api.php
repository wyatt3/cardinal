<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::domain('admin.' . env('APP_URL'))->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('messages', [MessageController::class, 'getMessages'])->name('messages');
        Route::delete('messages/{id}', [MessageController::class, 'deleteMessage'])->name('messages.delete');

        Route::group(['prefix' => 'services'], function () {
            Route::post('/', [ServiceController::class, 'updateService'])->name('services.update');
            Route::post('/update-order', [ServiceController::class, 'updateServiceOrder'])->name('services.update-order');
        });
    });
});

Route::get('services', [ServiceController::class, 'index'])->name('services');
Route::get('about', [Controller::class, 'getAbout'])->name('about');
Route::post('contact', [Controller::class, 'postContact'])->name('contact');
