<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        return view(
            '/admin/dashboard',
            ['students' => User::where('level', '3')->get(), 'studies' => Classes::all(), 'teachers' => User::where('level', '2')->get()]
        );
    }
}
