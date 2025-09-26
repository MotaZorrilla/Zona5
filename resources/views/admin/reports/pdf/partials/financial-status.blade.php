<div class="section">
    <div class="section-title">Estado Financiero - Tesorería</div>

    <div class="subsection-title">Resumen Financiero</div>
    
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

    <div class="subsection-title">Movimientos del Mes Actual</div>
    
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
    <div style="margin: 20px 0; padding: 20px; border: 1px solid #e5e7eb; background: #f8fafc;">
        <h4 style="margin: 0 0 15px 0; color: #1e40af; font-size: 14px; font-weight: bold;">Ingresos vs Egresos por Mes (Últimos 6 Meses)</h4>

        <div style="margin-bottom: 15px;">
            <div style="display: flex; align-items: center; margin-bottom: 5px;">
                <div style="width: 15px; height: 15px; background: #059669; margin-right: 10px; border-radius: 2px;"></div>
                <span style="font-size: 11px;">Ingresos</span>
            </div>
            <div style="display: flex; align-items: center;">
                <div style="width: 15px; height: 15px; background: #dc2626; margin-right: 10px; border-radius: 2px;"></div>
                <span style="font-size: 11px;">Egresos</span>
            </div>
        </div>

        @php
            // Get the last 6 months data
            $monthlyData = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = \Carbon\Carbon::now()->subMonths($i);
                $monthStart = $date->copy()->startOfMonth();
                $monthEnd = $date->copy()->endOfMonth();

                $income = \App\Models\Treasury::where('type', 'income')
                    ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                    ->sum('amount');

                $expense = \App\Models\Treasury::where('type', 'expense')
                    ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                    ->sum('amount');

                $monthlyData[] = [
                    'month' => $date->format('M Y'),
                    'income' => $income,
                    'expense' => $expense
                ];
            }

            $maxValue = collect($monthlyData)->max(function($item) {
                return max($item['income'], $item['expense']);
            });
            $maxValue = $maxValue > 0 ? $maxValue : 1000;
        @endphp

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px;">
            <tr>
                @foreach($monthlyData as $data)
                <td style="text-align: center; padding: 2px; border: 1px solid #e5e7eb;">
                    <div style="font-weight: bold; margin-bottom: 3px;">{{ $data['month'] }}</div>
                    <div style="color: #059669;">Ing: ${{ number_format($data['income'], 0) }}</div>
                    <div style="color: #dc2626;">Egr: ${{ number_format($data['expense'], 0) }}</div>
                </td>
                @endforeach
            </tr>
        </table>

        <div style="margin-top: 15px; font-size: 10px; color: #64748b;">
            <p style="margin: 0;"><strong>Resumen:</strong></p>
            <ul style="margin: 5px 0; padding-left: 20px;">
                <li>Ingresos totales (6 meses): ${{ number_format(collect($monthlyData)->sum('income'), 2) }}</li>
                <li>Egresos totales (6 meses): ${{ number_format(collect($monthlyData)->sum('expense'), 2) }}</li>
                <li>Balance neto: ${{ number_format(collect($monthlyData)->sum('income') - collect($monthlyData)->sum('expense'), 2) }}</li>
            </ul>
        </div>
    </div>
    @endif

    <div class="subsection-title">Movimientos Recientes (Últimos 20)</div>
    
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

    <div class="subsection-title">Análisis por Categorías</div>
    
    <div style="display: table; width: 100%; margin-bottom: 20px;">
        <div style="display: table-row;">
            <div style="display: table-cell; width: 50%; padding-right: 10px;">
                <div class="subsection-title" style="font-size: 12px; color: #27AE60; margin-bottom: 10px; padding-bottom: 5px; padding-top: 5px;">Ingresos por Categoría</div>
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
                <div class="subsection-title" style="font-size: 12px; color: #C1272D; margin-bottom: 10px; padding-bottom: 5px; padding-top: 5px;">Egresos por Categoría</div>
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
    <div class="subsection-title">Movimientos por Logia</div>
    
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

    <div class="subsection-title">Indicadores Financieros</div>
    
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