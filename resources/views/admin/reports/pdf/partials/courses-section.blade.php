<div class="section">
    <h2 class="section-title">Escuela Virtual y Cursos</h2>

    <h3 class="subsection-title">Resumen de Cursos</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $courses_data['total_courses'] }}</span>
                <div class="kpi-label">Total de Cursos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">{{ $courses_data['courses_by_status']->where('status', 'active')->first()->count ?? 0 }}</span>
                <div class="kpi-label">Cursos Activos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ $courses_data['courses_by_grade']->count() }}</span>
                <div class="kpi-label">Grados Cubiertos</div>
            </div>
        </div>
    </div>

    <h3 class="subsection-title">Cursos por Grado</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Grado</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses_data['courses_by_grade'] as $grade)
            <tr>
                <td class="font-bold">{{ $grade->grade_level ?: 'Sin especificar' }}</td>
                <td class="text-center">{{ $grade->count }}</td>
                <td class="text-center">{{ $courses_data['total_courses'] > 0 ? round(($grade->count / $courses_data['total_courses']) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Cursos por Estado</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses_data['courses_by_status'] as $status)
            <tr>
                <td class="font-bold">{{ ucfirst($status->status) }}</td>
                <td class="text-center">{{ $status->count }}</td>
                <td class="text-center">{{ $courses_data['total_courses'] > 0 ? round(($status->count / $courses_data['total_courses']) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Cursos por Tipo</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses_data['courses_by_type'] as $type)
            <tr>
                <td class="font-bold">{{ ucfirst($type->type) }}</td>
                <td class="text-center">{{ $type->count }}</td>
                <td class="text-center">{{ $courses_data['total_courses'] > 0 ? round(($type->count / $courses_data['total_courses']) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Cursos Activos</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Grado</th>
                <th>Instructor</th>
                <th>Duración</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses_data['active_courses'] as $course)
            <tr>
                <td class="font-bold">{{ $course->title }}</td>
                <td class="text-center">{{ $course->grade_level ?: 'Todos' }}</td>
                <td>{{ $course->instructor_name ?: 'No asignado' }}</td>
                <td class="text-center">{{ $course->duration ? $course->duration . ' horas' : 'N/A' }}</td>
                <td class="text-center">{{ ucfirst($course->type) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="color: #666; font-style: italic;">No hay cursos activos</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($courses_data['active_courses']->count() == 0)
    <div class="warning-box">
        <p><strong>Atención:</strong> No hay cursos activos en la escuela virtual. Se recomienda activar cursos para mantener la formación continua de los miembros.</p>
    </div>
    @endif
</div>