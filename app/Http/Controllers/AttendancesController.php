<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class AttendancesController extends Controller
{

    // API Section



    public function apiShow($id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  Attendances::where('class_id', $id)->orderBy('datetime', 'desc')->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function apiStore(Attendances $table, Request $request, $id)
    {
        try {
            $table->datetime = $request->datetime;
            $table->class_id = $id;
            $table->save();
            return response()->json(['message' => 'success'], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function store(Request $request, $id)
    {
        $table = new Attendances();
        $table->date = $request->date;
        $table->save();
        return redirect()->intended('/teacher/classes/' . $id . '/detail');
    }

    public function update(Request $request, $id)
    {
        $table = Attendances::find($id);
        $table->date = $request->date;
        $table->save();
        return redirect()->intended('');
    }


    public function delete($id)
    {
        $table = Attendances::find($id);
        $table->delete();
        return redirect()->intended('');
    }
}
