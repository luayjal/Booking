<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ServicesController;

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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth','type.user:admin,super-admin'])->name('dashboard');

Route::prefix('dashboard')->middleware(['auth','type.user:admin,super-admin'])->name('admin.')->group(function(){
    Route::resource('customers',CustomerController::class);
    Route::resource('shops',ShopController::class);
    Route::resource('categories',CategoriesController::class);
    Route::resource('services',ServicesController::class);

});

require __DIR__.'/auth.php';
