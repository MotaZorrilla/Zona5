<div class="header">
    <div class="logo">
        <!-- Using the existing Zona 5 logo from admin panel -->
        @if(file_exists(public_path('uploads/logos/TrIVLqlyufiGpsvdsWJ9ryV6tF5GLo3EGMW2Aeqb.png')))
            <img src="{{ public_path('uploads/logos/TrIVLqlyufiGpsvdsWJ9ryV6tF5GLo3EGMW2Aeqb.png') }}" alt="Logo Gran Zona 5" style="width: 120px; height: auto; margin: 0 auto; display: block;">
        @elseif(file_exists(public_path('uploads/logo/logo.png')))
            <img src="{{ public_path('uploads/logo/logo.png') }}" alt="Logo Gran Zona 5" style="width: 120px; height: auto; margin: 0 auto; display: block;">
        @else
            <!-- Fallback logo with GZ5 -->
            <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-blue), var(--secondary-purple)); border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: white; font-size: 32px; font-weight: bold; border: 3px solid var(--primary-black);">
                GZ5
            </div>
        @endif
    </div>

    <div class="title">Reporte Administrativo General</div>
    <div class="subtitle">Gran Zona 5 - Francmasonería Venezolana</div>
    <div class="jurisdiction">Jurisdicción de la Gran Logia de la República de Venezuela</div>

    <div class="report-info">
        <p><strong>{{ $report_info['period_description'] }}</strong></p>
        <p>Generado por: {{ $report_info['generated_by'] }}</p>
        <p>Fecha de generación: {{ $report_info['generated_at']->format('d/m/Y H:i:s') }}</p>
    </div>
</div>

<!-- Table of Contents/Índice -->
<div class="section">
    <div class="section-title">Índice del Reporte</div>

    @php
        $availableSections = [
            'kpis' => ['title' => 'Resumen Ejecutivo', 'description' => 'KPIs principales, estadísticas clave y visión general'],
            'members' => ['title' => 'Estadísticas de Membresía', 'description' => 'Distribución por grado, miembros por logia, crecimiento de membresía'],
            'finance' => ['title' => 'Estado Financiero', 'description' => 'Ingresos, egresos, movimientos financieros, análisis por categorías'],
            'events' => ['title' => 'Gestión de Eventos', 'description' => 'Próximos eventos, eventos recientes, análisis por tipo'],
            'news' => ['title' => 'Noticias y Publicaciones', 'description' => 'Noticias publicadas, estadísticas de contenido'],
            'repository' => ['title' => 'Repositorio de Documentos', 'description' => 'Documentos por categoría, por grado, documentos recientes'],
            'messages' => ['title' => 'Sistema de Mensajería', 'description' => 'Mensajes, estadísticas de comunicación'],
            'lodges' => ['title' => 'Directorio de Logias', 'description' => 'Listado de logias, distribución por oriente'],
            'dignitaries' => ['title' => 'Dignatarios de Zona', 'description' => 'Lista de dignatarios y sus cargos'],
            'school' => ['title' => 'Escuela Virtual y Cursos', 'description' => 'Cursos disponibles, progreso educativo, estadísticas de participación'],
            'activity' => ['title' => 'Actividad Reciente del Sistema', 'description' => 'Registros de actividad, usuarios más activos'],
            'system' => ['title' => 'Estadísticas de Uso del Sistema', 'description' => 'Métricas de rendimiento, uso de recursos, estado técnico']
        ];

        $selectedSections = $report_info['sections'] ?? [];
        $indexNumber = 1;
    @endphp

    @foreach($availableSections as $key => $section)
        @if(in_array($key, $selectedSections))
            <div class="index-item"><strong>{{ $indexNumber }}. {{ $section['title'] }}</strong></div>
            <div style="margin-left: 20px; font-size: 10px; margin-bottom: 5px;">
                {{ $section['description'] }}
            </div>
            @php $indexNumber++; @endphp
        @endif
    @endforeach
</div>