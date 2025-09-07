<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        return view('admin.forums.index');
    }

    public function create()
    {
        return view('admin.forums.create');
    }
}
