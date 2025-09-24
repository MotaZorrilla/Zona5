<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            PositionSeeder::class,
            LodgeSeeder::class,
            
            // Lodge-specific seeders
            AsiloDeLaPazLodgeSeeder::class,
            AuroraDelYuruariLodgeSeeder::class,
            BolivarYSucreLodgeSeeder::class,
            CarlosDanielFernandezLodgeSeeder::class,
            CorreoDelOrinocoLodgeSeeder::class,
            DallaCostaLodgeSeeder::class,
            DiosYPatriaLodgeSeeder::class,
            DomingoFaustinoSarmientoLodgeSeeder::class,
            DrCesarObdulioIriarteLodgeSeeder::class,
            EstrellaDelRoraimaLodgeSeeder::class,
            EstrellaDelSupamoLodgeSeeder::class,
            EstrellaGuzmanBlancoLodgeSeeder::class,
            EstudiosTradicionalesLodgeSeeder::class,
            GranCadenaUniversalLodgeSeeder::class,
            HansHauschildtLodgeSeeder::class,
            JesusValentinoLatanLaRosaLodgeSeeder::class,
            JuanFranciscoGironLodgeSeeder::class,
            LuzYReflexionLodgeSeeder::class,
            PedroCovaLodgeSeeder::class,
            RafaelCalabreseLodgeSeeder::class,
            RestauradoresDelHonorXXIILodgeSeeder::class,
            Salmo133LodgeSeeder::class,
            SolDeGuayanaLodgeSeeder::class,
            
            UserSeeder::class,
            AdminUserSeeder::class,
            ZoneDignitariesSeeder::class,
            MessagesTableSeeder::class,
            ContactMessagesTableSeeder::class,
            ActivityLogSeeder::class,
            LogoSettingsSeeder::class,
        ]);
    }
}