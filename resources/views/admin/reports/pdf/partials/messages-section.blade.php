<div class="section">
    <div class="section-title">Sistema de Mensajería</div>

    <div class="subsection-title">Estadísticas de Mensajes</div>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $messages_data['total_messages'] }}</span>
                <div class="kpi-label">Total de Mensajes</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-red">{{ $messages_data['unread_messages'] }}</span>
                <div class="kpi-label">Mensajes No Leídos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">{{ $messages_data['read_messages'] }}</span>
                <div class="kpi-label">Mensajes Leídos</div>
            </div>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value text-blue">{{ $messages_data['archived_messages'] }}</span>
                <div class="kpi-label">Mensajes Archivados</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ round($messages_data['total_messages'] > 0 ? ($messages_data['read_messages'] / $messages_data['total_messages']) * 100 : 0, 1) }}%</span>
                <div class="kpi-label">Tasa de Lectura</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ round($messages_data['total_messages'] > 0 ? ($messages_data['unread_messages'] / $messages_data['total_messages']) * 100 : 0, 1) }}%</span>
                <div class="kpi-label">Mensajes Pendientes</div>
            </div>
        </div>
    </div>

    <div class="subsection-title">Actividad Mensual de Mensajería</div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Mensajes Enviados</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages_data['monthly_activity'] as $activity)
            <tr>
                <td class="font-bold">{{ $activity['month'] }}</td>
                <td class="text-center">{{ $activity['messages_sent'] }}</td>
            </tr>
            @endforeach
            <tr style="background-color: #F3F4F6; font-weight: bold;">
                <td>TOTAL</td>
                <td class="text-center">{{ collect($messages_data['monthly_activity'])->sum('messages_sent') }}</td>
            </tr>
        </tbody>
    </table>

    @if($messages_data['unread_messages'] > 10)
    <div class="warning-box">
        <p><strong>Atención:</strong> Hay {{ $messages_data['unread_messages'] }} mensajes sin leer. Se recomienda revisar la bandeja de entrada regularmente.</p>
    </div>
    @endif
</div>