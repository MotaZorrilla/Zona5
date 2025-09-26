<?php

namespace App\Services;

use App\Models\User;
use App\Models\Lodge;
use App\Models\Treasury;
use App\Models\Event;
use App\Models\Repository;
use App\Models\Message;
use App\Models\News;
use App\Models\ActivityLog;
use App\Models\ZoneDignitaries;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    protected $debug;

    public function __construct(DebugService $debug = null)
    {
        $this->debug = $debug ?: new DebugService(false); // Deshabilitado si no se proporciona
    }

    /**
     * Generar todos los datos necesarios para el reporte
     */
    public function generateReportData($dateRange, $options = [])
    {
        $this->debug->startTask('generateReportData', 'Iniciando generación de datos del reporte');

        $this->debug->step('Iniciando generación de reporte', 5);
        $this->debug->info('Rango de fechas', json_encode($dateRange));
        $this->debug->info('Opciones', json_encode($options));

        $data = [
            'report_info' => $this->getReportInfo($dateRange),
            'executive_summary' => $this->getExecutiveSummary(),
            'membership_stats' => $this->getMembershipStats($dateRange),
            'financial_status' => $this->getFinancialStatus($dateRange),
            'events_data' => $this->getEventsData($dateRange),
            'repository_data' => $this->getRepositoryData($dateRange),
            'messages_data' => $this->getMessagesData($dateRange),
            'lodges_data' => $this->getLodgesData(),
            'dignitaries_data' => $this->getDignitariesData(),
            'courses_data' => $this->getCoursesData(),
            'activity_data' => $this->getActivityData($dateRange),
            'charts_data' => $options['include_charts'] ? $this->getChartsData($dateRange) : null
        ];

        $this->debug->step('Finalizando generación de reporte', 95);
        $this->debug->endTask(true, 'Reporte generado exitosamente');

        return $data;
    }

    /**
     * Información básica del reporte
     */
    private function getReportInfo($dateRange)
    {
        $this->debug->step('Generando información básica del reporte', 10);
        return [
            'title' => 'Reporte Administrativo General - Gran Zona 5',
            'generated_at' => now(),
            'generated_by' => Auth::check() ? Auth::user()->name : 'Sistema',
            'period_start' => is_string($dateRange['start']) ? Carbon::parse($dateRange['start']) : $dateRange['start'],
            'period_end' => is_string($dateRange['end']) ? Carbon::parse($dateRange['end']) : $dateRange['end'],
            'period_description' => $this->getPeriodDescription($dateRange)
        ];
    }

    /**
     * Resumen ejecutivo con KPIs principales
     */
    private function getExecutiveSummary()
    {
        $this->debug->step('Generando resumen ejecutivo', 15);
        $this->debug->info('Iniciando conteo de datos para resumen ejecutivo');

        $totalLodges = Lodge::count();
        $this->debug->query('Lodge::count()', [], null);
        $totalMembers = User::count();
        $this->debug->query('User::count()', [], null);
        $treasuryIncome = Treasury::where('type', 'income')->sum('amount');
        $this->debug->query("Treasury::where('type', 'income')->sum('amount')", [], null);
        $treasuryExpense = Treasury::where('type', 'expense')->sum('amount');
        $this->debug->query("Treasury::where('type', 'expense')->sum('amount')", [], null);
        $upcomingEvents = Event::where('start_time', '>', now())->count();
        $this->debug->query("Event::where('start_time', '>', now())->count()", [], null);
        $totalDocuments = Repository::count();
        $this->debug->query('Repository::count()', [], null);
        $unreadMessages = Message::where('status', 'unread')->count();
        $this->debug->query("Message::where('status', 'unread')->count()", [], null);
        $activeCourses = Course::where('status', 'active')->count();
        $this->debug->query("Course::where('status', 'active')->count()", [], null);

        $this->debug->info('Datos obtenidos', "Logias: {$totalLodges}, Miembros: {$totalMembers}, Ingresos: {$treasuryIncome}, Egresos: {$treasuryExpense}");

        return [
            'total_lodges' => $totalLodges,
            'total_members' => $totalMembers,
            'treasury_balance' => $treasuryIncome - $treasuryExpense,
            'upcoming_events' => $upcomingEvents,
            'total_documents' => $totalDocuments,
            'unread_messages' => $unreadMessages,
            'active_courses' => $activeCourses
        ];
    }

    /**
     * Estadísticas detalladas de membresía
     */
    private function getMembershipStats($dateRange)
    {
        $this->debug->step('Generando estadísticas de membresía', 20);
        $this->debug->info('Rango de fechas para membresía', json_encode($dateRange));

        // Distribución por grado
        $this->debug->info('Obteniendo distribución por grado');
        $degreeDistribution = User::select('degree', DB::raw('count(*) as count'))
            ->whereNotNull('degree')
            ->groupBy('degree')
            ->get()
            ->keyBy('degree');
        $this->debug->query('User::select(degree, count(*))', [], null);
        $this->debug->info('Distribución por grado obtenida', $degreeDistribution->count() . ' grados encontrados');

        // Miembros por logia
        $this->debug->info('Obteniendo miembros por logia');
        $membersByLodge = Lodge::withCount('users')
            ->with(['users' => function($query) {
                $query->select('users.id', 'degree')
                    ->groupBy('users.id', 'degree');
            }])
            ->get()
            ->map(function($lodge) {
                $degrees = $lodge->users->groupBy('degree');
                return [
                    'lodge' => $lodge,
                    'total_members' => $lodge->users_count,
                    'apprentices' => $degrees->get('Aprendiz', collect())->count(),
                    'companions' => $degrees->get('Compañero', collect())->count(),
                    'masters' => $degrees->get('Maestro', collect())->count()
                ];
            });
        $this->debug->query('Lodge::withCount(users)->with(users)', [], null);
        $this->debug->info('Miembros por logia obtenidos', $membersByLodge->count() . ' logias encontradas');

        // Crecimiento de membresía (últimos 6 meses)
        $this->debug->info('Calculando crecimiento de membresía');
        $membershipGrowth = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            
            $newMembers = User::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $apprentices = User::where('degree', 'Aprendiz')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $companions = User::where('degree', 'Compañero')->whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $masters = User::where('degree', 'Maestro')->whereBetween('created_at', [$monthStart, $monthEnd])->count();

            $membershipGrowth[] = [
                'month' => $date->format('M Y'),
                'new_members' => $newMembers,
                'apprentices' => $apprentices,
                'companions' => $companions,
                'masters' => $masters
            ];
        }
        $this->debug->info('Crecimiento de membresía calculado', count($membershipGrowth) . ' meses analizados');

        return [
            'degree_distribution' => $degreeDistribution,
            'members_by_lodge' => $membersByLodge,
            'membership_growth' => $membershipGrowth,
            'total_apprentices' => $degreeDistribution->get('Aprendiz')->count ?? 0,
            'total_companions' => $degreeDistribution->get('Compañero')->count ?? 0,
            'total_masters' => $degreeDistribution->get('Maestro')->count ?? 0
        ];
    }

    /**
     * Estado financiero completo
     */
    private function getFinancialStatus($dateRange)
    {
        $this->debug->step('Generando estado financiero', 25);
        $this->debug->info('Rango de fechas para estado financiero', json_encode($dateRange));

        // Resumen financiero
        $this->debug->info('Calculando resumen financiero');
        $totalIncome = Treasury::where('type', 'income')->sum('amount');
        $totalExpense = Treasury::where('type', 'expense')->sum('amount');
        $currentBalance = $totalIncome - $totalExpense;
        $this->debug->info('Resumen financiero', "Ingresos: {$totalIncome}, Egresos: {$totalExpense}, Balance: {$currentBalance}");

        // Movimientos del mes actual
        $this->debug->info('Calculando movimientos del mes actual');
        $currentMonthIncome = Treasury::where('type', 'income')->whereMonth('transaction_date', now()->month)->whereYear('transaction_date', now()->year)->sum('amount');
        $currentMonthExpense = Treasury::where('type', 'expense')->whereMonth('transaction_date', now()->month)->whereYear('transaction_date', now()->year)->sum('amount');
        $this->debug->info('Movimientos del mes actual', "Ingresos: {$currentMonthIncome}, Egresos: {$currentMonthExpense}");

        // Movimientos recientes
        $this->debug->info('Obteniendo movimientos recientes');
        $recentMovements = Treasury::with(['user', 'lodge'])->orderBy('transaction_date', 'desc')->take(20)->get();
        $this->debug->info('Movimientos recientes', $recentMovements->count() . ' movimientos obtenidos');

        // Análisis por categorías
        $this->debug->info('Obteniendo análisis por categorías');
        $incomeByCategory = Treasury::where('type', 'income')->whereBetween('transaction_date', [$dateRange['start'], $dateRange['end']])->select('category', DB::raw('sum(amount) as total'))->groupBy('category')->get();
        $expenseByCategory = Treasury::where('type', 'expense')->whereBetween('transaction_date', [$dateRange['start'], $dateRange['end']])->select('category', DB::raw('sum(amount) as total'))->groupBy('category')->get();
        $this->debug->info('Categorías de movimientos', "Ingresos: {$incomeByCategory->count()} categorías, Egresos: {$expenseByCategory->count()} categorías");

        // Movimientos por logia
        $this->debug->info('Obteniendo movimientos por logia');
        $movementsByLodge = Treasury::with('lodge')->whereNotNull('lodge_id')->whereBetween('transaction_date', [$dateRange['start'], $dateRange['end']])->select('lodge_id', 'type', DB::raw('sum(amount) as total'))->groupBy('lodge_id', 'type')->get()->groupBy('lodge_id');
        $this->debug->info('Movimientos por logia', $movementsByLodge->count() . ' logias con movimientos');

        return [
            'summary' => [
                'total_balance' => $currentBalance,
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'current_month_income' => $currentMonthIncome,
                'current_month_expense' => $currentMonthExpense,
                'current_month_balance' => $currentMonthIncome - $currentMonthExpense
            ],
            'recent_movements' => $recentMovements,
            'income_by_category' => $incomeByCategory,
            'expense_by_category' => $expenseByCategory,
            'movements_by_lodge' => $movementsByLodge
        ];
    }

    /**
     * Datos de eventos
     */
    private function getEventsData($dateRange)
    {
        $this->debug->step('Generando datos de eventos', 30);
        $this->debug->info('Rango de fechas para eventos', json_encode($dateRange));

        $this->debug->info('Obteniendo próximos eventos');
        $upcomingEvents = Event::where('start_time', '>', now())->orderBy('start_time')->take(10)->with('creator')->get();

        $this->debug->info('Obteniendo eventos recientes');
        $recentEvents = Event::whereBetween('start_time', [$dateRange['start'], $dateRange['end']])->orderBy('start_time', 'desc')->with('creator')->get();

        $this->debug->info('Obteniendo eventos por tipo');
        $eventsByType = Event::select('type', DB::raw('count(*) as count'))->groupBy('type')->get();

        $this->debug->info('Obteniendo eventos públicos vs privados');
        $publicVsPrivate = Event::select('is_public', DB::raw('count(*) as count'))->groupBy('is_public')->get();

        $this->debug->info('Datos de eventos', "Próximos: {$upcomingEvents->count()}, Recientes: {$recentEvents->count()}, Tipos: {$eventsByType->count()}");

        return [
            'upcoming_events' => $upcomingEvents,
            'recent_events' => $recentEvents,
            'events_by_type' => $eventsByType,
            'public_vs_private' => $publicVsPrivate,
            'total_events' => Event::count()
        ];
    }

    /**
     * Datos del repositorio
     */
    private function getRepositoryData($dateRange)
    {
        $this->debug->step('Generando datos del repositorio', 35);
        $this->debug->info('Rango de fechas para repositorio', json_encode($dateRange));

        $this->debug->info('Obteniendo documentos por categoría');
        $documentsByCategory = Repository::select('category', DB::raw('count(*) as count'))->whereNotNull('category')->groupBy('category')->get();

        $this->debug->info('Obteniendo documentos por grado');
        $documentsByGrade = Repository::select('grade_level', DB::raw('count(*) as count'))->whereNotNull('grade_level')->groupBy('grade_level')->get();

        $this->debug->info('Obteniendo documentos recientes');
        $recentDocuments = Repository::with('uploader')->orderBy('created_at', 'desc')->take(15)->get();

        $this->debug->info('Calculando tamaño total');
        $totalSize = Repository::sum('file_size');

        $this->debug->info('Datos del repositorio', "Total: " . Repository::count() . " documentos, Tamaño: " . round($totalSize / (1024 * 1024), 2) . " MB");

        return [
            'total_documents' => Repository::count(),
            'documents_by_category' => $documentsByCategory,
            'documents_by_grade' => $documentsByGrade,
            'recent_documents' => $recentDocuments,
            'total_size_mb' => round($totalSize / (1024 * 1024), 2)
        ];
    }

    /**
     * Datos de mensajería
     */
    private function getMessagesData($dateRange)
    {
        $this->debug->step('Generando datos de mensajería', 40);
        $this->debug->info('Rango de fechas para mensajería', json_encode($dateRange));

        $this->debug->info('Obteniendo estadísticas de mensajes');
        $messageStats = Message::select('status', DB::raw('count(*) as count'))->groupBy('status')->get()->keyBy('status');

        $this->debug->info('Calculando actividad mensual');
        $monthlyActivity = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            
            $messagesSent = Message::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $monthlyActivity[] = [
                'month' => $date->format('M Y'),
                'messages_sent' => $messagesSent
            ];
        }

        $this->debug->info('Datos de mensajería', "Total: " . Message::count() . " mensajes, No leídos: " . ($messageStats->get('unread')->count ?? 0));

        return [
            'total_messages' => Message::count(),
            'unread_messages' => $messageStats->get('unread')->count ?? 0,
            'read_messages' => $messageStats->get('read')->count ?? 0,
            'archived_messages' => $messageStats->get('archived')->count ?? 0,
            'monthly_activity' => $monthlyActivity
        ];
    }

    /**
     * Datos de logias
     */
    private function getLodgesData()
    {
        $this->debug->step('Generando datos de logias', 45);

        $this->debug->info('Obteniendo logias con conteo de usuarios');
        $lodges = Lodge::withCount('users')->orderBy('number')->get();

        $this->debug->info('Obteniendo logias por oriente');
        $lodgesByOrient = Lodge::select('orient', DB::raw('count(*) as count'))->groupBy('orient')->get();

        $this->debug->info('Datos de logias', "Total: {$lodges->count()} logias, Orientes: {$lodgesByOrient->count()}");

        return [
            'lodges' => $lodges,
            'lodges_by_orient' => $lodgesByOrient,
            'total_lodges' => $lodges->count()
        ];
    }

    /**
     * Datos de dignatarios
     */
    private function getDignitariesData()
    {
        $this->debug->step('Generando datos de dignatarios', 50);

        $this->debug->info('Obteniendo dignatarios');
        $dignitaries = ZoneDignitaries::orderBy('id')->get();

        $this->debug->info('Datos de dignatarios', "Total: {$dignitaries->count()} dignatarios");

        return [
            'dignitaries' => $dignitaries
        ];
    }

    /**
     * Datos de cursos
     */
    private function getCoursesData()
    {
        $this->debug->step('Generando datos de cursos', 55);

        $this->debug->info('Obteniendo cursos por grado');
        $coursesByGrade = Course::select('grade_level', DB::raw('count(*) as count'))->whereNotNull('grade_level')->groupBy('grade_level')->get();

        $this->debug->info('Obteniendo cursos por estado');
        $coursesByStatus = Course::select('status', DB::raw('count(*) as count'))->groupBy('status')->get();

        $this->debug->info('Obteniendo cursos por tipo');
        $coursesByType = Course::select('type', DB::raw('count(*) as count'))->groupBy('type')->get();

        $this->debug->info('Obteniendo cursos activos');
        $activeCourses = Course::where('status', 'active')->get();

        $this->debug->info('Datos de cursos', "Total: " . Course::count() . " cursos, Activos: {$activeCourses->count()}");

        return [
            'total_courses' => Course::count(),
            'courses_by_grade' => $coursesByGrade,
            'courses_by_status' => $coursesByStatus,
            'courses_by_type' => $coursesByType,
            'active_courses' => $activeCourses
        ];
    }

    /**
     * Datos de actividad reciente
     */
    private function getActivityData($dateRange)
    {
        $this->debug->step('Generando datos de actividad reciente', 60);
        $this->debug->info('Rango de fechas para actividad', json_encode($dateRange));

        $this->debug->info('Obteniendo actividades recientes');
        $recentActivities = ActivityLog::with('user')->orderBy('created_at', 'desc')->take(20)->get();

        $this->debug->info('Obteniendo usuarios más activos');
        $activitiesByUser = ActivityLog::with('user')->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->select('user_id', DB::raw('count(*) as count'))->groupBy('user_id')->orderBy('count', 'desc')->take(10)->get();

        $this->debug->info('Datos de actividad', "Recientes: {$recentActivities->count()}, Usuarios activos: {$activitiesByUser->count()}");

        return [
            'recent_activities' => $recentActivities,
            'most_active_users' => $activitiesByUser
        ];
    }

    /**
     * Datos para gráficos
     */
    private function getChartsData($dateRange)
    {
        $this->debug->step('Generando datos para gráficos', 65);
        $this->debug->info('Rango de fechas para gráficos', json_encode($dateRange));

        // Este método generaría datos específicos para gráficos
        // Por ahora retornamos null ya que los gráficos se manejarán en el frontend
        $this->debug->info('Datos para gráficos', 'Gráficos se manejarán en el frontend');

        return null;
    }

    /**
     * Generar descripción del período
     */
    private function getPeriodDescription($dateRange)
    {
        $this->debug->step('Generando descripción del per��odo', 70);

        // Convertir strings a objetos Carbon si es necesario
        $start = is_string($dateRange['start']) ? Carbon::parse($dateRange['start']) : $dateRange['start'];
        $end = is_string($dateRange['end']) ? Carbon::parse($dateRange['end']) : $dateRange['end'];

        $periodDescription = "Período: {$start->format('d/m/Y')} - {$end->format('d/m/Y')}";
        
        $this->debug->info('Período', $periodDescription);

        return $periodDescription;
    }
}