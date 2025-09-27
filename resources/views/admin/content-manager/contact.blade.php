<div class="p-4 sm:p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Imagen de Cabecera</h3>
        <div>
            <label class="block text-sm font-medium text-slate-700">Banner para "Contacto"</label>
            <div class="mt-1 flex items-center">
                <img src="https://placehold.co/800x200/EFEFEF/AAAAAA&text=Banner+Contacto" alt="Banner Contacto" class="h-20 mr-4 rounded w-auto">
                <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Configuración de la Página</h3>
        <div class="space-y-4">
            <div>
                <label for="contact_page_title" class="block text-sm font-medium text-slate-700">Título de la Página</label>
                <input type="text" id="contact_page_title" value="Ponte en Contacto" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="contact_page_subtitle" class="block text-sm font-medium text-slate-700">Subtítulo de la Página</label>
                <textarea id="contact_page_subtitle" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">¿Tienes alguna pregunta o quieres saber más sobre nosotros? No dudes en contactarnos.</textarea>
            </div>
            <div>
                <label for="contact_banner_image" class="block text-sm font-medium text-slate-700">URL de Imagen del Banner</label>
                <input type="url" id="contact_banner_image" value="https://picsum.photos/seed/contact-hero/1920/1080" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                <p class="mt-2 text-sm text-slate-500">URL de la imagen de fondo para el hero de la página de contacto.</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Configuración de Contacto</h3>
        <div class="space-y-4">
            <div>
                <label for="contact_email" class="block text-sm font-medium text-slate-700">Email de Contacto</label>
                <input type="email" id="contact_email" value="contacto@granzona5.org" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                <p class="mt-2 text-sm text-slate-500">La dirección de correo que recibirá los mensajes del formulario de contacto.</p>
            </div>
            <div>
                <label for="contact_phone" class="block text-sm font-medium text-slate-700">Teléfono de Contacto</label>
                <input type="text" id="contact_phone" value="+58-XXX-XXXX" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="contact_address" class="block text-sm font-medium text-slate-700">Dirección Física</label>
                <textarea id="contact_address" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm" placeholder="Gran Logia de la República de Venezuela&#10;Caracas, Distrito Capital">Gran Logia de la República de Venezuela&#10;Caracas, Distrito Capital</textarea>
                <p class="mt-2 text-sm text-slate-500">Use &#10; para saltos de línea.</p>
            </div>
            <div>
                <label for="contact_hours" class="block text-sm font-medium text-slate-700">Horario de Atención</label>
                <input type="text" id="contact_hours" value="Lunes a Viernes, 9:00 AM - 5:00 PM" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Opciones de Visualización</h3>
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Elementos a Mostrar</label>
                    <div class="mt-2 space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="contact_show_form" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Mostrar formulario de contacto.</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" id="contact_show_map" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Mostrar mapa de ubicación.</span>
                        </label>
                         <label class="flex items-center">
                            <input type="checkbox" id="contact_show_info" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Mostrar información de contacto.</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Estado del Formulario</label>
                    <div class="mt-2">
                        <label class="flex items-center">
                            <input type="checkbox" id="contact_form_enabled" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Formulario habilitado para recibir mensajes.</span>
                        </label>
                        <p class="mt-2 text-sm text-slate-500">Si se deshabilita, se mostrará un mensaje informativo en lugar del formulario.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.content-manager.contact.update') }}" method="POST">
        @csrf

        <!-- Configuración de la página -->
        <input type="hidden" name="contact_page_title" id="contact_page_title_hidden">
        <input type="hidden" name="contact_page_subtitle" id="contact_page_subtitle_hidden">
        <input type="hidden" name="contact_banner_image" id="contact_banner_image_hidden">

        <!-- Configuración de contacto -->
        <input type="hidden" name="contact_email" id="contact_email_hidden">
        <input type="hidden" name="contact_phone" id="contact_phone_hidden">
        <input type="hidden" name="contact_address" id="contact_address_hidden">
        <input type="hidden" name="contact_hours" id="contact_hours_hidden">

        <!-- Opciones de visualización -->
        <input type="hidden" name="contact_show_form" id="contact_show_form_hidden">
        <input type="hidden" name="contact_show_map" id="contact_show_map_hidden">
        <input type="hidden" name="contact_show_info" id="contact_show_info_hidden">
        <input type="hidden" name="contact_form_enabled" id="contact_form_enabled_hidden">

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150">Guardar Cambios de Contacto</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action*="content-manager/contact"]');

            if (form) {
                form.addEventListener('submit', function(e) {
                    // Sincronizar valores antes de enviar
                    document.getElementById('contact_page_title_hidden').value = document.getElementById('contact_page_title').value;
                    document.getElementById('contact_page_subtitle_hidden').value = document.getElementById('contact_page_subtitle').value;
                    document.getElementById('contact_banner_image_hidden').value = document.getElementById('contact_banner_image').value;
                    document.getElementById('contact_email_hidden').value = document.getElementById('contact_email').value;
                    document.getElementById('contact_phone_hidden').value = document.getElementById('contact_phone').value;
                    document.getElementById('contact_address_hidden').value = document.getElementById('contact_address').value;
                    document.getElementById('contact_hours_hidden').value = document.getElementById('contact_hours').value;
                    document.getElementById('contact_show_form_hidden').value = document.getElementById('contact_show_form').checked;
                    document.getElementById('contact_show_map_hidden').value = document.getElementById('contact_show_map').checked;
                    document.getElementById('contact_show_info_hidden').value = document.getElementById('contact_show_info').checked;
                    document.getElementById('contact_form_enabled_hidden').value = document.getElementById('contact_form_enabled').checked;
                });
            }
        });
    </script>
</div>
