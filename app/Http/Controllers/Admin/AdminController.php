<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Lodge;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $memberCount = User::count();
        $lodgeCount = Lodge::count();

        // Get top 5 lodges with most members
        $lodgesWithMemberCount = Lodge::withCount('users')->orderBy('users_count', 'desc')->take(5)->get();

        // Find the max member count for progress bar calculation
        $maxMembers = $lodgesWithMemberCount->max('users_count') ?? 0;

        // Get recent activities
        $recentActivities = ActivityLog::latest()->with('user', 'subject')->take(5)->get();

        // --- Chart Data ---

        // 1. Pie Chart: Member distribution by degree
        $degreeDistributionData = [
            'labels' => ['Aprendiz', 'Compañero', 'Maestro Masón'],
            'data' => [
                User::where('degree', 'Aprendiz')->count(),
                User::where('degree', 'Compañero')->count(),
                User::where('degree', 'Maestro Masón')->count(),
            ]
        ];

        // 2. Line Chart: Member growth (Fake data for now)
        $lineChartLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $lineChartLabels[] = Carbon::now()->subMonths($i)->format('M');
        }

        $memberGrowthData = [
            'labels' => $lineChartLabels,
            'datasets' => [
                [
                    'label' => 'Aprendices',
                    'data' => [1, 3, 2, 4, 5, 8], // Fake data
                    'borderColor' => '#38bdf8', // sky-400
                ],
                [
                    'label' => 'Compañeros',
                    'data' => [0, 1, 1, 2, 3, 5], // Fake data
                    'borderColor' => '#2dd4bf', // teal-400
                ],
                [
                    'label' => 'Maestros',
                    'data' => [5, 6, 8, 9, 11, 12], // Fake data
                    'borderColor' => '#facc15', // yellow-400
                ],
            ]
        ];

        // 3. Line Chart: Content growth (Fake data for now)
        $contentGrowthData = [
            'labels' => $lineChartLabels, // Reuse the same month labels
            'datasets' => [
                [
                    'label' => 'Noticias',
                    'data' => [5, 7, 8, 10, 15, 22], // Fake data
                ],
                [
                    'label' => 'Eventos',
                    'data' => [1, 2, 2, 3, 5, 6], // Fake data
                ],
                [
                    'label' => 'Cursos',
                    'data' => [0, 1, 2, 2, 3, 4], // Fake data
                ],
                 [
                    'label' => 'Foros',
                    'data' => [1, 1, 2, 3, 3, 4], // Fake data
                ],
            ]
        ];

        return view('admin.dashboard', compact(
            'memberCount', 
            'lodgeCount', 
            'lodgesWithMemberCount', 
            'maxMembers',
            'recentActivities',
            'degreeDistributionData',
            'memberGrowthData',
            'contentGrowthData'
        ));
    }
}
