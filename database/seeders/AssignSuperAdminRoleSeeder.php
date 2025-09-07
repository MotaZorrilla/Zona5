<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignSuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $user = User::where('email', 'test@example.com')->first();

        if ($superAdminRole && $user) {
            $user->roles()->syncWithoutDetaching([$superAdminRole->id]);
            $this->command->info('SuperAdmin role assigned to test@example.com.');
        } else {
            $this->command->warn('SuperAdmin role or test@example.com user not found.');
        }
    }
}
