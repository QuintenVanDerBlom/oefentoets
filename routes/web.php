<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\CategoryController;
//use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin as Admin;
use App\Http\Controllers\Open as Open;
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

Route::get('/', [Open\ProductController::class, 'index']);
Route::get('/products/{product}', [Open\ProductController::class, 'show'])->name('open.products.show');
Route::get('/products', [Open\ProductController::class, 'index'])->name('open.products.index');

Route::group(['middleware' => ['role:|sales|admin']], function () {
    Route::get('admin/categories/{category}/delete', [Admin\CategoryController::class, 'delete'])
        ->name('categories.delete');
    Route::resource('/admin/categories', Admin\CategoryController::class);

    Route::get('admin/products/importform', [Admin\ProductController::class, 'importForm'])
        ->name('products.importform');
    Route::post('admin/products/importexcel', [Admin\ProductController::class, 'importExcel'])
        ->name('products.importexcel');
    Route::get('admin/products/{product}/delete', [Admin\ProductController::class, 'delete'])
        ->name('products.delete');
    Route::resource('/admin/products', Admin\ProductController::class);

});


Route::get('admin/orders/{order}/delete', [Admin\OrderController::class, 'delete'])
    ->name('orders.delete');
Route::resource('/admin/orders', Admin\OrderController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
