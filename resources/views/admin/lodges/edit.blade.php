@extends('layouts.admin')

@section('title', 'Editar Logia')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Logia</h1>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <form action="{{ route('admin.lodges.update', $lodge) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" value="{{ $lodge->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="number" class="block text-sm font-medium text-gray-700">Número</label>
                <input type="number" name="number" id="number" value="{{ $lodge->number }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="valley" class="block text-sm font-medium text-gray-700">Valle</label>
                <input type="text" name="valley" id="valley" value="{{ $lodge->valley }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('admin.lodges.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md mr-2">Cancelar</a>
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">Actualizar</button>
            </div>
        </form>
    </div>
@endsection
