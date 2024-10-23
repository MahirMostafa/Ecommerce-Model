<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashBoardController;
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


// Public Routes
Route::get('/', [ProductController::class, 'home']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-user', [LoginController::class, 'loginuser'])->name('login-user');
Route::get('/signup', [SignUpController::class, 'signup']);
Route::post('/store', [SignUpController::class, 'ourfilestore'])->name('store');
Route::get('/logout', [LogOutController::class, 'logoutUser'])->name('logout');

// Cart Routes (accessible without login except for placing orders)
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');

// Place Order (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order}', [PaymentController::class, 'store'])->name('payment.store');
});

// Admin Routes (requires both authentication and admin role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'dashboard']);
    Route::get('/edit/{id}', [DashBoardController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [DashBoardController::class, 'updateData'])->name('update');
    Route::delete('/delete/{id}', [DashBoardController::class, 'deleteData'])->name('delete');
    Route::get('/products', [ProductController::class, 'products']);
    Route::post('/product-store', [ProductController::class, 'productstore'])->name('product-store');
    Route::get('/viewproducts', [ProductController::class, 'viewproducts']);
    Route::get('/category', [CategoryController::class, 'category']);
    Route::get('/addcategory', [CategoryController::class, 'viewcategory'])->name('addcategory');
    Route::post('/addcategory', [CategoryController::class, 'addcategory'])->name('addcategory');
    Route::get('/editcategory/{id}', [CategoryController::class, 'edit'])->name('editcategory');
    Route::post('/updatecategory/{id}', [CategoryController::class, 'update'])->name('updatecategory');
    Route::delete('/deletecategory/{id}', [CategoryController::class, 'deleteData'])->name('deletecategory');
    Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
    Route::get('/addbrand', [BrandController::class, 'viewbrand'])->name('addbrand');
    Route::post('/addbrand', [BrandController::class, 'addbrand'])->name('addbrand');
    Route::delete('/deletebrand/{id}', [BrandController::class, 'deleteData'])->name('deletebrand');
    Route::get('/editbrand/{id}', [BrandController::class, 'edit'])->name('editbrand');
    Route::post('/updatebrand/{id}', [BrandController::class, 'update'])->name('updatebrand');
});

// Customer Routes (requires both authentication and customer role)
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index'); // List all addresses
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create'); // Show create address form
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store'); // Store new address
    Route::get('/addresses/{address}', [AddressController::class, 'show'])->name('addresses.show'); // Show specific address
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit'); // Show edit address form
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update'); // Update address
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy'); // Delete address
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/payment/stripe/checkout/{order_id}', [PaymentController::class, 'stripeCheckout'])->name('stripe.checkout');
    Route::get('/payment/success/{order_id}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel/{order_id}', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
});
