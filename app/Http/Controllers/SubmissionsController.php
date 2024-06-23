<?php

namespace App\Http\Controllers;

use App\Models\Submissions;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SubmissionsController extends Controller
{
    // API Section
    public function apiDownloadFile($filename)
    {
        try {
            $filePath = storage_path('/app/public/files/' . $filename);
            if (!File::exists($filePath)) {
                return response()->json(['error' => 'File not found.'], 404);
            }
            return response()->download($filePath);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'An error occurred while downloading the file.'], $e->status);
        }
    }

    public function apiShow($class_id, $attachment_id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  Submissions::with('users')->where('class_id', $class_id)->where('attachment_id', $attachment_id)->orderBy('created_at', 'desc')->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }


    public function apiStore(Request $request, $class_id, $attachment_id)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('files/', $fileName);
                $table = new Submissions();
                $table->description = $request->description;
                $table->file = $fileName;
                $table->user_id = Auth::user()->uid;
                $table->class_id = $class_id;
                $table->attachment_id = $attachment_id;
                $table->save();
                return response()->json(['message' => 'success'], 201);
            } else {
                return response()->json(['message' => 'has no file'], 404);
            }
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }
}
