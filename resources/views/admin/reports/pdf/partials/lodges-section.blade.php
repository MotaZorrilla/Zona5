<div class="section">
    <h2 class="section-title">Directorio de Logias</h2>

    <h3 class="subsection-title">Resumen de Logias</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $lodges_data['total_lodges'] }}</span>
                <div class="kpi-label">Total de Logias</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ $lodges_data['lodges_by_orient']->count() }}</span>
                <div class="kpi-label">Orientes</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ round($lodges_data['lodges']->avg('users_count'), 1) }}</span>
                <div class="kpi-label">Promedio Miembros/Logia</div>
            </div>
        </div>
    </div>

    <h3 class="subsection-title">Logias por Oriente</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Oriente</th>
                <th>Cantidad de Logias</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lodges_data['lodges_by_orient'] as $orient)
            <tr>
                <td class="font-bold">{{ $orient->orient }}</td>
                <td class="text-center">{{ $orient->count }}</td>
                <td class="text-center">{{ round(($orient->count / $lodges_data['total_lodges']) * 100, 1) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Directorio Completo de Logias</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Número</th>
                <th>Oriente</th>
                <th>Miembros</th>
                <th>Fundación</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lodges_data['lodges'] as $lodge)
            <tr>
                <td class="font-bold">{{ $lodge->name }}</td>
                <td class="text-center">{{ $lodge->number }}</td>
                <td>{{ $lodge->orient }}</td>
                <td class="text-center">{{ $lodge->users_count }}</td>
                <td class="text-center">{{ $lodge->foundation_date ? \Carbon\Carbon::parse($lodge->foundation_date)->format('Y') : 'N/A' }}</td>
                <td style="font-size: 9px;">{{ $lodge->address ?: 'No especificada' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $oldestLodge = $lodges_data['lodges']->filter(function($lodge) {
            return $lodge->foundation_date;
        })->sortBy('foundation_date')->first();
        
        $newestLodge = $lodges_data['lodges']->filter(function($lodge) {
            return $lodge->foundation_date;
        })->sortByDesc('foundation_date')->first();
        
        $largestLodge = $lodges_data['lodges']->sortByDesc('users_count')->first();
    @endphp

    <h3 class="subsection-title">Estadísticas Destacadas</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Logia</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            @if($oldestLodge)
            <tr>
                <td class="font-bold">Logia más antigua</td>
                <td>{{ $oldestLodge->name }}</td>
                <td>Fundada en {{ \Carbon\Carbon::parse($oldestLodge->foundation_date)->format('Y') }}</td>
            </tr>
            @endif
            @if($newestLodge)
            <tr>
                <td class="font-bold">Logia más reciente</td>
                <td>{{ $newestLodge->name }}</td>
                <td>Fundada en {{ \Carbon\Carbon::parse($newestLodge->foundation_date)->format('Y') }}</td>
            </tr>
            @endif
            <tr>
                <td class="font-bold">Logia con más miembros</td>
                <td>{{ $largestLodge->name }}</td>
                <td>{{ $largestLodge->users_count }} miembros</td>
            </tr>
        </tbody>
    </table>
</div>