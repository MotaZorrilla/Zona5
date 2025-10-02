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
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            PositionSeeder::class,
            LodgeSeeder::class,
            UserSeeder::class,
            NewsSeeder::class,
            MessagesTableSeeder::class,
            EventSeeder::class,
            ContactMessagesTableSeeder::class,
            LogoSettingsSeeder::class,
            TreasurySeeder::class,
            CourseSeeder::class,
            SettingsSeeder::class,
            FaqSeeder::class,
            ForumSeeder::class,
            RepositorySeeder::class,
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
            ZoneDignitariesSeeder::class,
            ActivityLogSeeder::class,
        ]);
    }
}