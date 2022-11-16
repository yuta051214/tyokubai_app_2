<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CropController;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'index'])
    ->name('root');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 商品（Crop）
Route::resource('crops', CropController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');

Route::resource('users.crops', CropController::class)
    ->only(['show', 'index']);

// 直売所（User）
Route::resource('users', UserController::class)
    ->only(['edit', 'update'])  // create, store, deleteは削除
    ->middleware('auth');

Route::resource('users', UserController::class)
    ->only(['show', 'index']);

require __DIR__.'/auth.php';
