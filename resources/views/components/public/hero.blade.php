@props([
    'title' => 'Título por defecto',
    'subtitle' => 'Subtítulo por defecto.',
    'imageUrl' => 'https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2830&q=80&sat=-100'
])

<div class="relative bg-primary-800">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ $imageUrl }}" alt="{{ $title }}">
        <div class="absolute inset-0 bg-black bg-opacity-20" aria-hidden="true"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-serif">{{ $title }}</h1>
        <p class="mt-6 text-xl text-primary-100 max-w-3xl mx-auto">{{ $subtitle }}</p>
    </div>
</div>
