@extends('layouts.admin')

@section('title', 'Gestión de Eventos')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Eventos</h1>
            <p class="text-sm text-gray-500 mt-1">Planifica y administra los eventos de la Gran Zona.</p>
        </div>
        <button class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-calendar-2-line mr-2"></i>
            <span>Crear Nuevo Evento</span>
        </button>
    </div>

    <!-- Calendar View -->
    <div class="mb-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-700">Septiembre 2025</h2>
            <div class="flex gap-2">
                <button class="text-gray-500 hover:text-gray-700"><i class="ri-arrow-left-s-line text-2xl"></i></button>
                <button class="text-gray-500 hover:text-gray-700"><i class="ri-arrow-right-s-line text-2xl"></i></button>
            </div>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center">
            <!-- Calendar Header -->
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Dom</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Lun</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Mar</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Mié</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Jue</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Vie</div>
            <div class="text-xs font-bold text-gray-500 uppercase py-2">Sáb</div>

            <!-- Calendar Body (Static Example) -->
            <div class="h-24 border-t border-gray-200 text-gray-400 pt-1">31</div>
            <div class="h-24 border-t border-gray-200 pt-1">1</div>
            <div class="h-24 border-t border-gray-200 pt-1">2</div>
            <div class="h-24 border-t border-gray-200 pt-1 relative">
                3
                <div class="absolute bottom-1 left-1 right-1 text-xs bg-pink-500 text-white rounded-md p-1 truncate cursor-pointer">Tenida Solsticio</div>
            </div>
            <div class="h-24 border-t border-gray-200 pt-1">4</div>
            <div class="h-24 border-t border-gray-200 pt-1">5</div>
            <div class="h-24 border-t border-gray-200 pt-1">6</div>
            <div class="h-24 border-t border-gray-200 pt-1">7</div>
            <div class="h-24 border-t border-gray-200 pt-1">8</div>
            <div class="h-24 border-t border-gray-200 pt-1">9</div>
            <div class="h-24 border-t border-gray-200 pt-1">10</div>
            <div class="h-24 border-t border-gray-200 pt-1">11</div>
            <div class="h-24 border-t border-gray-200 pt-1 relative">
                12
                <div class="absolute bottom-1 left-1 right-1 text-xs bg-green-500 text-white rounded-md p-1 truncate cursor-pointer">Conferencia Pública</div>
            </div>
            <div class="h-24 border-t border-gray-200 pt-1">13</div>
            <!-- etc. -->
        </div>
    </div>

    <!-- Upcoming Events List -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Próximos Eventos</h3>
        <div class="space-y-4">
            <!-- Event Item 1 -->
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex flex-col items-center justify-center mr-4">
                        <span class="text-xs font-bold text-pink-500">SEP</span>
                        <span class="text-xl font-extrabold text-pink-600">3</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Tenida de Solsticio de Verano</p>
                        <p class="text-xs text-gray-500"><i class="ri-map-pin-line mr-1"></i>Templo Principal | <i class="ri-group-line ml-2 mr-1"></i>35 confirmados</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="#" class="bg-blue-100 text-blue-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-blue-200">Ver</a>
                    <a href="#" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-gray-200">Editar</a>
                </div>
            </div>
            <!-- Event Item 2 -->
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex flex-col items-center justify-center mr-4">
                        <span class="text-xs font-bold text-green-500">SEP</span>
                        <span class="text-xl font-extrabold text-green-600">12</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Conferencia Pública: Masonería y Sociedad</p>
                        <p class="text-xs text-gray-500"><i class="ri-vidicon-line mr-1"></i>Online (Zoom) | <i class="ri-group-line ml-2 mr-1"></i>112 confirmados</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="#" class="bg-blue-100 text-blue-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-blue-200">Ver</a>
                    <a href="#" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-gray-200">Editar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
