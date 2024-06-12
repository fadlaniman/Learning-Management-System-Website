<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserClass;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;



class UserClassController extends Controller
{
    public function index(): View
    {
        return view('/teacher/home', ['userclass' => Userclass::with(['users', 'classes'])->where('user_id', Auth::user()->uid)->get()]);
    }

    public function show(): View
    {
        return view('/admin/classes', ['classes' => UserClass::with('users')->paginate(15), 'users' => User::all(), 'studies' => Classes::all()]);
    }


    public function store(Request $request)
    {
        try {
            $table = User::find($request->uid);
            $table->classes()->attach($request->class_id);
            return redirect()->intended('/admin/classes');
        } catch (Exception $e) {
            return redirect()->intended('/admin/classes');
        }
    }

    public function delete($id)
    {
        $table = UserClass::find($id);
        $table->delete();
        return redirect()->intended('/admin/classes');
    }
}
