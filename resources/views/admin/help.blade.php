@extends('layouts.admin')

@section('title', 'Centro de Ayuda')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <i class="ri-question-line text-6xl text-primary-500"></i>
        <h1 class="text-4xl font-bold text-gray-800 mt-4">Centro de Ayuda</h1>
        <p class="text-lg text-gray-500 mt-2">¿Cómo podemos ayudarte?</p>
        <div class="mt-6 relative w-full max-w-lg mx-auto">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-4 text-gray-400"></i>
            <input type="text" class="w-full bg-white border border-gray-200 rounded-full py-3 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400 shadow-sm" placeholder="Busca en nuestra base de conocimiento...">
        </div>
    </div>

    <!-- Help Categories -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-6 rounded-xl shadow-lg text-center hover:shadow-2xl transition-shadow transform hover:-translate-y-1">
            <i class="ri-rocket-line text-4xl text-primary-500"></i>
            <h3 class="font-bold text-lg mt-4">Primeros Pasos</h3>
            <p class="text-sm text-gray-600 mt-2">Guías para configurar tu cuenta y empezar a usar el portal.</p>
            <a href="#" class="mt-4 inline-block text-primary-500 font-semibold hover:underline">Ver guías &rarr;</a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg text-center hover:shadow-2xl transition-shadow transform hover:-translate-y-1">
            <i class="ri-group-2-line text-4xl text-green-500"></i>
            <h3 class="font-bold text-lg mt-4">Gestión de Miembros</h3>
            <p class="text-sm text-gray-600 mt-2">Aprende a invitar, editar y gestionar los roles de los usuarios.</p>
            <a href="#" class="mt-4 inline-block text-green-500 font-semibold hover:underline">Ver guías &rarr;</a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg text-center hover:shadow-2xl transition-shadow transform hover:-translate-y-1">
            <i class="ri-archive-2-line text-4xl text-yellow-500"></i>
            <h3 class="font-bold text-lg mt-4">Uso del Repositorio</h3>
            <p class="text-sm text-gray-600 mt-2">Todo sobre cómo subir, categorizar y compartir documentos.</p>
            <a href="#" class="mt-4 inline-block text-yellow-500 font-semibold hover:underline">Ver guías &rarr;</a>
        </div>
    </div>

    <!-- FAQ Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Preguntas Frecuentes (FAQ)</h2>
        <div class="space-y-4" x-data="{ open: null }">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-xl shadow-sm">
                <button @click="open = (open === 1 ? null : 1)" class="w-full flex justify-between items-center text-left p-5">
                    <span class="font-semibold text-gray-800">¿Cómo restauro mi contraseña?</span>
                    <i class="ri-arrow-down-s-line transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                </button>
                <div x-show="open === 1" class="px-5 pb-5 text-gray-600">
                    <p>Puedes restaurar tu contraseña desde la página de inicio de sesión, haciendo clic en el enlace "¿Olvidaste tu contraseña?". Recibirás un correo electrónico con instrucciones para crear una nueva.</p>
                </div>
            </div>
            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-xl shadow-sm">
                <button @click="open = (open === 2 ? null : 2)" class="w-full flex justify-between items-center text-left p-5">
                    <span class="font-semibold text-gray-800">¿Qué roles de usuario existen?</span>
                    <i class="ri-arrow-down-s-line transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                </button>
                <div x-show="open === 2" class="px-5 pb-5 text-gray-600">
                    <p>Actualmente existen tres roles: <strong>SuperAdmin</strong> (control total), <strong>Admin</strong> (gestión de contenido y usuarios) y <strong>Miembro</strong> (acceso de solo lectura a ciertas secciones).</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
