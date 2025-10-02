@extends('layouts.admin')
@section('title', 'Tesorería')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i class="ri-scales-3-line"></i> Gestión de Tesorería
            </h1>
            <p class="text-sm text-gray-600 mt-1">Gestiona los ingresos, egresos y balance financiero.</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('admin.treasury.create', ['type' => 'expense']) }}" 
               class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                Registrar Egreso
            </a>
            <a href="{{ route('admin.treasury.create', ['type' => 'income']) }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                Registrar Ingreso
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-t-4 border-blue-500 p-6">
            <h3 class="text-sm font-medium text-gray-500 truncate">Saldo Actual</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900">+ $ {{ number_format($summary['total_balance'], 2) }}</p>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-t-4 border-green-500 p-6">
            <h3 class="text-sm font-medium text-gray-500 truncate">Ingresos (Este mes)</h3>
            <p class="mt-1 text-3xl font-semibold text-green-600">+ $ {{ number_format($summary['monthly_income'], 2) }}</p>
        </div>
            <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-t-4 border-red-500 p-6">
                <h3 class="text-sm font-medium text-gray-500 truncate">Egresos (Este mes)</h3>
                <p class="mt-1 text-3xl font-semibold text-red-600">- $ {{ number_format($summary['monthly_expense'], 2) }}</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold text-primary-600 mb-4">Movimientos Recientes</h3>
                
                <!-- Filtros -->
                <div class="mb-4 flex space-x-4">
                    <form method="GET" class="flex space-x-2">
                        <select name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Todos los tipos</option>
                            <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>Ingresos</option>
                            <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>Egresos</option>
                        </select>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Filtrar
                        </button>
                    </form>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($treasuryRecords as $record)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $record->transaction_date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $record->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $record->category }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $record->lodge ? $record->lodge->name : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
                                        {{ $record->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $record->type === 'income' ? '+' : '-' }} $ {{ number_format($record->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.treasury.show', $record) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                        <a href="{{ route('admin.treasury.edit', $record) }}" class="ml-2 text-indigo-600 hover:text-indigo-900">Editar</a>
                                        <form method="POST" action="{{ route('admin.treasury.destroy', $record) }}" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No hay registros de tesorería.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="mt-4">
                    {{ $treasuryRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection