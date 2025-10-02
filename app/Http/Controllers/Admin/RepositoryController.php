<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepositoryFormRequest;
use App\Models\Repository;
use App\Services\RepositoryService;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RepositoryController extends Controller
{
    use PaginationTrait;

    protected $repositoryService;

    public function __construct(RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to access repository
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = Repository::with('uploader');

        $repositories = $this->paginateWithSearchAndFilters(
            $query,
            ['title', 'description', 'category'], // searchable fields
            ['category', 'grade_level'], // filterable fields
            $request,
            'created_at',
            'desc'
        );

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
    public function store(RepositoryFormRequest $request)
    {
        // Only allow SuperAdmin and Admin users to store repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $files = [];
        if ($request->hasFile('document')) {
            $files['document'] = $request->file('document');
        }

        $this->repositoryService->create($request->validated(), $files);

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
    public function update(RepositoryFormRequest $request, Repository $repository)
    {
        // Only allow SuperAdmin and Admin users to update repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $files = [];
        if ($request->hasFile('document')) {
            $files['document'] = $request->file('document');
        }

        $this->repositoryService->update($repository->id, $request->validated(), $files);

        return redirect()->route('admin.repository.index')->with('success', 'Documento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repository $repository)
    {
        // Only allow SuperAdmin and Admin users to delete repository entries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $this->repositoryService->delete($repository->id);

        return redirect()->route('admin.repository.index')->with('success', 'Documento eliminado exitosamente del repositorio.');
    }
    
    /**
     * Download a file from the repository
     */
    public function download(Repository $repository)
    {
        // Check if user has permission to download (all authenticated users can download)
        if (!Auth::check()) {
            abort(403, 'Debes iniciar sesión para descargar este archivo.');
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
