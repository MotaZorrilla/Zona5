@extends('layouts.admin')

@section('title', 'Generador de Reportes')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600 mb-2">Generador de Reportes</h1>
            <p class="text-sm text-gray-500">Genera reportes administrativos completos en formato PDF.</p>
        </div>
        <div class="flex items-center space-x-2">
            <i class="ri-file-chart-line text-4xl text-primary-500"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulario de Generación -->
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Configurar Reporte</h3>
                
                <form id="reportForm" class="space-y-6">
                    @csrf
                    
                    <!-- Período del Reporte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Período del Reporte</label>
                        <select name="period" id="period" class="w-full bg-white border-2 border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                            <option value="1_month" selected>Último mes</option>
                            <option value="3_months">Últimos 3 meses</option>
                            <option value="6_months">Últimos 6 meses</option>
                            <option value="1_year">Último año</option>
                            <option value="custom">Período personalizado</option>
                        </select>
                    </div>

                    <!-- Fechas Personalizadas -->
                    <div id="customDates" class="hidden grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio</label>
                            <input type="date" name="start_date" class="w-full bg-white border-2 border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Fin</label>
                            <input type="date" name="end_date" class="w-full bg-white border-2 border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                        </div>
                    </div>

                    <!-- Filtros Adicionales -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Logia (Opcional)</label>
                        <select name="lodge_filter" class="w-full bg-white border-2 border-gray-200 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                            <option value="">Todas las logias</option>
                            @foreach(\App\Models\Lodge::orderBy('number')->get() as $lodge)
                                <option value="{{ $lodge->id }}">{{ $lodge->name }} ({{ $lodge->number }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Opciones del Reporte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Opciones del Reporte</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="include_charts" value="1" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Incluir gráficos y visualizaciones</span>
                            </label>
                        </div>
                    </div>

                    <!-- Botón de Generación -->
                    <div class="pt-4">
                        <button type="submit" id="generateBtn" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-4 px-6 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 flex items-center justify-center">
                            <i class="ri-file-download-line mr-2 text-xl"></i>
                            <span>Generar Reporte PDF</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Panel de Información -->
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Contenido del Reporte</h3>
                
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Resumen ejecutivo con KPIs</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Estadísticas de membresía</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Estado financiero completo</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Gestión de eventos</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Repositorio de documentos</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Sistema de mensajería</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Directorio de logias</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Dignatarios de zona</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Escuela virtual y cursos</span>
                    </div>
                    <div class="flex items-center">
                        <i class="ri-check-line text-green-500 mr-2"></i>
                        <span>Actividad reciente del sistema</span>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-information-line text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                El reporte incluye datos actualizados hasta el momento de la generación.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reportes Recientes -->
            @if($recentReports->count() > 0)
            <div class="mt-6 bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Reportes Recientes</h3>
                <div class="space-y-3">
                    @foreach($recentReports->take(5) as $report)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="ri-file-pdf-2-line text-red-500 mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $report['filename'] }}</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::createFromTimestamp($report['created_at'])->diffForHumans() }}</p>
                            </div>
                        <a href="{{ $report['url'] }}" target="_blank" class="text-primary-600 hover:text-primary-800">
                            <i class="ri-download-line"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-primary-100">
                <i class="ri-loader-4-line text-2xl text-primary-600 animate-spin"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-4">Generando Reporte</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Por favor espera mientras se genera tu reporte PDF. Este proceso puede tomar unos momentos.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Progress Modal -->
<div id="progressModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-primary-100">
                <i class="ri-file-chart-line text-2xl text-primary-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-4">Generando Reporte</h3>
            <div class="mt-4 px-7">
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div id="progressBar" class="bg-primary-600 h-4 rounded-full transition-all duration-300 ease-in-out" style="width: 0%"></div>
                </div>
                <div class="mt-2">
                    <span id="progressText" class="text-sm font-medium text-primary-600">0%</span>
                    <p id="progressMessage" class="text-sm text-gray-500 mt-1">Iniciando...</p>
                </div>
            <div class="mt-4">
                <button id="closeProgressModalBtn" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
                    Cerrar
                </button>
                <a id="downloadBtn" href="#" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 hidden">
                    Descargar Reporte
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Sistema de tareas asíncronas
let currentTaskId = null;
let pollingInterval = null;

document.addEventListener('DOMContentLoaded', function() {
    const periodSelect = document.getElementById('period');
    const customDates = document.getElementById('customDates');
    const reportForm = document.getElementById('reportForm');
    const generateBtn = document.getElementById('generateBtn');
    const loadingModal = document.getElementById('loadingModal');

    // Mostrar/ocultar fechas personalizadas
    periodSelect.addEventListener('change', function() {
        if (this.value === 'custom') {
            customDates.classList.remove('hidden');
        } else {
            customDates.classList.add('hidden');
        }
    });

    // Event listener para el botón de cerrar modal
    const closeProgressModalBtn = document.getElementById('closeProgressModalBtn');
    if (closeProgressModalBtn) {
        closeProgressModalBtn.addEventListener('click', hideProgressModal);
    }

    // Manejar envío del formulario para usar el sistema asíncrono
    reportForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Mostrar modal de carga durante el envío inicial
        loadingModal.classList.remove('hidden');
        generateBtn.disabled = true;
        generateBtn.innerHTML = '<i class="ri-loader-4-line mr-2 text-xl animate-spin"></i><span>Procesando...</span>';

        // Preparar datos del formulario
        const formData = new FormData(this);
        
        // Enviar solicitud para iniciar la tarea
        fetch('{{ route("admin.reports.generate") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            loadingModal.classList.add('hidden');
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="ri-file-download-line mr-2 text-xl"></i><span>Generar Reporte PDF</span>';
            
            if (data.success) {
                currentTaskId = data.task_id;
                showProgressModal();
                startPolling();
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loadingModal.classList.add('hidden');
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="ri-file-download-line mr-2 text-xl"></i><span>Generar Reporte PDF</span>';
            showNotification('Error al iniciar la generación del reporte', 'error');
        });
    });

    function startPolling() {
        // Detener polling anterior si existe
        if (pollingInterval) {
            clearInterval(pollingInterval);
        }
        
        // Iniciar nuevo polling cada 5 segundos
        pollingInterval = setInterval(checkTaskStatus, 5000);
        checkTaskStatus(); // Primera verificación inmediata
    }

    function checkTaskStatus() {
        if (!currentTaskId) return;
        
        fetch('{{ route("admin.reports.get-task-status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ task_id: currentTaskId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateProgressModal(data.task);
                
                if (data.task.status === 'completed') {
                    handleTaskCompletion(data.task);
                } else if (data.task.status === 'failed') {
                    handleTaskFailure(data.task);
                }
            }
        })
        .catch(error => {
            console.error('Error checking task status:', error);
        });
    }

    function updateProgressModal(task) {
        const progressPercent = task.progress || 0;
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const progressMessage = document.getElementById('progressMessage');
        
        if (progressBar) {
            progressBar.style.width = progressPercent + '%';
        }
        if (progressText) {
            progressText.textContent = progressPercent + '%';
        }
        if (progressMessage) {
            progressMessage.textContent = task.message || 'Procesando...';
        }
    }

    function handleTaskCompletion(task) {
        if (pollingInterval) {
            clearInterval(pollingInterval);
        }
        
        // Actualizar mensaje de éxito
        document.getElementById('progressMessage').textContent = '¡Reporte generado exitosamente!';
        
        // Botón de descarga
        const downloadBtn = document.getElementById('downloadBtn');
        if (downloadBtn) {
            downloadBtn.href = task.result.download_url;
            downloadBtn.style.display = 'inline-block';
            downloadBtn.onclick = function(e) {
                e.preventDefault();
                // Descargar el archivo
                window.open(task.result.download_url, '_blank');
            };
        }
        
        // Actualizar la lista de reportes recientes
        setTimeout(() => {
            window.location.reload();
        }, 2000);
    }

    function handleTaskFailure(task) {
        if (pollingInterval) {
            clearInterval(pollingInterval);
        }
        
        document.getElementById('progressMessage').textContent = 'Error: ' + (task.error || 'Tarea fallida');
        document.getElementById('progressBar').style.backgroundColor = '#EF4444';
        
        setTimeout(() => {
            hideProgressModal();
            showNotification('Error al generar el reporte: ' + (task.error || 'Tarea fallida'), 'error');
        }, 2000);
    }

    function showProgressModal() {
        const modal = document.getElementById('progressModal');
        if (modal) {
            modal.classList.remove('hidden');
            
            // Resetear elementos del modal
            document.getElementById('progressBar').style.width = '0%';
            document.getElementById('progressBar').style.backgroundColor = '#3B82F6';
            document.getElementById('progressText').textContent = '0%';
            document.getElementById('progressMessage').textContent = 'Iniciando...';
            document.getElementById('downloadBtn').style.display = 'none';
        }
    }

    function hideProgressModal() {
        const modal = document.getElementById('progressModal');
        if (modal) {
            modal.classList.add('hidden');
        }
        
        // Detener polling
        if (pollingInterval) {
            clearInterval(pollingInterval);
        }
        currentTaskId = null;
    }

    function showNotification(message, type) {
        // Crear notificación temporal
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="ri-${type === 'success' ? 'check' : 'error-warning'}-line mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Remover después de 5 segundos
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
});
</script>
@endpush