
<div class="section">
    <h2 class="section-title">Actividad Reciente del Sistema</h2>

    <h3 class="subsection-title">Actividades Recientes (Últimas 20)</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Actividad</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activity_data['recent_activities'] as $activity)
            <tr>
                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $activity->user ? $activity->user->name : 'Sistema' }}</td>
                <td style="font-size: 9px;">{{ $activity->description }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center" style="color: #666; font-style: italic;">No hay actividad reciente registrada</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="subsection-title">Usuarios Más Activos</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Actividades</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @php $totalActivities = $activity_data['most_active_users']->sum('count'); @endphp
            @forelse($activity_data['most_active_users'] as $userActivity)
            <tr>
                <td class="font-bold">{{ $userActivity->user ? $userActivity->user->name : 'Usuario Desconocido' }}</td>
                <td class="text-center">{{ $userActivity->count }}</td>
                <td class="text-center">{{ $totalActivities > 0 ? round(($userActivity->count / $totalActivities) * 100, 1) : 0 }}%</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center" style="color: #666; font-style: italic;">No hay datos de actividad de usuarios</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary-box">
        <p><strong>Resumen de Actividad:</strong></p>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>Total de actividades registradas: {{ $activity_data['recent_activities']->count() }}</li>
            <li>Usuarios activos: {{ $activity_data['most_active_users']->count() }}</li>
            <li>Última actividad: {{ $activity_data['recent_activities']->first() ? $activity_data['recent_activities']->first()->created_at->diffForHumans() : 'N/A' }}</li>
        </ul>
    </div>
</div>