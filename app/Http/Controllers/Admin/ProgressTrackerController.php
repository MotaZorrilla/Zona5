<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RealTimeProgressTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgressTrackerController extends Controller
{
    protected $progressTracker;

    public function __construct()
    {
        $this->progressTracker = new RealTimeProgressTracker();
    }

    /**
     * Obtener estado de progreso en tiempo real
     */
    public function getProgress(Request $request)
    {
        $taskId = $request->input('task_id');
        
        if (!$taskId) {
            return response()->json([
                'success' => false,
                'message' => 'ID de tarea requerido'
            ], 400);
        }

        try {
            // Obtener el estado de la tarea desde el servicio de tareas asíncronas
            $asyncTaskService = app('App\Services\AsyncTaskService');
            $task = $asyncTaskService->getTaskStatus($taskId);
            
            if (!$task) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tarea no encontrada'
                ], 404);
            }

            // Si existe un archivo de seguimiento de progreso para esta tarea, obtenerlo
            $progressFile = storage_path('logs/progress_tracker/' . $taskId . '_progress.json');
            $progressData = [];
            
            if (file_exists($progressFile)) {
                $progressData = json_decode(file_get_contents($progressFile), true);
                if (!$progressData) {
                    $progressData = [];
                }
            }

            // Obtener métricas de rendimiento si existen
            $performanceMetrics = $this->getPerformanceMetrics($taskId);

            $response = [
                'success' => true,
                'task' => $task,
                'progress_details' => [
                    'updates' => $progressData,
                    'metrics' => $performanceMetrics
                ]
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error obteniendo estado de progreso: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener métricas de rendimiento para una tarea específica
     */
    public function getPerformanceMetrics($taskId)
    {
        $metricsFile = storage_path('logs/progress_tracker/' . $taskId . '_progress.json');
        
        if (!file_exists($metricsFile)) {
            return null;
        }

        $logs = json_decode(file_get_contents($metricsFile), true);
        if (!$logs) {
            return null;
        }

        // Calcular métricas de rendimiento
        $totalTime = 0;
        $maxMemory = 0;
        $minMemory = PHP_INT_MAX;
        $totalQueries = 0;
        $totalSteps = 0;
        
        foreach ($logs as $log) {
            if (isset($log['data']['elapsed_ms'])) {
                $totalTime = max($totalTime, $log['data']['elapsed_ms']);
            }
            
            if (isset($log['data']['memory_usage'])) {
                $memoryBytes = $this->parseBytes($log['data']['memory_usage']);
                $maxMemory = max($maxMemory, $memoryBytes);
                $minMemory = min($minMemory, $memoryBytes);
            }
            
            if ($log['event_type'] === 'query_executed') {
                $totalQueries++;
            }
            
            if ($log['event_type'] === 'step_completed') {
                $totalSteps++;
            }
        }

        return [
            'total_queries_executed' => $totalQueries,
            'total_steps_completed' => $totalSteps,
            'estimated_total_time_ms' => $totalTime,
            'peak_memory_usage' => $this->formatBytes($maxMemory),
            'memory_at_start' => $this->formatBytes($minMemory),
            'total_logs' => count($logs)
        ];
    }

    /**
     * Parsear bytes desde formato legible
     */
    private function parseBytes($sizeStr)
    {
        $size = floatval($sizeStr);
        $unit = preg_replace('/[0-9\.]/', '', $sizeStr);
        
        $units = ['B' => 1, 'KB' => 1024, 'MB' => 1024 * 1024, 'GB' => 1024 * 1024 * 1024];
        
        return isset($units[$unit]) ? $size * $units[$unit] : $size;
    }

    /**
     * Formatear bytes a unidad legible
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
     * Obtener logs detallados de seguimiento
     */
    public function getDetailedLogs(Request $request)
    {
        $taskId = $request->input('task_id');
        
        if (!$taskId) {
            return response()->json([
                'success' => false,
                'message' => 'ID de tarea requerido'
            ], 400);
        }

        $logFile = storage_path('logs/progress_tracker/' . $taskId . '_progress.json');
        
        if (!file_exists($logFile)) {
            return response()->json([
                'success' => false,
                'message' => 'Logs de seguimiento no encontrados'
            ], 404);
        }

        $logs = json_decode(file_get_contents($logFile), true);
        
        if (!$logs) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudieron leer los logs'
            ], 500);
        }

        // Filtrar y ordenar los logs
        $filteredLogs = collect($logs)
            ->sortByDesc('timestamp')
            ->values()
            ->toArray();

        return response()->json([
            'success' => true,
            'logs' => $filteredLogs,
            'total_entries' => count($filteredLogs)
        ]);
    }

    /**
     * Exportar datos de seguimiento como archivo
     */
    public function exportProgressData(Request $request)
    {
        $taskId = $request->input('task_id');
        
        if (!$taskId) {
            return response()->json([
                'success' => false,
                'message' => 'ID de tarea requerido'
            ], 400);
        }

        // Usar el RealTimeProgressTracker para exportar datos
        $tracker = new RealTimeProgressTracker($taskId);
        $data = $tracker->exportProgressData();

        $filename = "progress_tracker_export_{$taskId}_" . now()->format('Y-m-d_H-i-s') . '.json';
        $filepath = storage_path('app/' . $filename);

        file_put_contents($filepath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->download($filepath)->deleteFileAfterSend(true);
    }

    /**
     * Obtener estadísticas de seguimiento general
     */
    public function getTrackerStats()
    {
        $progressDir = storage_path('logs/progress_tracker');
        
        if (!is_dir($progressDir)) {
            return response()->json([
                'success' => true,
                'stats' => [
                    'total_tracker_files' => 0,
                    'total_size' => '0 B',
                    'recent_trackers' => []
                ]
            ]);
        }

        $files = glob($progressDir . '/*_progress.json');
        $totalSize = 0;
        $recentTrackers = [];

        foreach ($files as $file) {
            $totalSize += filesize($file);
            $filename = basename($file);
            $taskId = str_replace('_progress.json', '', $filename);
            
            $recentTrackers[] = [
                'task_id' => $taskId,
                'filename' => $filename,
                'size' => $this->formatBytes(filesize($file)),
                'created_at' => filemtime($file),
                'created_at_formatted' => date('Y-m-d H:i:s', filemtime($file))
            ];
        }

        // Ordenar por fecha de creación (más recientes primero)
        usort($recentTrackers, function($a, $b) {
            return $b['created_at'] - $a['created_at'];
        });

        // Tomar solo los 10 más recientes
        $recentTrackers = array_slice($recentTrackers, 0, 10);

        return response()->json([
            'success' => true,
            'stats' => [
                'total_tracker_files' => count($files),
                'total_size' => $this->formatBytes($totalSize),
                'recent_trackers' => $recentTrackers
            ]
        ]);
    }
}