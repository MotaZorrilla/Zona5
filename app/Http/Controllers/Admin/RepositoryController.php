<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to access repository
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = Repository::with('uploader');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply grade level filter
        if ($request->filled('grade_level')) {
            $query->where('grade_level', $request->grade_level);
        }

        $repositories = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.repository', compact('repositories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only allow SuperAdmin and Admin users to create repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.repository.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only allow SuperAdmin and Admin users to store repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt,jpg,jpeg,png|max:10240', // 10MB max
            'category' => 'nullable|string|max:100',
            'grade_level' => 'nullable|in:Aprendiz,Compañero,Maestro,Todos',
        ]);

        $file = $request->file('document');
        $filePath = $file->store('repository', 'public');
        
        Repository::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientOriginalExtension(),
            'category' => $request->category,
            'grade_level' => $request->grade_level ?? 'Todos',
            'uploaded_by' => Auth::id(),
            'uploaded_at' => now(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()->route('admin.repository.index')->with('success', 'Documento subido exitosamente al repositorio.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Repository $repository)
    {
        // Only allow SuperAdmin and Admin users to view repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.repository.show', compact('repository'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repository $repository)
    {
        // Only allow SuperAdmin and Admin users to edit repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.repository.edit', compact('repository'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repository $repository)
    {
        // Only allow SuperAdmin and Admin users to update repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt,jpg,jpeg,png|max:10240', // 10MB max
            'category' => 'nullable|string|max:100',
            'grade_level' => 'nullable|in:Aprendiz,Compañero,Maestro,Todos',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'grade_level' => $request->grade_level ?? 'Todos',
        ];

        // Handle file upload if provided
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            
            // Delete old file
            if ($repository->file_path) {
                Storage::disk('public')->delete($repository->file_path);
            }
            
            $filePath = $file->store('repository', 'public');
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['file_size'] = $file->getSize();
        }

        $repository->update($data);

        return redirect()->route('admin.repository.index')->with('success', 'Documento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repository $repository)
    {
        // Only allow SuperAdmin and Admin users to delete repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        // Delete the file from storage
        if ($repository->file_path) {
            Storage::disk('public')->delete($repository->file_path);
        }

        $repository->delete();

        return redirect()->route('admin.repository.index')->with('success', 'Documento eliminado exitosamente del repositorio.');
    }
    
    /**
     * Download a file from the repository
     */
    public function download(Repository $repository)
    {
        // Check if user has permission to download (all authenticated users can download)
        if (!Auth::check()) {
            abort(403, 'No tienes permiso para acceder a este archivo.');
        }
        
        $path = Storage::disk('public')->path($repository->file_path);
        
        if (!file_exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }
        
        return response()->download($path, $repository->file_name);
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}
