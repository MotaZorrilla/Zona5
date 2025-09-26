<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\AsyncTaskService;
use App\Services\RealTimeProgressTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Lodge;
use App\Models\User;
use App\Models\Event;
use App\Models\Repository;
use App\Models\Message;
use App\Models\Treasury;
use App\Models\Course;
use App\Models\ZoneDignitary;
use App\Models\ActivityLog;
use App\Models\CourseSession;

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
        // ...existing code for userTasks, cleanup, recover, and view...

        return view('admin.reports.index', compact('recentReports'));
    }

    public function generate(Request $request)
    {
        $debug = $this->getDebugService();
        $debug->startTask('generate_report', 'Generando reporte');

        try {
            // Validar datos del formulario
            $request->validate([
                'period' => 'required|in:1_month,3_months,6_months,1_year,custom',
                'start_date' => 'nullable|date|required_if:period,custom',
                'end_date' => 'nullable|date|required_if:period,custom|after_or_equal:start_date',
                'lodge_filter' => 'nullable|exists:lodges,id',
                'sections' => 'required|array|min:1',
                'sections.*' => 'in:kpis,members,finance,events,repository,messages,lodges,dignitaries,school,activity,system'
            ]);

            $debug->step('Validación completada', 10, 'Datos del formulario validados');

            // Crear tarea asíncrona
            $taskId = $this->asyncTaskService->createTask('report_generation', [
                'period' => $request->period,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'lodge_filter' => $request->lodge_filter,
                'include_charts' => $request->boolean('include_charts', true),
                'sections' => $request->input('sections', [])
            ]);

            $debug->step('Tarea creada', 20, "Task ID: {$taskId}");

            // Actualizar progreso inicial
            $this->asyncTaskService->updateProgress($taskId, 5, 'Tarea de reporte creada exitosamente');

            $debug->endTask(true, "Tarea de reporte creada: {$taskId}");

            return response()->json([
                'success' => true,
                'task_id' => $taskId,
                'message' => 'Tarea de generación de reporte iniciada'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $debug->error('Error de validación', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos: ' . implode(', ', Arr::flatten($e->errors())),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            $debug->error('Error general', $e->getMessage());
            $this->asyncTaskService->failTask($taskId ?? null, $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar la generación del reporte: ' . $e->getMessage()
            ], 500);
        }
    }

    public function processTask(Request $request)
    {
        // ...existing code...
    }

    public function getTaskStatus(Request $request)
    {
        $taskId = $request->input('task_id');
        if (!$taskId) {
            return response()->json(['success' => false, 'message' => 'Task ID requerido'], 400);
        }

        $task = $this->asyncTaskService->getTaskStatus($taskId);
        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Tarea no encontrada'], 404);
        }

        return response()->json(['success' => true, 'task' => $task]);
    }

    public function download($filename)
    {
        $filepath = public_path('uploads/reports/' . $filename);
        if (!file_exists($filepath)) {
            abort(404, 'Reporte no encontrado');
        }
        return response()->download($filepath);
    }

    public function delete($filename)
    {
        $filepath = public_path('uploads/reports/' . $filename);
        if (file_exists($filepath)) {
            unlink($filepath);
            return redirect()->back()->with('success', 'Reporte eliminado exitosamente');
        }
        return redirect()->back()->with('error', 'Reporte no encontrado');
    }

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

    public function startProcessing(Request $request)
    {
        $taskId = $request->input('task_id');
        if (!$taskId) {
            return response()->json(['success' => false, 'message' => 'Task ID requerido'], 400);
        }
        $task = $this->asyncTaskService->getTaskStatus($taskId);
        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Tarea no encontrada'], 404);
        }
        if ($task['status'] === 'processing' && $task['progress'] > 15) {
            return response()->json(['success' => true, 'message' => 'Tarea ya en proceso', 'task' => $task]);
        }
        try {
            $this->asyncTaskService->updateProgress($taskId, 20, 'Procesando datos del reporte...');

            // Generar el reporte PDF
            $this->asyncTaskService->updateProgress($taskId, 50, 'Recopilando datos...');

            $filename = 'report_' . $taskId . '.pdf';
            $path = public_path('uploads/reports/' . $filename);

            $sections = $task['data']['sections'] ?? [];
            $lodgeFilter = $task['data']['lodge_filter'] ?? null;

            // Preparar datos para el header
            $periodDescriptions = [
                '1_month' => 'Último mes',
                '3_months' => 'Últimos 3 meses',
                '6_months' => 'Últimos 6 meses',
                '1_year' => 'Último año',
                'custom' => 'Período personalizado'
            ];

            $reportInfo = [
                'period_description' => $periodDescriptions[$task['data']['period'] ?? '6_months'] ?? 'Período personalizado',
                'generated_by' => Auth::user()->name ?? 'Sistema',
                'generated_at' => now(),
                'sections' => $sections
            ];

            // Crear PDF con contenido basado en secciones seleccionadas
            $html = view('admin.reports.pdf.styles')->render();
            $html .= view('admin.reports.pdf.partials.header', [
                'report_info' => $reportInfo
            ])->render();


            // Aplicar filtro por logia si está seleccionado
            $selectedLodge = null;
            if ($lodgeFilter) {
                $this->asyncTaskService->updateProgress($taskId, 25, 'Aplicando filtro por logia...');
                $selectedLodge = Lodge::find($lodgeFilter);
                if (!$selectedLodge) {
                    throw new \Exception("La logia seleccionada no existe.");
                }
                $this->asyncTaskService->updateProgress($taskId, 30, 'Filtro por logia aplicado correctamente');
            }

            $lodgeQuery = $lodgeFilter ? Lodge::where('id', $lodgeFilter) : Lodge::query();
            $userQuery = $lodgeFilter ? User::where('lodge_id', $lodgeFilter) : User::query();
            $treasuryQuery = $lodgeFilter ? Treasury::where('lodge_id', $lodgeFilter) : Treasury::query();

            // Para eventos, verificar que la relación creator existe
            $eventQuery = $lodgeFilter ?
                Event::whereHas('creator', function($q) use ($lodgeFilter) {
                    $q->where('lodge_id', $lodgeFilter);
                }) : Event::query();

            // Para mensajes, verificar que la relación recipient existe
            $messageQuery = $lodgeFilter ?
                Message::whereHas('recipient', function($q) use ($lodgeFilter) {
                    $q->where('lodge_id', $lodgeFilter);
                }) : Message::query();

            // Para actividad, verificar que la relación user existe
            $activityQuery = $lodgeFilter ?
                ActivityLog::whereHas('user', function($q) use ($lodgeFilter) {
                    $q->where('lodge_id', $lodgeFilter);
                }) : ActivityLog::query();

            // Recopilar datos para las secciones
            $executiveSummary = [
                'total_lodges' => $lodgeQuery->count(),
                'total_members' => $userQuery->count(),
                'treasury_balance' => $treasuryQuery->where('type', 'income')->sum('amount') - $treasuryQuery->where('type', 'expense')->sum('amount'),
                'upcoming_events' => $eventQuery->where('date', '>', now())->count(),
                'total_documents' => Repository::count(), // Documentos no se filtran por logia
                'unread_messages' => $messageQuery->where('status', 'unread')->count(),
                'active_courses' => Course::count(), // Cursos no se filtran por logia
            ];

            // Datos para estado financiero
            $financialStatus = [
                'summary' => [
                    'total_balance' => $treasuryQuery->where('type', 'income')->sum('amount') - $treasuryQuery->where('type', 'expense')->sum('amount'),
                    'total_income' => $treasuryQuery->where('type', 'income')->sum('amount'),
                    'total_expense' => $treasuryQuery->where('type', 'expense')->sum('amount'),
                    'current_month_income' => $treasuryQuery->where('type', 'income')
                        ->whereMonth('transaction_date', now()->month)
                        ->whereYear('transaction_date', now()->year)
                        ->sum('amount'),
                    'current_month_expense' => $treasuryQuery->where('type', 'expense')
                        ->whereMonth('transaction_date', now()->month)
                        ->whereYear('transaction_date', now()->year)
                        ->sum('amount'),
                ],
            ];
            $financialStatus['summary']['current_month_balance'] = $financialStatus['summary']['current_month_income'] - $financialStatus['summary']['current_month_expense'];

            $financialStatus['recent_movements'] = $treasuryQuery->with('lodge')->latest('transaction_date')->take(20)->get();
            $financialStatus['income_by_category'] = $treasuryQuery->selectRaw('category, SUM(amount) as total')
                ->where('type', 'income')
                ->groupBy('category')
                ->get();
            $financialStatus['expense_by_category'] = $treasuryQuery->selectRaw('category, SUM(amount) as total')
                ->where('type', 'expense')
                ->groupBy('category')
                ->get();
            $financialStatus['movements_by_lodge'] = $treasuryQuery->selectRaw('lodge_id, type, SUM(amount) as total')
                ->groupBy('lodge_id', 'type')
                ->get()
                ->groupBy('lodge_id');

            // Datos para eventos
            $eventsData = [
                'total_events' => $eventQuery->count(),
                'upcoming_events' => $eventQuery->with('creator')->where('start_time', '>', now())->orderBy('start_time')->take(10)->get(),
                'recent_events' => $eventQuery->with('creator')->where('start_time', '<', now())->orderBy('start_time', 'desc')->take(15)->get(),
                'events_by_type' => $eventQuery->selectRaw('type, COUNT(*) as count')->groupBy('type')->get(),
                'public_vs_private' => $eventQuery->selectRaw('is_public, COUNT(*) as count')->groupBy('is_public')->get(),
            ];

            // Datos para repositorio
            $totalSize = Repository::sum('file_size') / 1024 / 1024; // Convertir a MB
            $repositoryData = [
                'total_documents' => Repository::count(),
                'total_size_mb' => round($totalSize, 2),
                'documents_by_category' => Repository::selectRaw('category, COUNT(*) as count')->whereNotNull('category')->groupBy('category')->get(),
                'documents_by_grade' => Repository::selectRaw('grade_level, COUNT(*) as count')->whereNotNull('grade_level')->groupBy('grade_level')->get(),
                'recent_documents' => Repository::with('uploader')->latest()->take(20)->get(),
            ];

            // Datos para mensajes
            $messagesData = [
                'total_messages' => $messageQuery->count(),
                'unread_messages' => $messageQuery->where('status', 'unread')->count(),
                'read_messages' => $messageQuery->where('status', 'read')->count(),
                'archived_messages' => $messageQuery->where('status', 'archived')->count(),
                'messages_by_status' => $messageQuery->selectRaw('status, COUNT(*) as count')->groupBy('status')->get(),
                'recent_messages' => $messageQuery->latest()->take(20)->get(),
                'monthly_activity' => collect(),
            ];

            // Actividad mensual de mensajes
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthStart = $date->copy()->startOfMonth();
                $monthEnd = $date->copy()->endOfMonth();

                $messagesSent = $messageQuery->whereBetween('created_at', [$monthStart, $monthEnd])->count();

                $messagesData['monthly_activity']->push([
                    'month' => $date->format('M Y'),
                    'messages_sent' => $messagesSent,
                ]);
            }

            // Datos para logias
            $lodges = Lodge::withCount('users')->orderBy('number')->get();
            $lodgesData = [
                'total_lodges' => Lodge::count(),
                'lodges_by_orient' => Lodge::selectRaw('orient, COUNT(*) as count')->groupBy('orient')->get(),
                'lodges' => $lodges,
            ];

            // Datos para dignatarios
            $dignitariesData = [
                'total_dignitaries' => ZoneDignitary::count(),
                'dignitaries_by_position' => ZoneDignitary::selectRaw('role, COUNT(*) as count')->groupBy('role')->get(),
                'dignitaries' => ZoneDignitary::all(),
            ];

            // Datos para cursos
            $coursesData = [
                'total_courses' => Course::count(),
                'active_courses' => Course::where('status', 'active')->get(),
                'courses_list' => Course::all(),
                'course_sessions' => CourseSession::count(),
                'courses_by_status' => Course::selectRaw('status, COUNT(*) as count')->groupBy('status')->get(),
                'courses_by_grade' => Course::selectRaw('grade_level, COUNT(*) as count')->whereNotNull('grade_level')->groupBy('grade_level')->get(),
                'courses_by_type' => Course::selectRaw('type, COUNT(*) as count')->groupBy('type')->get(),
            ];

            // Datos para actividad
            $activityData = [
                'total_logs' => $activityQuery->count(),
                'recent_activities' => $activityQuery->with('user')->latest()->take(50)->get(),
                'most_active_users' => $activityQuery->with('user')
                    ->selectRaw('user_id, COUNT(*) as count')
                    ->groupBy('user_id')
                    ->orderBy('count', 'desc')
                    ->take(10)
                    ->get(),
            ];

            // Datos para estadísticas del sistema (uso básico)
            $systemStats = [
                'total_users' => User::count(),
                'active_users_last_30_days' => User::where('last_login_at', '>', now()->subDays(30))->count(),
                'total_sessions_today' => 0, // Would need session tracking
                'database_size_mb' => 0, // Would need DB size calculation
                'cache_size_mb' => 0, // Would need cache size calculation
                'log_files_count' => count(glob(storage_path('logs/*.log'))),
                'storage_usage_mb' => $this->getFolderSize(storage_path()) / 1024 / 1024,
                'public_usage_mb' => $this->getFolderSize(public_path()) / 1024 / 1024,
            ];

            // Datos para estadísticas de membresía
            $membershipStats = [
                'total_apprentices' => $userQuery->where('degree', 'Aprendiz')->count(),
                'total_companions' => $userQuery->where('degree', 'Compañero')->count(),
                'total_masters' => $userQuery->where('degree', 'Maestro')->count(),
                'members_by_lodge' => $lodgeFilter ?
                    collect([[
                        'lodge' => $selectedLodge,
                        'total_members' => $userQuery->count(),
                        'apprentices' => $userQuery->where('degree', 'Aprendiz')->count(),
                        'companions' => $userQuery->where('degree', 'Compañero')->count(),
                        'masters' => $userQuery->where('degree', 'Maestro')->count(),
                    ]]) :
                    Lodge::with('users')->get()->map(function ($lodge) {
                        return [
                            'lodge' => $lodge,
                            'total_members' => $lodge->users->count(),
                            'apprentices' => $lodge->users->where('degree', 'Aprendiz')->count(),
                            'companions' => $lodge->users->where('degree', 'Compañero')->count(),
                            'masters' => $lodge->users->where('degree', 'Maestro')->count(),
                        ];
                    }),
                'membership_growth' => collect(),
            ];

            // Crecimiento de membresía últimos 6 meses
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthStart = $date->copy()->startOfMonth();
                $monthEnd = $date->copy()->endOfMonth();

                $newMembers = $userQuery->whereBetween('created_at', [$monthStart, $monthEnd])->count();
                $apprentices = $userQuery->where('degree', 'Aprendiz')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
                $companions = $userQuery->where('degree', 'Compañero')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
                $masters = $userQuery->where('degree', 'Maestro')->whereBetween('created_at', [$monthStart, $monthEnd])->count();

                $membershipStats['membership_growth']->push([
                    'month' => $date->format('M Y'),
                    'new_members' => $newMembers,
                    'apprentices' => $apprentices,
                    'companions' => $companions,
                    'masters' => $masters,
                ]);
            }

            $chartsData = $task['data']['include_charts'] ?? true;

            $this->asyncTaskService->updateProgress($taskId, 60, 'Generando contenido del reporte...');

            // Contenido de cada sección usando las vistas parciales
            if (in_array('kpis', $sections)) {
                $html .= view('admin.reports.pdf.partials.executive-summary', [
                    'executive_summary' => $executiveSummary,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('members', $sections)) {
                $html .= view('admin.reports.pdf.partials.membership-stats', [
                    'membership_stats' => $membershipStats,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('finance', $sections)) {
                $html .= view('admin.reports.pdf.partials.financial-status', [
                    'financial_status' => $financialStatus,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('events', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.events-section', [
                    'events_data' => $eventsData,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('news', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.news-section', [
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('repository', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.repository-section', [
                    'repository_data' => $repositoryData,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('messages', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.messages-section', [
                    'messages_data' => $messagesData,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('lodges', $sections)) {
                $html .= view('admin.reports.pdf.partials.lodges-section', [
                    'lodges_data' => $lodgesData,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('dignitaries', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.dignitaries-section', [
                    'dignitaries_data' => $dignitariesData,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('school', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.courses-section', [
                    'courses_data' => $coursesData,
                    'charts_data' => $chartsData
                ])->render();
            }
            if (in_array('activity', $sections)) {
                $html .= '<div class="page-break"></div>';
                $html .= view('admin.reports.pdf.partials.activity-log', [
                    'activity_data' => $activityData,
                    'charts_data' => $chartsData
                ])->render();
            }

            // Include system usage statistics only if selected
            if (in_array('system', $sections)) {
                $html .= view('admin.reports.pdf.partials.system-usage', [
                    'system_stats' => $systemStats,
                    'charts_data' => $chartsData
                ])->render();
            }


            $html .= view('admin.reports.pdf.partials.footer')->render();

            $this->asyncTaskService->updateProgress($taskId, 80, 'Generando archivo PDF...');

            try {
                $pdf = Pdf::loadHTML($html);
                $pdf->save($path);
                $this->asyncTaskService->updateProgress($taskId, 90, 'PDF guardado exitosamente');
            } catch (\Exception $pdfException) {
                throw new \Exception('Error al generar PDF: ' . $pdfException->getMessage());
            }

            $this->asyncTaskService->updateProgress($taskId, 100, 'Reporte completado');

            // Completar la tarea
            $this->asyncTaskService->completeTask($taskId, [
                'download_url' => asset('uploads/reports/' . $filename)
            ]);

            $updatedTask = $this->asyncTaskService->getTaskStatus($taskId);
            return response()->json([
                'success' => true,
                'message' => 'Procesamiento iniciado exitosamente',
                'task' => $updatedTask
            ]);
        } catch (\Exception $e) {
            $this->asyncTaskService->failTask($taskId, $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar procesamiento: ' . $e->getMessage(),
                'task' => $this->asyncTaskService->getTaskStatus($taskId)
            ]);
        }
    }

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

    private function getFolderSize($path)
    {
        $size = 0;
        if (is_dir($path)) {
            $files = scandir($path);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $path . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($filePath)) {
                        $size += $this->getFolderSize($filePath);
                    } else {
                        $size += filesize($filePath);
                    }
                }
            }
        }
        return $size;
    }
}