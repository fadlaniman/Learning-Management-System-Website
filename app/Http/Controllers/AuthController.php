<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;





class AuthController extends Controller

{

    public function show(): View
    {
        return view('/auth/login');
    }


    public function register(Request $request)
    {
        $table = new User;
        $table->uid = $request->uid;
        $table->firstName = $request->firstName;
        $table->lastName = $request->lastName;
        $table->email = $request->email;
        $table->password = Hash::make($request->password);
        $table->phone = $request->phone;
        $table->role = $request->role;
        $table->save();
        return redirect()->intended('/admin/users');
    }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth::user()->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            else if(auth::user()->role == 'teacher'){
                return redirect()->intended('/teacher/home');
            }
        }
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login');
    }
}

