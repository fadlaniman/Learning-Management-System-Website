<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{

    // API Section

    public function apiShow(Comments $comments, $class_id, $attachment_id)
    {
        try {
            $table = $comments->with('users')->where('class_id', $class_id)->where('attachment_id', $attachment_id)->orderBy('created_at', 'desc')->get();
            return response()->json(['message' => 'succes', 'data' => $table], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }


    public function apiStore(Request $request, $class_id, $attachment_id)
    {
        try {
            $table = new Comments;
            $table->text = $request->text;
            $table->user_id = Auth::user()->uid;
            $table->class_id = $class_id;
            $table->attachment_id = $attachment_id;
            $table->save();
            return response()->json(['message' => 'succes'], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }

    public function store(Request $request, $study_id, $attachment_id)
    {
        try {
            $table = new Comments();
            $table->text = $request->text;
            $table->user_id = Auth::user()->uid;
            $table->class_id = $study_id;
            $table->attachment_id = $attachment_id;
            $table->save();
            return redirect()->intended('/teacher/classes/' . $study_id . '/' .  $attachment_id . '/detail');
        } catch (Exception $e) {
            return redirect()->intended('/teacher/classes/' . $study_id . '/' . $attachment_id . '/detail');
        }
    }
}
