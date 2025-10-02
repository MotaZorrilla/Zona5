<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Lodge;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clean up previous logs to avoid duplicates on re-seed
        ActivityLog::truncate();

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin')->orWhere('name', 'SuperAdmin');
        })->get();

        if ($admins->isEmpty()) {
            $this->command->warn('No admin users found to attribute activities to. Skipping ActivityLogSeeder.');
            return;
        }

        $users = User::latest()->take(5)->get();
        foreach ($users as $user) {
            ActivityLog::create([
                'description' => "Se ha registrado el nuevo usuario: {$user->name}",
                'action' => 'created',
                'subject_id' => $user->id,
                'subject_type' => get_class($user),
                'user_id' => $admins->random()->id,
                'created_at' => fake()->dateTimeBetween('-1 week'),
                'updated_at' => now(),
            ]);
        }

        $lodges = Lodge::take(3)->get();
        foreach ($lodges as $lodge) {
            ActivityLog::create([
                'description' => "La logia '{$lodge->name}' ha sido actualizada.",
                'action' => 'updated',
                'subject_id' => $lodge->id,
                'subject_type' => get_class($lodge),
                'user_id' => $admins->random()->id,
                'created_at' => fake()->dateTimeBetween('-2 weeks', '-1 week'),
                'updated_at' => now(),
            ]);
        }
    }
}
