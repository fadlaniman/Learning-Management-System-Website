<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Http\Request;


class AttendancesController extends Controller
{

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
