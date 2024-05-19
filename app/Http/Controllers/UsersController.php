<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function show(): View
    {
        return view('/admin/users', ['users' => User::paginate(15)]);
    }

    public function update(Request $request, $id)
    {
        $table = User::find($id);
        $table->firstName = $request->firstName;
        $table->lastName = $request->lastName;
        $table->email = $request->email;
        $table->phone = $request->phone;
        $table->role = $request->role;
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
