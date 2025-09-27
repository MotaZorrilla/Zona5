@extends('layouts.public')

@section('title', $pageSettings['title'] . ' - Gran Zona 5')

@section('content')
    <x-public.hero
        title="{{ $pageSettings['title'] }}"
        subtitle="{{ $pageSettings['subtitle'] }}"
        imageUrl="{{ $pageSettings['banner_image'] }}"
    />

    <div class="py-16 sm:py-24">
        <div class="mx-auto max-w-3xl px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                    <p class="font-bold">¡Éxito!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if($contactSettings['show_form'])
            <form action="{{ route('public.contact.store') }}" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8" data-scroll-reveal>
                @csrf
                <div class="sm:col-span-2">
                    <label for="full-name" class="block text-sm font-semibold leading-6 text-gray-900">Nombre Completo</label>
                    <div class="mt-2.5">
                        <input type="text" name="full-name" id="full-name" autocomplete="name" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-masonic-gold sm:text-sm sm:leading-6 @error('full-name') ring-red-500 @enderror" value="{{ old('full-name') }}">
                    </div>
                    @error('full-name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                    <div class="mt-2.5">
                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-masonic-gold sm:text-sm sm:leading-6 @error('email') ring-red-500 @enderror" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="phone" class="block text-sm font-semibold leading-6 text-gray-900">Teléfono</label>
                    <div class="mt-2.5">
                        <input type="text" name="phone" id="phone" autocomplete="tel" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-masonic-gold sm:text-sm sm:leading-6 @error('phone') ring-red-500 @enderror" value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Mensaje</label>
                    <div class="mt-2.5">
                        <textarea id="message" name="message" rows="4" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-masonic-gold sm:text-sm sm:leading-6 @error('message') ring-red-500 @enderror">{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <x-button type="submit" class="w-full bg-masonic-gold hover:bg-yellow-600">Enviar Mensaje</x-button>
                </div>
            </form>
            @else
            <div class="text-center p-8 bg-gray-50 rounded-lg" data-scroll-reveal>
                <i class="ri-mail-close-line text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Formulario de Contacto Deshabilitado</h3>
                <p class="text-gray-600">El formulario de contacto está temporalmente deshabilitado. Por favor, utiliza la información de contacto proporcionada arriba.</p>
            </div>
            @endif

            @if($contactSettings['show_info'])
            <div class="mt-16 border-t border-gray-200 pt-10 text-center" data-scroll-reveal>
                <h3 class="text-lg font-semibold text-gray-900">Información de Contacto</h3>
                <dl class="mt-4 text-base text-gray-600 space-y-2">
                    @if($contactSettings['contact_address'])
                    <div>
                        <dt class="sr-only">Dirección</dt>
                        <dd class="flex items-center justify-center">
                            <i class="ri-map-pin-line mr-2"></i>
                            <span>{!! $contactSettings['contact_address'] !!}</span>
                        </dd>
                    </div>
                    @endif
                    <div>
                        <dt class="sr-only">Email</dt>
                        <dd class="flex items-center justify-center">
                            <i class="ri-mail-send-line mr-2"></i>
                            <span>{{ $contactSettings['contact_email'] }}</span>
                        </dd>
                    </div>
                    @if($contactSettings['contact_phone'])
                    <div>
                        <dt class="sr-only">Teléfono</dt>
                        <dd class="flex items-center justify-center">
                            <i class="ri-phone-line mr-2"></i>
                            <span>{{ $contactSettings['contact_phone'] }}</span>
                        </dd>
                    </div>
                    @endif
                    @if($contactSettings['contact_hours'])
                    <div>
                        <dt class="sr-only">Horario de atención</dt>
                        <dd class="flex items-center justify-center">
                            <i class="ri-time-line mr-2"></i>
                            <span>{{ $contactSettings['contact_hours'] }}</span>
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
            @endif
        </div>
    </div>
@endsection
