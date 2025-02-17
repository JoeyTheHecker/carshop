<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/mail', function () {
    return view('mails.outbid');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/contact-us', function () {
    return view('contact_us');
});
Route::resource('vehicles', VehicleController::class);


// Auth::routes();
Auth::routes(['verify' => true]);

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
        'start_day' => 'Wed',
        'start_hour' => '11',
        'bidding_hours' => 129,
    ]);

    return "Data inserted successfully!";
});

Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user-show');

Route::post('/product/details/{id}', [App\Http\Controllers\BidsController::class, 'placeBid'])->name('place-bid');

Route::get('/bidding', [App\Http\Controllers\Admin\BiddingController::class, 'indexSummary']);
Route::get('/bidding/summary', [App\Http\Controllers\Admin\BiddingController::class, 'biddingAjaxSummary']);

Route::get('/info/{id}/cycle/{cycle_id}', [App\Http\Controllers\Admin\BiddingController::class, 'biddingInfo'])->name('bidding.info');
Route::get('/bidding/info/{id}/cycle/{cycle_id}/bidder/{bid_id}', [App\Http\Controllers\Admin\BiddingController::class, 'bidderInfo'])->name('bidder.info');

Route::post('/bidding/info/{product_id}/cycle/{cycle_id}/bidder/{bid_id}/sold', [App\Http\Controllers\Admin\BiddingController::class, 'productSold'])->name('product.sold');
Route::post('/bidding/info/{product_id}/cycle/{cycle_id}/bidder/{bid_id}/backout', [App\Http\Controllers\Admin\BiddingController::class, 'backOutBid'])->name('bid.backout');
Route::post('/bidding/info/{product_id}/cycle/{cycle_id}/bidder/{bid_id}/ban_user', [App\Http\Controllers\Admin\BiddingController::class, 'banUser'])->name('user.ban');

//bidder-account
// Route::get('/bidder-accounts', 'Web\BiddersController@indexSummary');
// Route::get('/bidder/view/{id}', 'Web\BiddersController@viewDetails');
// Route::get('/bidder/upload/{id}', 'Web\BiddersController@uploadFile');
// Route::get('/bidder/profile/edit/{id}', 'Web\BiddersController@editBidder');

Route::get('bidder-accounts', [App\Http\Controllers\Admin\BidderController::class, 'indexSummary']);
Route::get('/bidder/view/{id}', [App\Http\Controllers\Admin\BidderController::class, 'viewDetails']);

Route::get('/bidder/summary/pending', [App\Http\Controllers\Admin\BidderController::class, 'ajaxSummaryPending']);
Route::get('/bidder/summary/approved', [App\Http\Controllers\Admin\BidderController::class, 'ajaxSummaryApproved']);

Route::post('/bidder/put', [App\Http\Controllers\Admin\BidderController::class, 'bidderPut']);

Route::get('/inquiry', [App\Http\Controllers\Admin\InquiryController::class, 'indexSummary']);
Route::get('/inquiry/summary', [App\Http\Controllers\Admin\InquiryController::class, 'inquiryAjaxSummary']);

Route::get('/inquiry/view/{id}', [App\Http\Controllers\Admin\InquiryController::class, 'viewDetails']);




