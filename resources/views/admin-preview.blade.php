
@extends('layouts.admin')

@section('title', 'Admin Dashboard V4 - Preview')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <!-- At a glance -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Miembros</p>
                <p class="text-3xl font-extrabold">150</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-500"><i class="ri-group-2-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Logias</p>
                <p class="text-3xl font-extrabold">25</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-500"><i class="ri-bank-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Documentos</p>
                <p class="text-3xl font-extrabold">350</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500"><i class="ri-archive-2-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Visitantes Hoy</p>
                <p class="text-3xl font-extrabold">1.2k</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-cyan-100 flex items-center justify-center text-cyan-500"><i class="ri-eye-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Tickets Soporte</p>
                <p class="text-3xl font-extrabold">5</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-500"><i class="ri-lifebuoy-line text-2xl"></i></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm stat-card flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Acciones Urgentes</p>
                <p class="text-3xl font-extrabold">3</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center text-pink-500"><i class="ri-error-warning-line text-2xl"></i></div>
        </div>
    </div>

    <!-- Main grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h4 class="font-bold text-lg text-gray-800 mb-4">Actividad Reciente</h4>
                <ul class="divide-y divide-gray-200">
                    <li class="py-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4"><i class="ri-file-add-line text-green-500"></i></div>
                        <div class="flex-1">
                            <p class="text-sm">Nuevo documento <a href="#" class="font-medium text-primary-500">"Plancha de Arquitectura"</a> fue subido.</p>
                            <p class="text-xs text-gray-500">Por: Carlos Rodriguez</p>
                        </div>
                        <span class="text-sm text-gray-500">Hace 2h</span>
                    </li>
                    <li class="py-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4"><i class="ri-user-add-line text-blue-500"></i></div>
                        <div class="flex-1">
                            <p class="text-sm">Nuevo miembro <a href="#" class="font-medium text-primary-500">Juan Perez</a> fue aprobado.</p>
                            <p class="text-xs text-gray-500">L73: <p class="text-xs text-gray-500">Logia: Estrella de Orient</p>
L94: <span>Estrella de Orient</span></p>
                        </div>
                        <span class="text-sm text-gray-500">Hace 4h</span>
                    </li>
                    <li class="py-4 flex items-center">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center mr-4"><i class="ri-calendar-2-line text-pink-500"></i></div>
                        <div class="flex-1">
                            <p class="text-sm">Nuevo evento <a href="#" class="font-medium text-primary-500">"Tenida de Solsticio"</a> fue programado.</p>
                            <p class="text-xs text-gray-500">Fecha: 21 de Junio</p>
                        </div>
                        <span class="text-sm text-gray-500">Ayer</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h4 class="font-bold text-lg text-gray-800 mb-4">Miembros por Logia</h4>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Estrella de Oriente</span>
                            <span>35/40</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-primary-500 h-2.5 rounded-full" style="width: 87.5%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Domingo F. Sarmiento</span>
                            <span>28/40</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Sol de Guayana</span>
                            <span>25/40</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 62.5%"></div>
                        </div>
                    </div>
                     <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>Aurora del Orinoco</span>
                            <span>22/40</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-pink-500 h-2.5 rounded-full" style="width: 55%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
