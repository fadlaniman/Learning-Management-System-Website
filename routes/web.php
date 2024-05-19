<?php

use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserClassController;
use App\Http\Controllers\UsersController;

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

Route::controller(DashboardController::class)->group(function () {
    Route::get('/admin/dashboard', 'index');
});


Route::controller(UsersController::class)->group(function () {
    Route::get('/admin/users', 'show');
    Route::post('/admin/user/{id}/update', 'update');
    Route::post('/admin/user/{id}/delete', 'delete');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'show')->name('/auth/login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login');
    Route::post('/auth/logout', 'logout');
});


Route::controller(ClassController::class)->group(function () {
    Route::get('/admin/studies', 'show');
    Route::post('/admin/studies', 'store');
    Route::post('/admin/studies/{id}/update', 'update');
    Route::post('/admin/studies/{id}/delete', 'delete');
});

Route::controller(AttachmentsController::class)->group(function () {
    Route::get('/teacher/classes/classwork/{id}', 'show');
});


Route::controller(UserClassController::class)->group(function () {
    Route::get('/admin/classes', 'show');
    Route::get('/teacher/home', 'get');
    Route::get('/teacher/classes/attendance/{id}', 'getByCode');
    Route::post('/admin/class', 'store');
    Route::post('/admin/class/{id}/update', 'update');
    Route::post('/admin/class/{id}/delete', 'delete');

});


