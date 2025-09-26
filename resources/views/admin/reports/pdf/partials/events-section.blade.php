<div class="section">
    <h2 class="section-title">Gestión de Eventos</h2>

    <h3 class="subsection-title">Resumen de Eventos</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $events_data['total_events'] }}</span>
                <div class="kpi-label">Total de Eventos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">{{ $events_data['upcoming_events']->count() }}</span>
                <div class="kpi-label">Eventos Programados</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-blue">{{ $events_data['recent_events']->count() }}</span>
                <div class="kpi-label">Eventos Recientes</div>
            </div>
        </div>
    </div>

    <h3 class="subsection-title">Eventos por Tipo</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Tipo de Evento</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @php $totalEventsByType = $events_data['events_by_type']->sum('count'); @endphp
            @foreach($events_data['events_by_type'] as $eventType)
            <tr>
                <td class="font-bold">{{ ucfirst($eventType->type) }}</td>
                <td class="text-center">{{ $eventType->count }}</td>
                <td class="text-center">{{ $totalEventsByType > 0 ? round(($eventType->count / $totalEventsByType) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Eventos Públicos vs Privados</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPublicPrivate = $events_data['public_vs_private']->sum('count'); @endphp
            @foreach($events_data['public_vs_private'] as $visibility)
            <tr>
                <td class="font-bold">{{ $visibility->is_public ? 'Públicos' : 'Privados' }}</td>
                <td class="text-center">{{ $visibility->count }}</td>
                <td class="text-center">{{ $totalPublicPrivate > 0 ? round(($visibility->count / $totalPublicPrivate) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Próximos Eventos (Siguientes 10)</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Ubicación</th>
                <th>Tipo</th>
                <th>Visibilidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events_data['upcoming_events'] as $event)
            <tr>
                <td class="font-bold">{{ $event->title }}</td>
                <td>{{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}</td>
                <td>{{ $event->location ?: 'No especificada' }}</td>
                <td class="text-center">{{ ucfirst($event->type) }}</td>
                <td class="text-center">
                    <span class="{{ $event->is_public ? 'text-green' : 'text-blue' }}">
                        {{ $event->is_public ? 'Público' : 'Privado' }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="color: #666; font-style: italic;">No hay eventos programados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="subsection-title">Eventos Recientes</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Creado por</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events_data['recent_events']->take(15) as $event)
            <tr>
                <td class="font-bold">{{ $event->title }}</td>
                <td>{{ \Carbon\Carbon::parse($event->start_time)->format('d/m/Y') }}</td>
                <td class="text-center">{{ ucfirst($event->type) }}</td>
                <td>{{ $event->location ?: 'No especificada' }}</td>
                <td>{{ $event->creator ? $event->creator->name : 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="color: #666; font-style: italic;">No hay eventos recientes</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($events_data['upcoming_events']->count() == 0)
    <div class="warning-box">
        <p><strong>Atención:</strong> No hay eventos programados. Se recomienda planificar actividades para mantener la participación activa de los miembros.</p>
    </div>
    @endif
</div>