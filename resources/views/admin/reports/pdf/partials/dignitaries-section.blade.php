<div class="section">
    <h2 class="section-title">Dignatarios de Zona</h2>

    <h3 class="subsection-title">Estructura Directiva</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Biografía</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dignitaries_data['dignitaries'] as $dignitary)
            <tr>
                <td class="font-bold">{{ $dignitary->name }}</td>
                <td class="text-center">{{ $dignitary->role }}</td>
                <td style="font-size: 9px;">{{ $dignitary->bio ? Str::limit($dignitary->bio, 150) : 'Sin biografía disponible' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center" style="color: #666; font-style: italic;">No hay dignatarios registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary-box">
        <p><strong>Total de Dignatarios:</strong> {{ $dignitaries_data['dignitaries']->count() }}</p>
        <p>La estructura directiva de la Gran Zona 5 está compuesta por los dignatarios listados anteriormente, quienes lideran las actividades administrativas y ceremoniales de la jurisdicción.</p>
    </div>
</div>