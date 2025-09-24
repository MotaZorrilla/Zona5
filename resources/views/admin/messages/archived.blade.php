@extends('layouts.admin')

@section('title', 'Mensajes Archivados')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Mensajes Archivados</h1>
            <p class="text-sm text-gray-500 mt-1">Lista de mensajes archivados.</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="flex items-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-arrow-left-line mr-2"></i>
            <span>Volver a la bandeja</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Éxito</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <form method="GET" action="{{ route('admin.messages.archived') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Buscar</label>
                <div class="relative">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar en mensajes..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                </div>
            </div>
            
            <!-- Date Range -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Desde</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
            </div>
            
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Hasta</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
            </div>
            
            <!-- Apply Filters Button -->
            <div class="flex items-end">
                <div class="w-full flex space-x-2">
                    <button type="submit" class="flex-1 bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.messages.archived') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-primary-500">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Asunto</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Fecha Archivado</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($messages as $message)
                    <tr class="odd:bg-white even:bg-primary-50 hover:bg-primary-100 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                    <i class="ri-user-star-line text-primary-500"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $message->sender_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $message->subject }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $message->archived_at ? $message->archived_at->diffForHumans() : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.messages.restore', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres restaurar este mensaje?');">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Restaurar">
                                        <i class="ri-refresh-line text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 whitespace-nowrap text-center">
                            <div class="text-center">
                                <i class="ri-archive-line text-6xl text-gray-300 mb-4"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron mensajes archivados</h3>
                                <p class="mt-1 text-sm text-gray-500">Tu bandeja de mensajes archivados está vacía.</p>
                                <div class="mt-6">
                                    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        <i class="ri-arrow-left-line mr-2"></i>
                                        Volver a la bandeja de entrada
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
@endsection