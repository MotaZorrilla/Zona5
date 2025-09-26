<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ReportService;
use App\Services\AsyncTaskService;

class TestReportGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:report-generation {--debug : Habilitar modo de depuración detallada}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para probar el sistema de generación de reportes con seguimiento detallado';

    /**
     * Execute the console command.
     */
    public function handle(ReportService $reportService, AsyncTaskService $asyncTaskService)
    {
        $this->info('Iniciando prueba del sistema de generación de reportes...');
        
        // Generar un ID de tarea para este test
        $taskId = uniqid('test_', true);
        
        // Inicializar servicio de depuración con el ID de tarea
        $debug = new \App\Services\DebugService(true, $taskId);
        
        if ($this->option('debug')) {
            $debug->setEnabled(true);
            $this->info('Modo de depuración habilitado');
        } else {
            $debug->setEnabled(false);
            $this->info('Modo de depuración deshabilitado (solo registros básicos)');
        }
        
        $debug->startTask('TestReportGeneration', 'Iniciando prueba de generación de reportes');
        
        try {
            // Simular rango de fechas
            $dateRange = [
                'start' => now()->subMonths(6)->startOfDay(),
                'end' => now()->endOfDay()
            ];
            
            $debug->step('Rango de fechas configurado', 10, json_encode($dateRange));
            
            $this->info('1. Probando generación de datos del reporte...');
            // Inyectar debug service en el report service para que los logs vayan al archivo de esta tarea
            $reportServiceWithDebug = new ReportService($debug);
            $reportData = $reportServiceWithDebug->generateReportData($dateRange, ['include_charts' => true]);
            
            $debug->step('Datos del reporte generados', 50);
            $debug->info('Número de secciones generadas', count($reportData));
            
            $this->info('2. Probando creación de tarea asíncrona...');
            $taskId = $asyncTaskService->createTask('pdf_report_test', [
                'dateRange' => $dateRange,
                'options' => ['include_charts' => true]
            ]);
            
            $debug->step('Tarea asíncrona creada', 70, "Task ID: {$taskId}");
            
            $this->info('3. Probando obtención del estado de la tarea...');
            $taskStatus = $asyncTaskService->getTaskStatus($taskId);
            
            $debug->step('Estado de la tarea obtenido', 80, "Status: {$taskStatus['status']}");
            
            $this->info('4. Probando actualización de progreso...');
            $asyncTaskService->updateProgress($taskId, 25, 'Progreso de prueba');
            
            $debug->step('Progreso actualizado', 90);
            
            $this->info('5. Probando finalización de tarea...');
            $asyncTaskService->completeTask($taskId, ['test' => 'completed']);
            
            $debug->step('Tarea completada', 100);
            
            $debug->endTask(true, 'Prueba de generación de reportes completada exitosamente');
            
            $this->info('✅ Prueba completada exitosamente');
            $this->info("   - Fecha de inicio: " . $dateRange['start']->format('Y-m-d H:i:s'));
            $this->info("   - Fecha de fin: " . $dateRange['end']->format('Y-m-d H:i:s'));
            $this->info("   - Número de secciones en el reporte: " . count($reportData));
            $this->info("   - ID de la tarea: {$taskId}");
            
            if ($this->option('debug')) {
                $this->info("\n📝 Puedes revisar los logs de depuración en:");
                $this->info("   - storage/logs/laravel.log (logs generales)");
                $this->info("   - storage/logs/tasks/{$taskId}.log (logs específicos de esta prueba)");
                $this->info("   Cada paso del proceso ha sido registrado con marca de tiempo y detalles");
            }
            
        } catch (\Exception $e) {
            $debug->error('Error durante la prueba', $e->getMessage());
            $debug->endTask(false, 'Prueba fallida: ' . $e->getMessage());
            
            $this->error('❌ Error durante la prueba: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}