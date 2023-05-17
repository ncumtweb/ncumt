<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\PortalLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CalendarController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/commingsoon', function () {
    return view('commingsoon');
});

Route::get('/', [BasicController::class, 'index'])->name('index');

Route::resource('judgement', JudgementController::class);
Route::resource('record', RecordController::class);

Route::resource('user', UserController::class);


Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/', function () {
        return view('basic.portal');
    })->name('index');

    
    Route::get('/callback', [PortalLoginController::class, 'handleProviderCallback']);
    Route::get('/login', [PortalLoginController::class, 'redirectToProvider'])->name('login');
    Route::get('/logout', [PortalLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::resource('post', PostController::class);
    Route::resource('calendar', CalendarController::class);

});