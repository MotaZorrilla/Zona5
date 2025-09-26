<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Servicio de Seguimiento de Progreso en Tiempo Real
 * Proporciona un sistema integral de seguimiento para la generación de reportes
 */
class RealTimeProgressTracker
{
    private $taskId;
    private $startTime;
    private $debugService;
    private $progressUpdates = [];
    private $performanceMetrics = [];
    private $logPath;

    public function __construct($taskId = null)
    {
        $this->taskId = $taskId ?: Str::uuid()->toString();
        $this->startTime = microtime(true);
        $this->debugService = new DebugService(true, $this->taskId);
        $this->logPath = storage_path('logs/progress_tracker');
        
        if (!is_dir($this->logPath)) {
            mkdir($this->logPath, 0755, true);
        }
    }

    /**
     * Iniciar una tarea con seguimiento detallado
     */
    public function startTask($taskName, $initialMessage = null)
    {
        // Ensure initialMessage is a string for DebugService compatibility
        $stringMessage = is_array($initialMessage) ? json_encode($initialMessage) : $initialMessage;
        $this->debugService->startTask($taskName, $stringMessage);
        
        $this->logEvent('task_started', [
            'task_name' => $taskName,
            'task_id' => $this->taskId,
            'timestamp' => now()->toISOString(),
            'initial_message' => $initialMessage
        ]);

        $this->performanceMetrics['start_time'] = now()->toISOString();
        $this->performanceMetrics['start_memory'] = memory_get_usage(true);
        $this->performanceMetrics['start_peak_memory'] = memory_get_peak_usage(true);

        $this->logToConsole("TASK_STARTED: {$taskName}", [
            'taskId' => $this->taskId,
            'startTime' => $this->performanceMetrics['start_time'],
            'startMemory' => $this->formatBytes($this->performanceMetrics['start_memory'])
        ]);

        return $this->taskId;
    }

    /**
     * Registrar un paso en el proceso con porcentaje de progreso
     */
    public function step($stepName, $progress = 0, $additionalInfo = null)
    {
        // Ensure additionalInfo is properly formatted for DebugService
        $stringAdditionalInfo = is_array($additionalInfo) ? json_encode($additionalInfo) : $additionalInfo;
        $this->debugService->step($stepName, $progress, $stringAdditionalInfo);

        $progressData = [
            'step_name' => $stepName,
            'progress' => $progress,
            'additional_info' => $additionalInfo, // Keep original for internal tracking
            'timestamp' => now()->toISOString(),
            'elapsed_time' => $this->getElapsedTime(),
            'memory_usage' => $this->formatBytes(memory_get_usage(true)),
            'peak_memory_usage' => $this->formatBytes(memory_get_peak_usage(true))
        ];

        $this->progressUpdates[] = $progressData;

        $this->logEvent('step_completed', $progressData);

        $this->logToConsole("PROGRESS_UPDATE: {$progress}%", [
            'step' => $stepName,
            'info' => $additionalInfo,
            'time' => $this->getElapsedTime(),
            'memory' => $this->formatBytes(memory_get_usage(true))
        ]);

        return $progressData;
    }

    /**
     * Registrar información adicional
     */
    public function info($message, $additionalInfo = null)
    {
        // Ensure additionalInfo is properly formatted for DebugService
        $stringAdditionalInfo = is_array($additionalInfo) ? json_encode($additionalInfo) : $additionalInfo;
        $this->debugService->info($message, $stringAdditionalInfo);

        $infoData = [
            'message' => $message,
            'additional_info' => $additionalInfo, // Keep original for internal tracking
            'timestamp' => now()->toISOString(),
            'elapsed_time' => $this->getElapsedTime()
        ];

        $this->logEvent('info_logged', $infoData);

        $this->logToConsole("INFO: {$message}", $additionalInfo ? ['details' => $additionalInfo] : []);

        return $infoData;
    }

    /**
     * Registrar una advertencia
     */
    public function warning($message, $additionalInfo = null)
    {
        // Ensure additionalInfo is properly formatted for DebugService
        $stringAdditionalInfo = is_array($additionalInfo) ? json_encode($additionalInfo) : $additionalInfo;
        $this->debugService->warning($message, $stringAdditionalInfo);

        $warningData = [
            'message' => $message,
            'additional_info' => $additionalInfo, // Keep original for internal tracking
            'timestamp' => now()->toISOString(),
            'elapsed_time' => $this->getElapsedTime()
        ];

        $this->logEvent('warning_logged', $warningData);

        $this->logToConsole("WARNING: {$message}", $additionalInfo ? ['details' => $additionalInfo] : []);

        return $warningData;
    }

    /**
     * Registrar un error
     */
    public function error($message, $additionalInfo = null)
    {
        // Ensure additionalInfo is properly formatted for DebugService
        $stringAdditionalInfo = is_array($additionalInfo) ? json_encode($additionalInfo) : $additionalInfo;
        $this->debugService->error($message, $stringAdditionalInfo);

        $errorData = [
            'message' => $message,
            'additional_info' => $additionalInfo, // Keep original for internal tracking
            'timestamp' => now()->toISOString(),
            'elapsed_time' => $this->getElapsedTime()
        ];

        $this->logEvent('error_logged', $errorData);

        $this->logToConsole("ERROR: {$message}", $additionalInfo ? ['details' => $additionalInfo] : []);

        return $errorData;
    }

