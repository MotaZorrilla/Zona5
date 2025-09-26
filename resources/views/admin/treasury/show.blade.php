@extends('layouts.admin')
@section('title', 'Detalle del Movimiento - Tesorería')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    Detalle del {{ $treasury->type === 'income' ? 'Ingreso' : 'Egreso' }}
                </h2>
                <div>
                    <a href="{{ route('admin.treasury.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Volver
                    </a>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $treasury->description }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Tipo</h3>
                    <p class="mt-1 text-lg font-semibold">
                        <span class="{{ $treasury->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $treasury->type === 'income' ? 'Ingreso' : 'Egreso' }}
                        </span>
                    </p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Monto</h3>
                    <p class="mt-1 text-lg font-semibold {{ $treasury->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $treasury->type === 'income' ? '+' : '-' }} $ {{ number_format($treasury->amount, 2) }}
                    </p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Categoría</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $treasury->category }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Fecha</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $treasury->transaction_date->format('d/m/Y') }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                    <p class="mt-1 text-lg font-semibold">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $treasury->status === 'completed' ? 'bg-green-100 text-green-800' :
                               ($treasury->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                               ($treasury->status === 'approved' ? 'bg-blue-100 text-blue-800' :
                               'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($treasury->status) }}
                        </span>
                    </p>
                </div>
                
                @if($treasury->lodge)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Logia</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $treasury->lodge->name }} ({{ $treasury->lodge->number }})</p>
                </div>
                @endif
                
                @if($treasury->reference)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Referencia</h3>
                    <p class="mt-1 text-lg font-semibold">{{ $treasury->reference }}</p>
                </div>
                @endif
            </div>
            
            @if($treasury->notes)
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Notas</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $treasury->notes }}</p>
                </div>
            </div>
            @endif
            
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Registrado por: {{ $treasury->user->name ?? 'N/A' }} 
                        el {{ $treasury->created_at->format('d/m/Y H:i') }}
                    </p>
                    @if($treasury->updated_at != $treasury->created_at)
                        <p class="text-sm text-gray-500">
                            Última actualización: {{ $treasury->updated_at->format('d/m/Y H:i') }}
                        </p>
                    @endif
                </div>
                
                <div class="flex space-x-4">
                    <a href="{{ route('admin.treasury.edit', $treasury) }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Editar
                    </a>
                    
                    <form method="POST" action="{{ route('admin.treasury.destroy', $treasury) }}" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection