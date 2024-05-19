<?php

namespace App\Http\Controllers;


use App\Models\Classes;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function show(): View
    {
        return view('/admin/studies', ['classes' => Classes::paginate(15)]);
    }

    public function store(Request $request)
    {
        $table = new Classes;
        $table->id = $request->id;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->tingkatan = $request->tingkatan;
        $table->durasi = $request->durasi;
        $table->total = $request->total;
        $table->save();
        return redirect()->intended('/admin/studies');
    }
    
    
    public function update(Request $request, $id)
    {
        
        $table = Classes::find($id);
        $table->id = $request->id;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->tingkatan = $request->tingkatan;
        $table->durasi = $request->durasi;
        $table->total = $request->total;
        $table->save();
        return redirect()->intended('/admin/studies');
    }


    public function delete($id)
    {
        $table = Classes::find($id);
        $table->delete();
        return redirect()->intended('/admin/studies');
    }
}
