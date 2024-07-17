<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\JudgementController;
use App\Http\Controllers\PortalLoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
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

Route::fallback(function () {
    return view('404');
});

Route::get('/aboutus', function () {
    return view('information.aboutus');
});

// Route::get('/map', function () {
//     return view('map');
// });

Route::get('/', [BasicController::class, 'index'])->name('index');

Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/register', [CourseController::class, 'showRegister'])->name('course.showRegister');
Route::get('/judgement', [JudgementController::class, 'index'])->name('judgement.index');
Route::get('/judgement/record', [JudgementController::class, 'record'])->name('judgement.record');
Route::get('/judgement/rule', [JudgementController::class, 'rule'])->name('judgement.rule');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/record', [RecordController::class, 'index'])->name('record.index');
Route::get('/record/show/{id}', [RecordController::class, 'show'])->name('record.show');




Route::prefix('portal')->name('portal.')->group(function () {
    Route::get('/', [PortalLoginController::class, 'index'])->name('index');


    Route::get('/callback', [PortalLoginController::class, 'handleProviderCallback']);
    Route::get('/login', [PortalLoginController::class, 'redirectToProvider'])->name('login');
    Route::get('/logout', [PortalLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

    //course
    Route::get('/course/showRecord/', [CourseController::class, 'showRecord'])->name('course.showRecord');

    //equipment
    Route::get('/equipment/{name}', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::get("/selectEquipment", [EquipmentController::class, 'select'])->name('equipment.select');

    //rental
    Route::get('/rentalList', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rentalList/returnRental/{rental_id}', [RentalController::class, 'returnRental'])->name('rental.return');
    Route::put('/equipment/showRental/{rental_id}', [RentalController::class, 'update'])->name('rental.update');
    Route::get('/equipment/addEquipment/{equipment_id}', [RentalController::class, 'addEquipment'])->name('rental.addEquipment');
    Route::get('/equipment/showRental/{rental_id}', [RentalController::class, 'showRental'])->name('rental.showRental');
    Route::get('/equipment/removeRentalEquipment/{rentalEquipment_id}', [RentalController::class, 'removeEquipment'])->name('rentalEquipment.remove');
    Route::put('/equipment/showRental/{rental_id}', [RentalController::class, 'update'])->name('rental.update');
});

Route::middleware(['previousPage'])->group(function () {
    Route::post('/course/register/{id}', [CourseController::class, 'register'])->name('course.register');
});

//management control
Route::middleware(['checkRole'])->group(function () {

    //post
    Route::resource('post', PostController::class);

    //calendar
    Route::resource('calendar', CalendarController::class);
    Route::get('calendar/delete/{id}', [CalendarController::class, 'destroy'])->name('calendar.delete');

    // judgement
    Route::get('/judgement/edit/{id}', [JudgementController::class, 'edit'])->name('judgement.edit');

    //course
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course/create', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/edit/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::get('/course/delete/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::get('/course/record/{id}', [CourseController::class, 'showAllRecords'])->name('course.showAllRecords');


    //record
    Route::get('/record/create', [RecordController::class, 'create'])->name('record.create');
    Route::post('/record/store', [RecordController::class, 'store'])->name('record.store');
    Route::get('/record/edit/{id}', [RecordController::class, 'edit'])->name('record.edit');
    Route::put('/record/edit/{id}', [RecordController::class, 'update'])->name('record.update');
    Route::post('/record/upload', [RecordController::class, 'uploadImage'])->name('record.uploadImage');
    Route::post('/record/imgur', [RecordController::class, 'callImgurApi'])->name('record.callImgurApi');
    Route::get('/record/delete/{id}', [RecordController::class, 'delete'])->name('record.delete');


    //faq
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq/create', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/edit/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/edit/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');


});

Route::view('/404', '404');
