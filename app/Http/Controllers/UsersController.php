<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    // API Section
    public function apiShow(User $user)
    {
        return response()->json($user->all());
    }


    public function apiStore(User $table, Request $request)
    {
        try {
            $table->uid = $request->uid;
            $table->firstName = $request->firstName;
            $table->lastName = $request->lastName;
            $table->email = $request->email;
            $table->password = Hash::make($request->password);
            $table->phone = $request->phone;
            $table->level = $request->level;
            $table->save();
            return response()->json(['message' => 'success'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }
    public function apiUpdate(User $user, Request $request, $id)
    {
        try {
            $table = $user->find($id);
            $table->uid = $request->uid;
            $table->firstName = $request->firstName;
            $table->lastName = $request->lastName;
            $table->email = $request->email;
            $table->phone = $request->phone;
            $table->level = $request->level;
            $table->save();
            return response()->json(['message' => 'success'], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function apiDestroy(User $user, $id)
    {
        try {

            $user->find($id)->delete();
            return response()->json(['message' => 'success']);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function show(): View
    {
        return view('/admin/users', ['users' => User::paginate(15)]);
    }


    public function store(Request $request)
    {
        $table = new User;
        $table->uid = $request->uid;
        $table->firstName = $request->firstName;
        $table->lastName = $request->lastName;
        $table->email = $request->email;
        $table->password = Hash::make($request->password);
        $table->phone = $request->phone;
        $table->level = $request->level;
        $table->save();
        return redirect()->intended('/admin/users');
    }

    public function update(Request $request, $id)
    {
        $table = User::find($id);
        $table->firstName = $request->firstName;
        $table->lastName = $request->lastName;
        $table->email = $request->email;
        $table->password = Hash::make($request->password);
        $table->phone = $request->phone;
        $table->level = $request->level;
        $table->save();
        return redirect()->intended('/admin/users');
    }


    public function delete($id)
    {
        $table = User::find($id);
        $table->delete();
        return redirect()->intended('/admin/users');
    }
}
