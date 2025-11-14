<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    ProductController,
    CartController,
    CheckoutController,
    OrderController,
    AuthController,
    FeedbackController
};
use App\Http\Controllers\Admin\{
    AdminController,
    CategoryController,
    AdminProductController,
    AdminOrderController,
    EmployeeController,
    CustomerController
};

//  FRONTEND ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class);
Route::resource('cart', CartController::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::resource('orders', OrderController::class);
Route::resource('feedback', FeedbackController::class);

//  AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//  ADMIN ROUTES (prefix + middleware later add karenge)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('customers', CustomerController::class);
});




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

