<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Web\Client\InvoiceController;
use App\Http\Controllers\Web\Client\RoomController;
use App\Http\Controllers\Web\Client\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('contact', [HomeController::class, 'contact']);
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('', [ClientHomeController::class, 'index'])->name('dashboard');
    Route::prefix('/users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('dashboard_users');
        Route::get('promote/{id}', [UserController::class, 'promote']);
        Route::get('demote/{id}', [UserController::class, 'demote']);
        Route::get('delete/{user}', [UserController::class, 'delete']);
        Route::get('remove-verification/{id}', [UserController::class, 'removeVerify']);
        Route::get('apply-verification/{id}', [UserController::class, 'applyVerify']);
        Route::post('add-user', [UserController::class, 'store'])->name('dashboard_add_users');
    });
    Route::prefix('invoices')->group(function(){
        Route::get('show/{user}', [InvoiceController::class, 'index']);
    });
    Route::post('add-user', [UserController::class, 'store']);
    Route::get('/room/{room}', [RoomController::class, 'index']);
    Route::prefix('/rooms')->group(function () {
        Route::post('open', [RoomController::class, 'open']);
        Route::post('close', [RoomController::class, 'close']);
    });
});
