<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lodge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Añadir esta línea

class LodgeController extends Controller
{
    public function index()
    {
        $lodges = Lodge::withCount('users')->get();
        return view('admin.lodges.index', compact('lodges'));
    }

    public function create()
    {
        return view('admin.lodges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:lodges',
            'oriente' => 'required|string|max:255',
            'history' => 'nullable|string',
            'image_url' => 'nullable|image|max:5120', // Validar como imagen, max 5MB
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
        return view('admin.lodges.edit', compact('lodge'));
    }

    public function update(Request $request, Lodge $lodge)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|unique:lodges,number,' . $lodge->id,
            'oriente' => 'required|string|max:255',
            'history' => 'nullable|string',
            'image_url' => 'nullable|image|max:5120', // Validar como imagen, max 5MB
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
        $lodge->delete();

        return redirect()->route('admin.lodges.index')->with('success', 'Logia eliminada con éxito.');
    }
}
