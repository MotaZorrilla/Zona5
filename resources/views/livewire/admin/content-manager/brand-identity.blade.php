<div class="bg-white shadow-md rounded-lg p-6" x-data="{
    isLoading: false,
    isUploadingLogo: false, progressLogo: 0,
    isUploadingFavicon: false, progressFavicon: 0,
    handleFileUpload: function(event, modelName, progressVar, uploadingVar) {
        this[uploadingVar] = true;
        let file = null;
        if (event.dataTransfer && event.dataTransfer.files && event.dataTransfer.files.length > 0) {
            file = event.dataTransfer.files[0];
        } else if (event.target.files && event.target.files.length > 0) {
            file = event.target.files[0];
        }

        if (file) {
            @this.upload(modelName, file,
                () => { this[uploadingVar] = false; this[progressVar] = 0; },
                () => { this[uploadingVar] = false; },
                (e) => { this[progressVar] = e.detail.progress; }
            );
        } else {
            this[uploadingVar] = false; // Reset loading state if no file found
        }
    }
}" x-init="$wire.on('brand-identity-updated', () => { isLoading = false })">
    <form wire:submit.prevent="save" @submit="isLoading = true">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Identidad y Marca</h3>
        
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <div class="space-y-4">
            <div>
                <label for="site_name" class="block text-sm font-medium text-slate-700">Nombre del Sitio</label>
                <input type="text" wire:model.defer="site_name" id="site_name" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                @error('site_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="theme_color" class="block text-sm font-medium text-slate-700">Color Principal del Tema</label>
                <input type="color" wire:model.defer="theme_color" id="theme_color" class="mt-1 block w-20 h-10 rounded-md border-slate-300 shadow-sm">
                @error('theme_color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Logo Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">Logo del Sitio (Modo Claro)</label>
                    <div class="mt-1 flex items-center gap-4">
                        <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif ($existingLogo)
                                <img src="{{ asset('uploads/' . $existingLogo) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-bold text-gray-400">Z5</span>
                            @endif
                        </div>
                        <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-center"
                             x-on:dragover.prevent="$el.classList.add('border-primary-500', 'bg-primary-50')"
                             x-on:dragleave.prevent="$el.classList.remove('border-primary-500', 'bg-primary-50')"
                             x-on:drop.prevent="handleFileUpload($event, 'logo', 'progressLogo', 'isUploadingLogo'); $el.classList.remove('border-primary-500', 'bg-primary-50')">
                            <div x-show="!isUploadingLogo">
                                <p class="text-sm text-gray-500">Arrastra un logo aquí</p>
                                <label for="logo-upload" class="cursor-pointer text-primary-600 hover:text-primary-800 font-semibold">o selecciona</label>
                                <input type="file" id="logo-upload" class="hidden" @change="handleFileUpload($event, 'logo', 'progressLogo', 'isUploadingLogo')">
                                @error('logo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div x-show="isUploadingLogo" class="w-full px-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary-600 h-2.5 rounded-full" :style="`width: ${progressLogo}%`"></div>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Subiendo... <span x-text="progressLogo"></span>%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Favicon Upload -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">Favicon</label>
                     <div class="mt-1 flex items-center gap-4">
                        <div class="w-24 h-24 rounded-md bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if ($favicon)
                                <img src="{{ $favicon->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif ($existingFavicon)
                                <img src="{{ asset('uploads/' . $existingFavicon) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl font-bold text-gray-400">ico</span>
                            @endif
                        </div>
                        <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-center"
                             x-on:dragover.prevent="$el.classList.add('border-primary-500', 'bg-primary-50')"
                             x-on:dragleave.prevent="$el.classList.remove('border-primary-500', 'bg-primary-50')"
                             x-on:drop.prevent="handleFileUpload($event, 'favicon', 'progressFavicon', 'isUploadingFavicon'); $el.classList.remove('border-primary-500', 'bg-primary-50')">
                            <div x-show="!isUploadingFavicon">
                                <p class="text-sm text-gray-500">Arrastra un favicon</p>
                                <label for="favicon-upload" class="cursor-pointer text-primary-600 hover:text-primary-800 font-semibold">o selecciona</label>
                                <input type="file" id="favicon-upload" class="hidden" @change="handleFileUpload($event, 'favicon', 'progressFavicon', 'isUploadingFavicon')">
                                @error('favicon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div x-show="isUploadingFavicon" class="w-full px-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary-600 h-2.5 rounded-full" :style="`width: ${progressFavicon}%`"></div>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Subiendo... <span x-text="progressFavicon"></span>%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150" :disabled="isLoading">
                <span class="flex items-center" x-show="!isLoading">
                    <i class="ri-save-3-line -ml-1 mr-2 h-5 w-5"></i>
                    Guardar Cambios
                </span>
                <span class="flex items-center" x-show="isLoading" style="display: none;">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Guardando...
                </span>
            </button>
        </div>
    </form>
</div>