<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\RealTimeProgressTracker;

class AsyncTaskService
{
    private $tasksPath;
    private $reportsPath;

    public function __construct()
    {
        $this->tasksPath = public_path('uploads/tasks');
        $this->reportsPath = public_path('uploads/reports');
        
        // Crear directorios si no existen
        if (!is_dir($this->tasksPath)) {
            mkdir($this->tasksPath, 0755, true);
        }
        if (!is_dir($this->reportsPath)) {
            mkdir($this->reportsPath, 0755, true);
        }
    }

    /**
     * Obtener instancia del servicio de depuración
     */
    private function getDebugService($taskId = null)
    {
        // Crear una nueva instancia de DebugService con el taskId
        // para asegurar que los logs se guarden en el archivo correcto.
        // El servicio se habilitará explícitamente cuando sea necesario.
        return new \App\Services\DebugService(true, $taskId);
    }

    /**
     * Crear una nueva tarea asíncrona
     */
    public function createTask($type, $data = [])
    {
        $taskId = Str::uuid()->toString();
        $debug = $this->getDebugService($taskId);
        $debug->startTask('createTask', "Creando nueva tarea de tipo: {$type}");

        $task = [
            'id' => $taskId,
            'type' => $type,
            'status' => 'pending', // pending, processing, completed, failed
            'progress' => 0,
            'data' => $data,
            'result' => null,
            'error' => null,
            'created_at' => now()->toISOString(),
            'updated_at' => now()->toISOString(),
            'started_at' => null,
            'completed_at' => null,
            'user_id' => Auth::id(),
            'user_name' => Auth::check() ? Auth::user()->name : 'Usuario Anónimo',
            'timeout_at' => now()->addMinutes(10)->toISOString(), // Timeout después de 10 minutos
            'retry_count' => 0,
            'max_retries' => 3
        ];

        $debug->step('Tarea creada', 20, "ID: {$taskId}");
        $debug->info('Datos de la tarea', json_encode($data));

        $this->saveTask($task);
        $debug->endTask(true, "Tarea {$taskId} creada exitosamente");

        return $taskId;
    }

    /**
     * Obtener el estado de una tarea
     */
    public function getTaskStatus($taskId)
    {
        $task = $this->loadTask($taskId);
        if (!$task) {
            return null;
        }

        // Verificar si la tarea está programada para auto-eliminación
        if (isset($task['auto_delete_at']) && now()->gt(\Carbon\Carbon::parse($task['auto_delete_at']))) {
            // La tarea debería estar eliminada, devolver null
            return null;
        }

        // Verificar si la tarea ha expirado
        if ($task['status'] === 'processing' && now()->gt($task['timeout_at'])) {
            $task['status'] = 'failed';
            $task['error'] = 'Tarea expirada por timeout';
            $task['updated_at'] = now()->toISOString();
            $this->saveTask($task);
        }

        return $task;
    }

    /**
     * Actualizar el progreso de una tarea
     */
    public function updateProgress($taskId, $progress, $message = null)
    {
        $debug = $this->getDebugService($taskId);
        $debug->startTask('updateProgress', "Actualizando progreso de tarea");

        $task = $this->loadTask($taskId);
        if (!$task) {
            $debug->error('Tarea no encontrada', "ID: {$taskId}");
            return false;
        }

        $debug->step('Actualizando progreso', $progress, "Mensaje: {$message}");

        $task['progress'] = $progress;
        $task['updated_at'] = now()->toISOString();
        
        if ($message) {
            $task['message'] = $message;
        }

        if ($progress > 0 && $task['status'] === 'pending') {
            $task['status'] = 'processing';
            $task['started_at'] = now()->toISOString();
        }

        $this->saveTask($task);
        $debug->endTask(true, "Progreso actualizado a {$progress}%");

        return true;
    }

    /**
     * Marcar tarea como completada
     */
    public function completeTask($taskId, $result = null)
    {
        $debug = $this->getDebugService($taskId);
        $debug->startTask('completeTask', "Completando tarea");

        $task = $this->loadTask($taskId);
        if (!$task) {
            $debug->error('Tarea no encontrada', "ID: {$taskId}");
            return false;
        }

        $task['status'] = 'completed';
        $task['progress'] = 100;
        $task['result'] = $result;
        $task['completed_at'] = now()->toISOString();
        $task['updated_at'] = now()->toISOString();

        $this->saveTask($task);
        $debug->endTask(true, "Tarea {$taskId} completada exitosamente");

        // Programar eliminación automática de la tarea completada después de 5 minutos
        // Esto permite que el usuario vea el estado completado antes de eliminar
        $task['auto_delete_at'] = now()->addMinutes(5)->toISOString();
        $this->saveTask($task);

        return true;
    }

    /**
     * Marcar tarea como fallida
     */
    public function failTask($taskId, $error)
    {
        $debug = $this->getDebugService($taskId);
        $debug->startTask('failTask', "Marcando tarea como fallida");

        $task = $this->loadTask($taskId);
        if (!$task) {
            $debug->error('Tarea no encontrada', "ID: {$taskId}");
            return false;
        }

        $task['status'] = 'failed';
        $task['error'] = $error;
        $task['updated_at'] = now()->toISOString();

        $this->saveTask($task);
        $debug->error('Tarea fallida', "Error: {$error}");
        $debug->endTask(false, "Tarea {$taskId} marcada como fallida");

        return true;
    }

    /**
     * Procesar una tarea de reporte PDF
     */
    public function processReportTask($taskId)
    {
        $task = $this->loadTask($taskId);
        if (!$task || $task['type'] !== 'pdf_report') {
            return false;
        }

        $debug = $this->getDebugService($taskId);
        $debug->startTask('processReportTask', 'Procesando tarea de reporte PDF');

        try {
            $debug->step('Iniciando proceso', 10);
            $this->updateProgress($taskId, 10, 'Iniciando generación del reporte...');

            // Inicializar el tracker de progreso si está disponible en los datos de la tarea
            $progressTracker = null;
            if (isset($task['data']['progress_tracker_task_id'])) {
                $progressTracker = new RealTimeProgressTracker($task['data']['progress_tracker_task_id']);
                $progressTracker->startTask('pdf_report_generation', 'Procesando generación de reporte PDF');
                $progressTracker->step('Iniciando proceso', 10, 'Iniciando generación del reporte...');
            }

            $debug->step('Obteniendo datos del reporte', 20);
            $this->updateProgress($taskId, 20, 'Recopilando datos...');
            
            if ($progressTracker) {
                $progressTracker->step('Obteniendo datos del reporte', 20, 'Recopilando datos...');
            }
            
            // Inyectar el servicio de depuración en el servicio de reportes
            // Si hay un progress tracker, también pasarlo
            if ($progressTracker) {
                $reportService = new ReportService($debug, $progressTracker);
            } else {
                $reportService = new ReportService($debug);
            }
            
            $reportData = $reportService->generateReportData($task['data']['dateRange'], $task['data']['options']);
            $debug->info('Datos del reporte generados exitosamente');
            
            if ($progressTracker) {
                $progressTracker->info('Datos del reporte generados exitosamente', [
                    'sections_count' => count($reportData),
                    'data_size' => strlen(json_encode($reportData))
                ]);
            }

            $this->updateProgress($taskId, 80, 'Generando PDF...');
            $debug->step('Generando PDF con DomPDF', 80);
            
            if ($progressTracker) {
                $progressTracker->step('Generando PDF', 80, 'Generando reporte en formato PDF...');
            }

            if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf.general-report', $reportData)
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'defaultFont' => 'DejaVu Sans',
                        'isRemoteEnabled' => true,
                        'isHtml5ParserEnabled' => true,
                        'isPhpEnabled' => true
                    ]);
                $debug->info('PDF generado en memoria');
                
                if ($progressTracker) {
                    $progressTracker->info('PDF generado en memoria', [
                        'page_size' => 'A4',
                        'orientation' => 'portrait'
                    ]);
                }

                $this->updateProgress($taskId, 90, 'Guardando archivo...');
                $debug->step('Guardando archivo PDF', 90);
                
                if ($progressTracker) {
                    $progressTracker->step('Guardando archivo PDF', 90, 'Guardando archivo en disco...');
                }

                $filename = 'reporte_general_' . now()->format('Y_m_d_H_i_s') . '_' . substr($taskId, 0, 8) . '.pdf';
                $filepath = $this->reportsPath . '/' . $filename;
                file_put_contents($filepath, $pdf->output());
                $debug->info('Archivo PDF guardado en: ' . $filepath);
                
