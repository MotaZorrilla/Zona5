@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl overflow-hidden border-gray-10 p-1">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-white to-indigo-50 sticky top-0 bg-white z-10 shadow-sm rounded-t-xl">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-indigo-800 mb-2">Dashboard</h1>
                    <p class="text-sm text-gray-600">Panel de control y métricas generales de la Gran Zona 5.</p>
                </div>
            </div>
        </div>
        <div class="pb-6"></div> <!-- Separación entre la tarjeta principal y las tarjetas KPI -->

        <!-- 📊 MÉTRICAS PRINCIPALES - Primera fila con paleta original -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-6">
            <!-- Mensajes Nuevos (ROJO) -->
            @php
                $unreadMessages = \App\Models\Message::where('status', 'unread')->count();
            @endphp
            <a href="{{ route('admin.messages.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-red-200 hover:bg-gradient-to-r hover:from-red-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-red-600 transition-colors">Mensajes Nuevos</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $unreadMessages }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-500 group-hover:bg-red-200 transition-colors">
                    <i class="ri-mail-unread-line text-2xl"></i>
                </div>
            </a>

            <!-- Saldo Tesorería (AZUL) -->
            <a href="{{ route('admin.treasury.index') }}" class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 group border border-gray-100 hover:border-blue-200">
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">Saldo Tesorería</p>
                    <p class="text-3xl font-extrabold text-gray-800">$ {{ number_format($treasuryBalance, 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 group-hover:bg-blue-200 transition-colors">
                    <i class="ri-hand-coin-line text-2xl"></i>
                </div>
            </a>

            <!-- Ingresos del Mes (VERDE) -->
            <a href="{{ route('admin.treasury.index') }}" class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 group border border-gray-100 hover:border-green-200">
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-green-600 transition-colors">Ingresos (Mes)</p>
                    <p class="text-3xl font-extrabold text-gray-800">$ {{ number_format($currentMonthIncome, 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-500 group-hover:bg-green-200 transition-colors">
                    <i class="ri-arrow-up-circle-line text-2xl"></i>
                </div>
            </a>

            <!-- Egresos del Mes (NARANJA) -->
            <a href="{{ route('admin.treasury.index') }}" class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 group border border-gray-100 hover:border-orange-200">
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-orange-600 transition-colors">Egresos (Mes)</p>
                    <p class="text-3xl font-extrabold text-gray-800">$ {{ number_format($currentMonthExpense, 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-500 group-hover:bg-orange-200 transition-colors">
                    <i class="ri-arrow-down-circle-line text-2xl"></i>
                </div>
            </a>

            <!-- Balance del Mes (MORADO) -->
            <a href="{{ route('admin.treasury.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-purple-300 hover:bg-gradient-to-r hover:from-purple-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-purple-600 transition-colors">Balance (Mes)</p>
                    <p class="text-3xl font-extrabold text-gray-800">$ {{ number_format($currentMonthBalance, 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-500 group-hover:bg-purple-200 transition-colors">
                    <i class="ri-balance-line text-2xl"></i>
                </div>
            </a>

            <!-- Miembros Totales (AMARILLO) -->
            <a href="{{ route('admin.users.index') }}" class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-105 group border border-gray-100 hover:border-yellow-300">
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-yellow-600 transition-colors">Miembros</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $memberCount }} <span class="text-sm font-normal text-green-500">(+{{ $differenceCount }})</span></p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 group-hover:bg-yellow-200 transition-colors">
                    <i class="ri-group-2-line text-2xl"></i>
                </div>
            </a>
        </div>

        <!-- 📚 CONTENIDO Y COMUNIDAD - Segunda fila -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
            <!-- Documentos (AZUL) -->
            <a href="{{ route('admin.repository.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-blue-200 hover:bg-gradient-to-r hover:from-blue-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-blue-600 transition-colors">Documentos</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $repositoryCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 group-hover:bg-blue-200 transition-colors">
                    <i class="ri-archive-2-line text-2xl"></i>
                </div>
            </a>

            <!-- Noticias (VERDE) -->
            <a href="{{ route('admin.news.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-green-200 hover:bg-gradient-to-r hover:from-green-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-green-600 transition-colors">Noticias</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $newsCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-500 group-hover:bg-green-200 transition-colors">
                    <i class="ri-newspaper-line text-2xl"></i>
                </div>
            </a>

            <!-- Eventos (AMARILLO) -->
            <a href="{{ route('admin.events.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-yellow-200 hover:bg-gradient-to-r hover:from-yellow-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-yellow-600 transition-colors">Eventos</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $eventCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500 group-hover:bg-yellow-200 transition-colors">
                    <i class="ri-calendar-event-line text-2xl"></i>
                </div>
            </a>

            <!-- Cursos (MORADO) -->
            @php
                $courseCount = \App\Models\Course::count();
            @endphp
            <a href="{{ route('admin.school.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-purple-200 hover:bg-gradient-to-r hover:from-purple-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-purple-600 transition-colors">Cursos</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $courseCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-500 group-hover:bg-purple-200 transition-colors">
                    <i class="ri-book-open-line text-2xl"></i>
                </div>
            </a>

            <!-- Logias Activas (MORADO) -->
            <a href="{{ route('admin.lodges.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-purple-300 hover:bg-gradient-to-r hover:from-purple-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-purple-600 transition-colors">Logias</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $lodgeCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 group-hover:bg-purple-200 transition-colors">
                    <i class="ri-bank-line text-2xl"></i>
                </div>
            </a>

            <!-- Foros (ROJO) -->
            @php
                $forumCount = \App\Models\Forum::count();
            @endphp
            <a href="{{ route('admin.forums.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-red-300 hover:bg-gradient-to-r hover:from-red-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-red-600 transition-colors">Foros</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $forumCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 group-hover:bg-red-200 transition-colors">
                    <i class="ri-discuss-line text-2xl"></i>
                </div>
            </a>
        </div>

        <!-- 📈 ESTADÍSTICAS DETALLADAS - Tercera fila -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
            <!-- Aprendices (VERDE) -->
            <div class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center border border-gray-100 hover:bg-gradient-to-r hover:from-green-50 to-white">
                <div>
                    <p class="text-sm text-gray-600">Aprendices</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $apprenticeCount }}</p>
                    <p class="text-xs text-gray-500">{{ number_format(($apprenticeCount / max($memberCount, 1)) * 100, 1) }}% del total</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-500">
                    <i class="ri-user-star-line text-2xl"></i>
                </div>
            </div>

            <!-- Compañeros (AMARILLO) -->
            <div class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center border border-gray-100 hover:bg-gradient-to-r hover:from-yellow-50 to-white">
                <div>
                    <p class="text-sm text-gray-600">Compañeros</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $companionCount }}</p>
                    <p class="text-xs text-gray-500">{{ number_format(($companionCount / max($memberCount, 1)) * 100, 1) }}% del total</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500">
                    <i class="ri-user-shared-line text-2xl"></i>
                </div>
            </div>

            <!-- Maestros (ROSA) -->
            <div class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center border border-gray-100 hover:bg-gradient-to-r hover:from-pink-50 to-white">
                <div>
                    <p class="text-sm text-gray-600">Maestros</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $masterCount }}</p>
                    <p class="text-xs text-gray-500">{{ number_format(($masterCount / max($memberCount, 1)) * 100, 1) }}% del total</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center text-pink-500">
                    <i class="ri-award-line text-2xl"></i>
                </div>
            </div>

            <!-- Visitantes Hoy (AZUL) -->
            <div class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center border border-gray-100 hover:bg-gradient-to-r hover:from-blue-50 to-white">
                <div>
                    <p class="text-sm text-gray-600">Visitantes Hoy</p>
                    <p class="text-3xl font-extrabold text-gray-800">1.2k</p>
                    <p class="text-xs text-gray-500">Tráfico del día</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                    <i class="ri-eye-line text-2xl"></i>
                </div>
            </div>

            <!-- Tickets Soporte (VERDE) -->
            <a href="{{ route('admin.messages.index') }}" class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center cursor-pointer transition-all duration-200 hover:shadow-lg hover:scale-[1.02] group border border-gray-100 hover:border-green-300 hover:bg-gradient-to-r hover:from-green-50 to-white">
                <div>
                    <p class="text-sm text-gray-600 group-hover:text-green-600 transition-colors">Tickets Soporte</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $unreadMessages }}</p>
                    <p class="text-xs text-gray-500">Pendientes</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 group-hover:bg-green-200 transition-colors">
                    <i class="ri-lifebuoy-line text-2xl"></i>
                </div>
            </a>

            <!-- Acciones Urgentes (ROJO) -->
            @php
                $urgentActions = $unreadMessages; // Por ahora usamos los mensajes no leídos como acciones urgentes
            @endphp
            <div class="bg-white p-6 rounded-xl shadow-md stat-card flex justify-between items-center border border-gray-100 hover:bg-gradient-to-r hover:from-red-50 to-white">
                <div>
                    <p class="text-sm text-gray-600">Acciones Urgentes</p>
                    <p class="text-3xl font-extrabold text-gray-800">{{ $urgentActions }}</p>
                    <p class="text-xs text-gray-500">Requieren atención</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                    <i class="ri-error-warning-line text-2xl"></i>
                </div>
            </div>
        </div>

    <!-- Main grid with spacing -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl shadow-lg h-full p-6 flex flex-col">
                <h4 class="font-bold text-lg text-primary-600 mb-4">Actividad Reciente</h4>
                <div class="flex-grow overflow-y-auto">
                    <ul class="divide-y divide-gray-200">
                        @forelse ($recentActivities as $activity)
                            <li class="py-4 flex items-center">
                                @php
                                    $icon = 'ri-question-mark';
                                    $color = 'gray';
                                    if ($activity->subject_type === App\Models\User::class) {
                                        $icon = 'ri-user-add-line';
                                        $color = 'primary';
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
        </div>
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl shadow-lg h-full p-6">
                <h4 class="font-bold text-lg text-primary-600 mb-4">Miembros por Logia</h4>
                <livewire:admin.lodge-members-overview />
            </div>
        </div>
    </div>


    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl shadow-lg p-6 flex flex-col">
            <h4 class="font-bold text-lg text-primary-600 mb-4">Distribución por Grado</h4>
            <div class="flex-grow flex items-center justify-center max-h-80">
                <canvas id="degreePieChart"></canvas>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg p-6 flex flex-col">
            <h4 class="font-bold text-lg text-primary-600 mb-4">Crecimiento de Miembros (Últimos 6 Meses)</h4>
            <div class="flex-grow flex items-center justify-center">
                <canvas id="memberGrowthLineChart"></canvas>
            </div>
        </div>
        <div class="bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl shadow-lg p-6 flex flex-col">
            <h4 class="font-bold text-lg text-primary-600 mb-4">Crecimiento de Contenido (Últimos 6 Meses)</h4>
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
