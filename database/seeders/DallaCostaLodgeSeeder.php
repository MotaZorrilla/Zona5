<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DallaCostaLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $dallaCostaLodge = Lodge::where('name', 'Dalla Costa')->first();

        if ($dallaCostaLodge) {
            $membersData = [
                ['name' => 'RIGOBERTO IBARRA TORRES', 'national_id' => '3018598', 'birth_date' => '1943-01-04', 'initiation_date' => '1977-11-18', 'degree' => 'Maestro', 'phone' => '0424-9026958', 'email' => 'ibarrarigoberto696@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'VICTOR ANΤΟΝΙΟ GARCIA BURGOS', 'national_id' => '3901139', 'birth_date' => '1950-12-22', 'initiation_date' => '1991-09-11', 'degree' => 'Maestro', 'phone' => '18323591893', 'email' => 'VAGBURGOS@GMAIL.COM', 'profession' => 'MÉDICO'],
                ['name' => 'CANDELARIO AMADEO YEPEZ NUÑEZ', 'national_id' => '4693344', 'birth_date' => '1957-02-02', 'initiation_date' => '1994-02-24', 'degree' => 'Maestro', 'phone' => '0416-4850355', 'email' => 'candelarioyepezn@yahoo.es', 'profession' => 'COMERCIANTE'],
                ['name' => 'ΑΝΤΟΝΙΟ MA CLARET GUEVARA GIRON', 'national_id' => '4778590', 'birth_date' => '1953-10-23', 'initiation_date' => '1993-07-24', 'degree' => 'Maestro', 'phone' => '0426-2145763', 'email' => 'antonioguevara964@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'HECTOR JOSE SILVA MEDINA', 'national_id' => '6734036', 'birth_date' => '1944-12-09', 'initiation_date' => '1993-11-09', 'degree' => 'Maestro', 'phone' => null, 'email' => null, 'profession' => 'MECÁNICO'],
                ['name' => 'JAVIER DE JESÚS GARCIA', 'national_id' => '8530488', 'birth_date' => '1950-09-11', 'initiation_date' => '1994-11-09', 'degree' => 'Maestro', 'phone' => '0288-7620275', 'email' => null, 'profession' => 'COMERCIANTE'],
                ['name' => 'ANTONIO CLARET SALAZAR GONZALEZ', 'national_id' => '8535227', 'birth_date' => '1957-10-14', 'initiation_date' => '1992-09-26', 'degree' => 'Maestro', 'phone' => '0416-3907069', 'email' => 'antonio14salazar@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'JOSÉ DE JESÚS GARCÍA BURGOS', 'national_id' => '8535425', 'birth_date' => '1960-04-14', 'initiation_date' => '1997-05-31', 'degree' => 'Maestro', 'phone' => '0424-9048336', 'email' => 'bajogarciaburgos1@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'JOSE ADIXΟΝ TARRIDO BRICEÑO', 'national_id' => '8538541', 'birth_date' => '1961-03-19', 'initiation_date' => '2002-07-09', 'degree' => 'Maestro', 'phone' => '0416-4866303', 'email' => null, 'profession' => 'ELECTRICISTA'],
                ['name' => 'NICASIO EDUARDO COPELAND MORENO', 'national_id' => '8540670', 'birth_date' => '1956-11-10', 'initiation_date' => '1989-12-16', 'degree' => 'Maestro', 'phone' => '0414-8757259', 'email' => null, 'profession' => 'COMERCIANTE'],
                ['name' => 'JOSE LUIS VERGARA VELAZCO', 'national_id' => '8711789', 'birth_date' => '1969-09-10', 'initiation_date' => '2006-10-21', 'degree' => 'Maestro', 'phone' => '0414-8980613', 'email' => 'jolver69@hotmail.com', 'profession' => 'INGENIERO'],
                ['name' => 'JUAN JOSE HERNANDEZ', 'national_id' => '8884236', 'birth_date' => '1964-12-22', 'initiation_date' => '1993-12-11', 'degree' => 'Maestro', 'phone' => '0212-2299848', 'email' => 'Juanjose uno@hotmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'GUSTAVO CEFERINO CHACIN DELGADO', 'national_id' => '8921058', 'birth_date' => '1965-08-28', 'initiation_date' => '1993-07-23', 'degree' => 'Maestro', 'phone' => '0424-8858462', 'email' => 'gustavoceferino12@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'KENTON GABRIEL STBERNALD NORMAN', 'national_id' => '8922780', 'birth_date' => '1967-12-03', 'initiation_date' => '1996-04-13', 'degree' => 'Maestro', 'phone' => '0424-9690383', 'email' => 'kentongabriel@yahoo.com', 'profession' => 'INGENIERO'],
                ['name' => 'DOMINGO ALBERTO MUCURA RODRÍGUEZ', 'national_id' => '9074381', 'birth_date' => '1960-07-06', 'initiation_date' => '2017-10-28', 'degree' => 'Maestro', 'phone' => '0414-8933610', 'email' => 'domingomucura@hotmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'MANOLO RAMON RONDON', 'national_id' => '9907851', 'birth_date' => '1966-07-26', 'initiation_date' => '1996-03-30', 'degree' => 'Maestro', 'phone' => '0424-9743884', 'email' => 'manolorondon61@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'LUIS BARTOLO RAMIREZ GONZALEZ', 'national_id' => '10047978', 'birth_date' => '1971-04-16', 'initiation_date' => '2009-11-21', 'degree' => 'Maestro', 'phone' => '0424-9052012', 'email' => 'luisbramirez@hotmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'WILFREDO JOSE ARZOLAY', 'national_id' => '10390838', 'birth_date' => '1968-06-06', 'initiation_date' => '2005-10-10', 'degree' => 'Maestro', 'phone' => '0426-7218361', 'email' => 'arzolaywilfredo@gmail.com', 'profession' => 'INGENIERO'],
                ['name' => 'JUAN LEONARDO DEVERA HURTADO', 'national_id' => '10553620', 'birth_date' => '1971-02-14', 'initiation_date' => '2002-09-07', 'degree' => 'Maestro', 'phone' => '0414-8579803', 'email' => 'jdevera11@gmail.com', 'profession' => 'T.S.U.SEGURIDAD INDUSTRIAL'],
                ['name' => 'JESUS RAFAEL RIVAS MEDINA', 'national_id' => '10554194', 'birth_date' => '1970-02-09', 'initiation_date' => '2007-10-31', 'degree' => 'Maestro', 'phone' => '0416-9800960', 'email' => 'gerets09@gmail.com', 'profession' => 'INGENIERO'],
                ['name' => 'RAFAEL AUGUSTO DIAZ VALERIO', 'national_id' => '11209700', 'birth_date' => '1946-03-24', 'initiation_date' => '1993-07-24', 'degree' => 'Maestro', 'phone' => '0424-9209135', 'email' => 'rafaeldiazvalerio@gmail.com', 'profession' => 'MÉDICO'],
                ['name' => 'OSCAR RAFAEL SILVEIRA', 'national_id' => '12559183', 'birth_date' => '1974-06-10', 'initiation_date' => '2019-09-14', 'degree' => 'Maestro', 'phone' => '0424-9285613', 'email' => 'oscarsilveira1975@gmail.com', 'profession' => 'SUPERVISOR'],
                ['name' => 'AMALIO RAFAEL SILVA BRAVO', 'national_id' => '12560341', 'birth_date' => '1970-07-10', 'initiation_date' => '2012-11-30', 'degree' => 'Maestro', 'phone' => '0416-9992483', 'email' => 'amaliorsb@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'JUAN CARLOS SARMIENTO', 'national_id' => '13807038', 'birth_date' => '1974-10-26', 'initiation_date' => '2002-12-07', 'degree' => 'Maestro', 'phone' => '0424-9441107', 'email' => 'toyorca@gmail.com', 'profession' => 'MECÁNICO'],
                ['name' => 'JOSE LUIS LUGO PERALES', 'national_id' => '14692862', 'birth_date' => '1979-10-08', 'initiation_date' => '2011-06-17', 'degree' => 'Maestro', 'phone' => '0414-9986332', 'email' => 'joselugo1075@hotmail.com', 'profession' => 'MÉDICO'],
                ['name' => 'ARLEID RAFAEL CHARRIS ALACAYO', 'national_id' => '14884265', 'birth_date' => '1981-03-10', 'initiation_date' => '2011-06-18', 'degree' => 'Maestro', 'phone' => '0414-8935163', 'email' => 'arneldcharris10@gmail.com', 'profession' => 'DOCENTE'],
                ['name' => 'ENDER ENRIQUE PINEDA DIAZ', 'national_id' => '14895580', 'birth_date' => '1980-08-12', 'initiation_date' => '2008-10-24', 'degree' => 'Maestro', 'phone' => '0424-9237677', 'email' => 'lasombradeelcallao@hotmail.com', 'profession' => 'OBRERO'],
                ['name' => 'GUSTAVO LUIS GONZALEZ VALDEZ', 'national_id' => '15522999', 'birth_date' => '1982-06-09', 'initiation_date' => '2006-10-10', 'degree' => 'Maestro', 'phone' => '0416-6866967', 'email' => 'gustavoluisgonzalezvaldez@gmail.com', 'profession' => 'ABOGADO'],
                ['name' => 'DERBY JAVIER PRIETO REINA', 'national_id' => '16009387', 'birth_date' => '1983-04-20', 'initiation_date' => '2016-09-26', 'degree' => 'Maestro', 'phone' => '0414-0875135', 'email' => 'javierprietoreina@gmail.com', 'profession' => 'TÉCNICO EN REFRIGERACIÓN'],
                ['name' => 'STEEL MACK GOURMEITTE ARAUJO', 'national_id' => '16010847', 'birth_date' => '1982-03-24', 'initiation_date' => '2019-06-22', 'degree' => 'Maestro', 'phone' => '0424-9551508', 'email' => 'steelmackgourmeitte@gmail.com', 'profession' => 'INGENIERO'],
                ['name' => 'SHARIFF NASSER AZZAM', 'national_id' => '25558429', 'birth_date' => '1993-02-16', 'initiation_date' => '2018-10-26', 'degree' => 'Compañero', 'phone' => '0424-9035609', 'email' => 'shariff 14a@hotmail.com', 'profession' => 'Lic. Administración'],
                ['name' => 'LEONARDO ALEXIS SALAZAR TOUSSAINT', 'national_id' => '11534467', 'birth_date' => '1972-12-03', 'initiation_date' => '2023-10-27', 'degree' => 'Aprendiz', 'phone' => '0424-9377276', 'email' => 'Toussa730@gmail.com', 'profession' => 'INGENIERO'],
                ['name' => 'HUGO MANUEL NATERA HERNANDEZ', 'national_id' => '13782260', 'birth_date' => '1977-10-11', 'initiation_date' => '2023-10-27', 'degree' => 'Aprendiz', 'phone' => '0416-8924374', 'email' => 'hugomnh@gmail.com', 'profession' => 'INGENIERO'],
                ['name' => 'JEAN PAUL FITTIPALDI', 'national_id' => '26839603', 'birth_date' => '1999-07-18', 'initiation_date' => '2023-10-28', 'degree' => 'Aprendiz', 'phone' => '0424-9501245', 'email' => 'jeanpaulfittipaldi717@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'ANGEL KARIM NASSER AL ATRACH', 'national_id' => '27574475', 'birth_date' => '1999-10-07', 'initiation_date' => '2023-10-28', 'degree' => 'Aprendiz', 'phone' => '0414-7817255', 'email' => 'karimnasser19997101@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'FREDDY JOSE MORENO CUSTODIO', 'national_id' => '16010171', 'birth_date' => '1978-03-21', 'initiation_date' => '2015-08-08', 'degree' => 'Aprendiz', 'phone' => '0424-9178575', 'email' => 'freddymoreno.orfebre@gmail.com', 'profession' => 'COMERCIANTE'],
            ];

            foreach ($membersData as $memberData) {
                $nationalId = !empty($memberData['national_id']) ? str_replace(['.', ','], '', $memberData['national_id']) : null;
                $name = $memberData['name'];

                $user = User::firstOrCreate(
                    $nationalId ? ['national_id' => $nationalId] : ['name' => $name],
                    [
                        'name' => $name,
                        'national_id' => $nationalId,
                        'email' => $memberData['email'],
                        'password' => Hash::make('password'),
                        'birth_date' => Carbon::parse($memberData['birth_date']),
                        'initiation_date' => Carbon::parse($memberData['initiation_date']),
                        'degree' => $memberData['degree'],
                        'phone_number' => $memberData['phone'],
                        'profession' => $memberData['profession'],
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);
                $user->lodges()->syncWithoutDetaching([$dallaCostaLodge->id => ['position_id' => $memberPosition->id]]);
            }
        }
    }
}
