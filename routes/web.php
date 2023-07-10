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
    Route::get('/', function () {
        return "admin";
    });
    Auth::routes(['register' => false]);
});

Route::get('/', [Controller::class, 'index'])->name('home');
