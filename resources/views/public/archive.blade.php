@extends('layouts.public')

@section('title', $pageSettings['title'] . ' - Gran Zona 5')

@section('content')
    <x-public.hero
        title="{{ $pageSettings['title'] }}"
        subtitle="{{ $pageSettings['subtitle'] }}"
        imageUrl="{{ $pageSettings['banner_image'] }}"
    />

    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Overlay de acceso restringido para usuarios no autenticados -->
            @if($pageSettings['restricted'])
                <div class="fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center">
                    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 text-center shadow-2xl">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="ri-lock-2-line text-3xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Acceso Restringido</h3>
                        <p class="text-gray-600 mb-6">El archivo histórico solo está disponible para miembros registrados. Inicia sesión para acceder a los documentos.</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                Registrarse
                            </a>
                        </div>
                        <p class="text-xs text-gray-500 mt-4">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary-600 hover:underline">Inicia sesión aquí</a></p>
                    </div>
                </div>
            @endif

            <!-- Search and Filters -->
            <form method="GET" action="{{ url()->current() }}" class="mb-16 flex flex-col md:flex-row justify-between items-center gap-4" data-scroll-reveal>
                <div class="relative w-full md:w-2/3">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full bg-white border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar en el archivo...">
                </div>
                <div class="flex items-center gap-4">
                    <select name="category" class="bg-white border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        <option value="">Filtrar por Categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <select name="grade" class="bg-white border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        <option value="">Filtrar por Grado</option>
                        @foreach($grades as $grade_level)
                            <option value="{{ $grade_level }}" {{ request('grade') == $grade_level ? 'selected' : '' }}>{{ $grade_level }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        Filtrar
                    </button>
                </div>
            </form>

            <!-- Documents List -->
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3" data-scroll-reveal>
                @forelse($documents as $document)
                    <div class="group flex flex-col overflow-hidden rounded-lg shadow-lg transition-all duration-200 hover:shadow-2xl hover:scale-[1.02] border border-transparent hover:border-primary-200">
                        <div class="flex-shrink-0">
                            <div class="h-48 w-full bg-gray-200 flex items-center justify-center group-hover:bg-primary-50 transition-all duration-200">
                                @if($document->file_type == 'pdf')
                                    <i class="ri-file-pdf-2-line text-6xl text-red-500 group-hover:text-red-600 group-hover:scale-110 transition-all duration-200"></i>
                                @elseif(in_array($document->file_type, ['doc', 'docx']))
                                    <i class="ri-file-word-2-line text-6xl text-blue-500 group-hover:text-blue-600 group-hover:scale-110 transition-all duration-200"></i>
                                @elseif(in_array($document->file_type, ['xls', 'xlsx']))
                                    <i class="ri-file-excel-2-line text-6xl text-green-500 group-hover:text-green-600 group-hover:scale-110 transition-all duration-200"></i>
                                @elseif(in_array($document->file_type, ['ppt', 'pptx']))
                                    <i class="ri-file-ppt-2-line text-6xl text-orange-500 group-hover:text-orange-600 group-hover:scale-110 transition-all duration-200"></i>
                                @elseif(in_array($document->file_type, ['jpg', 'jpeg', 'png']))
                                    <i class="ri-image-2-line text-6xl text-purple-500 group-hover:text-purple-600 group-hover:scale-110 transition-all duration-200"></i>
                                @else
                                    <i class="ri-file-3-line text-6xl text-gray-500 group-hover:text-gray-600 group-hover:scale-110 transition-all duration-200"></i>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col justify-between bg-white p-6">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-primary-600 group-hover:text-primary-700">
                                    <a href="#" onclick="openDocumentModal({{ $document->id }})" class="hover:underline">
                                        {{ $document->category ?? 'Documento' }}
                                    </a>
                                </p>
                                <a href="#" onclick="openDocumentModal({{ $document->id }})" class="mt-2 block">
                                    <p class="text-xl font-semibold text-gray-900 group-hover:text-primary-800">{{ $document->title }}</p>
                                    <p class="mt-3 text-base text-gray-500">{{ Str::limit($document->description ?? '', 100) }}</p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="text-sm text-gray-500">
                                        <time datetime="{{ $document->created_at->format('Y-m-d') }}">{{ $document->created_at->format('d M, Y') }}</time>
                                    </span>
                                </div>
                                @if($document->grade_level)
                                    <span class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                        {{ $document->grade_level }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-12">
                        <i class="ri-folder-3-line text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No se encontraron documentos</h3>
                        <p class="text-gray-500">No hay documentos que coincidan con los filtros aplicados.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $documents->appends(request()->query())->links() }}
                </div>
            @endif


        </div>
    </div>

    <!-- Modal para detalles del documento -->
    <div id="documentModal" class="fixed inset-0 bg-black bg-opacity-70 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-4">
                        <div id="modalIcon"></div>
                        <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">Detalles del Documento</h3>
                    </div>
                    <button onclick="closeDocumentModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Tipo de Archivo</h4>
                        <p class="text-lg font-semibold text-gray-800" id="modalFileType">PDF</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Tamaño</h4>
                        <p class="text-lg font-semibold text-gray-800" id="modalFileSize">2.4 MB</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Fecha de Subida</h4>
                        <p class="text-lg font-semibold text-gray-800" id="modalUploadDate">15 Jun, 2023</p>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-3">Información del Documento</h4>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Nombre del Archivo</p>
                                <p class="font-medium text-gray-800" id="modalFileName">documento.pdf</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Categoría</p>
                                <p class="font-medium text-gray-800" id="modalCategory">Ritual y Liturgia</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nivel de Grado</p>
                                <p class="font-medium text-gray-800" id="modalGradeLevel">Todos</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Subido por</p>
                                <p class="font-medium text-gray-800" id="modalUploader">Usuario Ejemplo</p>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600">Descripción</p>
                            <p class="mt-1 text-gray-800 whitespace-pre-line" id="modalDescription">Descripción del documento...</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <button id="downloadButton" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="ri-download-line mr-2"></i>
                        Descargar Documento
                    </button>
                    <button onclick="closeDocumentModal()" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar el modal -->
    <script>
        // Función para abrir el modal con los detalles del documento
        function openDocumentModal(documentId) {
            // Aquí haríamos una llamada AJAX para obtener los detalles del documento
            // Por ahora simularemos con datos de ejemplo
            fetch(`/api/documents/${documentId}`)
                .then(response => response.json())
                .then(data => {
                    // Create icon element
                    const iconContainer = document.getElementById('modalIcon');
                    iconContainer.innerHTML = ''; // Clear previous icon
                    const icon = document.createElement('i');
                    let iconClass = 'ri-file-3-line';
                    let colorClass = 'text-gray-500';
                    switch (data.file_type) {
                        case 'pdf':
                            iconClass = 'ri-file-pdf-2-line';
                            colorClass = 'text-red-500';
                            break;
                        case 'doc':
                        case 'docx':
                            iconClass = 'ri-file-word-2-line';
                            colorClass = 'text-blue-500';
                            break;
                        case 'xls':
                        case 'xlsx':
                            iconClass = 'ri-file-excel-2-line';
                            colorClass = 'text-green-500';
                            break;
                        case 'ppt':
                        case 'pptx':
                            iconClass = 'ri-file-ppt-2-line';
                            colorClass = 'text-orange-500';
                            break;
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                            iconClass = 'ri-image-2-line';
                            colorClass = 'text-purple-500';
                            break;
                    }
                    icon.className = `${iconClass} text-4xl ${colorClass}`;
                    iconContainer.appendChild(icon);

                    // Actualizar contenido del modal con los datos del documento
                    document.getElementById('modalTitle').textContent = data.title;
                    document.getElementById('modalFileType').textContent = data.file_type.toUpperCase();
                    document.getElementById('modalFileSize').textContent = formatFileSize(data.file_size);
                    document.getElementById('modalUploadDate').textContent = formatDate(data.created_at);
                    document.getElementById('modalFileName').textContent = data.file_name;
                    document.getElementById('modalCategory').textContent = data.category || 'Sin categoría';
                    document.getElementById('modalGradeLevel').textContent = data.grade_level || 'Todos';
                    document.getElementById('modalUploader').textContent = data.uploader?.name || 'Desconocido';
                    document.getElementById('modalDescription').textContent = data.description || 'Sin descripción disponible';
                    
                    // Configurar el botón de descarga
                    document.getElementById('downloadButton').onclick = () => downloadDocument(documentId);
                    
                    // Mostrar el modal
                    document.getElementById('documentModal').classList.remove('hidden');
                    document.getElementById('documentModal').classList.add('flex');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('No se pudieron cargar los detalles del documento.');
                });
        }
        
        // Función para cerrar el modal
        function closeDocumentModal() {
            document.getElementById('documentModal').classList.add('hidden');
            document.getElementById('documentModal').classList.remove('flex');
        }
        
        // Función para descargar el documento
        function downloadDocument(documentId) {
            window.location.href = `/admin/repository/${documentId}/download`;
        }
        
        // Función auxiliar para formatear el tamaño del archivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Función auxiliar para formatear la fecha
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
        
        // Cerrar modal al hacer clic fuera del contenido
        document.getElementById('documentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDocumentModal();
            }
        });
    </script>
@endsection
