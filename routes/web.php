<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\PortalLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;

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

Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/judgement', [JudgementController::class, 'index'])->name('judgement.index');

Route::resource('record', RecordController::class);




Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/', function () {
        return view('basic.portal');
    })->name('index');

    
    Route::get('/callback', [PortalLoginController::class, 'handleProviderCallback']);
    Route::get('/login', [PortalLoginController::class, 'redirectToProvider'])->name('login');
    Route::get('/logout', [PortalLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

});

//management control
Route::middleware(['checkRole'])->group(function () {

    //post
    Route::resource('post', PostController::class);

    //calendar
    Route::resource('calendar', CalendarController::class);

    // judgement 
    Route::post('/judgement', [JudgementController::class, 'store'])->name('judgement.store');
    Route::get('/judgement/{id}', [JudgementController::class, 'edit'])->name('judgement.edit');
    Route::put('/judgement/{id}', [JudgementController::class, 'update'])->name('judgement.update');
    Route::delete('/judgement/delete/{id}', [JudgementController::class, 'destroy'])->name('judgement.destroy');

    //course
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/create', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/edit/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::get('/course/delete/{id}', [CourseController::class, 'destroy'])->name('course.destroy');


    Route::get('/record/delete/{id}', [RecordController::class, 'delete'])->name('record.delete');
    
});