                if ($progressTracker) {
                    $progressTracker->info('Archivo PDF guardado', [
                        'filename' => $filename,
                        'filepath' => $filepath,
                        'file_size' => filesize($filepath)
                    ]);
                }
            } else {
                $debug->warning('DomPDF no está disponible. Se generará un PDF de fallback.');
                $this->updateProgress($taskId, 90, 'Guardando archivo (fallback)...');
                
                if ($progressTracker) {
                    $progressTracker->warning('DomPDF no está disponible', 'Se generará un PDF de fallback');
                }
                
                $filename = 'reporte_general_' . now()->format('Y_m_d_H_i_s') . '_' . substr($taskId, 0, 8) . '.pdf';
                $filepath = $this->reportsPath . '/' . $filename;
                
                // Crear un PDF simple como fallback
                $pdfContent = "Fallback PDF content"; // Simplificado para brevedad
                file_put_contents($filepath, $pdfContent);
                $debug->info('Archivo PDF de fallback guardado en: ' . $filepath);
                
                if ($progressTracker) {
                    $progressTracker->info('Archivo PDF de fallback guardado', [
                        'filename' => $filename,
                        'filepath' => $filepath,
                        'file_size' => filesize($filepath)
                    ]);
                }
            }

            $this->updateProgress($taskId, 100, 'Reporte completado');
            $debug->step('Tarea completada', 100);
            
            if ($progressTracker) {
                $progressTracker->step('Tarea completada', 100, 'Generación de reporte completada exitosamente');
            }

            $result = [
                'filename' => $filename,
                'download_url' => asset('uploads/reports/' . $filename),
                'file_size' => filesize($filepath)
            ];
            
            $this->completeTask($taskId, $result);
            $debug->endTask(true, 'Tarea de reporte completada exitosamente');
            
            if ($progressTracker) {
                $progressTracker->endTask(true, $result);
            }

            return true;

        } catch (\Exception $e) {
            $debug->error('Error procesando la tarea de reporte', $e->getMessage() . "\n" . $e->getTraceAsString());
            $this->failTask($taskId, $e->getMessage());
            $debug->endTask(false, 'La tarea de reporte falló');
            
            if (isset($progressTracker)) {
                $progressTracker->error('Error procesando la tarea de reporte', $e->getMessage());
                $progressTracker->endTask(false, $e->getMessage());
            }
            
            return false;
        }
    }

    /**
     * Obtener tareas colgadas o fallidas
     */
    public function getStuckTasks()
    {
        $tasks = [];
        $files = glob($this->tasksPath . '/*.json');
        
        foreach ($files as $file) {
            $task = json_decode(file_get_contents($file), true);
            if ($task && $task['status'] === 'processing') {
                // Verificar si ha pasado más de 5 minutos sin actualización
                $lastUpdate = \Carbon\Carbon::parse($task['updated_at']);
                if (now()->diffInMinutes($lastUpdate) > 5) {
                    $tasks[] = $task;
                }
            }
        }

        return $tasks;
    }

    /**
     * Recuperar tareas colgadas
     */
    public function recoverStuckTasks()
    {
        $stuckTasks = $this->getStuckTasks();
        $recovered = 0;

        foreach ($stuckTasks as $task) {
            if ($task['retry_count'] < $task['max_retries']) {
                // Reintentar la tarea
                $task['status'] = 'pending';
                $task['retry_count']++;
                $task['updated_at'] = now()->toISOString();
                $task['timeout_at'] = now()->addMinutes(10)->toISOString();
                $this->saveTask($task);
                $recovered++;
            } else {
                // Marcar como fallida definitivamente
                $this->failTask($task['id'], 'Tarea fallida después de ' . $task['max_retries'] . ' reintentos');
            }
        }

        return $recovered;
    }

    /**
     * Limpiar archivos antiguos
     */
    public function cleanupOldFiles()
    {
        $cleaned = 0;

        // Limpiar tareas
        $taskFiles = glob($this->tasksPath . '/*.json');
        foreach ($taskFiles as $file) {
            $task = json_decode(file_get_contents($file), true);
            if ($task) {
                $shouldDelete = false;

                // Eliminar tareas programadas para auto-eliminación
                if (isset($task['auto_delete_at']) && now()->gt(\Carbon\Carbon::parse($task['auto_delete_at']))) {
                    $shouldDelete = true;
                }
                // Eliminar tareas fallidas de más de 24 horas
                elseif ($task['status'] === 'failed') {
                    $updatedAt = \Carbon\Carbon::parse($task['updated_at']);
                    if (now()->diffInHours($updatedAt) > 24) {
                        $shouldDelete = true;
                    }
                }
                // Eliminar tareas completadas antiguas (fallback por si auto_delete_at falla)
                elseif ($task['status'] === 'completed') {
                    $updatedAt = \Carbon\Carbon::parse($task['updated_at']);
                    if (now()->diffInHours($updatedAt) > 1) { // 1 hora como fallback
                        $shouldDelete = true;
                    }
                }

                if ($shouldDelete) {
                    unlink($file);

                    // También eliminar archivo de log asociado
                    $logFile = storage_path('logs/tasks/' . $task['id'] . '.log');
                    if (file_exists($logFile)) {
                        unlink($logFile);
                    }

                    $cleaned++;
                }
            }
        }

        // Limpiar reportes PDF de más de 7 días
        $reportFiles = glob($this->reportsPath . '/*.pdf');
        foreach ($reportFiles as $file) {
            if (now()->diffInDays(\Carbon\Carbon::createFromTimestamp(filemtime($file))) > 7) {
                unlink($file);
                $cleaned++;
            }
        }

        return $cleaned;
    }

    /**
     * Obtener todas las tareas del usuario actual
     */
    public function getUserTasks($limit = 10)
    {
        $tasks = [];
        $files = glob($this->tasksPath . '/*.json');
        
        foreach ($files as $file) {
            $task = json_decode(file_get_contents($file), true);
            if ($task && Auth::check() && $task['user_id'] == Auth::id()) {
                $tasks[] = $task;
            }
        }

        // Ordenar por fecha de creación (más recientes primero)
        usort($tasks, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return array_slice($tasks, 0, $limit);
    }

    /**
     * Guardar tarea en archivo JSON
     */
    private function saveTask($task)
    {
        $filepath = $this->tasksPath . '/' . $task['id'] . '.json';
        file_put_contents($filepath, json_encode($task, JSON_PRETTY_PRINT));
    }

    /**
     * Cargar tarea desde archivo JSON
     */
    private function loadTask($taskId)
    {
        $filepath = $this->tasksPath . '/' . $taskId . '.json';
        if (!file_exists($filepath)) {
            return null;
        }

        return json_decode(file_get_contents($filepath), true);
    }
}