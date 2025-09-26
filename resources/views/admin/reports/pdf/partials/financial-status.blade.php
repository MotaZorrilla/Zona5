<div class="section">
    <h2 class="section-title">Estado Financiero - Tesorería</h2>

    <h3 class="subsection-title">Resumen Financiero</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value {{ $financial_status['summary']['total_balance'] >= 0 ? 'text-green' : 'text-red' }}">
                    ${{ number_format($financial_status['summary']['total_balance'], 2) }}
                </span>
                <div class="kpi-label">Saldo Total Actual</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">${{ number_format($financial_status['summary']['total_income'], 2) }}</span>
                <div class="kpi-label">Ingresos Totales</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-red">${{ number_format($financial_status['summary']['total_expense'], 2) }}</span>
                <div class="kpi-label">Egresos Totales</div>
            </div>
        </div>
    </div>

    <h3 class="subsection-title">Movimientos del Mes Actual</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value text-green">${{ number_format($financial_status['summary']['current_month_income'], 2) }}</span>
                <div class="kpi-label">Ingresos del Mes</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-red">${{ number_format($financial_status['summary']['current_month_expense'], 2) }}</span>
                <div class="kpi-label">Egresos del Mes</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value {{ $financial_status['summary']['current_month_balance'] >= 0 ? 'text-green' : 'text-red' }}">
                    ${{ number_format($financial_status['summary']['current_month_balance'], 2) }}
                </span>
                <div class="kpi-label">Balance del Mes</div>
            </div>
        </div>
    </div>

    @if($charts_data)
    <div class="chart-placeholder">
        Gráfico de Barras: Ingresos vs Egresos por Mes
    </div>
    @endif

    <h3 class="subsection-title">Movimientos Recientes (Últimos 20)</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Logia</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($financial_status['recent_movements'] as $movement)
            <tr>
                <td>{{ \Carbon\Carbon::parse($movement->transaction_date)->format('d/m/Y') }}</td>
                <td>{{ $movement->description }}</td>
                <td>{{ $movement->category }}</td>
                <td>{{ $movement->lodge ? $movement->lodge->name : 'N/A' }}</td>
                <td class="text-center">
                    <span class="{{ $movement->type === 'income' ? 'text-green' : 'text-red' }}">
                        {{ $movement->type === 'income' ? 'Ingreso' : 'Egreso' }}
                    </span>
                </td>
                <td class="text-right {{ $movement->type === 'income' ? 'text-green' : 'text-red' }}">
                    {{ $movement->type === 'income' ? '+' : '-' }} ${{ number_format($movement->amount, 2) }}
                </td>
                <td class="text-center">{{ ucfirst($movement->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Análisis por Categorías</h3>
    
    <div style="display: table; width: 100%; margin-bottom: 20px;">
        <div style="display: table-row;">
            <div style="display: table-cell; width: 50%; padding-right: 10px;">
                <h4 style="font-size: 12px; font-weight: bold; color: #10B981; margin-bottom: 10px;">Ingresos por Categoría</h4>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Monto</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalIncome = $financial_status['income_by_category']->sum('total');
                        @endphp
                        @foreach($financial_status['income_by_category'] as $income)
                        <tr>
                            <td>{{ $income->category }}</td>
                            <td class="text-right text-green">${{ number_format($income->total, 2) }}</td>
                            <td class="text-center">{{ $totalIncome > 0 ? round(($income->total / $totalIncome) * 100, 1) : 0 }}%</td>
                        </tr>
                        @endforeach
                        <tr style="background-color: #F3F4F6; font-weight: bold;">
                            <td>TOTAL</td>
                            <td class="text-right text-green">${{ number_format($totalIncome, 2) }}</td>
                            <td class="text-center">100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="display: table-cell; width: 50%; padding-left: 10px;">
                <h4 style="font-size: 12px; font-weight: bold; color: #EF4444; margin-bottom: 10px;">Egresos por Categoría</h4>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Monto</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalExpense = $financial_status['expense_by_category']->sum('total');
                        @endphp
                        @foreach($financial_status['expense_by_category'] as $expense)
                        <tr>
                            <td>{{ $expense->category }}</td>
                            <td class="text-right text-red">${{ number_format($expense->total, 2) }}</td>
                            <td class="text-center">{{ $totalExpense > 0 ? round(($expense->total / $totalExpense) * 100, 1) : 0 }}%</td>
                        </tr>
                        @endforeach
                        <tr style="background-color: #F3F4F6; font-weight: bold;">
                            <td>TOTAL</td>
                            <td class="text-right text-red">${{ number_format($totalExpense, 2) }}</td>
                            <td class="text-center">100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($financial_status['movements_by_lodge']->count() > 0)
    <h3 class="subsection-title">Movimientos por Logia</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Logia</th>
                <th>Ingresos</th>
                <th>Egresos</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($financial_status['movements_by_lodge'] as $lodgeId => $movements)
                @php
                    $lodge = \App\Models\Lodge::find($lodgeId);
                    $income = $movements->where('type', 'income')->sum('total');
                    $expense = $movements->where('type', 'expense')->sum('total');
                    $balance = $income - $expense;
                @endphp
                <tr>
                    <td class="font-bold">{{ $lodge ? $lodge->name : 'Logia Desconocida' }}</td>
                    <td class="text-right text-green">${{ number_format($income, 2) }}</td>
                    <td class="text-right text-red">${{ number_format($expense, 2) }}</td>
                    <td class="text-right {{ $balance >= 0 ? 'text-green' : 'text-red' }}">
                        ${{ number_format($balance, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h3 class="subsection-title">Indicadores Financieros</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Indicador</th>
                <th>Valor</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="font-bold">Liquidez Actual</td>
                <td class="text-center">${{ number_format($financial_status['summary']['total_balance'], 2) }}</td>
                <td class="text-center {{ $financial_status['summary']['total_balance'] >= 0 ? 'text-green' : 'text-red' }}">
                    {{ $financial_status['summary']['total_balance'] >= 0 ? 'Positiva' : 'Negativa' }}
                </td>
            </tr>
            <tr>
                <td class="font-bold">Flujo Mensual</td>
                <td class="text-center">${{ number_format($financial_status['summary']['current_month_balance'], 2) }}</td>
                <td class="text-center {{ $financial_status['summary']['current_month_balance'] >= 0 ? 'text-green' : 'text-red' }}">
                    {{ $financial_status['summary']['current_month_balance'] >= 0 ? 'Positivo' : 'Negativo' }}
                </td>
            </tr>
            <tr>
                <td class="font-bold">Ratio Ingresos/Egresos</td>
                <td class="text-center">
                    {{ $financial_status['summary']['total_expense'] > 0 ? round($financial_status['summary']['total_income'] / $financial_status['summary']['total_expense'], 2) : 'N/A' }}
                </td>
                <td class="text-center">
                    @php
                        $ratio = $financial_status['summary']['total_expense'] > 0 ? $financial_status['summary']['total_income'] / $financial_status['summary']['total_expense'] : 0;
                    @endphp
                    <span class="{{ $ratio >= 1 ? 'text-green' : 'text-red' }}">
                        {{ $ratio >= 1 ? 'Saludable' : 'Atención' }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    @if($financial_status['summary']['total_balance'] < 0)
    <div class="warning-box">
        <p><strong>Alerta Financiera:</strong> El saldo de tesorería es negativo (${{ number_format($financial_status['summary']['total_balance'], 2) }}). Se recomienda:</p>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>Revisar y reducir gastos no esenciales</li>
            <li>Implementar estrategias de generación de ingresos</li>
            <li>Solicitar contribuciones extraordinarias si es necesario</li>
        </ul>
    </div>
    @endif

    @if($financial_status['summary']['current_month_balance'] < 0)
    <div class="warning-box">
        <p><strong>Atención:</strong> El balance del mes actual es negativo (${{ number_format($financial_status['summary']['current_month_balance'], 2) }}). Monitorear de cerca los próximos movimientos.</p>
    </div>
    @endif
</div>