<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RealTimeProgressTracker;
use App\Services\ReportService;

class TestRealTimeProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:realtime-progress {--steps=10 : Number of steps to simulate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test command for real-time progress tracking system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando prueba del sistema de seguimiento en tiempo real...');

        // Crear instancia del tracker
        $tracker = new RealTimeProgressTracker();
        
        $taskId = $tracker->startTask('test_realtime_progress', [
            'description' => 'Prueba de seguimiento en tiempo real',
            'steps' => $this->option('steps')
        ]);

        $this->info("Tracker iniciado con ID: {$taskId}");
        $this->info('Iniciando simulación de proceso con seguimiento detallado...');

        $totalSteps = (int)$this->option('steps');
        
        for ($i = 1; $i <= $totalSteps; $i++) {
            $progress = ($i / $totalSteps) * 100;
            
            $stepMessage = "Simulando paso {$i} de {$totalSteps}";
            $tracker->step($stepMessage, $progress, [
                'step_number' => $i,
                'total_steps' => $totalSteps,
                'estimated_completion' => now()->addSeconds(($totalSteps - $i) * 0.5)->format('H:i:s')
            ]);
            
            $this->info("  Paso {$i}/{$totalSteps} - Progreso: {$progress}%");
            
            // Simular trabajo
            sleep(1);
            
            // Cada 3 pasos, registrar información adicional
            if ($i % 3 == 0) {
                $tracker->info("Punto de control alcanzado", [
                    'checkpoint' => $i,
                    'progress' => $progress,
                    'timestamp' => now()->toISOString()
                ]);
            }
        }

        // Registrar métricas finales
        $summary = [
            'total_steps_completed' => $totalSteps,
            'average_time_per_step' => '1s',
            'peak_memory_used' => $tracker->getPerformanceMetrics()['end_peak_memory'] ?? 'N/A'
        ];

        $tracker->endTask(true, $summary);

        $this->info('');
        $this->info('✅ Prueba completada exitosamente');
        $this->info('📊 Métricas recolectadas:');
        
        $metrics = $tracker->getPerformanceMetrics();
        $this->info("  - Duración total: {$metrics['total_duration']}");
        $this->info("  - Total de pasos: {$metrics['total_steps']}");
        $this->info("  - ID de tarea: {$taskId}");
        
        $progressSummary = $tracker->getProgressSummary();
        $this->info("  - Progreso final: {$progressSummary['current_progress']}%");
        
        if ($this->confirm('¿Deseas exportar los datos de seguimiento?', false)) {
            $exportData = $tracker->exportProgressData();
            $filename = "progress_test_export_{$taskId}_" . now()->format('Y-m-d_H-i-s') . '.json';
            $filepath = storage_path("app/{$filename}");
            
            file_put_contents($filepath, json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            
            $this->info("Datos exportados a: {$filepath}");
        }

        return 0;
    }
}