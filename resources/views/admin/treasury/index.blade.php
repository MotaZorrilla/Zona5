@extends('layouts.admin')
@section('title', 'Tesorería')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Gestión de Tesorería</h2>
            <div>
                <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                    Registrar Egreso
                </button>
                <button class="ml-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Registrar Ingreso
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 truncate">Saldo Actual</h3>
                <p class="mt-1 text-3xl font-semibold text-gray-900">$ 1,250.75</p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 truncate">Ingresos (Últimos 30 días)</h3>
                <p class="mt-1 text-3xl font-semibold text-green-600">+ $ 450.00</p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-sm font-medium text-gray-500 truncate">Egresos (Últimos 30 días)</h3>
                <p class="mt-1 text-3xl font-semibold text-red-600">- $ 120.50</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Últimos Movimientos</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Ejemplo de Ingreso --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">01/09/2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Aporte Logia Asilo de la Paz N° 13</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aportes</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+ $ 150.00</td>
                        </tr>
                        {{-- Ejemplo de Egreso --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/08/2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Compra de papelería para secretaría</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Gastos Administrativos</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">- $ 45.00</td>
                        </tr>
                        {{-- Otro Ingreso --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25/08/2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Donación Q∴H∴ Anónimo</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Donaciones</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+ $ 100.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
