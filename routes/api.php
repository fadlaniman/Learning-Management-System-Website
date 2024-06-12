<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UsersController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'apiLogin');
    Route::post('/logout', 'apiLogout')->middleware('auth:sanctum');
});


Route::controller(UsersController::class)->group(function () {
    Route::get('/users', 'apiShow');
    Route::post('/users', 'apiStore');
    Route::post('/users/{id}/update', 'apiUpdate');
    Route::post('/users/{id}/delete', 'apiDestroy');
});

Route::controller(ClassController::class)->group(function () {
    Route::get('/classes', 'apiShow');
    Route::post('/classes', 'apiStore');
    Route::post('/classes/{id}/update', 'apiUpdate');
    Route::post('/classes/{id}/delete', 'apiDestroy');
});
