<?php

use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
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
    return redirect('/auth/login');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/admin/dashboard', 'index');
});


Route::controller(UsersController::class)->group(function () {
    Route::get('/admin/users', 'show');
    Route::post('/admin/users', 'store');
    Route::post('/admin/user/{id}/update', 'update');
    Route::post('/admin/user/{id}/delete', 'delete');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'show');
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
    Route::get('/teacher/classes/{id}/detail', 'show');
    Route::post('/teacher/classes/{id}/detail', 'store');
    Route::get('/teacher/classes/{study_id}/{attachment_id}/detail', 'showDetail');
    Route::post('/teacher/classes/{study_id}/{attachment_id}/update', 'update');
    Route::post('/teacher/classes/{study_id}/{attachment_id}/delete', 'delete');
});

Route::controller(AttendancesController::class)->group(function () {
    Route::get('/teacher/classes/{id}/detail', 'show');
    Route::post('/teacher/classes/{id}/detail', 'store');
    Route::get('/teacher/classes/{study_id}/{attachment_id}/detail', 'showDetail');
    Route::post('/teacher/classes/{study_id}/{attachment_id}/update', 'update');
    Route::post('/teacher/classes/{study_id}/{attachment_id}/delete', 'delete');
});



Route::controller(CommentsController::class)->group(function () {
    Route::post('/teacher/classes/{study_id}/{attachment_id}/store', 'store');
});


Route::controller(UserClassController::class)->group(function () {
    Route::get('/teacher/home', 'index');
    Route::get('/admin/classes', 'show');
    Route::post('/admin/classes', 'store');
    Route::post('/admin/class/{id}/update', 'update');
    Route::post('/admin/class/{id}/delete', 'delete');
});
