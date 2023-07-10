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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('messages', [MessageController::class, 'getMessages'])->name('messages');
    Route::delete('messages', [MessageController::class, 'deleteMessage'])->name('messages.delete');
});

Route::get('services', [ServiceController::class, 'index'])->name('services');
Route::get('about', [Controller::class, 'getAbout'])->name('about');
Route::post('contact', [Controller::class, 'postContact'])->name('contact');
