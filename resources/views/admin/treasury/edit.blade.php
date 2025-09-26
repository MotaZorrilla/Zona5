@extends('layouts.admin')
@section('title', 'Editar Movimiento - Tesorería')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">
                Editar {{ $treasury->type === 'income' ? 'Ingreso' : 'Egreso' }}
            </h2>
            
            <form method="POST" action="{{ route('admin.treasury.update', $treasury) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <input type="text" name="description" id="description" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('description', $treasury->description) }}" required>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Monto</label>
                        <input type="number" step="0.01" name="amount" id="amount" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('amount', $treasury->amount) }}" required>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                        <select name="type" id="type" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="income" {{ old('type', $treasury->type) === 'income' ? 'selected' : '' }}>Ingreso</option>
                            <option value="expense" {{ old('type', $treasury->type) === 'expense' ? 'selected' : '' }}>Egreso</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select name="category" id="category" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Seleccione una categoría</option>
                            @if(old('type', $treasury->type) === 'income')
                                <option value="Aportes" {{ old('category', $treasury->category) === 'Aportes' ? 'selected' : '' }}>Aportes</option>
                                <option value="Donaciones" {{ old('category', $treasury->category) === 'Donaciones' ? 'selected' : '' }}>Donaciones</option>
                                <option value="Eventos" {{ old('category', $treasury->category) === 'Eventos' ? 'selected' : '' }}>Eventos</option>
                                <option value="Otros Ingresos" {{ old('category', $treasury->category) === 'Otros Ingresos' ? 'selected' : '' }}>Otros Ingresos</option>
                            @else
                                <option value="Gastos Administrativos" {{ old('category', $treasury->category) === 'Gastos Administrativos' ? 'selected' : '' }}>Gastos Administrativos</option>
                                <option value="Eventos" {{ old('category', $treasury->category) === 'Eventos' ? 'selected' : '' }}>Eventos</option>
                                <option value="Mantenimiento" {{ old('category', $treasury->category) === 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="Otros Egresos" {{ old('category', $treasury->category) === 'Otros Egresos' ? 'selected' : '' }}>Otros Egresos</option>
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
                               value="{{ old('transaction_date', $treasury->transaction_date->format('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="reference" class="block text-sm font-medium text-gray-700">Referencia</label>
                        <input type="text" name="reference" id="reference" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               value="{{ old('reference', $treasury->reference) }}">
                        @error('reference')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="lodge_id" class="block text-sm font-medium text-gray-700">Logia</label>
                        <select name="lodge_id" id="lodge_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Seleccione una logia (opcional)</option>
                            @foreach($lodges as $lodge)
                                <option value="{{ $lodge->id }}" {{ old('lodge_id', $treasury->lodge_id) == $lodge->id ? 'selected' : '' }}>
                                    {{ $lodge->name }} ({{ $lodge->number }})
                                </option>
                            @endforeach
                        </select>
                        @error('lodge_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="pending" {{ old('status', $treasury->status) === 'pending' ? 'selected' : '' }}>Pendiente</option>
                            <option value="approved" {{ old('status', $treasury->status) === 'approved' ? 'selected' : '' }}>Aprobado</option>
                            <option value="rejected" {{ old('status', $treasury->status) === 'rejected' ? 'selected' : '' }}>Rechazado</option>
                            <option value="completed" {{ old('status', $treasury->status) === 'completed' ? 'selected' : '' }}>Completado</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notas</label>
                        <textarea name="notes" id="notes" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes', $treasury->notes) }}</textarea>
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
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection