<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;


class DashboardController extends Controller
{
    public function index() {
        return view('/admin/dashboard', ['students' => User::where('role', 'student')->get(), 'studies' => Classes::all(), 'teachers' => User::where('role', 'teacher')->get()]);
    }
}
