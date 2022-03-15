<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

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

// Admin Route
Route::prefix('admin')->group(function (){
    Route::get('/login',[AdminController::class, 'Index'])->name('login_from');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create',[AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
    

});


// End Admin Route

// Seller Route

Route::prefix('seller')->group(function (){
    Route::get('/login',[SellerController::class, 'SellerIndex'])->name('seller_login_from');
    Route::get('/dashboard',[SellerController::class, 'SellerDashboard'])->name('seller.dashboard')->middleware('seller');

    Route::post('/login/owner',[SellerController::class, 'SellerLogin'])->name('seller.login');
    
    Route::get('/logout',[SellerController::class, 'SellerLogout'])->name('seller.logout')->middleware('seller');
    Route::get('/register',[SellerController::class, 'SellerRegister'])->name('seller.register');
    Route::post('/register/create',[SellerController::class, 'SellerRegisterCreate'])->name('seller.register.create');

});

// End Seller Route

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
