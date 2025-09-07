@extends('layouts.public')

@section('title', 'Logias de la Gran Zona 5')

@section('content')
    <x-public.hero 
        title="Nuestras Logias" 
        subtitle="Un crisol de tradición y fraternidad a lo largo de la Gran Zona 5."
        imageUrl="https://images.unsplash.com/photo-1630583949684-a334b217b3cf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <ul role="list" class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <x-card image="https://images.unsplash.com/photo-1521790797524-12035c8f9419?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" title="Estrella de Oriente N° 123" subtitle="Valle de Caracas" />
                <x-card image="https://images.unsplash.com/photo-1614595289092-2349a5f64436?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" title="Domingo F. Sarmiento N° 45" subtitle="Valle de Maracay" />
                <x-card image="https://images.unsplash.com/photo-1554463118-346574263b85?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" title="Sol de Guayana N° 88" subtitle="Valle de Ciudad Guayana" />
            </ul>
        </div>
    </div>
@endsection
