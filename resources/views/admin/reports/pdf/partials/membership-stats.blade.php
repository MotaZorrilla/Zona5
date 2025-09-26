<div class="section">
    <div class="section-title">Estadísticas de Membresía</div>

    <div class="subsection-title">Distribución por Grado</div>
    
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
                <span class="kpi-value text-red">{{ $membership_stats['total_masters'] }}</span>
                <div class="kpi-label">Maestros</div>
            </div>
        </div>
    </div>

    @if($charts_data)
    <div style="margin: 20px 0; padding: 20px; border: 1px solid #e5e7eb; background: #f8fafc;">
        <h4 style="margin: 0 0 15px 0; color: #1e40af; font-size: 14px; font-weight: bold;">Distribución por Grado</h4>

        @php
            $total_members = $membership_stats['total_apprentices'] + $membership_stats['total_companions'] + $membership_stats['total_masters'];
        @endphp

        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="width: 15px; height: 15px; background: #2563eb; margin-right: 10px; border-radius: 2px;"></div>
            <span style="font-size: 11px;">Aprendices: {{ $membership_stats['total_apprentices'] }} ({{ $total_members > 0 ? round(($membership_stats['total_apprentices'] / $total_members) * 100, 1) : 0 }}%)</span>
        </div>

        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div style="width: 15px; height: 15px; background: #059669; margin-right: 10px; border-radius: 2px;"></div>
            <span style="font-size: 11px;">Compañeros: {{ $membership_stats['total_companions'] }} ({{ $total_members > 0 ? round(($membership_stats['total_companions'] / $total_members) * 100, 1) : 0 }}%)</span>
        </div>

        <div style="display: flex; align-items: center; margin-bottom: 15px;">
            <div style="width: 15px; height: 15px; background: #d97706; margin-right: 10px; border-radius: 2px;"></div>
            <span style="font-size: 11px;">Maestros: {{ $membership_stats['total_masters'] }} ({{ $total_members > 0 ? round(($membership_stats['total_masters'] / $total_members) * 100, 1) : 0 }}%)</span>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="width: 33%; text-align: center; padding: 5px; background: #2563eb; color: white; font-weight: bold;">{{ round($total_members > 0 ? ($membership_stats['total_apprentices'] / $total_members) * 100 : 0, 1) }}%</td>
                <td style="width: 33%; text-align: center; padding: 5px; background: #059669; color: white; font-weight: bold;">{{ round($total_members > 0 ? ($membership_stats['total_companions'] / $total_members) * 100 : 0, 1) }}%</td>
                <td style="width: 33%; text-align: center; padding: 5px; background: #dc2626; color: white; font-weight: bold;">{{ round($total_members > 0 ? ($membership_stats['total_masters'] / $total_members) * 100 : 0, 1) }}%</td>
            </tr>
        </table>

        <p style="font-size: 10px; color: #64748b; margin: 10px 0 0 0; font-style: italic;">Representación visual de la distribución porcentual por grado masónico</p>
    </div>
    @endif

    <div class="subsection-title">Miembros por Logia</div>
    
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
                <td class="text-center text-red">{{ $lodgeData['masters'] }}</td>
                <td class="text-center">{{ $lodgeData['lodge']->foundation_date ? \Carbon\Carbon::parse($lodgeData['lodge']->foundation_date)->format('Y') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #DC2626; color: white; font-weight: bold;">
                <td colspan="3">TOTALES</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('total_members') }}</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('apprentices') }}</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('companions') }}</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->sum('masters') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="subsection-title">Crecimiento de Membresía (Últimos 6 Meses)</div>
    
    @if($charts_data)
    <div style="margin: 20px 0; padding: 20px; border: 1px solid #e5e7eb; background: #f8fafc;">
        <h4 style="margin: 0 0 15px 0; color: #1e40af; font-size: 14px; font-weight: bold;">Crecimiento de Membresía (Últimos 6 Meses)</h4>

        <div style="margin-bottom: 15px;">
            <div style="display: flex; align-items: center; margin-bottom: 5px;">
                <div style="width: 12px; height: 2px; background: #2563eb; margin-right: 8px;"></div>
                <span style="font-size: 10px;">Aprendices</span>
            </div>
            <div style="display: flex; align-items: center; margin-bottom: 5px;">
                <div style="width: 12px; height: 2px; background: #059669; margin-right: 8px;"></div>
                <span style="font-size: 10px;">Compañeros</span>
            </div>
            <div style="display: flex; align-items: center;">
                <div style="width: 12px; height: 2px; background: #d97706; margin-right: 8px;"></div>
                <span style="font-size: 10px;">Maestros</span>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px;">
            <tr>
                @foreach($membership_stats['membership_growth'] as $growth)
                <td style="text-align: center; padding: 2px; border: 1px solid #e5e7eb;">
                    <div style="font-weight: bold; margin-bottom: 3px;">{{ substr($growth['month'], 0, 3) }}</div>
                    <div style="color: #2563eb;">A: {{ $growth['apprentices'] }}</div>
                    <div style="color: #059669;">C: {{ $growth['companions'] }}</div>
                    <div style="color: #dc2626;">M: {{ $growth['masters'] }}</div>
                </td>
                @endforeach
            </tr>
        </table>

        <p style="font-size: 10px; color: #64748b; margin: 10px 0 0 0; font-style: italic;">Tendencia de crecimiento por grado masónico en los últimos 6 meses</p>
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
                <td class="text-center text-red">{{ $growth['masters'] }}</td>
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

    <div class="subsection-title">Análisis de Membresía</div>
    
    <div class="summary-box">
        <p><strong>Distribución Actual:</strong></p>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li><strong>Aprendices:</strong> {{ $membership_stats['total_apprentices'] }} miembros ({{ $total_members > 0 ? round(($membership_stats['total_apprentices'] / $total_members) * 100, 1) : 0 }}%)</li>
            <li><strong>Compañeros:</strong> {{ $membership_stats['total_companions'] }} miembros ({{ $total_members > 0 ? round(($membership_stats['total_companions'] / $total_members) * 100, 1) : 0 }}%)</li>
            <li><strong>Maestros:</strong> {{ $membership_stats['total_masters'] }} miembros ({{ $total_members > 0 ? round(($membership_stats['total_masters'] / $total_members) * 100, 1) : 0 }}%)</li>
        </ul>
    </div>

    @php
        $totalNewMembers = collect($membership_stats['membership_growth'])->sum('new_members');
        $averagePerMonth = round($totalNewMembers / 6, 1);
        $topLodge = $membership_stats['members_by_lodge']->isNotEmpty() ? $membership_stats['members_by_lodge']->sortByDesc('total_members')->first() : null;
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
                <td class="text-center">{{ $topLodge ? $topLodge['lodge']->name . ' (' . $topLodge['total_members'] . ' miembros)' : 'N/A' }}</td>
            </tr>
            <tr>
                <td class="font-bold">Promedio de miembros por logia</td>
                <td class="text-center">{{ $membership_stats['members_by_lodge']->isNotEmpty() ? round($membership_stats['members_by_lodge']->avg('total_members'), 1) : 0 }}</td>
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