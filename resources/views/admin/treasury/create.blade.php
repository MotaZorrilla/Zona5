@extends('layouts.admin')
@section('title', 'Registrar Movimiento - Tesorería')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">
                Registrar {{ request('type') === 'income' ? 'Ingreso' : 'Egreso' }}
            </h2>
            
            <form method="POST" action="{{ route('admin.treasury.store') }}">
                @csrf
                
                <input type="hidden" name="type" value="{{ request('type') ?? 'income' }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <input type="text" name="description" id="description" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('description') }}" required>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Monto</label>
                        <input type="number" step="0.01" name="amount" id="amount" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('amount') }}" required>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select name="category" id="category" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Seleccione una categoría</option>
                            @if($type === 'income')
                                <option value="Aportes" {{ old('category') === 'Aportes' ? 'selected' : '' }}>Aportes</option>
                                <option value="Donaciones" {{ old('category') === 'Donaciones' ? 'selected' : '' }}>Donaciones</option>
                                <option value="Eventos" {{ old('category') === 'Eventos' ? 'selected' : '' }}>Eventos</option>
                                <option value="Otros Ingresos" {{ old('category') === 'Otros Ingresos' ? 'selected' : '' }}>Otros Ingresos</option>
                            @else
                                <option value="Gastos Administrativos" {{ old('category') === 'Gastos Administrativos' ? 'selected' : '' }}>Gastos Administrativos</option>
                                <option value="Eventos" {{ old('category') === 'Eventos' ? 'selected' : '' }}>Eventos</option>
                                <option value="Mantenimiento" {{ old('category') === 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="Otros Egresos" {{ old('category') === 'Otros Egresos' ? 'selected' : '' }}>Otros Egresos</option>
                            @endif
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" name="transaction_date" id="transaction_date" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="reference" class="block text-sm font-medium text-gray-700">Referencia</label>
                        <input type="text" name="reference" id="reference" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('reference') }}">
                        @error('reference')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="lodge_id" class="block text-sm font-medium text-gray-700">Logia</label>
                        <select name="lodge_id" id="lodge_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Seleccione una logia (opcional)</option>
                            @foreach($lodges ?? [] as $lodge)
                                <option value="{{ $lodge->id }}" {{ old('lodge_id') == $lodge->id ? 'selected' : '' }}>
                                    {{ $lodge->name }} ({{ $lodge->number }})
                                </option>
                            @endforeach
                        </select>
                        @error('lodge_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notas</label>
                        <textarea name="notes" id="notes" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('admin.treasury.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cargar lodges si es necesario
    fetch('{{ route('admin.lodges.index') }}')
        .then(response => response.json())
        .then(data => {
            // Procesar la información de lodges si es necesario
        })
        .catch(error => console.error('Error:', error));
});
</script>
@endpush