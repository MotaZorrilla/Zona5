<!-- Sidebar -->
<div class="fixed left-0 top-0 w-64 h-full bg-white p-4 z-50 shadow-lg transition-transform duration-300" :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
    <a href="#" class="flex items-center pb-4 border-b">
        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xl font-bold">Z5</div>
        <span class="text-xl font-bold text-gray-800 ml-3">Gran Zona 5</span>
    </a>
    <ul class="mt-4">
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link active"><i class="ri-dashboard-3-line mr-3"></i><span>Dashboard</span></a></li>
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-bank-line mr-3"></i><span>Logias</span></a></li>
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-group-2-line mr-3"></i><span>Miembros</span></a></li>
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-archive-2-line mr-3"></i><span>Repositorio</span></a></li>
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-calendar-todo-line mr-3"></i><span>Eventos</span></a></li>
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-newspaper-line mr-3"></i><span>Noticias</span></a></li>
        <hr class="my-4 border-gray-200">
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-settings-3-line mr-3"></i><span>Configuración</span></a></li>
        <li class="mb-1"><a href="#" class="flex items-center py-2.5 px-4 rounded-lg sidebar-link"><i class="ri-question-line mr-3"></i><span>Ayuda</span></a></li>
    </ul>
</div>
<!-- End Sidebar -->