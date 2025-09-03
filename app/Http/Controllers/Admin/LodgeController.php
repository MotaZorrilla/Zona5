<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lodge;
use Illuminate\Http\Request;

class LodgeController extends Controller
{
    public function index()
    {
        $lodges = Lodge::all();
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
            'valley' => 'required|string|max:255',
        ]);

        Lodge::create($request->all());

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
            'valley' => 'required|string|max:255',
        ]);

        $lodge->update($request->all());

        return redirect()->route('admin.lodges.index')->with('success', 'Logia actualizada con éxito.');
    }

    public function destroy(Lodge $lodge)
    {
        $lodge->delete();

        return redirect()->route('admin.lodges.index')->with('success', 'Logia eliminada con éxito.');
    }
}
