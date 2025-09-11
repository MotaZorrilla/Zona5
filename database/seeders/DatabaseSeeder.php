<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PositionSeeder::class,
            LodgeSeeder::class,
            AdminUserSeeder::class,
            DiosYPatriaLodgeSeeder::class,
            Salmo133LodgeSeeder::class,
            JesusValentinoLatanLaRosaLodgeSeeder::class,
            AsiloDeLaPazLodgeSeeder::class,
            JuanFranciscoGironLodgeSeeder::class,
            HansHauschildtLodgeSeeder::class,
            BolivarYSucreLodgeSeeder::class,
            PedroCovaLodgeSeeder::class,
            GranCadenaUniversalLodgeSeeder::class,
            EstrellaGuzmanBlancoLodgeSeeder::class,
            DallaCostaLodgeSeeder::class,
            DrCesarObdulioIriarteLodgeSeeder::class,
            RafaelCalabreseLodgeSeeder::class,
            RestauradoresDelHonorXXIILodgeSeeder::class,
            CarlosDanielFernandezLodgeSeeder::class,
            SolDeGuayanaLodgeSeeder::class,
            EstrellaDelRoraimaLodgeSeeder::class,
            EstrellaDelSupamoLodgeSeeder::class,
            LuzYReflexionLodgeSeeder::class,
            AuroraDelYuruariLodgeSeeder::class,
            CorreoDelOrinocoLodgeSeeder::class,
            DomingoFaustinoSarmientoLodgeSeeder::class,
            EstudiosTradicionalesLodgeSeeder::class,
            ZoneDignitariesSeeder::class,
            ActivityLogSeeder::class, // Add this line
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}