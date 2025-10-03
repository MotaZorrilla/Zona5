@extends('layouts.admin')

@section('title', 'Usuarios Pendientes')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <livewire:admin.pending-users />
</div>
@endsection