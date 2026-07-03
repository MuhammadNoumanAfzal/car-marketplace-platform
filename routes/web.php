<?php

use App\Http\Controllers\User\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AppointmentRequestController;
use App\Http\Controllers\Admin\ConsignmentRequestController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ShippingRequestController;
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

Route::prefix('admin/inventory')->controller(InventoryController::class)->group(function () {
    Route::get('/index', 'index')->name('admin.inventory.index');
    Route::get('/create', 'create')->name('admin.inventory.create');
    Route::post('/store', 'store')->name('admin.inventory.store');
    Route::get('/show/{inventory}', 'show')->name('admin.inventory.show');
    Route::get('/edit/{inventory}', 'edit')->name('admin.inventory.edit');
    Route::put('/update/{inventory}', 'update')->name('admin.inventory.update');
    Route::delete('/delete/{inventory}', 'destroy')->name('admin.inventory.destroy');
});

Route::prefix('admin/contact-inquiries')->controller(ContactInquiryController::class)->group(function () {
    Route::get('/index', 'index')->name('admin.contact-inquiries.index');
    Route::get('/show/{contactInquiry}', 'show')->name('admin.contact-inquiries.show');
    Route::delete('/delete/{contactInquiry}', 'destroy')->name('admin.contact-inquiries.destroy');
});

Route::prefix('admin/appointment-requests')->controller(AppointmentRequestController::class)->group(function () {
    Route::get('/index', 'index')->name('admin.appointment-requests.index');
    Route::get('/show/{appointmentRequest}', 'show')->name('admin.appointment-requests.show');
    Route::delete('/delete/{appointmentRequest}', 'destroy')->name('admin.appointment-requests.destroy');
});

Route::prefix('admin/shipping-requests')->controller(ShippingRequestController::class)->group(function () {
    Route::get('/index', 'index')->name('admin.shipping-requests.index');
    Route::get('/show/{shippingRequest}', 'show')->name('admin.shipping-requests.show');
    Route::delete('/delete/{shippingRequest}', 'destroy')->name('admin.shipping-requests.destroy');
});

Route::prefix('admin/consignment-requests')->controller(ConsignmentRequestController::class)->group(function () {
    Route::get('/index', 'index')->name('admin.consignment-requests.index');
    Route::get('/show/{consignmentRequest}', 'show')->name('admin.consignment-requests.show');
    Route::delete('/delete/{consignmentRequest}', 'destroy')->name('admin.consignment-requests.destroy');
});


//ADMIN DASHBOARD

// Route::get('admin/dashboard', [DashboardController::class, 'index']);
  Route::get('admin/dashboard',[DashboardController::class, 'index']);
