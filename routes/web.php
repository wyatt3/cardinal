<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain('admin.' . env('APP_URL'))->group(function () {
    Auth::routes(['register' => false, 'password.request' => false, 'password.reset' => false, 'password.update' => false, 'password.confirm' => false, 'email.verification' => false, 'email.verification.notice' => false]);
    Route::middleware('auth')->group(function () {
        Route::get('/', [Controller::class, 'adminIndex'])->name('admin.home');
    });
});

Route::get('/', [Controller::class, 'index'])->name('home');
