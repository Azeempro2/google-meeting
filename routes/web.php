<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleMeetingController;

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('google-meetings', GoogleMeetingController::class);


//    Route::post("/google-meeting/", [GoogleMeetingController::class, 'store'])->name('google-meeting.store');
//    Route::delete("/google-meeting/{id}", [GoogleMeetingController::class, 'delete'])->name('google-meeting.delete');
//    Route::get("/google-meeting", [GoogleMeetingController::class, 'list'])->name('google-meeting.list');
});

