@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <!-- KPI Row 1: Members & Degrees -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Logias Activas</p>
                <p class="text-3xl font-extrabold">{{ $lodgeCount }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-500"><i class="ri-bank-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Aprendices</p>
                <p class="text-3xl font-extrabold">{{ $apprenticeCount }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-sky-100 flex items-center justify-center text-sky-500"><i class="ri-user-star-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Compañeros</p>
                <p class="text-3xl font-extrabold">{{ $companionCount }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center text-teal-500"><i class="ri-user-shared-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Maestros</p>
                <p class="text-3xl font-extrabold">{{ $masterCount }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-500"><i class="ri-award-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Miembros</p>
                <p class="text-3xl font-extrabold">{{ $memberCount }} <span class="text-sm font-normal text-red-400">({{ $differenceCount }})</span></p>
            </div>
            <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-500"><i class="ri-group-2-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Mensajes Nuevos</p>
                <p class="text-3xl font-extrabold">4</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-500"><i class="ri-mail-unread-line text-2xl"></i></div>
        </div>
    </div>

    <!-- KPI Row 2: Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Documentos</p>
                <p class="text-3xl font-extrabold">350</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500"><i class="ri-archive-2-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Noticias</p>
                <p class="text-3xl font-extrabold">45</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-sky-100 flex items-center justify-center text-sky-500"><i class="ri-newspaper-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Eventos</p>
                <p class="text-3xl font-extrabold">12</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center text-pink-500"><i class="ri-calendar-event-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Cursos</p>
                <p class="text-3xl font-extrabold">8</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500"><i class="ri-book-open-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Foros</p>
                <p class="text-3xl font-extrabold">5</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-500"><i class="ri-discuss-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Saldo Tesorería</p>
                <p class="text-3xl font-extrabold">$8.9k</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-lime-100 flex items-center justify-center text-lime-500"><i class="ri-hand-coin-line text-2xl"></i></div>
        </div>
    </div>

    <!-- Main grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-sm h-full">
                <h4 class="font-bold text-lg text-gray-800 mb-4">Actividad Reciente</h4>
                <ul class="divide-y divide-gray-200">
                    @forelse ($recentActivities as $activity)
                        <li class="py-4 flex items-center">
                            @php
                                $icon = 'ri-question-mark';
                                $color = 'gray';
                                if ($activity->subject_type === App\Models\User::class) {
                                    $icon = 'ri-user-add-line';
                                    $color = 'blue';
                                }
                            @endphp
                            <div class="w-10 h-10 rounded-full bg-{{$color}}-100 flex items-center justify-center mr-4">
                                <i class="{{ $icon }} text-{{$color}}-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">{{ $activity->description }}</p>
                                @if ($activity->user)
                                <p class="text-xs text-gray-500">Por: {{ $activity->user->name }}</p>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li class="py-4 text-sm text-gray-500">No hay actividad reciente para mostrar.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-sm h-full">
                <livewire:admin.lodge-members-overview />
            </div>
        </div>
    </div>

    <!-- Second grid for summaries -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="font-bold text-lg text-gray-800 mb-4">Resumen de Mensajes</h4>
            <div class="flex justify-around text-center">
                <div>
                    <p class="text-3xl font-extrabold">15</p>
                    <p class="text-sm text-gray-500">En Bandeja</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-red-500">4</p>
                    <p class="text-sm text-gray-500">Sin Responder</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-green-500">11</p>
                    <p class="text-sm text-gray-500">Respondidos</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h4 class="font-bold text-lg text-gray-800 mb-4">Resumen de Tesorería</h4>
            <div class="flex justify-around text-center">
                <div>
                    <p class="text-2xl font-bold text-green-600">$ 1,250.75</p>
                    <p class="text-sm text-gray-500">Ingresos (Mes)</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600">$ 430.50</p>
                    <p class="text-sm text-gray-500">Egresos (Mes)</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold text-primary-600">$ 8,920.00</p>
                    <p class="text-sm text-gray-500">Saldo Total</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
            <h4 class="font-bold text-lg text-gray-800 mb-4">Distribución por Grado</h4>
            <div class="flex-grow flex items-center justify-center max-h-80">
                <canvas id="degreePieChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
            <h4 class="font-bold text-lg text-gray-800 mb-4">Crecimiento de Miembros (Últimos 6 Meses)</h4>
            <div class="flex-grow flex items-center justify-center">
                <canvas id="memberGrowthLineChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm flex flex-col">
            <h4 class="font-bold text-lg text-gray-800 mb-4">Crecimiento de Contenido (Últimos 6 Meses)</h4>
            <div class="flex-grow flex items-center justify-center">
                <canvas id="contentGrowthLineChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const beautifulColors = {
            backgroundColor: ['rgba(79, 70, 229, 0.7)', 'rgba(236, 72, 153, 0.7)', 'rgba(245, 158, 11, 0.7)', 'rgba(56, 189, 248, 0.7)', 'rgba(20, 184, 166, 0.7)', 'rgba(139, 92, 246, 0.7)'],
            borderColor: ['#4f46e5', '#ec4899', '#f59e0b', '#38bdf8', '#14b8a6', '#8b5cf6'],
        };

        // Pie Chart
        const degreeCtx = document.getElementById('degreePieChart').getContext('2d');
        new Chart(degreeCtx, {
            type: 'pie',
            data: {
                labels: @json($degreeDistributionData['labels']),
                datasets: [{
                    label: 'Miembros por Grado',
                    data: @json($degreeDistributionData['data']),
                    backgroundColor: beautifulColors.backgroundColor.slice(0, 3),
                    borderColor: beautifulColors.borderColor.slice(0, 3),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'left',
                    }
                }
            }
        });

        // Member Growth Line Chart
        const memberGrowthCtx = document.getElementById('memberGrowthLineChart').getContext('2d');
        const memberGrowthDatasets = @json($memberGrowthData['datasets']);
        memberGrowthDatasets.forEach((dataset, index) => {
            dataset.borderColor = beautifulColors.borderColor[index];
            dataset.backgroundColor = beautifulColors.backgroundColor[index];
            dataset.tension = 0.3;
        });
        new Chart(memberGrowthCtx, {
            type: 'line',
            data: {
                labels: @json($memberGrowthData['labels']),
                datasets: memberGrowthDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Content Growth Line Chart
        const contentGrowthCtx = document.getElementById('contentGrowthLineChart').getContext('2d');
        const contentGrowthDatasets = @json($contentGrowthData['datasets']);
        contentGrowthDatasets.forEach((dataset, index) => {
            dataset.borderColor = beautifulColors.borderColor[index + 2]; // Offset colors
            dataset.backgroundColor = beautifulColors.backgroundColor[index + 2];
            dataset.tension = 0.3;
        });
        new Chart(contentGrowthCtx, {
            type: 'line',
            data: {
                labels: @json($contentGrowthData['labels']),
                datasets: contentGrowthDatasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
