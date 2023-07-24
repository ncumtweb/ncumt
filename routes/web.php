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
use App\Http\Controllers\FaqController;

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

Route::fallback(function () {
    return redirect()->route('index');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/comingsoon', function () {
    return view('comingsoon');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('/', [BasicController::class, 'index'])->name('index');

Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/judgement', [JudgementController::class, 'index'])->name('judgement.index');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::resource('record', RecordController::class);
Route::post('/record/upload', [RecordController::class, 'uploadImage'])->name('record.uploadImage');



Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/', function () {
        return view('basic.portal');
    })->name('index');

    
    Route::get('/callback', [PortalLoginController::class, 'handleProviderCallback']);
    Route::get('/login', [PortalLoginController::class, 'redirectToProvider'])->name('login');
    Route::get('/logout', [PortalLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

});

//management control
Route::middleware(['checkRole'])->group(function () {

    //post
    Route::resource('post', PostController::class);

    //calendar
    Route::resource('calendar', CalendarController::class);
    Route::get('calendar/delete/{id}', [CalendarController::class, 'destroy'])->name('calendar.delete');

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

    //record
    Route::get('/record/delete/{id}', [RecordController::class, 'delete'])->name('record.delete');
    
    //faq
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq/create', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/edit/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/edit/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
    
});
