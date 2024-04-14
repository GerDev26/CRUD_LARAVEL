<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::controller(ProductController::class)->group(function(){
    Route::get('product', 'index');
    Route::get('product/id={id}', 'searchById');
    Route::get('product/s', 'search');
    Route::post('product', 'store');
    Route::put('product/{id}', 'update');
    Route::delete('product/{id}', 'destroy');
});
