<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LodgeFormRequest;
use App\Models\Lodge;
use App\Services\LodgeService;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LodgeController extends Controller
{
    use PaginationTrait;

    protected $lodgeService;

    public function __construct(LodgeService $lodgeService)
    {
        $this->lodgeService = $lodgeService;
    }

    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = Lodge::withCount('users');

        $lodges = $this->paginateWithSearchAndFilters(
            $query,
            ['name', 'number', 'orient', 'address'], // searchable fields
            ['number'], // filterable fields
            $request,
            'created_at',
            'desc'
        );

        return view('admin.lodges.index', compact('lodges'));
    }

    public function create()
    {
        // Only allow SuperAdmin and Admin users to create lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.lodges.create');
    }

    public function store(LodgeFormRequest $request)
    {
        // Only allow SuperAdmin and Admin users to create lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $files = [];
        if ($request->hasFile('image_url')) {
            $files['image_url'] = $request->file('image_url');
        }

        $this->lodgeService->create($request->validated(), $files);

        return redirect()->route('admin.lodges.index')->with('success', 'Logia creada con éxito.');
    }

    public function edit(Lodge $lodge)
    {
        // Only allow SuperAdmin and Admin users to edit lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.lodges.edit', compact('lodge'));
    }

    public function update(LodgeFormRequest $request, Lodge $lodge)
    {
        // Only allow SuperAdmin and Admin users to update lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $files = [];
        if ($request->hasFile('image_url')) {
            $files['image_url'] = $request->file('image_url');
        }

        $this->lodgeService->update($lodge->id, $request->validated(), $files);

        return redirect()->route('admin.lodges.index')->with('success', 'Logia actualizada con éxito.');
    }

    public function destroy(Lodge $lodge)
    {
        // Only allow SuperAdmin and Admin users to delete lodges 
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $this->lodgeService->delete($lodge->id);

        return redirect()->route('admin.lodges.index')->with('success', 'Logia eliminada con éxito.');
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}
