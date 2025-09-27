@extends('layouts.public')

@section('title', $pageSettings['title'] . ' - Gran Zona 5')

@section('content')
    <x-public.hero
        title="{{ $pageSettings['title'] }}"
        subtitle="{{ $pageSettings['subtitle'] }}"
        imageUrl="{{ $pageSettings['banner_image'] }}"
    />

    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Search and Filters -->
            <form method="GET" action="{{ url()->current() }}" class="mb-16 flex flex-col md:flex-row justify-between items-center gap-4" data-scroll-reveal>
                <div class="relative w-full md:w-2/3">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full bg-white border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar en el archivo...">
                </div>
                <div class="flex items-center gap-4">
                    <select name="category" class="bg-white border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        <option value="">Filtrar por Categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <select name="grade" class="bg-white border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        <option value="">Filtrar por Grado</option>
                        @foreach($grades as $grade_level)
                            <option value="{{ $grade_level }}" {{ request('grade') == $grade_level ? 'selected' : '' }}>{{ $grade_level }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        Filtrar
                    </button>
                </div>
            </form>

            <!-- Documents List -->
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3" data-scroll-reveal>
                @forelse($documents as $document)
                    <x-card-image
                        image="https://picsum.photos/seed/doc-{{ $document->id }}/800/600"
                        title="{{ $document->title }}"
                        subtitle="{{ Str::limit($document->description ?? '', 100) }}"
                        type="{{ $document->category }}"
                        link="{{ route('admin.repository.show', $document) }}"
                    >
                        <div class="mt-8 flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $document->created_at->format('Y-m-d') }}" class="text-gray-500">
                                {{ $document->created_at->format('d M, Y') }}
                            </time>
                            @if($document->grade_level)
                                <span class="px-2 py-1 bg-primary-100 text-primary-800 rounded-full text-xs">
                                    {{ $document->grade_level }}
                                </span>
                            @endif
                        </div>
                    </x-card-image>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <i class="ri-folder-3-line text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No se encontraron documentos</h3>
                        <p class="text-gray-500">No hay documentos que coincidan con los filtros aplicados.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $documents->appends(request()->query())->links() }}
                </div>
            @endif

            <!-- Recent Documents List -->
            <div class="mt-24 bg-white p-8 rounded-2xl shadow-lg" data-scroll-reveal>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Documentos Recientes</h3>
                @guest
                    <p class="text-sm text-gray-600 mb-4">Para descargar documentos, por favor <a href="{{ route('login') }}" class="underline font-semibold text-primary-600 hover:text-primary-500" wire:navigate>inicia sesión</a> o <a href="{{ route('register') }}" class="underline font-semibold text-primary-600 hover:text-primary-500" wire:navigate>regístrate</a>.</p>
                @endguest
                <div class="space-y-4">
                    @forelse($documents->take(5) as $document)
                        <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                @if($document->file_type == 'pdf')
                                    <i class="ri-file-pdf-2-line text-3xl text-red-500 mr-4"></i>
                                @elseif(in_array($document->file_type, ['doc', 'docx']))
                                    <i class="ri-file-word-2-line text-3xl text-blue-500 mr-4"></i>
                                @elseif(in_array($document->file_type, ['xls', 'xlsx']))
                                    <i class="ri-file-excel-2-line text-3xl text-green-500 mr-4"></i>
                                @elseif(in_array($document->file_type, ['ppt', 'pptx']))
                                    <i class="ri-file-ppt-2-line text-3xl text-orange-500 mr-4"></i>
                                @elseif(in_array($document->file_type, ['jpg', 'jpeg', 'png']))
                                    <i class="ri-image-2-line text-3xl text-purple-500 mr-4"></i>
                                @else
                                    <i class="ri-file-3-line text-3xl text-gray-500 mr-4"></i>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $document->title }}</p>
                                    <p class="text-xs text-gray-500">
                                        Categoría: {{ $document->category ?? 'Sin categoría' }} |
                                        Grado: {{ $document->grade_level ?? 'Todos' }} |
                                        Subido por: {{ $document->uploader->name ?? 'Desconocido' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($document->created_at)->diffForHumans() }}</span>
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-gray-500 hover:text-gray-700"><i class="ri-more-2-fill"></i></button>
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-10 py-1">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalles</a>
                                        @guest
                                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Iniciar Sesión para Descargar</a>
                                        @endguest
                                        @auth
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Descargar</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="ri-folder-open-line text-4xl text-gray-300 mb-2"></i>
                            <p class="text-gray-500">No hay documentos disponibles en este momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
