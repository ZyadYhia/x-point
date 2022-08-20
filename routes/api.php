<?php

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('menu', function(){
    $menu = Contact::first()->menu;
    return redirect(asset("uploads/$menu"));
    // return Response::download(asset("uploads/$menu"));
    // return Response::download(public_path('uploads/') . $menu);
    // return response()->file(public_path('uploads/') . $menu, ['Content-type' => 'image/jpg']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
