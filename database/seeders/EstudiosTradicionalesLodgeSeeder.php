<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EstudiosTradicionalesLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $lodge = Lodge::where('name', 'Estudios Tradicionales')->first();
        $vmPosition = Position::where('name', 'Venerable Maestro')->first();

        if ($lodge && $memberRole && $vmPosition) {
            $membersData = [
                [
                    'name' => 'Mervin Quiñones',
                    'phone' => '04148980698',
                    'position_id' => $vmPosition->id,
                ],
            ];

            foreach ($membersData as $memberData) {
                $user = User::firstOrCreate(
                    ['name' => $memberData['name']],
                    [
                        'email' => null,
                        'password' => Hash::make('password'),
                        'phone_number' => $memberData['phone'],
                        'degree' => 'Maestro',
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);
                $user->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $memberData['position_id']]]);
            }
        }
    }
}
