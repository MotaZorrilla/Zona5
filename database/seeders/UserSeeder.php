<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios de ejemplo con posiciones
        $positions = Position::whereIn('name', ['Presidente', 'Vicepresidente', 'Secretario'])->get();
        
        // Crear un usuario administrador
        $admin = User::where('email', 'admin@zonacinco.org.ve')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Administrador del Sistema',
                'email' => 'admin@zonacinco.org.ve',
                'password' => Hash::make('password'),
                'national_id' => null,
                'degree' => 'Maestro',
            ]);
        }
        
        // Asignar rol de administrador (si existe)
        if ($role = \App\Models\Role::where('name', 'admin')->first()) {
            if (!$admin->roles()->where('role_id', $role->id)->exists()) {
                $admin->roles()->attach($role);
            }
        }
        
        // Crear usuarios para las posiciones principales
        $dignitaries = [
            ['name' => 'Luis Bartolo Ramírez', 'position' => 'Presidente', 'email' => 'presidente@zonacinco.org.ve'],
            ['name' => 'Carlos José Larreal', 'position' => 'Vicepresidente', 'email' => 'vicepresidente@zonacinco.org.ve'],
            ['name' => 'Juan Pérez', 'position' => 'Secretario', 'email' => 'secretario@zonacinco.org.ve'],
        ];
        
        foreach ($dignitaries as $dignitary) {
            // Verificar si el usuario ya existe
            $user = User::where('email', $dignitary['email'])->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $dignitary['name'],
                    'email' => $dignitary['email'],
                    'password' => Hash::make('password'),
                    'national_id' => null,
                    'degree' => 'Maestro',
                ]);
            }
            
            // Asignar posición si existe
            $position = $positions->where('name', $dignitary['position'])->first();
            if ($position) {
                // Asociar el usuario con una logia de ejemplo (la primera)
                $lodge = \App\Models\Lodge::first();
                if ($lodge) {
                    // Verificar si la relación ya existe
                    if (!$user->positions()->where('position_id', $position->id)->where('lodge_user.lodge_id', $lodge->id)->exists()) {
                        $user->positions()->attach($position, ['lodge_id' => $lodge->id]);
                    }
                    
                    // Verificar si la relación con la logia ya existe
                    if (!$user->lodges()->where('lodge_id', $lodge->id)->exists()) {
                        $user->lodges()->attach($lodge);
                    }
                }
            }
        }
    }
}