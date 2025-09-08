<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lodge;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'lodges')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $lodges = Lodge::all();
        $positions = Position::all();
        return view('admin.users.create', compact('roles', 'lodges', 'positions'));
    }

    public function store(Request $request)
    {
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
        $roles = Role::all();
        $lodges = Lodge::all();
        $positions = Position::all();
        return view('admin.users.edit', compact('user', 'roles', 'lodges', 'positions'));
    }

    public function update(Request $request, User $user)
    {
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
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
