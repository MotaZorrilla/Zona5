<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoneDignitary;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;

class ZoneDignitaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dignitaries = ZoneDignitary::all();

        $vmPositionId = Position::where('name', 'Venerable Maestro')->value('id');

        $venerableMasters = User::whereHas('lodges', function ($query) use ($vmPositionId) {
            $query->where('lodge_user.position_id', $vmPositionId);
        })
        ->with('lodges')
        ->get()
        ->map(function ($user) {
            $lodge = $user->lodges->first();
            return (object) [
                'name' => $user->name,
                'lodge_name' => $lodge ? $lodge->name : 'N/A',
                'phone_number' => $user->phone_number,
            ];
        });

        return view('admin.dignitaries', compact('dignitaries', 'venerableMasters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.zone-dignitaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
        ]);

        ZoneDignitary::create($request->all());

        return redirect()->route('admin.zone-dignitaries.index')->with('success', 'Dignatario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ZoneDignitary $zoneDignitary)
    {
        // Not typically used for simple CRUD, but can be implemented if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ZoneDignitary $zoneDignitary)
    {
        return view('admin.zone-dignitaries.edit', compact('zoneDignitary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ZoneDignitary $zoneDignitary)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string',
        ]);

        $zoneDignitary->update($request->all());

        return redirect()->route('admin.zone-dignitaries.index')->with('success', 'Dignatario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ZoneDignitary $zoneDignitary)
    {
        $zoneDignitary->delete();

        return redirect()->route('admin.zone-dignitaries.index')->with('success', 'Dignatario eliminado exitosamente.');
    }
}