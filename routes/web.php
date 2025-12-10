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
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Product details
Route::get('/product/{slug}', [HproductController::class, 'show'])->name('product.detail');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');



/*
|--------------------------------------------------------------------------
| CUSTOMER PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->group(function () {

    // Checkout page
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

    // Store Order (IMPORTANT)
    Route::post('/user-orders/store', [OrderController::class, 'store'])->name('userorders.store');

    // Thank you page
        Route::get('/thankyou', [HomeController::class, 'thankyou'])->name('thankyou');

});



// Feedback
Route::resource('feedback', FeedbackController::class);


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('customers', CustomerController::class);
});


/*
|--------------------------------------------------------------------------
| EMPLOYEE ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('employee')->middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('employee.dashboard');
});