    /**
     * Registrar una consulta SQL o base de datos
     */
    public function query($query, $bindings = [], $time = null)
    {
        $this->debugService->query($query, $bindings, $time);

        $queryData = [
            'query' => $query,
            'bindings' => $bindings,
            'time_ms' => $time,
            'timestamp' => now()->toISOString(),
            'elapsed_time' => $this->getElapsedTime()
        ];

        $this->logEvent('query_executed', $queryData);

        $this->logToConsole("QUERY_EXECUTED", [
            'time' => $time ? $time . 'ms' : 'N/A',
            'query' => substr($query, 0, 100) . (strlen($query) > 100 ? '...' : '')
        ]);

        return $queryData;
    }

    /**
     * Finalizar el seguimiento de la tarea
     */
    public function endTask($success = true, $result = null)
    {
        $this->performanceMetrics['end_time'] = now()->toISOString();
        $this->performanceMetrics['end_memory'] = memory_get_usage(true);
        $this->performanceMetrics['end_peak_memory'] = memory_get_peak_usage(true);
        $this->performanceMetrics['total_duration'] = $this->getElapsedTime();
        $this->performanceMetrics['total_steps'] = count($this->progressUpdates);

        $this->debugService->endTask($success, $result);

        $taskSummary = [
            'task_id' => $this->taskId,
            'success' => $success,
            'result' => $result,
            'total_duration' => $this->performanceMetrics['total_duration'],
            'total_memory_used' => $this->formatBytes($this->performanceMetrics['end_memory'] - $this->performanceMetrics['start_memory']),
            'peak_memory_used' => $this->formatBytes($this->performanceMetrics['end_peak_memory']),
            'total_steps' => $this->performanceMetrics['total_steps'],
            'timestamp' => now()->toISOString()
        ];

        $this->logEvent('task_ended', $taskSummary);

        $this->logToConsole("TASK_COMPLETED: " . ($success ? "SUCCESS" : "FAILED"), [
            'taskId' => $this->taskId,
            'duration' => $this->performanceMetrics['total_duration'],
            'result' => $result
        ]);

        return $taskSummary;
    }

    /**
     * Obtener el ID de la tarea actual
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Obtener todas las actualizaciones de progreso
     */
    public function getProgressUpdates()
    {
        return $this->progressUpdates;
    }

    /**
     * Obtener métricas de rendimiento
     */
    public function getPerformanceMetrics()
    {
        return $this->performanceMetrics;
    }

    /**
     * Obtener un resumen del seguimiento de progreso
     */
    public function getProgressSummary()
    {
        return [
            'task_id' => $this->taskId,
            'total_steps' => count($this->progressUpdates),
            'last_progress' => !empty($this->progressUpdates) ? 
                end($this->progressUpdates)['progress'] : 0,
            'current_progress' => !empty($this->progressUpdates) ? 
                end($this->progressUpdates)['progress'] : 0,
            'progress_updates' => $this->progressUpdates,
            'performance_metrics' => $this->performanceMetrics,
            'elapsed_time' => $this->getElapsedTime(),
            'memory_usage' => $this->formatBytes(memory_get_usage(true))
        ];
    }

    /**
     * Registrar un evento en el archivo de seguimiento
     */
    private function logEvent($eventType, $data)
    {
        $logFile = $this->logPath . '/' . $this->taskId . '_progress.json';
        
        $logEntry = [
            'event_type' => $eventType,
            'data' => $data,
            'timestamp' => now()->toISOString(),
            'elapsed_ms' => round((microtime(true) - $this->startTime) * 1000)
        ];

        // Leer el archivo existente o crear uno nuevo
        $existingLogs = [];
        if (file_exists($logFile)) {
            $existingLogs = json_decode(file_get_contents($logFile), true);
            if (!$existingLogs) {
                $existingLogs = [];
            }
        }

        $existingLogs[] = $logEntry;

        // Mantener solo las últimas 1000 entradas para prevenir problemas de espacio
        if (count($existingLogs) > 1000) {
            $existingLogs = array_slice($existingLogs, -1000);
        }

        file_put_contents($logFile, json_encode($existingLogs, JSON_PRETTY_PRINT));
    }

    /**
     * Registrar en consola para seguimiento en tiempo real
     */
    private function logToConsole($message, $data = [])
    {
        $consoleLog = [
            'timestamp' => now()->toISOString(),
            'task_id' => $this->taskId,
            'message' => $message,
            'data' => $data,
            'elapsed_time' => $this->getElapsedTime()
        ];

        // Registrar en Laravel logs
        Log::info("PROGRESS_TRACKER[{$this->taskId}]: {$message}", $data);
    }

    /**
     * Obtener tiempo transcurrido desde el inicio
     */
    private function getElapsedTime()
    {
        $elapsed = microtime(true) - $this->startTime;
        return number_format($elapsed, 4) . "s";
    }

    /**
     * Formatear bytes a una unidad legible
     */
    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, $precision) . ' ' . $units[$i];
    }

    /**
     * Habilitar o deshabilitar el servicio de depuración
     */
    public function setDebugEnabled($enabled)
    {
        $this->debugService->setEnabled($enabled);
    }

    /**
     * Verificar si el servicio de depuración está habilitado
     */
    public function isDebugEnabled()
    {
        return $this->debugService->isEnabled();
    }

    /**
     * Exportar datos de seguimiento en formato JSON
     */
    public function exportProgressData()
    {
        return [
            'task_id' => $this->taskId,
            'progress_updates' => $this->progressUpdates,
            'performance_metrics' => $this->performanceMetrics,
            'summary' => $this->getProgressSummary()
        ];
    }
}