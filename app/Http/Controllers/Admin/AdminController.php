<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Lodge;
use App\Models\News;
use App\Models\Event;
use App\Models\Repository;
use App\Models\User;
use App\Models\Treasury;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $memberCount = User::count();
        $lodgeCount = Lodge::count();

        $apprenticeCount = User::where('degree', 'Aprendiz')->count();
        $companionCount = User::where('degree', 'Compañero')->count();
        $masterCount = User::where('degree', 'Maestro')->count();

        $sumOfDegrees = $apprenticeCount + $companionCount + $masterCount;
        $differenceCount = $memberCount - $sumOfDegrees;

        // Get recent activities
        $recentActivities = ActivityLog::latest()->with('user', 'subject')->get();

        // KPIs específicos para el dashboard
        $newsCount = News::count();
        $eventCount = Event::count();
        $repositoryCount = Repository::count();
        $treasuryIncome = Treasury::where('type', 'income')->sum('amount');
        $treasuryExpense = Treasury::where('type', 'expense')->sum('amount');
        $treasuryBalance = $treasuryIncome - $treasuryExpense;
        
        // KPIs adicionales de tesorería para mejor información financiera
        $currentMonthIncome = Treasury::where('type', 'income')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');
        
        $currentMonthExpense = Treasury::where('type', 'expense')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');
        
        $currentMonthBalance = $currentMonthIncome - $currentMonthExpense;

        // --- Chart Data ---

        // 1. Pie Chart: Member distribution by degree
        $degreeDistributionData = [
            'labels' => ['Aprendiz', 'Compañero', 'Maestro'],
            'data' => [
                User::where('degree', 'Aprendiz')->count(),
                User::where('degree', 'Compañero')->count(),
                User::where('degree', 'Maestro')->count(),
            ]
        ];

        // 2. Line Chart: Member growth (real data for last 6 months)
        $lineChartLabels = [];
        $apprenticeData = [];
        $companionData = [];
        $masterData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $lineChartLabels[] = $date->format('M Y');
            $apprenticeData[] = User::where('degree', 'Aprendiz')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            $companionData[] = User::where('degree', 'Compañero')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            $masterData[] = User::where('degree', 'Maestro')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
        }

        $memberGrowthData = [
            'labels' => $lineChartLabels,
            'datasets' => [
                [
                    'label' => 'Aprendices',
                    'data' => $apprenticeData,
                    'borderColor' => '#38bdf8', // sky-400
                ],
                [
                    'label' => 'Compañeros',
                    'data' => $companionData,
                    'borderColor' => '#2dd4bf', // teal-400
                ],
                [
                    'label' => 'Maestros',
                    'data' => $masterData,
                    'borderColor' => '#facc15', // yellow-400
                ],
            ]
        ];

        // 3. Line Chart: Content growth (real data for last 6 months)
        $contentGrowthLabels = $lineChartLabels; // Reuse the same month labels
        $newsData = [];
        $eventData = [];
        $repositoryData = [];
        $treasuryIncomeData = [];
        $treasuryExpenseData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $newsData[] = News::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $eventData[] = Event::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $repositoryData[] = Repository::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $treasuryIncomeData[] = Treasury::where('type', 'income')
                ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                ->sum('amount');
            $treasuryExpenseData[] = Treasury::where('type', 'expense')
                ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                ->sum('amount');
        }

        $contentGrowthData = [
            'labels' => $contentGrowthLabels,
            'datasets' => [
                [
                    'label' => 'Noticias',
                    'data' => $newsData,
                ],
                [
                    'label' => 'Eventos',
                    'data' => $eventData,
                ],
                [
                    'label' => 'Documentos',
                    'data' => $repositoryData,
                ],
                [
                    'label' => 'Ingresos Tesorería',
                    'data' => $treasuryIncomeData,
                ],
                [
                    'label' => 'Egresos Tesorería',
                    'data' => $treasuryExpenseData,
                ],
            ]
        ];

        return view('admin.dashboard', compact(
            'memberCount', 
            'lodgeCount', 
            'apprenticeCount',
            'companionCount',
            'masterCount',
            'differenceCount', // Added this line
            'recentActivities',
            'degreeDistributionData',
            'memberGrowthData',
            'contentGrowthData',
            'newsCount',
            'eventCount',
            'repositoryCount',
            'treasuryBalance',
            'currentMonthIncome',
            'currentMonthExpense',
            'currentMonthBalance'
        ));
    }
}
