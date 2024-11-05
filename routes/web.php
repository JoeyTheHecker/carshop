<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);


Route::resource('vehicles', VehicleController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

Route::get('/product', [App\Http\Controllers\Admin\ProductController::class, 'indexSummary']);
Route::get('/product/summary/active', [App\Http\Controllers\Admin\ProductController::class, 'productAjaxSummary']);
Route::get('/product/summary/sold', [App\Http\Controllers\Admin\ProductController::class, 'productAjaxSummary']);
Route::get('/product/summary/inactive', [App\Http\Controllers\Admin\ProductController::class, 'productAjaxSummary']);
Route::get('/product/summary/deleted', [App\Http\Controllers\Admin\ProductController::class, 'productAjaxSummary']);
Route::get('/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create']);
Route::post('/product/store', [App\Http\Controllers\Admin\ProductController::class, 'store']);

Route::get('/loi', [App\Http\Controllers\Admin\IntentController::class, 'loiSummary']);
Route::get('/loi/summary', [App\Http\Controllers\Admin\IntentController::class, 'loiAjaxSummary']);

Route::get('/product/gallery/{id}', [App\Http\Controllers\ProductGalleryController::class, 'galleryPost']);
Route::post('/product/gallery/{id}', [App\Http\Controllers\ProductGalleryController::class, 'galleryPostNew']);

Route::get('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/product/details/{id}', [App\Http\Controllers\ProductController::class, 'details'])->name('details');

Route::get('/insert-bidding-config', function () {
    DB::table('bidding_config')->insert([
        'start_day' => 'Mon',
        'start_hour' => '08',
        'bidding_hours' => 129,
    ]);

    return "Data inserted successfully!";
});
