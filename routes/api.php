<?php

use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\SubmissionsController;
use App\Http\Controllers\UserAttendanceController;
use App\Http\Controllers\UserClassController;
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
    Route::get('/users/{id}', 'apiShowById');
    Route::post('/forgotPassword', 'apiForgotPassword');
    Route::post('/users/{id}/update', 'apiUpdate');
    Route::post('/users/{id}/delete', 'apiDestroy');
});

Route::controller(ClassController::class)->group(function () {
    Route::get('/studies', 'apiShow');
    Route::post('/studies', 'apiStore');
    Route::get('/studies/{id}', 'apiShowById');
    Route::post('/studies/{id}/update', 'apiUpdate');
    Route::post('/studies/{id}/delete', 'apiDestroy');
});

Route::controller(UserClassController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes', 'apiShow');
    Route::post('/classes', 'apiStore');
    Route::get('/classes/enroll', 'ApiShowEnroll');
    Route::get('/classes/{id}/enroll/users', 'ApiShowEnrollUsers');
    Route::post('/classes/{id}/delete', 'apiDelete');
});

Route::controller(AttachmentsController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes/{class_id}/attachments/{attachment_id}', 'apiShowDetail');
    Route::get('/classes/{id}/attachments', 'apiShow');
    Route::post('/classes/{id}/attachments', 'apiStore');
    Route::get('/classes/{class_id}/attachments/{attachment_id}/file', 'apiShowFile');
    Route::get('/download/{filename}', 'apiDownloadFile');
});

Route::controller(AttendancesController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes/{id}/attendances', 'apiShow');
    Route::post('/classes/{id}/attendances', 'apiStore');
});

Route::controller(SubmissionsController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes/{class_id}/attachments/{attachment_id}/submissions', 'apiShow');
    Route::post('/classes/{class_id}/attachments/{attachment_id}/submissions', 'apiStore');
});

Route::controller(UserAttendanceController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes/{class_id}/userAttendances/{attendance_id}', 'apiShow');
    Route::post('/classes/{class_id}/userAttendances/{attendance_id}', 'apiStore');
});


Route::controller(CommentsController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes/{class_id}/attachments/{attachment_id}/comments', 'apiShow');
    Route::post('/classes/{class_id}/attachments/{attachment_id}/comments', 'apiStore');
});

Route::controller(ScoresController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/classes/{class_id}/attachments/{attachment_id}/submissions/{submission_id}', 'apiShow');
    Route::post('/classes/{class_id}/attachments/{attachment_id}/submissions/{submission_id}', 'apiStore');
});
