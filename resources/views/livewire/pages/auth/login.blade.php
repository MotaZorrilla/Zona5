<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center mb-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <x-application-logo class="w-32 h-32 rounded-full flex items-center justify-center text-primary-500 text-6xl font-bold shadow-lg" />
        </div>
        
        <h2 class="text-2xl font-bold font-serif text-gray-900">Acceso de Miembros</h2>
        <p class="text-sm text-gray-600">Ingresa tus credenciales para continuar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" name="remember">
                <label for="remember" class="ml-2 block text-sm text-gray-900">{{ __('Remember me') }}</label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a class="font-semibold text-primary-600 hover:text-primary-500" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-primary-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    <p class="mt-8 text-center text-sm text-gray-500">
        ¿No eres miembro aún?
        <a href="{{ route('register') }}" class="font-semibold leading-6 text-primary-600 hover:text-primary-500" wire:navigate>Regístrate aquí</a>
    </p>
</div>
