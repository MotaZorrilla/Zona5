@extends('layouts.admin')

@section('title', 'Bandeja de Entrada')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Bandeja de Entrada de Contacto</h2>
        
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="flex h-[calc(100vh-250px)]">
                <!-- Sidebar de Mensajes -->
                <div class="w-1/3 lg:w-1/4 border-r border-gray-200 bg-gray-50 overflow-y-auto">
                    <div class="p-4 border-b">
                        <input type="search" placeholder="Buscar en mensajes..." class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-primary-500 focus:border-primary-500">
                    </div>
                    <nav class="flex-1" aria-label="Messages">
                        @php
                            $messages = [
                                ['id' => 1, 'sender' => 'Ana Torres', 'subject' => 'Consulta sobre horarios', 'time' => '10:45 AM', 'read' => false],
                                ['id' => 2, 'sender' => 'Marcos Rivas', 'subject' => 'Información de ingreso', 'time' => 'Ayer', 'read' => false],
                                ['id' => 3, 'sender' => 'Logia Piar y Sucre', 'subject' => 'Invitación a tenida blanca', 'time' => '2d atrás', 'read' => true],
                                ['id' => 4, 'sender' => 'Carlos Mendoza', 'subject' => 'Agradecimiento', 'time' => '3d atrás', 'read' => true],
                            ];
                        @endphp

                        @foreach ($messages as $message)
                            <a href="#" class="block p-4 border-b border-gray-200 @if($loop->first) bg-primary-100 border-l-4 border-primary-500 @else hover:bg-gray-100 @endif">
                                <div class="flex justify-between items-start">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $message['sender'] }}</p>
                                    @if(!$message['read'])
                                        <span class="h-2 w-2 mt-1 rounded-full bg-primary-500"></span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-800 truncate mt-1">{{ $message['subject'] }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $message['time'] }}</p>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <!-- Panel de Lectura -->
                <div class="w-2/3 lg:w-3/4 flex flex-col">
                    <!-- Cabecera del Mensaje -->
                    <div class="p-4 border-b flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-lg font-bold">Consulta sobre horarios</h3>
                            <p class="text-sm text-gray-600">De: <span class="font-medium">Ana Torres</span> (ana.torres@email.com)</p>
                        </div>
                        <div class="text-sm text-gray-500">Hoy, 10:45 AM</div>
                    </div>

                    <!-- Cuerpo del Mensaje -->
                    <div class="p-6 overflow-y-auto flex-grow">
                        <p class="text-gray-700 leading-relaxed">
                            Estimados Hermanos,
                            <br><br>
                            Mi nombre es Ana Torres y estoy interesada en conocer más sobre la masonería. Me gustaría saber si tienen horarios de atención al público o si es posible concertar una cita para conversar y aclarar algunas dudas que tengo.
                            <br><br>
                            Agradezco de antemano su tiempo y su guía.
                            <br><br>
                            Saludos cordiales,
                            <br>
                            Ana Torres
                        </p>
                    </div>

                    <!-- Acciones -->
                    <div class="p-4 border-t bg-gray-50">
                        <div class="flex items-center space-x-2">
                            <button class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="ri-reply-line mr-1"></i> Responder
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="ri-archive-line mr-1"></i> Archivar
                            </button>
                            <button class="px-4 py-2 text-sm font-medium text-red-600 border border-red-300 rounded-md hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <i class="ri-delete-bin-line mr-1"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
