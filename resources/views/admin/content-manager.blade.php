@extends('layouts.admin')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Page header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary-600 mb-2">Gestor de Contenido del Sitio</h1>
        <p class="text-sm text-gray-500">Administra y personaliza el contenido de las páginas públicas de tu sitio web.</p>
    </div>

    <div class="bg-white shadow-lg rounded-sm">
        <!-- Tabs Navigation -->
        <div class="border-b border-slate-200">
            <div class="flex flex-nowrap overflow-x-auto no-scrollbar">
                @foreach ($sections as $sectionId => $sectionName)
                    <a class="block text-sm font-medium truncate whitespace-nowrap py-4 px-6 @if($currentSection == $sectionId) border-b-2 border-primary-500 text-primary-500 @else border-b-2 border-transparent text-slate-600 hover:text-slate-800 @endif" href="{{ route('admin.content-manager.show', $sectionId) }}">
                        {{ $sectionName }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Content Area -->
        <div class="border-t border-slate-200">
            @include($sectionView)
        </div>

    </div>
</div>
@endsection
