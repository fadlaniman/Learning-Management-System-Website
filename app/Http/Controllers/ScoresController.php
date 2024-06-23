<?php

namespace App\Http\Controllers;

use App\Models\Scores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ScoresController extends Controller
{
    public function showApi($class_id, $attachment_id, $submission_id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  Scores::where('class_id', $class_id)->where('attachment_id', $attachment_id)->where('submission_id', $submission_id)->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function storeApi(Request $request, $class_id, $attachment_id, $submission_id)
    {
        try {
            $table = new Scores();
            $table->value = $request->value;
            $table->user_id = Auth::user()->uid;
            $table->class_id = $class_id;
            $table->atatchment_id = $attachment_id;
            $table->submission_id = $submission_id;
            $table->save();
            return response()->json(['message' => 'success'], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }
}
