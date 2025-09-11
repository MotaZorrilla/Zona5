@extends('layouts.admin')

@section('title', 'Detalles del Miembro')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detalles del Miembro: {{ $user->name }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Columna Izquierda: Datos Personales y Roles --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
                <div class="flex items-center border-b pb-4 mb-6">
                    <img class="w-28 h-28 rounded-full object-cover mr-6 border-4 border-primary-500 shadow-md" src="https://i.pravatar.cc/150?u={{ $user->email }}" alt="Avatar de {{ $user->name }}">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-lg text-gray-600">{{ $user->profession ?? 'Profesión no especificada' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center p-3 bg-gray-50 rounded-md shadow-sm">
                        <i class="ri-mail-line text-primary-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Email</p>
                            <p class="text-sm font-medium text-gray-800">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-md shadow-sm">
                        <i class="ri-phone-line text-primary-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Teléfono</p>
                            <p class="text-sm font-medium text-gray-800">{{ $user->phone_number ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-md shadow-sm">
                        <i class="ri-id-card-line text-primary-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Cédula</p>
                            <p class="text-sm font-medium text-gray-800">{{ $user->national_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-md shadow-sm">
                        <i class="ri-cake-line text-primary-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Fecha de Nacimiento</p>
                            <p class="text-sm font-medium text-gray-800">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-md shadow-sm">
                        <i class="ri-calendar-event-line text-primary-600 text-2xl mr-3"></i>
                        <div>
                            <p class="text-xs font-semibold text-gray-500">Fecha de Iniciación</p>
                            <p class="text-sm font-medium text-gray-800">{{ $user->initiation_date ? \Carbon\Carbon::parse($user->initiation_date)->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-md shadow-sm">
                            <i class="ri-medal-line text-primary-600 text-2xl mr-3"></i>
                            <div>
                                <p class="text-xs font-semibold text-gray-500">Grado</p>
                                @php
                                    $degree = $user->degree ?? 'N/A';
                                    $class = 'text-gray-800 bg-gray-200';
                                    if ($degree === 'Aprendiz') {
                                        $class = 'text-sky-800 bg-sky-100';
                                    } elseif ($degree === 'Compañero') {
                                        $class = 'text-teal-800 bg-teal-100';
                                    } elseif ($degree === 'Maestro') {
                                        $class = 'text-amber-800 bg-amber-100';
                                    }
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                    {{ $degree }}
                                </span>
                            </div>
                        </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-6">Roles del Sistema</h2>
                <div class="flex flex-wrap gap-3">
                    @forelse ($user->roles as $role)
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-100 text-primary-800 border border-primary-200 shadow-sm">
                            <i class="ri-shield-user-line text-lg mr-2"></i>
                            {{ $role->name }}
                        </span>
                    @empty
                        <p class="text-base text-gray-500">Este miembro no tiene roles asignados.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Columna Derecha: Afiliaciones --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-6">Afiliaciones y Cargos</h2>

                <div class="space-y-4">
                    @forelse ($user->lodges as $affiliation)
                        <div class="bg-primary-50 p-4 rounded-lg shadow-sm border border-primary-100">
                            <p class="font-bold text-primary-800 text-lg mb-1">{{ $affiliation->name }} (No. {{ $affiliation->number }})</p>
                            <p class="text-sm text-primary-700 flex items-center">
                                <i class="ri-briefcase-line text-base mr-2"></i>
                                {{ $affiliation->pivot->position_id ? \App\Models\Position::find($affiliation->pivot->position_id)->name : 'Sin Cargo' }}
                            </p>
                        </div>
                    @empty
                        <p class="text-base text-gray-500">Este miembro no tiene afiliaciones activas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10 flex justify-end">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
            <i class="ri-arrow-left-line text-lg mr-2"></i>
            Volver a la lista
        </a>
    </div>
@endsection