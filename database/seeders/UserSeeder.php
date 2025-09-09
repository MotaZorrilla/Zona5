<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find Roles, Lodges, Positions
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $memberRole = Role::where('name', 'User')->first(); // Assuming 'User' role for general members

        $vmPosition = Position::where('name', 'Venerable Maestro')->first();
        $pvPosition = Position::where('name', 'Primer Vigilante')->first();
        $sz5Position = Position::where('name', 'Secretario de la Zona 5')->first();
        $memberPosition = Position::where('name', 'Miembro')->first(); // General member position

        // --- Admin Users (from AdminUserSeeder) ---
        // Logic moved to AdminUserSeeder.php

        // --- Venerable Masters (from Lodge list) ---
        $venerableMastersData = [
            ['lodge_name' => 'Aurora del Yuruari', 'name' => 'Ricardo Brito', 'phone' => '04148111791'],
            ['lodge_name' => 'Domingo Faustino Sarmiento', 'name' => 'José Alfredo Boada', 'phone' => '04249505718'],
            ['lodge_name' => 'Hans Hauschildt', 'name' => 'José Sierra', 'phone' => '04127090198'],
            ['lodge_name' => 'Dr Cesar Obdulio Iriarte', 'name' => 'Edgar Casanova', 'phone' => '04249267120'],
            ['lodge_name' => 'Salmo 133', 'name' => 'Fidas Jaber', 'phone' => '04148957746'],
            ['lodge_name' => 'Jesús Valentino Latan La Rosa', 'name' => 'Noel Lira', 'phone' => '04148916059'],
            ['lodge_name' => 'Luz y Reflexión', 'name' => 'Jairo Torres', 'phone' => '04148751598'],
            ['lodge_name' => 'Bolivar y Sucre', 'name' => 'Oscar Rodríguez', 'phone' => '04267920729'],
            ['lodge_name' => 'Restauradores del Honor XXII', 'name' => 'Tomas Chacare', 'phone' => '04249012758'],
            ['lodge_name' => 'Estudios Tradicionales', 'name' => 'Mervin Quiñones', 'phone' => '04148980698'],
            ['lodge_name' => 'Carlos Daniel Fernández', 'name' => 'José Fernández', 'phone' => '04249476551'],
            ['lodge_name' => 'Gran Cadena Universal', 'name' => 'Carlos Figueroa', 'phone' => '04124216891'],
            // Logias de Ciudad Bolívar
            ['lodge_name' => 'Asilo de la Paz', 'name' => 'Ramón Olivares', 'phone' => null],
            ['lodge_name' => 'Sol de Guayana', 'name' => 'Antonio Sequera', 'phone' => null],
            ['lodge_name' => 'DC Carlos Rodríguez Jiménez', 'name' => 'JESÚS Ortíz', 'phone' => null],
            ['lodge_name' => 'Congreso de Angostura', 'name' => 'César Ruiz', 'phone' => null],
            ['lodge_name' => 'Correo del Orinoco', 'name' => 'Cesar Iriarte', 'phone' => null],
            ['lodge_name' => 'Justicia y Luz', 'name' => 'Tu Yunta', 'phone' => null],
            ['lodge_name' => 'Rafael Calabrese', 'name' => 'Fernando Gómez', 'phone' => null],
            ['lodge_name' => 'Humberto Camejo Arias', 'name' => 'Carlos Ávilez', 'phone' => null],
            // Logias de Upata
            ['lodge_name' => 'Cent Pedro Cova', 'name' => 'Yobel Morgan', 'phone' => '04129282135'],
            ['lodge_name' => 'Juan Francisco Girón', 'name' => 'Mario Curcio', 'phone' => '04143884143'],
            // Logias de El Palmar
            ['lodge_name' => 'Sol de Imataca', 'name' => 'Miguel del Rosario', 'phone' => '04148610233'],
            // Logias de El Manteco
            ['lodge_name' => 'Estrella del Supamo', 'name' => 'Edgar Suárez', 'phone' => '04249652455'],
        ];

        foreach ($venerableMastersData as $vmData) {
            $lodge = Lodge::where('name', $vmData['lodge_name'])->first();
            if ($lodge) {
                $vmUser = User::firstOrCreate(
                    ['email' => Str::slug($vmData['name']) . '@example.com'], // Use slugged name for unique email
                    [
                        'name' => $vmData['name'],
                        'password' => Hash::make('password'),
                        'phone_number' => $vmData['phone'],
                        'national_id' => null, 'birth_date' => null, 'initiation_date' => null, 'degree' => null, 'profession' => null,
                    ]
                );
                $vmUser->roles()->syncWithoutDetaching([$memberRole->id]); // Assign general member role
                if ($vmPosition) {
                    $vmUser->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $vmPosition->id]]);
                }
            }
        }

        // --- Members of R∴ L∴ NRO. 175 (Hans Hauschildt) ---
        $rl175Lodge = Lodge::where('name', 'Hans Hauschildt')->first();
        if ($rl175Lodge) {
            $membersData = [
                ['Apellidos Nombres' => 'Carvajal Alfonzo Raúl Homero', 'Cédula' => '2.154.528', 'Fecha de Nacimiento' => '28/11/1941', 'Fecha de iniciación' => '09/02/1991', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04249392409', 'CORREO' => 'rhoca868@gmail.com', 'PROFESION' => 'Ingeniero'],
                ['Apellidos Nombres' => 'Sierra Palacios José Ramón', 'Cédula' => '5.335.725', 'Fecha de Nacimiento' => '17/03/1958', 'Fecha de iniciación' => '09/12/2000', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04166873301', 'CORREO' => 'siejose@gmail.com', 'PROFESION' => 'T.S.U. Metalurgia'],
                ['Apellidos Nombres' => 'Medina Carlos Eduardo', 'Cédula' => '9.812.648', 'Fecha de Nacimiento' => '14/01/1967', 'Fecha de iniciación' => '28/10/2006', 'Ap∴' => 1, 'M∴ C∴' => 0, 'M∴ M∴' => 0, 'Teléfono' => '04148941429', 'CORREO' => 'carlosmedina1467@gmail.com', 'PROFESION' => 'Abogado'],
                ['Apellidos Nombres' => 'Marín la Rosa Francisco Javier', 'Cédula' => '8.370.707', 'Fecha de Nacimiento' => '05/02/1963', 'Fecha de iniciación' => '05/05/1990', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04148672971', 'CORREO' => 'marinlarosa@gmail.com', 'PROFESION' => 'Ingeniero'],
                ['Apellidos Nombres' => 'Escorihuela Blanco Nelson Wilfredo', 'Cédula' => '3.627.857', 'Fecha de Nacimiento' => '18/04/1955', 'Fecha de iniciación' => '10/10/1992', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04148971552', 'CORREO' => 'nescorihuela@gmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Milne Martínez Carlos Santiago', 'Cédula' => '8.933.593', 'Fecha de Nacimiento' => '19/04/1967', 'Fecha de iniciación' => '21/06/2008', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148672828', 'CORREO' => 'drcarlosmilne@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Velásquez Díaz Antonio José', 'Cédula' => '17.432.300', 'Fecha de Nacimiento' => '30/08/1984', 'Fecha de iniciación' => '20/10/2007', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249651882', 'CORREO' => 'velasquezantonio84@gmail.com', 'PROFESION' => 'Ingeniero'],
                ['Apellidos Nombres' => 'Farrera Rodríguez David Jesús', 'Cédula' => '8.179.402', 'Fecha de Nacimiento' => '25/12/1964', 'Fecha de iniciación' => '03/04/2011', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148675479', 'CORREO' => 'davidjfarrera@gmail.com', 'PROFESION' => 'Mecánico'],
                ['Apellidos Nombres' => 'Cambridge Daniels Leonardo Alexander', 'Cédula' => '8.523.984', 'Fecha de Nacimiento' => '31/01/1961', 'Fecha de iniciación' => '13/06/2014', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148693258', 'CORREO' => 'leonardo.cambridge@gmail.com', 'PROFESION' => 'T.S.U. Administración'],
                ['Apellidos Nombres' => 'Sandoval Gutíerrez Obdrus Rafael', 'Cédula' => '16.395.555', 'Fecha de Nacimiento' => '28/10/1982', 'Fecha de iniciación' => '23/02/2013', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148742474', 'CORREO' => 'obdrusan@yahoo.es', 'PROFESION' => 'Ingeniero'],
                ['Apellidos Nombres' => 'Rondón Malave Carlos Alberto', 'Cédula' => '4.035.046', 'Fecha de Nacimiento' => '11/11/1955', 'Fecha de iniciación' => '08/10/2017', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04147647640', 'CORREO' => 'rondonmalave@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Colina Adrianza José Gregorio', 'Cédula' => '8.179.762', 'Fecha de Nacimiento' => '19/12/1962', 'Fecha de iniciación' => '22/08/1998', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249079903', 'CORREO' => 'jgcolina62@gmail.com', 'PROFESION' => 'Ingeniero'],
                ['Apellidos Nombres' => 'Villarroel Linch Ernesto José', 'Cédula' => '4.939.353', 'Fecha de Nacimiento' => '19/03/1958', 'Fecha de iniciación' => '08/11/1986', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04148753649', 'CORREO' => 'ernestovillarroel58@gmail.com', 'PROFESION' => 'Abogado'],
                ['Apellidos Nombres' => 'Osuna Dugarte Iván Alfonso', 'Cédula' => '3.995.520', 'Fecha de Nacimiento' => '18/08/1954', 'Fecha de iniciación' => '15/06/1994', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04147643476', 'CORREO' => 'traumatosuna@hotmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Hurtado Davila Mario Gabriel', 'Cédula' => '4.163.007', 'Fecha de Nacimiento' => '20/06/1956', 'Fecha de iniciación' => '01/03/2005', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04128370284', 'CORREO' => 'mario.hurtadodavila4@gmail.com', 'PROFESION' => 'Arquitecto'],
                ['Apellidos Nombres' => 'Dacduk Flores Tony José', 'Cédula' => '4.696.820', 'Fecha de Nacimiento' => '11/01/1956', 'Fecha de iniciación' => '18/07/2018', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04148716779', 'CORREO' => 'tondac2@hotmail.com', 'PROFESION' => 'Técnico Construcción Civil'],
                ['Apellidos Nombres' => 'Dona Quijada Oswaldo Enrique', 'Cédula' => '3.801.116', 'Fecha de Nacimiento' => '18/01/1951', 'Fecha de iniciación' => '18/06/1975', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04142216998', 'CORREO' => 'doloswal72@hotmail.com', 'PROFESION' => 'Militar Retirado'],
                ['Apellidos Nombres' => 'Guormetts Bethelmy Carlos Eduardo', 'Cédula' => '12.004.311', 'Fecha de Nacimiento' => '06/06/1973', 'Fecha de iniciación' => '18/11/2019', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249013982', 'CORREO' => 'carlosguormetts06@hotmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Ramírez Padilla Carlos Daniel', 'Cédula' => '12.131.544', 'Fecha de Nacimiento' => '12/07/1976', 'Fecha de iniciación' => '16/06/2018', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04147636027', 'CORREO' => 'ramirezcarlosdaniel@gmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Guerrero Alviarez Franklin Alfredo', 'Cédula' => '18.161.744', 'Fecha de Nacimiento' => '13/11/1986', 'Fecha de iniciación' => '15/11/2014', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04162873234', 'CORREO' => 'guerrero.18franklin@gmail.com', 'PROFESION' => 'Militar'],
                ['Apellidos Nombres' => 'Sanchez Lira Oscar Rafael', 'Cédula' => '20.817.622', 'Fecha de Nacimiento' => '20/12/1992', 'Fecha de iniciación' => '18/11/2016', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04249098350', 'CORREO' => 'oscarsanchezlira7@gmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Almao Murillo Luis Alejandro', 'Cédula' => '13.887.727', 'Fecha de Nacimiento' => '15/03/1980', 'Fecha de iniciación' => '17/05/2010', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04143210093', 'CORREO' => 'laam27@hotmail.com', 'PROFESION' => 'T.S.U. Informática'],
                ['Apellidos Nombres' => 'Rosas Medina Carlos Alberto', 'Cédula' => '8.956.757', 'Fecha de Nacimiento' => '27/02/1966', 'Fecha de iniciación' => '10/06/2013', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04143853224', 'CORREO' => 'carlosalbertorosasmedina@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'La Torre Mejia Roque Carmine', 'Cédula' => '15.320.822', 'Fecha de Nacimiento' => '23/12/1981', 'Fecha de iniciación' => '24/08/2019', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04143640444', 'CORREO' => 'roquelatorre@hotmail.com', 'PROFESION' => 'Ingeniero Civil'],
                ['Apellidos Nombres' => 'Quintero Aguilar Luis Fernando', 'Cédula' => '5.778.325', 'Fecha de Nacimiento' => '16/09/1964', 'Fecha de iniciación' => '31/05/2003', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04126948550', 'CORREO' => 'lf.quintero7@gmail.com', 'PROFESION' => 'Ingeniero de Sistemas'],
                ['Apellidos Nombres' => 'Said Alberto Sakha Herrera', 'Cédula' => '13.573.330', 'Fecha de Nacimiento' => '13/04/1979', 'Fecha de iniciación' => '04/06/2017', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04148645875', 'CORREO' => 'saidsaha@gmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Torres Da Freitas Ricardo José', 'Cédula' => '11.723.879', 'Fecha de Nacimiento' => '09/01/1974', 'Fecha de iniciación' => '14/06/2022', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249218770', 'CORREO' => 'terapytorres09@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Salas Orta Antonio Rafael', 'Cédula' => '8.376.726', 'Fecha de Nacimiento' => '29/05/1964', 'Fecha de iniciación' => '14/06/2022', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04164908379', 'CORREO' => 'asalas29@hotmail.com', 'PROFESION' => 'Lic. Sociología'],
                ['Apellidos Nombres' => 'Alvarez Carcovich Roberto Antonio', 'Cédula' => '16.008.719', 'Fecha de Nacimiento' => '10/11/1982', 'Fecha de iniciación' => '21/03/2005', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148570871', 'CORREO' => 'robertoalvarezcarcovich@gmail.com', 'PROFESION' => 'Ingeniero'],
                ['Apellidos Nombres' => 'Mendez Velasquez King Michael', 'Cédula' => '14.634.595', 'Fecha de Nacimiento' => '16/08/1979', 'Fecha de iniciación' => '19/09/2021', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04249110198', 'CORREO' => 'maderarted@gmail.com', 'PROFESION' => 'Carpintero'],
                ['Apellidos Nombres' => 'Garcia Catoni Carlos Rafael', 'Cédula' => '13.335.913', 'Fecha de Nacimiento' => '29/05/1977', 'Fecha de iniciación' => '25/09/2004', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 1, 'Teléfono' => '04166763404', 'CORREO' => 'cgcatoni@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Da Silva Parra Armando Alexander', 'Cédula' => '11.515.978', 'Fecha de Nacimiento' => '06/02/1972', 'Fecha de iniciación' => '28/03/2023', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249076175', 'CORREO' => 'aadasilva16@gmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Mendez Parra Hector Eduardo', 'Cédula' => '8.523.952', 'Fecha de Nacimiento' => '07/08/1961', 'Fecha de iniciación' => '29/07/2023', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249038829', 'CORREO' => 'edumendez61@gmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Ramírez Carvajal Jesús Alberto', 'Cédula' => '12.680.722', 'Fecha de Nacimiento' => '21/06/1977', 'Fecha de iniciación' => '03/04/2011', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148687133', 'CORREO' => 'jealraca@gmail.com', 'PROFESION' => 'Abogado'],
                ['Apellidos Nombres' => 'Bravo Requena Juan Carlos', 'Cédula' => '12.429.547', 'Fecha de Nacimiento' => '03/02/1976', 'Fecha de iniciación' => '28/03/2023', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04166872381', 'CORREO' => 'juancarlosbravo25@hotmail.com', 'PROFESION' => 'Comerciante'],
                ['Apellidos Nombres' => 'Lopez Martinez Nelson Eduardo', 'Cédula' => '17.633.126', 'Fecha de Nacimiento' => '17/01/1986', 'Fecha de iniciación' => '29/07/2023', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249056534', 'CORREO' => 'nelsone17@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Hamilton Gutierrez Jhon Ricardo', 'Cédula' => '21.251.687', 'Fecha de Nacimiento' => '02/10/1993', 'Fecha de iniciación' => '07/12/2023', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04249727326', 'CORREO' => 'hamiltongutierrezjr@gmail.com', 'PROFESION' => 'Médico'],
                ['Apellidos Nombres' => 'Doering Aguirrez Eduardo Andres', 'Cédula' => '15.907.045', 'Fecha de Nacimiento' => '28/08/1974', 'Fecha de iniciación' => '16/04/2024', 'Ap∴' => 1, 'M∴ C∴' => 1, 'M∴ M∴' => 0, 'Teléfono' => '04148977459', 'CORREO' => 'edoering37@gmail.com', 'PROFESION' => 'T.S.U. Informática'],
            ];

            foreach ($membersData as $memberData) {
                $degree = 'Aprendiz';
                if ($memberData['M∴ C∴'] == 1) $degree = 'Compañero';
                if ($memberData['M∴ M∴'] == 1) $degree = 'Maestro Masón';

                $email = $memberData['CORREO'] ?? Str::slug($memberData['Apellidos Nombres']) . '@example.com';
                $nationalId = str_replace(['.', ','], '', $memberData['Cédula']); // Clean national_id

                User::firstOrCreate(
                    ['national_id' => $nationalId],
                    [
                        'name' => $memberData['Apellidos Nombres'],
                        'email' => $email,
                        'password' => Hash::make('password'), // Default password for members
                        'birth_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $memberData['Fecha de Nacimiento'])->format('Y-m-d'),
                        'initiation_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $memberData['Fecha de iniciación'])->format('Y-m-d'),
                        'degree' => $degree,
                        'profession' => $memberData['PROFESION'],
                        'phone_number' => $memberData['Teléfono'],
                    ]
                )->lodges()->syncWithoutDetaching([$rl175Lodge->id => ['position_id' => $memberPosition->id]]);
            }
        }
    }
}