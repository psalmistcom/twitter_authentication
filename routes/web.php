<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('auth/twitter', [TwitterController::class, 'loginwithTwitter']);
Route::get('auth/twitter/callback', [TwitterController::class, 'cbTwitter']);
Route::get('auth/facebook', [FacebookController::class, 'loginwithFacebook']);
Route::get('auth/callback/facebook', [FacebookController::class, 'cbFacebook']);
