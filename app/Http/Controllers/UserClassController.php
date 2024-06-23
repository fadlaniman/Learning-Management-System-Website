<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserClass;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

use function PHPUnit\Framework\isEmpty;

class UserClassController extends Controller
{

    // API Section

    public function ApiShowEnrollUsers($id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  UserClass::with(['users', 'classes'])->where('class_id', $id)->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }
    public function ApiShowEnroll(Request $request)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  UserClass::with(['users', 'classes'])->where('user_id', $request->user()->uid)->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }


    public function apiShow()
    {
        return response()->json(['message' => 'success', 'data' =>  Userclass::with(['users', 'classes'])->get()], 200);
    }

    public function apiStore(Request $request)
    {
        try {
            $table = new UserClass();
            $table->user_id = $request->user_id;
            $table->class_id = $request->class_id;
            return response()->json(['message' => 'success'], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }



    public function apiDelete($id)
    {
        try {
            $table = UserClass::find($id);
            if ($table != null) {
                $table->delete();
                return response()->json(['message' => 'success'], 200);
            }
            return response()->json(['message' => 'class not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    // WEB Section
    public function index(): View
    {
        return view('/teacher/home', ['userclass' => Userclass::with(['users', 'classes'])->where('user_id', Auth::user()->uid)->get()]);
    }

    public function show(): View
    {
        return view('/admin/classes', ['classes' => UserClass::with(['users', 'classes'])->paginate(15), 'users' => User::all(), 'studies' => Classes::all()]);
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
