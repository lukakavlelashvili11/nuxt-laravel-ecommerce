<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',LoginController::class);
Route::post('/signup',SignupController::class);
Route::post('/logout',LogoutController::class);

Route::get('/category',[CategoryController::class,'get']);
Route::post('/category/save',[CategoryController::class,'store']);
Route::post('/category/edit',[CategoryController::class,'edit']);
Route::delete('/category/delete',[CategoryController::class,'delete']);

Route::get('/brand',[BrandController::class,'get']);
Route::post('/brand/save',[BrandController::class,'store']);