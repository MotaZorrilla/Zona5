<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lodge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Añadir esta línea
use Illuminate\Support\Facades\Auth;

class LodgeController extends Controller
{
    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = Lodge::withCount('users');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('number', 'LIKE', "%{$search}%")
                  ->orWhere('orient', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%");
            });
        }

        // Apply number filter
        if ($request->filled('number')) {
            $query->where('number', $request->number);
        }

        $lodges = $query->get();

        return view('admin.lodges.index', compact('lodges'));
    }

    public function create()
    {
        // Only allow SuperAdmin and Admin users to create lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.lodges.create');
    }

    public function store(Request $request)
    {
        // Only allow SuperAdmin and Admin users to create lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:lodges',
            'orient' => 'required|string|max:255',
            'history' => 'nullable|string',
            'image_url' => 'nullable|image|max:5120', // Validar como imagen, max 5MB
            'address' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('lodges', 'public');
        }

        Lodge::create($data);

        return redirect()->route('admin.lodges.index')->with('success', 'Logia creada con éxito.');
    }

    public function edit(Lodge $lodge)
    {
        // Only allow SuperAdmin and Admin users to edit lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.lodges.edit', compact('lodge'));
    }

    public function update(Request $request, Lodge $lodge)
    {
        // Only allow SuperAdmin and Admin users to update lodges
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:lodges,number,' . $lodge->id,
            'orient' => 'required|string|max:255',
            'history' => 'nullable|string',
            'image_url' => 'nullable|image|max:5120', // Validar como imagen, max 5MB
            'address' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_url')) {
            // Eliminar la imagen anterior si existe
            if ($lodge->image_url) {
                Storage::disk('public')->delete($lodge->image_url);
            }
            $data['image_url'] = $request->file('image_url')->store('lodges', 'public');
        }

        $lodge->update($data);

        return redirect()->route('admin.lodges.index')->with('success', 'Logia actualizada con éxito.');
    }

    public function destroy(Lodge $lodge)
    {
        // Only allow SuperAdmin and Admin users to delete lodges 
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $lodge->delete();

        return redirect()->route('admin.lodges.index')->with('success', 'Logia eliminada con éxito.');
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}
