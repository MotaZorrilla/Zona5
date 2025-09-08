@extends('layouts.admin')

@section('title', 'Mi Perfil')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mi Perfil</h1>

    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
@endsection
