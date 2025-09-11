<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find Roles
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        // Create Héctor Mota
        $hector = User::firstOrCreate(
            ['email' => 'hector@motazorrilla.com'],
            [
                'name' => 'Héctor Mota',
                'password' => Hash::make('Baralo00.'),
            ]
        );
        $hector->roles()->sync([$superAdminRole->id]);

        // Create Carlos Larreal
        $carlos = User::firstOrCreate(
            ['email' => 'carlosjoselarreal@gmail.com'],
            [
                'name' => 'Carlos Larreal',
                'password' => Hash::make('password'),
            ]
        );
        $carlos->roles()->sync([$adminRole->id]);
    }
}