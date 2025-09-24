<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZoneDignitary;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoneDignitaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all zone dignitaries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = ZoneDignitary::query();

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('role', 'LIKE', "%{$search}%")
                  ->orWhere('bio', 'LIKE', "%{$search}%");
            });
        }

        // Apply role filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $dignitaries = $query->get();

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
        // Only allow SuperAdmin and Admin users to create zone dignitaries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.zone-dignitaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only allow SuperAdmin and Admin users to create zone dignitaries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
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
        // Only allow SuperAdmin and Admin users to edit zone dignitaries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        return view('admin.zone-dignitaries.edit', compact('zoneDignitary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ZoneDignitary $zoneDignitary)
    {
        // Only allow SuperAdmin and Admin users to update zone dignitaries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
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
        // Only allow SuperAdmin and Admin users to delete zone dignitaries
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $zoneDignitary->delete();

        return redirect()->route('admin.zone-dignitaries.index')->with('success', 'Dignatario eliminado exitosamente.');
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}