<?php

use App\Http\Controllers\Admin\CatalogsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WebController::class, 'index'])->name('index');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/service', [WebController::class, 'service'])->name('service');
Route::get('/booking', [WebController::class, 'booking'])->name('booking');
Route::post('/booking/create', [BookingController::class, 'store'])->name('booking.store');
Route::get('/menu', [ProductController::class, 'index'])->name('product');

Route::prefix('')->group(function (){
    Route::get('/register', [WebController::class, 'register'])->name('registerView');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', [WebController::class, 'login'])->name('loginView');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});


Route::middleware('auth')->prefix('user')->group(function (){
    // Корзина
    Route::get('/basket', [BasketController::class, 'show'])->name('basket');
    Route::get('/basket/{product}/store', [BasketController::class, 'store'])->name('basket.store');
    Route::post('/basket/{basket}/update', [BasketController::class, 'update'])->name('basket.update');
    Route::get('/basket/{basket}/delete', [BasketController::class, 'delete'])->name('basket.delete');
    // Заказы
    Route::get('orders', [OrderController::class, 'index'])->name('order');
    Route::get('order/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('order/{id}', [OrderItemController::class, 'store'])->name('order.item.store');
});

Route::middleware('IsAdminOrManager')->prefix('admin')->group(function (){
    Route::get('/', function (){
        return view('new_admin.layout.admin');
    })->name('admin.index');
    // Пользователи
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('users/{user}/update', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    // Продукты
    Route::get('products/', [ProductsController::class, 'index'])->name('admin.products.index');
    Route::get('products/create', [ProductsController::class, 'create'])->name('admin.products.create');
    Route::post('products/store', [ProductsController::class, 'store'])->name('admin.products.store');
    Route::get('products/{products}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
    Route::get('products/{products}/delete', [ProductsController::class, 'delete'])->name('admin.products.delete');
    Route::post('products/{products}/update', [ProductsController::class, 'update'])->name('admin.products.update');
    // Заказы пользователей
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{id}',[\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('orders/update/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.orders.update');
    // Бронь столов
    Route::get('booking', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.booking.index');
});
