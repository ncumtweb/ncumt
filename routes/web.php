<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\RecordController;

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
Route::get('/', function () {
    return view('basic.index');
});

Route::resource('judgement', JudgementController::class);
Route::resource('record', RecordController::class);