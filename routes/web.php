<?php

use App\Http\Controllers\admin\AugmentedRealityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\front\AugmentedRealityController as FrontAugmentedRealityController;
use App\Http\Controllers\front\auth\AugmentedRealityAccountController;
use App\Http\Controllers\HomeController;
use App\Mail\NotifikasiPembayaranSukses;
use App\Mail\NotifikasiPembayaranSuksesAR;
use App\Models\AugmentedRealityAccount;
use Illuminate\Support\Facades\Route;


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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/transaction/{package:id}', [HomeController::class, 'transaction'])->name('home.transaction');
Route::post('/transaction/filter/province', [HomeController::class, 'getProvince'])->name('home.transaction.filter.province');
Route::post('/transaction/checkout', [HomeController::class, 'checkout'])->name('home.transaction.checkout');
Route::post('/transaction/checkout/notify', [HomeController::class, 'notify'])->name('home.transaction.checkout.notify');
Route::get('/transaction/checkout/ureturn', [HomeController::class, 'ureturn'])->name('home.transaction.checkout.ureturn');
// Route::get('/email', function () {
//     return new NotifikasiPembayaranSuksesAR();
// });


// Route::group(['middleware' => ['auth']], function () {

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('augmented-reality', AugmentedRealityController::class)->except(["destroy", "show"]);
    Route::resource("packages", PackageController::class)->only(["index","create","edit"]);

});

//ar
Route::middleware('auth:augmentedRealities')->group(function () {
    Route::get('/ar-reader', [FrontAugmentedRealityController::class, 'index'])->name('ArReader');
});
//ar-auth
Route::get('/ar-reader/login', [AugmentedRealityAccountController::class, 'index'])->name('ArReader.login');
Route::post('/ar-reader/logout', [AugmentedRealityAccountController::class, 'logout'])->name('ArReader.logout');
Route::post('/ar-reader/login/proses', [AugmentedRealityAccountController::class, 'login'])->name('ArReader.login.proses');


// });