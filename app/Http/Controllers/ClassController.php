<?php

namespace App\Http\Controllers;


use App\Models\Classes;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // API Section


    public function apiShow(Classes $classes)
    {
        return response()->json($classes->all());
    }

    public function apiShowById(Classes $classes, $id)
    {
        $table = $classes->find($id);
        return response()->json(['message' => 'success', 'data' => $table], 200);
    }

    public function apiStore(Classes $table, Request $request)
    {
        try {
            $table->id = $request->id;
            $table->name = $request->name;
            $table->description = $request->description;
            $table->duration = $request->duration;
            $table->save();
            return response()->json('success', 201);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function apiUpdate(Classes $classes, Request $request, $id)
    {
        try {

            $table = $classes->find($id);
            $table->id = $request->id;
            $table->name = $request->name;
            $table->description = $request->description;
            $table->duration = $request->duration;
            $table->save();
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function apiDestroy(Classes $classses, $id)
    {
        try {

            $classses->find($id)->delete();
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

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
        $table->duration = $request->duration;
        $table->save();
        return redirect()->intended('/admin/studies');
    }


    public function update(Request $request, $id)
    {

        $table = Classes::find($id);
        $table->id = $request->id;
        $table->name = $request->name;
        $table->description = $request->description;
        $table->duration = $request->duration;
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
