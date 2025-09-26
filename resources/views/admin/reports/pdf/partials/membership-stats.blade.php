<div class="section">
    <h2 class="section-title">Estadísticas de Membresía</h2>

    <h3 class="subsection-title">Distribución por Grado</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value text-blue">{{ $membership_stats['total_apprentices'] }}</span>
                <div class="kpi-label">Aprendices</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">{{ $membership_stats['total_companions'] }}</span>
                <div class="kpi-label">Compañeros</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value" style="color: #D4AF37;">{{ $membership_stats['total_masters'] }}</span>
                <div class="kpi-label">Maestros</div>
            </div>
        </div>
    </div>

    @if($charts_data)
    <div class="chart-placeholder">
        Gráfico Circular: Distribución por Grado
    </div>
    @endif

    <h3 class="subsection-title">Miembros por Logia</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Logia</th>
                <th>Número</th>
                <th>Oriente</th>
                <th>Total</th>
                <th>Aprendices</th>
                <th>Compañeros</th>
                <th>Maestros</th>
                <th>Fundación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membership_stats['members_by_lodge'] as $lodgeData)
            <tr>
                <td class="font-bold">{{ $lodgeData['lodge']->name }}</td>
                <td class="text-center">{{ $lodgeData['lodge']->number }}</td>
                <td>{{ $lodgeData['lodge']->orient }}</td>
                <td class="text-center font-bold">{{ $lodgeData['total_members'] }}</td>
                <td class="text-center text-blue">{{ $lodgeData['apprentices'] }}</td>
                <td class="text-center text-green">{{ $lodgeData['companions'] }}</td>
                <td class="text-center" style="color: #D4AF37;">{{ $lodgeData['masters'] }}</td>
                <td class="text-center">{{ $lodgeData['lodge']->foundation_date ? \Carbon\Carbon::parse($lodgeData['lodge']->foundation_date)->format('Y') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #D4AF37; color: white; font-weight: bold;">
                <td colspan="3">TOTALES</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('total_members') }}</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('apprentices') }}</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('companions') }}</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('masters') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <h3 class="subsection-title">Crecimiento de Membresía (Últimos 6 Meses)</h3>
    
    @if($charts_data)
    <div class="chart-placeholder">
        Gráfico de Líneas: Crecimiento de Membresía por Grado
    </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Nuevos Miembros</th>
                <th>Aprendices</th>
                <th>Compañeros</th>
                <th>Maestros</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membership_stats['membership_growth'] as $growth)
            <tr>
                <td class="font-bold">{{ $growth['month'] }}</td>
                <td class="text-center">{{ $growth['new_members'] }}</td>
                <td class="text-center text-blue">{{ $growth['apprentices'] }}</td>
                <td class="text-center text-green">{{ $growth['companions'] }}</td>
                <td class="text-center" style="color: #D4AF37;">{{ $growth['masters'] }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #F3F4F6; font-weight: bold;">
                <td>TOTAL</td>
                <td class="text-center">{{ collect($membership_stats['membership_growth'])->sum('new_members') }}</td>
                <td class="text-center">{{ collect($membership_stats['membership_growth'])->sum('apprentices') }}</td>
                <td class="text-center">{{ collect($membership_stats['membership_growth'])->sum('companions') }}</td>
                <td class="text-center">{{ collect($membership_stats['membership_growth'])->sum('masters') }}</td>
            </tr>
        </tfoot>
    </table>

    <h3 class="subsection-title">Análisis de Membresía</h3>
    
    <div class="summary-box">
        <p><strong>Distribución Actual:</strong></p>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li><strong>Aprendices:</strong> {{ $membership_stats['total_apprentices'] }} miembros ({{ round(($membership_stats['total_apprentices'] / ($membership_stats['total_apprentices'] + $membership_stats['total_companions'] + $membership_stats['total_masters'])) * 100, 1) }}%)</li>
            <li><strong>Compañeros:</strong> {{ $membership_stats['total_companions'] }} miembros ({{ round(($membership_stats['total_companions'] / ($membership_stats['total_apprentices'] + $membership_stats['total_companions'] + $membership_stats['total_masters'])) * 100, 1) }}%)</li>
            <li><strong>Maestros:</strong> {{ $membership_stats['total_masters'] }} miembros ({{ round(($membership_stats['total_masters'] / ($membership_stats['total_apprentices'] + $membership_stats['total_companions'] + $membership_stats['total_masters'])) * 100, 1) }}%)</li>
        </ul>
    </div>

    @php
        $totalNewMembers = collect($membership_stats['membership_growth'])->sum('new_members');
        $averagePerMonth = round($totalNewMembers / 6, 1);
        $topLodge = $membership_stats['members_by_lodge']->sortByDesc('total_members')->first();
    @endphp

    <table class="data-table">
        <thead>
            <tr>
                <th colspan="2" style="text-align: center;">Estadísticas Adicionales</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="font-bold">Nuevos miembros (últimos 6 meses)</td>
                <td class="text-center">{{ $totalNewMembers }}</td>
            </tr>
            <tr>
                <td class="font-bold">Promedio mensual de nuevos miembros</td>
                <td class="text-center">{{ $averagePerMonth }}</td>
            </tr>
            <tr>
                <td class="font-bold">Logia con más miembros</td>
                <td class="text-center">{{ $topLodge['lodge']->name }} ({{ $topLodge['total_members'] }} miembros)</td>
            </tr>
            <tr>
                <td class="font-bold">Promedio de miembros por logia</td>
                <td class="text-center">{{ round($membership_stats['members_by_lodge']->avg('total_members'), 1) }}</td>
            </tr>
        </tbody>
    </table>

    @if($totalNewMembers == 0)
    <div class="warning-box">
        <p><strong>Observación:</strong> No se registraron nuevos miembros en los últimos 6 meses. Se recomienda revisar las estrategias de reclutamiento y crecimiento.</p>
    </div>
    @elseif($averagePerMonth < 1)
    <div class="warning-box">
        <p><strong>Observación:</strong> El crecimiento de membresía es bajo ({{ $averagePerMonth }} miembros/mes). Considerar implementar programas de atracción de nuevos miembros.</p>
    </div>
    @endif
</div>