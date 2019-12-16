<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttachController extends Controller
{
    public function index($type)
    {
        $src = url('laravel-filemanager/').'?type='.$type;
        
        return view('admin.attach.index', ['src' => $src]);
    }
}
