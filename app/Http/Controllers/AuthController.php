<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class AuthController extends Controller

{
    // API Section

    public function apilogin(Request $request)
    {
        try {
            $credentials =
                $request->validate([
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]);
            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken($request->email);
                return response()->json(['data' => Auth::user(), 'message' => 'succes', 'token' => $token->plainTextToken], 200);
            } else {
                return response()->json(['message' => 'User not found'], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function apiLogout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'succes'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e,
            ], 401);
        }
    }


    // WEB Section
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
