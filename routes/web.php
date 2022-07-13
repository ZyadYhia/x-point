<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Client\HomeController as ClientHomeController;
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
Route::get('contacts', [HomeController::class, 'contct']);
Route::prefix('dashboard')->middleware(['auth'])->group(function(){
    Route::get('', [ClientHomeController::class, 'index']);
});
