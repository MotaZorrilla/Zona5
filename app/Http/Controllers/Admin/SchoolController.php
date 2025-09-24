<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function index()
    {
        // Only allow SuperAdmin and Admin users to see school section
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.school.index');
    }

    public function create()
    {
        // Only allow SuperAdmin and Admin users to create school content
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.school.create');
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}
