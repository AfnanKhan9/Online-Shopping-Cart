<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    ProductController,
    HproductController,
    CartController,
    CheckoutController,
    OrderController,
    AuthController,
    FeedbackController,

};

use App\Http\Controllers\Admin\{
    AdminController,
    CategoryController,
    AdminProductController,
    AdminOrderController,
    EmployeeController,
    CustomerController
};

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Customer Area)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop',[HomeController::class,'shop'])->name('shop');
Route::get('/blog',[HomeController::class,'blog'])->name('blog');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');


Route::get('/product/{slug}', [HproductController::class, 'show'])->name('product.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

Route::resource('orders', OrderController::class);
Route::resource('feedback', FeedbackController::class);


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Only Admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('customers', CustomerController::class);
});


/*
|--------------------------------------------------------------------------
| EMPLOYEE ROUTES (Only Employee)
|--------------------------------------------------------------------------
*/

Route::prefix('employee')->middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('employee.dashboard');
});
