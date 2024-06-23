<?php

namespace App\Http\Controllers;

use App\Models\UserAttendance;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class UserAttendanceController extends Controller
{
    // API Section
    public function apiShow($class_id, $attendance_id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  UserAttendance::with(['users', 'attendances'])->where('class_id', $class_id)->where('attendance_id', $attendance_id)->orderBy('created_at', 'desc')->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function apiStore(UserAttendance $table, Request $request, $class_id, $attendance_id)
    {
        try {
            $table->attendance_id = $attendance_id;
            $table->user_id = $request->user()->uid;
            $table->class_id = $class_id;
            $table->save();
            return response()->json(['message' => 'success'], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }
}
