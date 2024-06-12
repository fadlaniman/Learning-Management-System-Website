<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class AuthController extends Controller

{
    // API Section
    public function apilogin(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ])->status(422);
            }
            $token =  $user->createToken($request->email)->plainTextToken;
            return response()->json(['data' => $user, 'message' => 'succes', 'token' => $token], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function apiLogout(Request $request)
    {
        return response()->json([
            'message' => 'Successfully logged out', 'user' => auth::user()
        ]);
    }

    public function show(): View
    {
        return view('/auth/login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth::user()->level == '1') {
                return redirect()->intended('/admin/dashboard');
            } else if (auth::user()->level == '2') {
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
