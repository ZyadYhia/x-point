<?php

use App\Models\User;
use App\Models\Mobile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Client\RoomController;
use App\Http\Controllers\Web\Client\UserController;
use App\Http\Controllers\Web\Admin\ReportsController;
use App\Http\Controllers\Web\Client\ClientController;
use App\Http\Controllers\Web\Client\InvoiceController;
use App\Http\Controllers\Web\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Web\Client\HomeController as ClientHomeController;

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
Route::prefix('dashboard')->middleware(['auth', 'canEnterDashboard', 'verified'])->group(function () {
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
    Route::prefix('/clients')->group(function () {
        Route::get('', [ClientController::class, 'index'])->name('dashboard_clients');
        Route::get('promote/{id}', [ClientController::class, 'promote']);
        Route::get('demote/{id}', [ClientController::class, 'demote']);
        Route::get('delete/{user}', [ClientController::class, 'delete']);
        Route::get('remove-verification/{id}', [ClientController::class, 'removeVerify']);
        Route::get('apply-verification/{id}', [ClientController::class, 'applyVerify']);
        Route::post('add-client', [ClientController::class, 'store'])->name('dashboard_add_clients');
    });
    Route::prefix('/rooms')->group(function () {
        Route::post('open', [RoomController::class, 'open']);
        Route::post('close', [RoomController::class, 'close']);
        Route::prefix('control')->group(function(){
            Route::get('', [AdminRoomController::class, 'index'])->name('control_room');
            Route::post('store', [AdminRoomController::class, 'create'])->name('control_room_store');
            Route::post('update', [AdminRoomController::class, 'update'])->name('control_room_update');
            Route::get('room/{id}', [AdminRoomController::class, 'show'])->name('control_room_room');
            Route::get('delete/{room}', [AdminRoomController::class, 'delete'])->name('control_room_delete');
        });
    });
    Route::prefix('invoices')->group(function(){
        Route::get('', [InvoiceController::class, 'index'])->name('invoices');
        Route::get('pay/{id}', [InvoiceController::class, 'pay']);
        Route::get('unpaid/{id}', [InvoiceController::class, 'unpaid']);
        Route::get('user/{id}', [InvoiceController::class, 'showUser']);
        Route::post('add-points', [InvoiceController::class, 'add_points']);
    });
    Route::prefix('reports')->group(function(){
        Route::get('', [ReportsController::class, 'index'])->name('reports');
    });
    Route::post('add-user', [UserController::class, 'store']);
    Route::get('/room/{room}', [RoomController::class, 'index']);
});

// Route::get('update-mobiles', function () {
//     $users = User::get();
//     foreach ($users as $user) {
//         $mobiles = Mobile::get();
//         foreach ($mobiles as $mobile) {
//             if ($mobile->user_id == $user->id) {
//                 $user->mobile = $mobile->name;
//                 $user->save();
//             }
//         }
//     }
//     return 'done';
// })->middleware('isSuperadmin');
