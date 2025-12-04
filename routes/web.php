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

Route::middleware(['auth','role:customer'])->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::get('/shop',[HomeController::class,'shop'])->name('shop');
    Route::get('/blog',[HomeController::class,'blog'])->name('blog');
    Route::get('/contact',[HomeController::class,'contact'])->name('contact');
});



Route::get('/product/{slug}', [HproductController::class, 'show'])->name('product.detail');

Route::resource('cart', CartController::class);

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

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
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
