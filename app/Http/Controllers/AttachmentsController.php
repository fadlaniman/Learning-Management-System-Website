<?php

namespace App\Http\Controllers;

use Illuminate\View\View;


class AttachmentsController extends Controller
{
    public function show($id): View
    {
        return view('/teacher/classes/classwork');
    }
    
}
