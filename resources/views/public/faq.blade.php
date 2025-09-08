@extends('layouts.public')

@section('title', 'Preguntas Frecuentes (FAQ)')

@section('content')
    <x-public.hero 
        title="Preguntas Frecuentes"
        subtitle="Respuestas a las dudas más comunes sobre nuestra institución y la masonería."
        imageUrl="https://picsum.photos/seed/faq-hero/1920/1080"
    />

    <div class="bg-white">
        <x-public.faq />
    </div>
@endsection
