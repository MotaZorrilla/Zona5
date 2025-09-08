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
        // Find Roles, Lodges, Positions
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        $dfsLodge = Lodge::where('name', 'Domingo Faustino Sarmiento')->first();
        $hanhoushingLodge = Lodge::where('name', 'Hanhoushing')->first();

        $vmPosition = Position::where('name', 'Venerable Maestro')->first();
        $pvPosition = Position::where('name', 'Primer Vigilante')->first();
        $sz5Position = Position::where('name', 'Secretario de la Zona 5')->first();

        // Create Héctor Mota
                $hector = User::create([
            'name' => 'Héctor Mota',
            'email' => 'hector@motazorrilla.com',
            'password' => Hash::make('Baralo00.'),
        ]);
        $hector->roles()->attach($superAdminRole);
        $hector->lodges()->attach($dfsLodge->id, ['position_id' => $vmPosition->id]);
        $hector->lodges()->attach($hanhoushingLodge->id, ['position_id' => $pvPosition->id]);

        // Create Carlos Larreal
        $carlos = User::create([
            'name' => 'Carlos Larreal',
            'email' => 'carlos.larreal@example.com',
            'password' => Hash::make('password'), // Default password, should be changed
        ]);
        $carlos->roles()->attach($adminRole);
        // No lodge affiliation yet, as per the request, but has a zonal position.
        // This assumes a way to represent zonal positions, for now we can assign a special position.
        // A better model might be a null lodge_id for zonal positions.
        // For now, let's assign him to a lodge as an example.
        $carlos->lodges()->attach($dfsLodge->id, ['position_id' => $sz5Position->id]);
    }
}