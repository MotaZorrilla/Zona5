<div class="section">
    <h2 class="section-title">Resumen Ejecutivo</h2>
    
    <div class="summary-box">
        <p><strong>Este reporte presenta un análisis completo del estado administrativo de la Gran Zona 5, incluyendo estadísticas de membresía, estado financiero, gestión de eventos, repositorio de documentos y actividad general del sistema.</strong></p>
    </div>

    <h3 class="subsection-title">Indicadores Clave de Rendimiento (KPIs)</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $executive_summary['total_lodges'] }}</span>
                <div class="kpi-label">Logias Activas</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ $executive_summary['total_members'] }}</span>
                <div class="kpi-label">Miembros Totales</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">${{ number_format($executive_summary['treasury_balance'], 2) }}</span>
                <div class="kpi-label">Saldo de Tesorería</div>
            </div>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $executive_summary['upcoming_events'] }}</span>
                <div class="kpi-label">Eventos Programados</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ $executive_summary['total_documents'] }}</span>
                <div class="kpi-label">Documentos en Repositorio</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-red">{{ $executive_summary['unread_messages'] }}</span>
                <div class="kpi-label">Mensajes Pendientes</div>
            </div>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $executive_summary['active_courses'] }}</span>
                <div class="kpi-label">Cursos Activos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ round($executive_summary['total_members'] / $executive_summary['total_lodges'], 1) }}</span>
                <div class="kpi-label">Promedio Miembros/Logia</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">100%</span>
                <div class="kpi-label">Sistema Operativo</div>
            </div>
        </div>
    </div>

    <h3 class="subsection-title">Resumen de Actividad</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Área</th>
                <th>Estado Actual</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Membresía</strong></td>
                <td class="text-green">Activa</td>
                <td>{{ $executive_summary['total_members'] }} miembros distribuidos en {{ $executive_summary['total_lodges'] }} logias</td>
            </tr>
            <tr>
                <td><strong>Finanzas</strong></td>
                <td class="{{ $executive_summary['treasury_balance'] >= 0 ? 'text-green' : 'text-red' }}">
                    {{ $executive_summary['treasury_balance'] >= 0 ? 'Positivo' : 'Déficit' }}
                </td>
                <td>Saldo actual: ${{ number_format($executive_summary['treasury_balance'], 2) }}</td>
            </tr>
            <tr>
                <td><strong>Eventos</strong></td>
                <td class="text-blue">Programados</td>
                <td>{{ $executive_summary['upcoming_events'] }} eventos próximos en calendario</td>
            </tr>
            <tr>
                <td><strong>Documentación</strong></td>
                <td class="text-green">Actualizada</td>
                <td>{{ $executive_summary['total_documents'] }} documentos disponibles en repositorio</td>
            </tr>
            <tr>
                <td><strong>Comunicación</strong></td>
                <td class="{{ $executive_summary['unread_messages'] > 10 ? 'text-red' : 'text-green' }}">
                    {{ $executive_summary['unread_messages'] > 10 ? 'Atención Requerida' : 'Normal' }}
                </td>
                <td>{{ $executive_summary['unread_messages'] }} mensajes pendientes de respuesta</td>
            </tr>
            <tr>
                <td><strong>Formación</strong></td>
                <td class="text-green">Activa</td>
                <td>{{ $executive_summary['active_courses'] }} cursos disponibles en escuela virtual</td>
            </tr>
        </tbody>
    </table>

    @if($executive_summary['unread_messages'] > 10)
    <div class="warning-box">
        <p><strong>Atención:</strong> Hay {{ $executive_summary['unread_messages'] }} mensajes pendientes de respuesta. Se recomienda revisar la bandeja de entrada para mantener una comunicación fluida.</p>
    </div>
    @endif

    @if($executive_summary['treasury_balance'] < 0)
    <div class="warning-box">
        <p><strong>Alerta Financiera:</strong> El saldo de tesorería es negativo. Se recomienda revisar los movimientos financieros y tomar medidas correctivas.</p>
    </div>
    @endif
</div>