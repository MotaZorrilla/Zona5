@extends('layouts.admin')

@section('title', 'Configuración')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary-600 mb-2">Configuración</h1>
        <p class="text-sm text-gray-500">Ajusta las configuraciones generales del portal.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        <!-- Settings Navigation -->
        <aside class="w-full lg:w-1/4">
            <ul class="space-y-2">
                <li><a href="{{ route('admin.settings') }}" class="flex items-center gap-3 p-3 rounded-lg {{ request()->routeIs('admin.settings') ? 'bg-primary-100 text-primary-600 font-bold' : 'hover:bg-gray-100' }}"><i class="ri-settings-3-line text-xl"></i><span>General</span></a></li>
                <li><a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"><i class="ri-palette-line text-xl"></i><span>Apariencia</span></a></li>
                <li><a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"><i class="ri-shield-keyhole-line text-xl"></i><span>Seguridad</span></a></li>
                <li><a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"><i class="ri-mail-send-line text-xl"></i><span>Correo</span></a></li>
                <li><a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"><i class="ri-user-shared-line text-xl"></i><span>Roles y Permisos</span></a></li>
            </ul>
        </aside>

        <!-- Settings Content -->
        <main class="w-full lg:w-3/4">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Configuración General</h2>
                
                <form class="space-y-6" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="section" value="general" />
                    
                    <!-- Site Name -->
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700">Nombre del Sitio</label>
                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $generalSettings['site_name']) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <!-- Site Description -->
                    <div>
                        <label for="site_description" class="block text-sm font-medium text-gray-700">Descripción Corta</label>
                        <textarea name="site_description" id="site_description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">{{ old('site_description', $generalSettings['site_description']) }}</textarea>
                    </div>

                    <!-- Site Contact Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="site_email" class="block text-sm font-medium text-gray-700">Email de Contacto</label>
                            <input type="email" name="site_email" id="site_email" value="{{ old('site_email', $generalSettings['site_email']) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="site_phone" class="block text-sm font-medium text-gray-700">Teléfono de Contacto</label>
                            <input type="text" name="site_phone" id="site_phone" value="{{ old('site_phone', $generalSettings['site_phone']) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Site Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Logo del Sitio</label>
                        <div class="mt-2 flex items-center gap-6">
                            <div class="w-16 h-16 rounded-full bg-primary-500 flex items-center justify-center text-white text-3xl font-bold">Z5</div>
                            <div>
                                <input type="file" name="logo" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100"/>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, SVG hasta 2MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timezone -->
                    <div>
                        <label for="timezone" class="block text-sm font-medium text-gray-700">Zona Horaria</label>
                        <select name="timezone" id="timezone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="America/Caracas" {{ old('timezone', $generalSettings['timezone']) == 'America/Caracas' ? 'selected' : '' }}>Venezuela (GMT-4)</option>
                            <option value="America/New_York" {{ old('timezone', $generalSettings['timezone']) == 'America/New_York' ? 'selected' : '' }}>New York (GMT-5/-4)</option>
                            <option value="UTC" {{ old('timezone', $generalSettings['timezone']) == 'UTC' ? 'selected' : '' }}>UTC</option>
                        </select>
                    </div>

                    <!-- Maintenance Mode -->
                    <div class="border-t pt-6">
                        <label class="flex items-center justify-between">
                            <div>
                                <span class="text-base font-medium text-gray-900">Modo Mantenimiento</span>
                                <p class="text-sm text-gray-500">Desactiva el acceso público al sitio temporalmente.</p>
                            </div>
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{ old('maintenance_mode', $generalSettings['maintenance_mode']) ? 'checked' : '' }} />
                                <label for="maintenance_mode" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </label>
                    </div>

                    <!-- Save Button -->
                    <div class="text-right">
                        <button type="submit" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                            <i class="ri-save-3-line mr-2"></i>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<style>
.toggle-checkbox:checked {
  right: 0;
  border-color: #6366F1;
}
.toggle-checkbox:checked + .toggle-label {
  background-color: #6366F1;
}
</style>
@endsection