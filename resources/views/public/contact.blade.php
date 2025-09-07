@extends('layouts.public')

@section('title', 'Contacto')

@section('content')
    <x-public.hero 
        title="Ponte en Contacto" 
        subtitle="¿Tienes alguna pregunta o quieres saber más sobre nosotros? No dudes en contactarnos."
        imageUrl="https://images.unsplash.com/photo-1586769852836-bc069f19e1b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
    />

    <div class="py-16 sm:py-24">
        <div class="mx-auto max-w-3xl px-6 lg:px-8">
            <form action="#" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                <div class="sm:col-span-2">
                    <label for="full-name" class="block text-sm font-semibold leading-6 text-gray-900">Nombre Completo</label>
                    <div class="mt-2.5">
                        <input type="text" name="full-name" id="full-name" autocomplete="name" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                    <div class="mt-2.5">
                        <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="phone" class="block text-sm font-semibold leading-6 text-gray-900">Teléfono</label>
                    <div class="mt-2.5">
                        <input type="text" name="phone" id="phone" autocomplete="tel" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Mensaje</label>
                    <div class="mt-2.5">
                        <textarea id="message" name="message" rows="4" class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Enviar Mensaje</button>
                </div>
            </form>

            <div class="mt-16 border-t border-gray-200 pt-10 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Información Adicional</h3>
                <dl class="mt-4 text-base text-gray-600 space-y-2">
                    <div>
                        <dt class="sr-only">Postal address</dt>
                        <dd><p>Gran Logia de la República de Venezuela</p><p>Caracas, Distrito Capital</p></dd>
                    </div>
                    <div>
                        <dt class="sr-only">Email</dt>
                        <dd class="flex items-center justify-center"><i class="ri-mail-send-line mr-2"></i><span>contacto@granlogia.org.ve</span></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
