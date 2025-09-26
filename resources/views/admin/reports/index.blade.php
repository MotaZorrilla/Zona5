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

        <!-- Panel de Información y Selección de Secciones -->
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Secciones del Reporte</h3>
                <p class="text-sm text-gray-600 mb-4">Selecciona las secciones que deseas incluir en tu reporte personalizado.</p>

                <form id="sectionsForm">
                    <div class="space-y-2 mb-4">
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="kpis" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Resumen Ejecutivo con KPIs</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="members" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Estadísticas de Membresía</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="finance" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Estado Financiero</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="events" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Eventos y Actividades</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="repository" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Repositorio de Documentos</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="messages" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Sistema de Mensajería</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="lodges" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Directorio de Logias</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="dignitaries" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Dignatarios de Zona</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="school" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Escuela Virtual y Cursos</span>
                        </label>
                        <label class="flex items-center text-sm border-t pt-2 mt-2">
                            <input type="checkbox" name="sections[]" value="activity" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Actividad del Sistema</span>
                        </label>
                        <label class="flex items-center text-sm">
                            <input type="checkbox" name="sections[]" value="system" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Estadísticas de Uso del Sistema</span>
                        </label>
                        <label class="flex items-center text-sm font-medium">
                            <input type="checkbox" name="include_charts" value="1" checked class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mr-2">
                            <span>Incluir gráficos y visualizaciones</span>
                        </label>
                    </div>

                    <div class="flex gap-2 mb-4">
                        <button type="button" id="selectAllBtn" class="text-xs bg-primary-500 hover:bg-primary-600 text-white px-3 py-2 rounded flex-1">
                            Seleccionar Todo
                        </button>
                        <button type="button" id="deselectAllBtn" class="text-xs bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded flex-1">
                            Deseleccionar Todo
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Tarjeta de Consejos e Información -->
    <div class="mt-6">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-blue-50 border-l-4 border-blue-400 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-lightbulb-line text-blue-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-blue-800 mb-1">Consejo de Optimización</h4>
                            <p class="text-sm text-blue-700">
                                Selecciona solo las secciones que necesitas para generar reportes más enfocados y rápidos. Menos secciones = generación más veloz.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-time-line text-yellow-400 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-yellow-800 mb-1">Datos en Tiempo Real</h4>
                            <p class="text-sm text-yellow-700">
                                El reporte incluye datos actualizados hasta el momento exacto de la generación. Los números reflejan el estado actual del sistema.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Reports Section -->
