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
        $hector = User::firstOrCreate(
            ['email' => 'hector@motazorrilla.com'],
            [
                'name' => 'Héctor Mota',
                'password' => Hash::make('Baralo00.'),
            ]
        );
        $hector->roles()->syncWithoutDetaching([$superAdminRole->id]);
        if ($dfsLodge && $vmPosition) {
            $hector->lodges()->syncWithoutDetaching([$dfsLodge->id => ['position_id' => $vmPosition->id]]);
        }
        if ($hanhoushingLodge && $pvPosition) {
            $hector->lodges()->syncWithoutDetaching([$hanhoushingLodge->id => ['position_id' => $pvPosition->id]]);
        }

        // Create Carlos Larreal
        $carlos = User::firstOrCreate(
            ['email' => 'carlos.larreal@example.com'],
            [
                'name' => 'Carlos Larreal',
                'password' => Hash::make('password'),
            ]
        );
        $carlos->roles()->syncWithoutDetaching([$adminRole->id]);
        if ($dfsLodge && $sz5Position) {
            $carlos->lodges()->syncWithoutDetaching([$dfsLodge->id => ['position_id' => $sz5Position->id]]);
        }
    }
}