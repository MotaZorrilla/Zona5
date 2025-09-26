<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use App\Enums\NewsStatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user for creating news
        $adminUser = User::where('email', 'hector@motazorrilla.com')->first();
        if (!$adminUser) {
            $adminUser = User::first(); // Fallback to any user if admin user doesn't exist
        }
        
        // Create specific portal news
        News::create([
            'user_id' => $adminUser ? $adminUser->id : null,
            'title' => 'Creación del Portal de la Gran Zona 5',
            'slug' => Str::slug('creacion-del-portal-de-la-gran-zona-5'),
            'excerpt' => 'Se ha lanzado oficialmente el nuevo portal digital de la Gran Zona 5, un espacio dedicado a la comunicación, transparencia y acceso a la información masónica.',
            'content' => 'Con gran satisfacción anunciamos la creación del Portal de la Gran Zona 5, una plataforma digital que tiene como objetivo fortalecer la comunicación entre las logias, facilitar el acceso a documentos importantes, y mantener informados a los hermanos sobre las actividades de la zona. Este portal representa un hito importante en la modernización y transparencia de nuestras instituciones, permitiendo un mejor acceso a la información y recursos masónicos para todos los QQ.`.`HH.`.`.',
            'status' => NewsStatusEnum::PUBLISHED,
            'published_at' => Carbon::create(2025, 9, 25, 10, 0, 0),
            'created_at' => Carbon::create(2025, 9, 25, 10, 0, 0),
            'updated_at' => Carbon::create(2025, 9, 25, 10, 0, 0),
        ]);

        // Create 3 additional news items
        News::create([
            'user_id' => $adminUser ? $adminUser->id : null,
            'title' => 'Actualización de Documentos de la Gran Zona 5',
            'slug' => Str::slug('actualizacion-de-documentos-de-la-gran-zona-5'),
            'excerpt' => 'Se han actualizado los documentos institucionales y reglamentos de la Gran Zona 5 para su acceso público.',
            'content' => 'La Gran Zona 5 ha realizado una actualización importante de sus documentos institucionales, incluyendo reglamentos, protocolos y directrices. Estos documentos han sido revisados para asegurar su relevancia y aplicación adecuada. El acceso a estos documentos se ha facilitado a través de la nueva plataforma digital, permitiendo a los hermanos estar informados sobre los cambios y actualizaciones necesarias para el correcto funcionamiento de las logias.',
            'status' => NewsStatusEnum::PUBLISHED,
            'published_at' => Carbon::create(2025, 9, 20, 14, 30, 0),
            'created_at' => Carbon::create(2025, 9, 20, 14, 30, 0),
            'updated_at' => Carbon::create(2025, 9, 20, 14, 30, 0),
        ]);

        News::create([
            'user_id' => $adminUser ? $adminUser->id : null,
            'title' => 'Celebración del Aniversario de la Gran Logia',
            'slug' => Str::slug('celebracion-del-aniversario-de-la-gran-logia'),
            'excerpt' => 'La Gran Logia de la República de Venezuela celebra un nuevo aniversario de fundación con una ceremonia especial.',
            'content' => 'Durante este mes se celebró el aniversario de fundación de la Gran Logia de la República de Venezuela con una ceremonia solemne que contó con la presencia de muchas de las más distinguidas personalidades del mundo masónico. La ceremonia incluyó la reafirmación de los principios fundamentales de la masonería y una mirada hacia el futuro de la institución. El evento tuvo lugar en el Templo Principal y fue una oportunidad para recordar la importancia de nuestra labor en la sociedad.',
            'status' => NewsStatusEnum::PUBLISHED,
            'published_at' => Carbon::create(2025, 9, 15, 16, 0, 0),
            'created_at' => Carbon::create(2025, 9, 15, 16, 0, 0),
            'updated_at' => Carbon::create(2025, 9, 15, 16, 0, 0),
        ]);

        News::create([
            'user_id' => $adminUser ? $adminUser->id : null,
            'title' => 'Nuevas Iniciaciones en Logias de la Zona',
            'slug' => Str::slug('nuevas-iniciaciones-en-logias-de-la-zona'),
            'excerpt' => 'Varias logias de la Gran Zona 5 han realizado nuevas iniciaciones con la incorporación de nuevos hermanos.',
            'content' => 'Las logias pertenecientes a la Gran Zona 5 continúan con su labor de formación y expansión. En las últimas semanas, varias logias han realizado ceremonias de iniciación para nuevos hermanos, quienes se suman al trabajo fraterno en pos de los ideales masónicos. Estas ceremonias representan la continuidad de la tradición iniciática y el compromiso de las logias con la búsqueda de la perfección moral y espiritual.',
            'status' => NewsStatusEnum::PUBLISHED,
            'published_at' => Carbon::create(2025, 9, 10, 11, 0, 0),
            'created_at' => Carbon::create(2025, 9, 10, 11, 0, 0),
            'updated_at' => Carbon::create(2025, 9, 10, 11, 0, 0),
        ]);
    }
}