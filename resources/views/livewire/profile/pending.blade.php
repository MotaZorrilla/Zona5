<div class="max-w-2xl mx-auto p-6">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold font-serif text-gray-900">Perfil Pendiente de Aprobación</h2>
        <p class="text-sm text-gray-600 mt-2">Tu perfil está siendo revisado por los administradores</p>
    </div>

    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    <strong>Importante:</strong> Tu registro ha sido completado exitosamente. Tu perfil está pendiente de aprobación por parte de los administradores.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">¿Qué sucede ahora?</h3>
        
        <ul class="space-y-3">
            <li class="flex items-start">
                <div class="flex-shrink-0 h-5 w-5 text-primary-500 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-2 text-gray-600">Tu perfil ha sido enviado para revisión</span>
            </li>
            <li class="flex items-start">
                <div class="flex-shrink-0 h-5 w-5 text-primary-500 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-2 text-gray-600">Un administrador revisará tu información</span>
            </li>
            <li class="flex items-start">
                <div class="flex-shrink-0 h-5 w-5 text-primary-500 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-2 text-gray-60">Recibirás una notificación cuando tu perfil sea aprobado</span>
            </li>
            <li class="flex items-start">
                <div class="flex-shrink-0 h-5 w-5 text-primary-500 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-2 text-gray-600">Una vez aprobado, podrás acceder a todas las funcionalidades del sistema</span>
            </li>
        </ul>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Gracias por tu paciencia. ¡Bienvenido a la comunidad!</p>
        </div>
    </div>
    
    <div class="mt-6 text-center">
        <a
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
            class="text-sm text-gray-600 hover:text-gray-900"
        >
            Cerrar sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>