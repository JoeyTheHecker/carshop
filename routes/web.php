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

Route::get('/product/change/status/{id}/{status}', [App\Http\Controllers\Admin\ProductController::class, 'productChangeStatus']);
Route::get('/product/view/{id}', [App\Http\Controllers\Admin\ProductController::class, 'viewDetails']);
Route::get('/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'createPut']);
Route::post('/product/put', [App\Http\Controllers\Admin\ProductController::class, 'newPut']);

Route::get('/loi', [App\Http\Controllers\Admin\IntentController::class, 'loiSummary']);
Route::get('/loi/summary', [App\Http\Controllers\Admin\IntentController::class, 'loiAjaxSummary']);

Route::get('/product/gallery/{id}', [App\Http\Controllers\ProductGalleryController::class, 'galleryPost']);
Route::post('/product/gallery/{id}', [App\Http\Controllers\ProductGalleryController::class, 'galleryPostNew']);

Route::get('/product/search', [App\Http\Controllers\ProductController::class, 'search']);
Route::get('/product/details/{id}', [App\Http\Controllers\ProductController::class, 'details'])->name('details');

Route::get('/insert-bidding-config', function () {
    DB::table('bidding_config')->insert([
        'start_day' => 'Sun',
        'start_hour' => '10',
        'bidding_hours' => 129,
    ]);

    return "Data inserted successfully!";
});

Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');

Route::post('/product/details/{id}', [App\Http\Controllers\BidsController::class, 'placeBid'])->name('place-bid');

Route::get('/bidding', [App\Http\Controllers\Admin\BiddingController::class, 'indexSummary']);
Route::get('/bidding/summary', [App\Http\Controllers\Admin\BiddingController::class, 'biddingAjaxSummary']);

Route::get('/info/{id}/cycle/{cycle_id}', [App\Http\Controllers\Admin\BiddingController::class, 'biddingInfo'])->name('bidding.info');
Route::get('/bidding/info/{id}/cycle/{cycle_id}/bidder/{bid_id}', [App\Http\Controllers\Admin\BiddingController::class, 'bidderInfo'])->name('bidder.info');

Route::post('/bidding/info/{product_id}/cycle/{cycle_id}/bidder/{bid_id}/sold', [App\Http\Controllers\Admin\BiddingController::class, 'productSold'])->name('product.sold');
Route::post('/bidding/info/{product_id}/cycle/{cycle_id}/bidder/{bid_id}/backout', [App\Http\Controllers\Admin\BiddingController::class, 'backOutBid'])->name('bid.backout');
Route::post('/bidding/info/{product_id}/cycle/{cycle_id}/bidder/{bid_id}/ban_user', [App\Http\Controllers\Admin\BiddingController::class, 'banUser'])->name('user.ban');
