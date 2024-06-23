<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\Classes;
use App\Models\UserAttendance;
use App\Models\UserClass;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AttachmentsController extends Controller
{

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

    public function apiShowDetail($class_id, $attachment_id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  Attachments::with(['users', 'classes'])->where('class_id', $class_id)->find($attachment_id)], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }
    public function apiShow($id)
    {
        try {
            return response()->json(['message' => 'success', 'data' =>  Attachments::with('users', 'classes')->where('class_id', $id)->orderBy('created_at', 'desc')->get()], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }


    public function apiStore(Request $request, $id)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('files/', $fileName);
                $table = new Attachments();
                $table->title = $request->title;
                $table->description = $request->description;
                $table->type = $request->type;
                $table->deadline = $request->deadline;
                $table->file = $fileName;
                $table->user_id = Auth::user()->uid;
                $table->class_id = $id;
                $table->save();
                return response()->json(['message' => 'success'], 201);
            } else {
                return response()->json(['message' => 'has no file'], 404);
            }
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], $e->status);
        }
    }




    public function show($id): View
    {
        return view('/teacher/classes/detail', ['classes' => Classes::with(['attachments', 'users'])->find($id), 'userclass' => UserClass::with(['users', 'classes'])->where('user_id', Auth::user()->uid)->get(), 'attendances' => UserAttendance::paginate(15)]);
    }
    public function showDetail($study_id, $attachment_id): View
    {
        return view('/teacher/classes/attachment', ['attachments' => Attachments::with(['users', 'comments', 'class'])->find($attachment_id), 'userclass' => UserClass::with(['users', 'classes'])->where('user_id', Auth::user()->uid)->get()]);
    }

    public function store(Attachments $table, Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,ppt,pdf,mp4|max:20048',
        ]);


        try {
            if ($request->hasFile('file')) {
                $file = $request->file->store('files');
                $table->title = $request->title;
                $table->description = $request->description;
                $table->type = $request->type;
                $table->deadline = $request->deadline;
                $table->file = $file;
                $table->user_id = Auth::user()->uid;
                $table->class_id = $id;
                $table->save();
                return redirect()->intended('/teacher/classes/' . $id . '/detail');
            }
        } catch (Exception $e) {
            return redirect()->intended('/teacher/classes/' . $id . '/detail');
        }
    }

    public function update(Request $request, $study_id, $attachment_id)

    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,ppt,pdf,mp4|max:20048',
        ]);
        try {
            if ($request->hasFile('file')) {
                $table = Attachments::find($attachment_id);
                Storage::delete($table->file);
                $file = $request->file->store('files');
                $table->title = $request->title;
                $table->description = $request->description;
                $table->type = $request->type;
                $table->deadline = $request->deadline;
                $table->file = $file;
                $table->user_id = Auth::user()->uid;
                $table->class_id = $study_id;
                $table->save();
                return redirect()->intended('/teacher/classes/' . $study_id . '/detail');
            }
        } catch (Exception $e) {
            return $e;;
        }
    }

    public function delete($study_id, $attachment_id)
    {
        $table = Attachments::find($attachment_id);
        Storage::delete($table->file);
        $table->comments()->delete();
        $table->delete();
        return redirect()->intended('/teacher/classes/' . $study_id . '/detail');
    }
}
