<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\InquiryController as FrontendInquiryController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\FacilityController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\LaunchingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\UserController;

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

/**
 * FRONTEND ROUTES (Public routes)
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

// Properties routes
Route::get('/hunian', [PropertyController::class, 'index'])->defaults('slug', 'hunian')->name('properties.hunian');
Route::get('/business', [PropertyController::class, 'index'])->defaults('slug', 'business')->name('properties.business');
Route::get('/property/{slug}', [PropertyController::class, 'show'])->name('property.show');

// About route
Route::get('/tentang', [AboutController::class, 'index'])->name('about');

// Facility route
Route::get('/fasilitas/{slug}', [FacilityController::class, 'show'])->name('facility.show');

// Inquiry routes
Route::post('/inquiry', [FrontendInquiryController::class, 'store'])->name('inquiry.store');

// Information pages
Route::get('/kawasan', [HomeController::class, 'kawasan'])->name('kawasan');
Route::get('/launching', [HomeController::class, 'launching'])->name('launching');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/brochure', [HomeController::class, 'brochure'])->name('brochure');

/**
 * ADMIN ROUTES
 */
// Admin Authentication Routes
Route::get('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');

// Admin Protected Routes
Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Properties CRUD
    Route::resource('properties', \App\Http\Controllers\Admin\PropertyController::class);

    // Sliders CRUD
    Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class);

    // Launching CRUD
    Route::resource('launchings', \App\Http\Controllers\Admin\LaunchingController::class);

    // Categories CRUD
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    // Facilities CRUD
    Route::resource('facilities', AdminFacilityController::class);
    Route::get('facilities/{facility}/items', [AdminFacilityController::class, 'editItems'])->name('facilities.items');
    Route::post('facilities/{facility}/items', [AdminFacilityController::class, 'storeItem'])->name('facilities.items.store');
    Route::patch('facilities/{facility}/items/{item}', [AdminFacilityController::class, 'updateItem'])->name('facilities.items.update');
    Route::delete('facilities/{facility}/items/{item}', [AdminFacilityController::class, 'destroyItem'])->name('facilities.items.destroy');

    // Inquiries (view only)
    Route::get('inquiries', [\App\Http\Controllers\Admin\InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('inquiries/{inquiry}', [\App\Http\Controllers\Admin\InquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('inquiries/{inquiry}/mark-contacted', [\App\Http\Controllers\Admin\InquiryController::class, 'markAsContacted'])->name('inquiries.mark-contacted');
    Route::delete('inquiries/{inquiry}', [\App\Http\Controllers\Admin\InquiryController::class, 'destroy'])->name('inquiries.destroy');

    // Users Management (Admin Users)
    Route::resource('users', UserController::class);

    // Change Password
    Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('users.change-password');
    Route::post('/change-password', [UserController::class, 'updatePassword'])->name('users.update-password');

    // About Kami & Visi Misi (Content Management)
    Route::get('about', [\App\Http\Controllers\Admin\AboutController::class, 'show'])->name('about.show');
    Route::get('about/edit', [\App\Http\Controllers\Admin\AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');
});


