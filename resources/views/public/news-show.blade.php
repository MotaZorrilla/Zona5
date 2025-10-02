@extends('layouts.public')

@section('title', $news->title)

@section('content')
    <x-public.hero 
        :title="$news->title" 
        :subtitle="$news->excerpt"
        :imageUrl="$news->image_path ? asset('storage/' . $news->image_path) : 'https://picsum.photos/seed/news-' . $news->id . '/1920/1080'"
    />

    <div class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <img src="{{ $news->image_path ? asset('storage/' . $news->image_path) : 'https://picsum.photos/seed/news-' . $news->id . '/1200/800' }}" alt="{{ $news->title }}" class="w-full h-auto rounded-2xl shadow-lg mb-8">
                <div class="flex items-center gap-x-4 text-sm text-gray-500 mb-8">
                    <time datetime="{{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('Y-m-d') : \Carbon\Carbon::parse($news->created_at)->format('Y-m-d') }}">
                        Publicado el {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d M, Y') : \Carbon\Carbon::parse($news->created_at)->format('d M, Y') }}
                    </time>
                    @if($news->author)
                        <span>por {{ $news->author->name }}</span>
                    @endif
                </div>
                <div class="prose prose-lg max-w-none">
                    {!! $news->content !!}
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('public.news') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="ri-arrow-left-line mr-2"></i>
                        Volver a Noticias y Eventos
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection