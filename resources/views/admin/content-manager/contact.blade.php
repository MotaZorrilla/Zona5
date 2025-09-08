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
        <h3 class="text-xl font-bold text-slate-800 mb-4">Configuración de la Página de Contacto</h3>
        <div class="space-y-4">
            <div>
                <label for="contact_title" class="block text-sm font-medium text-slate-700">Título de la Página</label>
                <input type="text" id="contact_title" value="Ponte en Contacto" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="contact_intro" class="block text-sm font-medium text-slate-700">Texto Introductorio</label>
                <textarea id="contact_intro" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">¿Tienes preguntas o deseas más información? Utiliza el formulario a continuación o nuestros datos de contacto.</textarea>
            </div>
            <div>
                <label for="contact_recipient_email" class="block text-sm font-medium text-slate-700">Email Destinatario del Formulario</label>
                <input type="email" id="contact_recipient_email" value="secretaria@granzona5.org" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                <p class="mt-2 text-sm text-slate-500">La dirección de correo que recibirá los mensajes del formulario de contacto.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Información de Contacto</label>
                    <div class="mt-2 space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Mostrar formulario de contacto.</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Mostrar mapa de ubicación.</span>
                        </label>
                         <label class="flex items-center">
                            <input type="checkbox" checked class="rounded text-primary-600">
                            <span class="ml-2 text-sm text-slate-600">Mostrar dirección y teléfono.</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label for="contact_address" class="block text-sm font-medium text-slate-700">Dirección Física</label>
                    <textarea id="contact_address" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm" placeholder="Calle Ficticia 123, Templo Principal, Ciudad."></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150">Guardar Cambios de Contacto</button>
    </div>
</div>
