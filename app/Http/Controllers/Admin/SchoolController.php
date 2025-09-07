<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return view('admin.school.index');
    }

    public function create()
    {
        return view('admin.school.create');
    }
}
