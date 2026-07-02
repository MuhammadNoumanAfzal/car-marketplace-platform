<?php

use App\Http\Controllers\User\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SizeController;

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

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/testimonials', 'testimonials')->name('testimonials');
    Route::get('/directions', 'directions')->name('directions');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-us', 'sendContact')->name('contact.send');
    Route::get('/appointment', 'appointment')->name('appointment');
    Route::post('/appointment', 'bookAppointment')->name('appointment.book');
});


//ADMIN DASHBOARD

// Route::get('admin/dashboard', [DashboardController::class, 'index']);
  Route::get('admin/dashboard',[DashboardController::class, 'index']);
