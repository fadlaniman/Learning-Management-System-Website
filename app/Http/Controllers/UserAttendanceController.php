<?php

namespace App\Http\Controllers;

use App\Models\UserAttendance;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UserAttendanceController extends Controller
{
    public function show(): View
    {
        return view('', ['attendances' => UserAttendance::paginate(15)]);
    }
}
