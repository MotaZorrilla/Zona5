<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lodge;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = User::with('roles', 'lodges');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Apply role filter
        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('id', $request->role);
            });
        }

        // Apply lodge filter
        if ($request->filled('lodge')) {
            $query->whereHas('lodges', function($q) use ($request) {
                $q->where('id', $request->lodge);
            });
        }

        $users = $query->get();

        $roles = Role::all();
        $lodges = Lodge::all();

        return view('admin.users.index', compact('users', 'roles', 'lodges'));
    }

    public function create()
    {
        // Only allow SuperAdmin and Admin users to create users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $roles = Role::all();
        $lodges = Lodge::all();
        $positions = Position::all();
        return view('admin.users.create', compact('roles', 'lodges', 'positions'));
    }

    public function store(Request $request)
    {
        // Only allow SuperAdmin and Admin users to create users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',
            'lodge_id' => 'nullable|exists:lodges,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lodge_id' => $request->lodge_id,
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function edit(User $user)
    {
        // Only allow SuperAdmin and Admin users to edit users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $roles = Role::all();
        $lodges = Lodge::all();
        $positions = Position::all();
        return view('admin.users.edit', compact('user', 'roles', 'lodges', 'positions'));
    }

    public function update(Request $request, User $user)
    {
        // Only allow SuperAdmin and Admin users to update users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'roles' => 'sometimes|array',
            'new_affiliation.lodge_id' => 'nullable|exists:lodges,id',
            'new_affiliation.position_id' => 'nullable|exists:positions,id',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Sync system roles
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        // Add new affiliation if provided
        if ($request->filled('new_affiliation.lodge_id') && $request->filled('new_affiliation.position_id')) {
            $user->lodges()->attach($request->input('new_affiliation.lodge_id'), [
                'position_id' => $request->input('new_affiliation.position_id')
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(User $user)
    {
        // Only allow SuperAdmin and Admin users to delete users 
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function show(User $user)
    {
        // Users can view their own profile, SuperAdmin and Admin can view any user
        if (Auth::id() !== $user->id && !Auth::user()->roles()->whereIn('name', ['SuperAdmin', 'Admin'])->exists()) {
            abort(403, 'No tienes permiso para ver este perfil.');
        }
        
        $user->load('lodges', 'roles'); // Eager load relationships
        return view('admin.users.show', compact('user'));
    }
    
    protected function authorizeRole($roles)
    {
        if (!Auth::user() || !Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
    }
}
