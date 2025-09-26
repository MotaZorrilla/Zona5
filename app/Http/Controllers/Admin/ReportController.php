<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\AsyncTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    protected $reportService;
    protected $asyncTaskService;

    public function __construct(ReportService $reportService, AsyncTaskService $asyncTaskService)
    {
        $this->reportService = $reportService;
        $this->asyncTaskService = $asyncTaskService;
    }

    /**
     * Obtener instancia del servicio de depuración
     */
    private function getDebugService()
    {
        return app('debug.service');
    }

    /**
     * Mostrar la interfaz de generación de reportes
     */
    public function index()
    {
        // Obtener reportes generados recientemente (últimas 24 horas) desde public/uploads/reports
        $reportsPath = public_path('uploads/reports');
        $recentReports = collect();
        
        if (is_dir($reportsPath)) {
            $files = glob($reportsPath . '/*.pdf');
            $recentReports = collect($files)
                ->filter(function ($file) {
                    return filemtime($file) > now()->subDay()->timestamp;
                })
                ->map(function ($file) {
                    return [
                        'filename' => basename($file),
                        'size' => filesize($file),
                        'created_at' => filemtime($file),
                        'url' => asset('uploads/reports/' . basename($file))
                    ];
                })
                ->sortByDesc('created_at')
                ->values();
        }

        // Obtener tareas del usuario actual
        $userTasks = $this->asyncTaskService->getUserTasks(5);

        // Limpiar archivos antiguos automáticamente
        $this->asyncTaskService->cleanupOldFiles();

        // Recuperar tareas colgadas
        $this->asyncTaskService->recoverStuckTasks();

        return view('admin.reports.index', compact('recentReports', 'userTasks'));
    }

    /**
     * Iniciar generación asíncrona del reporte PDF
     */
    public function generate(Request $request)
    {
        $debug = $this->getDebugService();
        $debug->startTask('generateReport', 'Iniciando generación de reporte');

        $request->validate([
            'period' => 'required|in:1_month,3_months,6_months,1_year,custom',
            'start_date' => 'nullable|date|required_if:period,custom',
            'end_date' => 'nullable|date|after_or_equal:start_date|required_if:period,custom',
            'include_charts' => 'boolean',
            'lodge_filter' => 'nullable|exists:lodges,id'
        ]);

        $debug->step('Validación completada', 10);
        $debug->info('Parámetros recibidos', json_encode($request->all()));

        try {
            // Determinar el período de fechas
            $dateRange = $this->getDateRange($request->period, $request->start_date, $request->end_date);
            $debug->step('Rango de fechas determinado', 20, json_encode($dateRange));
            
            // Crear tarea asíncrona
            $taskId = $this->asyncTaskService->createTask('pdf_report', [
                'dateRange' => $dateRange,
                'options' => [
                    'include_charts' => $request->boolean('include_charts', true),
                    'lodge_filter' => $request->lodge_filter
                ],
                'period' => $request->period,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            $debug->step('Tarea creada', 30, "Task ID: {$taskId}");
            $debug->endTask(true, "Tarea {$taskId} creada exitosamente");

            return response()->json([
                'success' => true,
                'message' => 'Generación de reporte iniciada',
                'task_id' => $taskId
            ]);

        } catch (\Exception $e) {
            $debug->error('Error al iniciar la generación del reporte', $e->getMessage());
            $debug->endTask(false, "Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar la generación del reporte: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Procesar una tarea de reporte (llamado por polling)
     * Este método ahora solo verifica el estado de la tarea y no inicia el proceso
     * ya que el proceso debería iniciarse automáticamente en el servicio de tareas
     */
    public function processTask(Request $request)
    {
        $debug = $this->getDebugService();
        $debug->startTask('processTask', 'Procesando tarea de reporte');

        $taskId = $request->input('task_id');
        if (!$taskId) {
            $debug->error('Task ID no proporcionado');
            return response()->json(['success' => false, 'message' => 'Task ID requerido'], 400);
        }

        $debug->step('Obteniendo estado de la tarea', 10, "Task ID: {$taskId}");
        $task = $this->asyncTaskService->getTaskStatus($taskId);
        if (!$task) {
            $debug->error('Tarea no encontrada', "Task ID: {$taskId}");
            return response()->json(['success' => false, 'message' => 'Tarea no encontrada'], 404);
        }

        $debug->info('Estado actual de la tarea', json_encode([
            'status' => $task['status'],
            'progress' => $task['progress'],
            'message' => $task['message'] ?? 'N/A'
        ]));

        // Si la tarea está pendiente y no ha sido procesada, iniciar el proceso
        // Solo si no está ya en proceso
        if ($task['status'] === 'pending') {
            $debug->step('Iniciando proceso de reporte', 20);
            // Ejecutar el proceso en segundo plano
            $this->asyncTaskService->processReportTask($taskId);
        }

        $debug->endTask(true, "Tarea {$taskId} procesada");
        return response()->json(['success' => true]);
    }

    /**
     * Obtener el estado de una tarea
     */
    public function getTaskStatus(Request $request)
    {
        $debug = $this->getDebugService();
        $debug->startTask('getTaskStatus', 'Obteniendo estado de tarea');

        $taskId = $request->input('task_id');
        if (!$taskId) {
            $debug->error('Task ID no proporcionado');
            return response()->json(['success' => false, 'message' => 'Task ID requerido'], 400);
        }

        $debug->step('Obteniendo estado de la tarea', 10, "Task ID: {$taskId}");
        $task = $this->asyncTaskService->getTaskStatus($taskId);
        if (!$task) {
            $debug->error('Tarea no encontrada', "Task ID: {$taskId}");
            return response()->json(['success' => false, 'message' => 'Tarea no encontrada'], 404);
        }

        $debug->info('Estado de la tarea', json_encode([
            'status' => $task['status'],
            'progress' => $task['progress'],
            'message' => $task['message'] ?? 'N/A',
            'error' => $task['error'] ?? null
        ]));

        $debug->endTask(true, "Estado de tarea {$taskId} obtenido");

        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }

    /**
     * Descargar un reporte generado
     */
    public function download($filename)
    {
        $filepath = public_path('uploads/reports/' . $filename);
        
        if (!file_exists($filepath)) {
            abort(404, 'Reporte no encontrado');
        }

        return response()->download($filepath);
    }

    /**
     * Obtener los logs de depuración de una tarea específica
     */
    public function getTaskLogs(Request $request)
    {
        $taskId = $request->input('task_id');
        if (!$taskId) {
            return response()->json(['success' => false, 'message' => 'Task ID requerido'], 400);
        }

        $logPath = storage_path('logs/tasks/' . $taskId . '.log');
        if (!file_exists($logPath)) {
            return response()->json(['success' => false, 'message' => 'Logs de tarea no encontrados'], 404);
        }

        $logs = file_get_contents($logPath);
        return response()->json(['success' => true, 'logs' => $logs]);
    }

    /**
     * Determinar el rango de fechas basado en el período seleccionado
     */
    private function getDateRange($period, $startDate = null, $endDate = null)
    {
        switch ($period) {
            case '1_month':
                return [
                    'start' => now()->subMonth()->startOfDay(),
                    'end' => now()->endOfDay()
                ];
            case '3_months':
                return [
                    'start' => now()->subMonths(3)->startOfDay(),
                    'end' => now()->endOfDay()
                ];
            case '6_months':
                return [
                    'start' => now()->subMonths(6)->startOfDay(),
                    'end' => now()->endOfDay()
                ];
            case '1_year':
                return [
                    'start' => now()->subYear()->startOfDay(),
                    'end' => now()->endOfDay()
                ];
            case 'custom':
                return [
                    'start' => \Carbon\Carbon::parse($startDate)->startOfDay(),
                    'end' => \Carbon\Carbon::parse($endDate)->endOfDay()
                ];
            default:
                return [
                    'start' => now()->subMonths(6)->startOfDay(),
                    'end' => now()->endOfDay()
                ];
        }
    }
}