<!-- Sidebar -->
<div class="fixed left-0 top-0 w-64 h-full bg-white p-4 z-50 shadow-lg transition-transform duration-300" :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
    <div class="flex items-center justify-between pb-4 border-b">
        <a href="{{ route('welcome') }}" target="_blank" rel="noopener" class="flex items-center">
            <x-application-logo class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-primary-500 text-xl font-bold" />
            <span class="text-xl font-bold text-primary-600 ml-3">Gran Zona 5</span>
        </a>
        <button @click="sidebarOpen = false" class="text-gray-500 hover:text-gray-800">
            <i class="ri-close-line text-2xl"></i>
        </button>
    </div>
    <ul class="mt-4">
        <li class="mb-1"><a href="{{ route('admin.dashboard') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="ri-dashboard-3-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Dashboard</span></a></li>
        
        <hr class="my-2 border-gray-200">

        <li class="mb-1"><a href="{{ route('admin.users.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="ri-group-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Miembros</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.zone-dignitaries.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.zone-dignitaries.index') ? 'active' : '' }}"><i class="ri-user-star-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Dignatarios</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.lodges.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.lodges.index') ? 'active' : '' }}"><i class="ri-bank-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Logias</span></a></li>

        <hr class="my-2 border-gray-200">

        <li class="mb-1"><a href="{{ route('admin.news.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"><i class="ri-newspaper-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Noticias</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.events.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"><i class="ri-calendar-todo-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Eventos</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.repository.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.repository.*') ? 'active' : '' }}"><i class="ri-archive-2-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Repositorio</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.school.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.school.*') ? 'active' : '' }}"><i class="ri-book-open-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Escuela Virtual</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.forums.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.forums.*') ? 'active' : '' }}"><i class="ri-discuss-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Foros</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.faqs.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"><i class="ri-question-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">FAQ</span></a></li>

        <hr class="my-2 border-gray-200">

        <li class="mb-1"><a href="{{ route('admin.messages.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="ri-mail-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Mensajes</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.treasury.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.treasury.*') ? 'active' : '' }}"><i class="ri-scales-3-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Tesorería</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.content-manager.show', 'general') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.content-manager.*') ? 'active' : '' }}"><i class="ri-pencil-ruler-2-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Gestor de Contenido</span></a></li>

        <hr class="my-4 border-gray-200">

        <li class="mb-1"><a href="{{ route('admin.reports.index') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"><i class="ri-file-chart-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Reportes</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.settings') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}"><i class="ri-settings-3-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Configuración</span></a></li>
        <li class="mb-1"><a href="{{ route('admin.help') }}" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link {{ request()->routeIs('admin.help') ? 'active' : '' }}"><i class="ri-question-line mr-3 text-primary-500"></i><span class="text-primary-600 font-sans">Ayuda</span></a></li>
    </ul>
</div>
<!-- End Sidebar -->
