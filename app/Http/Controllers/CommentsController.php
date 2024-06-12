<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentsController extends Controller
{
    public function store(Request $request, $study_id, $attachment_id)
    {
        try
        {
            $table = new Comments();
            $table->text = $request->text;
            $table->user_id = Auth::user()->uid;
            $table->class_id = $study_id;
            $table->attachment_id = $attachment_id;
            $table->save();
            return redirect()->intended('/teacher/classes/' . $study_id . '/' .  $attachment_id . '/detail');
        }catch (Exception $e) {
            return redirect()->intended('/teacher/classes/' . $study_id. '/' . $attachment_id . '/detail');
        }
    }
    }

