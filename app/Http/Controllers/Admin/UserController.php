<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\Lodge;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use PaginationTrait;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        // Only allow SuperAdmin and Admin users to see all users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $query = User::with('roles', 'lodges');

        $users = $this->paginateWithSearchAndFilters(
            $query,
            ['name', 'email'], // searchable fields
            [], // filterable fields will be handled separately
            $request,
            'created_at',
            'desc'
        );

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

    public function store(UserFormRequest $request)
    {
        // Only allow SuperAdmin and Admin users to create users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $this->userService->create($request->validated());

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

    public function update(UserFormRequest $request, User $user)
    {
        // Only allow SuperAdmin and Admin users to update users
        $this->authorizeRole(['SuperAdmin', 'Admin']);
        
        $this->userService->update($user->id, $request->validated());

        // Add new affiliation if provided
        if ($request->filled('new_affiliation.lodge_id') && $request->filled('new_affiliation.position_id')) {
            $this->userService->assignAffiliation(
                $user->id,
                $request->input('new_affiliation.lodge_id'),
                $request->input('new_affiliation.position_id')
            );
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
