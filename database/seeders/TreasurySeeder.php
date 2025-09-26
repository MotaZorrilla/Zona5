<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treasury;
use App\Models\User;
use App\Models\Lodge;
use Carbon\Carbon;

class TreasurySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurarse de que existan usuarios para asociar
        $users = User::all();
        
        if ($users->count() === 0) {
            $this->command->error('No hay usuarios disponibles. Por favor, asegúrate de ejecutar UserSeeder primero.');
            return;
        }
        
        $user_id = $users->first()->id;
        
        // Gastos relacionados con la creación del portal digital (financiados por Héctor Mota)
        Treasury::create([
            'description' => 'Diseño y desarrollo del portal digital de la Gran Logia',
            'type' => 'expense',
            'amount' => 350.00,
            'category' => 'Desarrollo Tecnológico',
            'transaction_date' => Carbon::create(2025, 8, 15),
            'reference' => 'PORTAL-001',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Gasto financiado por Héctor Mota - Desarrollo del sistema web'
        ]);
        
        Treasury::create([
            'description' => 'Adquisición de dominio y configuración DNS para portal digital',
            'type' => 'expense',
            'amount' => 15.00,
            'category' => 'Desarrollo Tecnológico',
            'transaction_date' => Carbon::create(2025, 8, 16),
            'reference' => 'PORTAL-002',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Gasto financiado por Héctor Mota - Registro de dominio'
        ]);
        
        Treasury::create([
            'description' => 'Servicio de hosting anual para portal digital',
            'type' => 'expense',
            'amount' => 120.00,
            'category' => 'Desarrollo Tecnológico',
            'transaction_date' => Carbon::create(2025, 8, 17),
            'reference' => 'PORTAL-003',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Gasto financiado por Héctor Mota - Servicio de hosting'
        ]);
        
        Treasury::create([
            'description' => 'Certificado SSL para portal digital',
            'type' => 'expense',
            'amount' => 50.00,
            'category' => 'Desarrollo Tecnológico',
            'transaction_date' => Carbon::create(2025, 8, 18),
            'reference' => 'PORTAL-004',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Gasto financiado por Héctor Mota - Seguridad del portal'
        ]);
        
        Treasury::create([
            'description' => 'Licencia de software para desarrollo del portal',
            'type' => 'expense',
            'amount' => 80.00,
            'category' => 'Desarrollo Tecnológico',
            'transaction_date' => Carbon::create(2025, 8, 19),
            'reference' => 'PORTAL-005',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Gasto financiado por Héctor Mota - Licencias necesarias'
        ]);
        
        // Aporte relacionado con el portal digital (100 dólares del querido hermano Luis Bartolo)
        Treasury::create([
            'description' => 'Aporte del Q∴H∴ Luis Bartolo, Presidente de la Zona para portal digital',
            'type' => 'income',
            'amount' => 100.00,
            'category' => 'Aportes Especiales',
            'transaction_date' => Carbon::create(2025, 8, 20),
            'reference' => 'AP-001',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Aporte del querido hermano Luis Bartolo, Presidente de la Zona'
        ]);
        
        // Gastos relacionados con el Séptimo Evento Binacional entre Brasil y Venezuela
        Treasury::create([
            'description' => 'Gastos de transporte para delegación Venezolana al evento binacional',
            'type' => 'expense',
            'amount' => 450.00,
            'category' => 'Eventos',
            'transaction_date' => Carbon::create(2025, 9, 1),
            'reference' => 'BINACIONAL-001',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Gastos asumidos por varios hermanos de la delegación'
        ]);
        
        Treasury::create([
            'description' => 'Documentación y certificados para el VII Evento Binacional',
            'type' => 'expense',
            'amount' => 75.00,
            'category' => 'Eventos',
            'transaction_date' => Carbon::create(2025, 9, 2),
            'reference' => 'BINACIONAL-002',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Costos de impresión y documentación oficial'
        ]);
        
        Treasury::create([
            'description' => 'Gastos de logística y coordinación evento binacional',
            'type' => 'expense',
            'amount' => 200.00,
            'category' => 'Eventos',
            'transaction_date' => Carbon::create(2025, 9, 3),
            'reference' => 'BINACIONAL-003',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Costos asumidos por la Estrella de Roraima'
        ]);
        
        Treasury::create([
            'description' => 'Materiales para ceremonia conmemorativa del evento binacional',
            'type' => 'expense',
            'amount' => 125.00,
            'category' => 'Eventos',
            'transaction_date' => Carbon::create(2025, 9, 4),
            'reference' => 'BINACIONAL-004',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Suministros ceremoniales y conmemorativos'
        ]);
        
        Treasury::create([
            'description' => 'Aporte adicional para VII Evento Binacional',
            'type' => 'income',
            'amount' => 300.00,
            'category' => 'Aportes Evento',
            'transaction_date' => Carbon::create(2025, 9, 5),
            'reference' => 'BINACIONAL-005',
            'status' => 'completed',
            'user_id' => $user_id,
            'notes' => 'Aporte de Q∴H∴ para cubrir gastos del evento binacional'
        ]);
        
        // Saldo a cero para reflejar que todos los gastos están cubiertos
        $totalIngresos = Treasury::where('type', 'income')->sum('amount');
        $totalEgresos = Treasury::where('type', 'expense')->sum('amount');
        $diferencia = $totalEgresos - $totalIngresos;
        
        if ($diferencia > 0) {
            // Si hay diferencia, asumimos que es cubierta por Héctor Mota
            Treasury::create([
                'description' => 'Saldo cubierto por Héctor Mota para dejar cuenta en cero',
                'type' => 'income',
                'amount' => $diferencia,
                'category' => 'Financiamiento Personal',
                'transaction_date' => Carbon::now(),
                'reference' => 'BALANCE-001',
                'status' => 'completed',
                'user_id' => $user_id,
                'notes' => 'Financiado por Héctor Mota - Cierre de cuenta a cero'
            ]);
        } elseif ($diferencia < 0) {
            // Si sobra dinero, se registra como aporte adicional
            Treasury::create([
                'description' => 'Saldo adicional como aporte para proyectos futuros',
                'type' => 'income',
                'amount' => abs($diferencia),
                'category' => 'Aportes Futuros',
                'transaction_date' => Carbon::now(),
                'reference' => 'BALANCE-002',
                'status' => 'completed',
                'user_id' => $user_id,
                'notes' => 'Fondos adicionales para proyectos futuros'
            ]);
        }
    }
}