<div class="mt-6">
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reportes Recientes</h3>
        @if($recentReports->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Archivo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamaño</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentReports->take(10) as $report)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <i class="ri-file-pdf-2-line text-red-500 mr-2"></i>{{ $report['filename'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($report['size'] / 1024, 2) }} KB</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::createFromTimestamp($report['created_at'], 'UTC')->setTimezone(config('app.timezone'))->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ $report['url'] }}" target="_blank" class="text-primary-600 hover:text-primary-900 mr-4">Descargar</a>
                            <form method="POST" action="{{ route('admin.reports.delete', $report['filename']) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este reporte?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500">No hay reportes recientes.</p>
        @endif
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
<script src="{{ asset('js/seguimiento-progreso-reporte.js') }}"></script>
<script>
// Sistema de tareas asíncronas con seguimiento en tiempo real
let currentTaskId = null;
let pollingInterval = null;
let progressTracker = null;

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar el tracker global
    progressTracker = window.seguimientoProgresoReporte;
    
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

    // Funcionalidad de seleccionar/deseleccionar todo
    const selectAllBtn = document.getElementById('selectAllBtn');
    const deselectAllBtn = document.getElementById('deselectAllBtn');
    const sectionCheckboxes = document.querySelectorAll('#sectionsForm input[name="sections[]"]');
    const chartsCheckbox = document.querySelector('#sectionsForm input[name="include_charts"]');

    if (selectAllBtn) {
        selectAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sectionCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            if (chartsCheckbox) {
                chartsCheckbox.checked = true;
            }
        });
    }

    if (deselectAllBtn) {
        deselectAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sectionCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            if (chartsCheckbox) {
                chartsCheckbox.checked = false;
            }
        });
    }

    // Event listener para el botón de cerrar modal
    const closeProgressModalBtn = document.getElementById('closeProgressModalBtn');
    if (closeProgressModalBtn) {
        closeProgressModalBtn.addEventListener('click', hideProgressModal);
    }

    // Manejar envío del formulario para usar el sistema asíncrono
    reportForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Copiar valores de checkboxes del panel lateral al formulario principal
        const sectionCheckboxes = document.querySelectorAll('#sectionsForm input[name="sections[]"]:checked');
        const sectionsValues = Array.from(sectionCheckboxes).map(cb => cb.value);

        // Copiar valor del checkbox de gráficos
        const chartsCheckbox = document.querySelector('#sectionsForm input[name="include_charts"]');

        // Limpiar inputs existentes en el formulario principal
        const existingSections = this.querySelectorAll('input[name="sections[]"]');
        existingSections.forEach(input => input.remove());
        const existingCharts = this.querySelector('input[name="include_charts"]');
        if (existingCharts) existingCharts.remove();

        // Agregar los valores seleccionados al formulario principal
        sectionsValues.forEach(value => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'sections[]';
            hiddenInput.value = value;
            this.appendChild(hiddenInput);
        });

        // Agregar el valor de gráficos
        if (chartsCheckbox) {
            const chartsInput = document.createElement('input');
            chartsInput.type = 'hidden';
            chartsInput.name = 'include_charts';
            chartsInput.value = chartsCheckbox.checked ? '1' : '0';
            this.appendChild(chartsInput);
        }

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

                // Iniciar el procesamiento real
                fetch('{{ route("admin.reports.start-processing") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ task_id: currentTaskId })
                })
                .then(response => response.json())
                .then(startData => {
                    if (!startData.success) {
                        console.error('Error starting processing:', startData.message);
                        showNotification('Error al iniciar procesamiento: ' + startData.message, 'error');
                        return;
                    }

                    // Iniciar seguimiento en tiempo real si está disponible
                    if (progressTracker) {
                        progressTracker.iniciarSeguimiento(currentTaskId, {
                            pollInterval: 2000, // Polling más frecuente para mejor seguimiento
                            maxRetries: 150     // Aumentar reintentos para procesos largos
                        });
                    }

                    showProgressModal();
                    startPolling();
                })
                .catch(error => {
                    console.error('Error starting processing:', error);
                    showNotification('Error al iniciar procesamiento', 'error');
                });
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
        
        // Iniciar nuevo polling cada 2 segundos para mejor seguimiento
        pollingInterval = setInterval(checkTaskStatus, 2000);
        checkTaskStatus(); // Primera verificación inmediata
    }

    async function checkTaskStatus() {
        if (!currentTaskId) return;
        
        // Use the progress tracker if available, otherwise use the original method
        if (progressTracker) {
            // The progress tracker handles status updates independently
            // This function is kept for backward compatibility
        }
        
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
        
        // Log detallado en consola para seguimiento en tiempo real
        console.log(`%cPROGRESO: ${progressPercent}% - ${task.message || 'Procesando...'}`, 
            'color: #007bff; font-weight: bold;');
        
        if (progressTracker) {
            progressTracker.registroATracker('info', [`PROGRESO ACTUALIZADO: ${progressPercent}%`, task]);
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
        
        // Detener el seguimiento cuando se completa
        if (progressTracker) {
            progressTracker.detenerSeguimiento();
        }
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
            
            // Detener el seguimiento cuando falla
            if (progressTracker) {
                progressTracker.detenerSeguimiento();
            }
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
        
        // Detener seguimiento si existe
        if (progressTracker) {
            progressTracker.detenerSeguimiento();
        }
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