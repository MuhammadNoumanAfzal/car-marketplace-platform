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
    Route::get('/inventory', 'inventory')->name('inventory.all');
    Route::get('/inventory/sold', 'soldInventory')->name('inventory.sold');
    Route::get('/inventory/sold/{stock}', 'soldInventoryDetail')->name('inventory.sold.detail');
    Route::get('/inventory/{stock}', 'inventoryDetail')->name('inventory.detail');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/testimonials', 'testimonials')->name('testimonials');
    Route::get('/directions', 'directions')->name('directions');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-us', 'sendContact')->name('contact.send');
    Route::get('/appointment', 'appointment')->name('appointment');
    Route::post('/appointment', 'bookAppointment')->name('appointment.book');
    Route::get('/services/shipping', 'shipping')->name('services.shipping');
    Route::post('/services/shipping', 'sendShipping')->name('services.shipping.send');
    Route::get('/services/consignment', 'consignment')->name('services.consignment');
    Route::post('/services/consignment', 'sendConsignment')->name('services.consignment.send');
});


//ADMIN DASHBOARD

// Route::get('admin/dashboard', [DashboardController::class, 'index']);
  Route::get('admin/dashboard',[DashboardController::class, 'index']);
