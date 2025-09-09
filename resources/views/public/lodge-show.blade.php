@extends('layouts.public')

@section('title', $lodge->name)

@section('content')
    <x-public.hero 
        :title="$lodge->name" 
        :subtitle="$lodge->orient"
        :imageUrl="$lodge->image_url ?? 'https://picsum.photos/seed/'. $lodge->slug .'/1920/1080'"
    />

    <div class="bg-white py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Columna Principal (Historia y Eventos) -->
                <div class="lg:col-span-2">
                    <!-- Historia -->
                    <div class="mb-12" data-scroll-reveal>
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 font-serif border-b pb-4 mb-6">Nuestra Historia</h2>
                        <div class="prose prose-lg max-w-none text-gray-600 text-justify">
                            <p>{{ $lodge->history ?? 'La historia de esta logia aún no ha sido registrada.' }}</p>
                        </div>
                    </div>

                    <!-- Próximos Eventos (Aún estático) -->
                    <div data-scroll-reveal>
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 font-serif border-b pb-4 mb-6">Próximos Eventos</h2>
                        <div class="space-y-4">
                            {{-- @forelse ($lodge->events as $event) --}}
                                <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-800">Tenida Ordinaria</p>
                                        <p class="text-sm text-gray-500">Fecha: Próximamente</p>
                                    </div>
                                    <i class="ri-calendar-event-line text-primary-500 text-2xl"></i>
                                </div>
                            {{-- @empty --}}
                                <p class="text-gray-500">No hay eventos próximos programados.</p>
                            {{-- @endforelse --}}
                        </div>
                    </div>
                </div>

                <!-- Columna Lateral (Dignatarios y Mapa) -->
                <aside class="lg:col-span-1 space-y-12">
                    <!-- Dignatarios -->
                    <div data-scroll-reveal>
                        <h3 class="text-2xl font-bold text-gray-900 font-serif mb-4">Cuadro Logial</h3>
                        <ul class="space-y-3">
                            @forelse ($lodge->users as $user)
                                <li class="flex items-center p-3 bg-gray-50 rounded-md">
                                    <i class="ri-user-star-line text-primary-600 mr-3"></i>
                                    <div>
                                        {{-- Asumimos que el rol se manejará más adelante. Por ahora, un rol genérico --}}
                                        <p class="font-semibold text-sm text-gray-800">{{ $user->getRoleDisplayName() ?? 'Miembro' }}</p>
                                        <p class="text-sm text-gray-600">{{ $user->name }}</p>
                                    </div>
                                </li>
                            @empty
                                <li class="text-gray-500">No hay miembros registrados para esta logia.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Mapa (Aún estático) -->
                    <div data-scroll-reveal>
                        <h3 class="text-2xl font-bold text-gray-900 font-serif mb-4">Ubicación</h3>
                        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-md">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.339728974775!2d-62.716088!3d-8.101628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8dce86a7c5c37c75%3A0x54468b4f569c46b6!2sPlaza%20Bolivar!5e0!3m2!1sen!2sve!4v1678886400000!5m2!1sen!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
@endsection