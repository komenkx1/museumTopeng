<?php

use App\Http\Controllers\admin\AugmentedRealityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\front\AugmentedRealityController as FrontAugmentedRealityController;
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

Route::get('/', function () {
    return view('welcome');
});


// Route::group(['middleware' => ['auth']], function () {

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('augmented-reality', AugmentedRealityController::class)->except(["destroy","show"]);
});

//ar
Route::get('/ar-reader', [FrontAugmentedRealityController::class, 'index'])->name('ArReader');


// });