<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample events
        $adminUser = User::where('email', 'admin@example.com')->first();
        
        // Specific event: Séptimo binacional in Santa Elena de Uairén
        Event::create([
            'title' => 'Séptimo Encuentro Binacional Masónico',
            'description' => 'Ceremonia conmemorativa del séptimo encuentro binacional entre hermanos de la Gran Logia de la República de Venezuela y la Gran Logia del Brasil, celebrado en Santa Elena de Uairén.',
            'start_time' => Carbon::create(2025, 9, 28, 10, 0, 0),
            'end_time' => Carbon::create(2025, 9, 28, 18, 0, 0),
            'location' => 'Santa Elena de Uairén, Venezuela',
            'type' => 'event',
            'is_public' => true,
            'created_by' => $adminUser ? $adminUser->id : null
        ]);

        // Sample events for September 2025
        Event::create([
            'title' => 'Tenida de Solsticio de Verano',
            'description' => 'Ceremonia especial para celebrar el solsticio de verano con hermanos de todas las logias.',
            'start_time' => Carbon::create(2025, 9, 3, 19, 0, 0),
            'end_time' => Carbon::create(2025, 9, 3, 22, 0, 0),
            'location' => 'Templo Principal',
            'type' => 'tenida',
            'is_public' => false,
            'created_by' => $adminUser ? $adminUser->id : null
        ]);

        Event::create([
            'title' => 'Conferencia Pública: Masonería y Sociedad',
            'description' => 'Conferencia abierta al público sobre el papel de la masonería en la sociedad moderna.',
            'start_time' => Carbon::create(2025, 9, 12, 18, 0, 0),
            'end_time' => Carbon::create(2025, 9, 12, 20, 0, 0),
            'location' => 'Auditorio Central (Online por Zoom)',
            'type' => 'conference',
            'is_public' => true,
            'created_by' => $adminUser ? $adminUser->id : null
        ]);

        // Additional events
        Event::create([
            'title' => 'Reunión de Logia Regular',
            'description' => 'Reunión ordinaria de trabajos reglamentarios.',
            'start_time' => Carbon::create(2025, 9, 15, 20, 0, 0),
            'end_time' => Carbon::create(2025, 9, 15, 22, 30, 0),
            'location' => 'Sala de Trabajos Capitulares',
            'type' => 'meeting',
            'is_public' => false,
            'created_by' => $adminUser ? $adminUser->id : null
        ]);
    }
}