<div class="section">
    <h2 class="section-title">Repositorio de Documentos</h2>

    <h3 class="subsection-title">Resumen del Repositorio</h3>
    
    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value">{{ $repository_data['total_documents'] }}</span>
                <div class="kpi-label">Total de Documentos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ $repository_data['total_size_mb'] }} MB</span>
                <div class="kpi-label">Tamaño Total</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value">{{ $repository_data['documents_by_category']->count() }}</span>
                <div class="kpi-label">Categorías</div>
            </div>
        </div>
    </div>

    <h3 class="subsection-title">Documentos por Categoría</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repository_data['documents_by_category'] as $category)
            <tr>
                <td class="font-bold">{{ $category->category }}</td>
                <td class="text-center">{{ $category->count }}</td>
                <td class="text-center">{{ $repository_data['total_documents'] > 0 ? round(($category->count / $repository_data['total_documents']) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Documentos por Grado</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Grado</th>
                <th>Cantidad</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repository_data['documents_by_grade'] as $grade)
            <tr>
                <td class="font-bold">{{ $grade->grade_level }}</td>
                <td class="text-center">{{ $grade->count }}</td>
                <td class="text-center">{{ $repository_data['total_documents'] > 0 ? round(($grade->count / $repository_data['total_documents']) * 100, 1) : 0 }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="subsection-title">Documentos Recientes (Últimos 15)</h3>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Grado</th>
                <th>Tipo</th>
                <th>Subido por</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($repository_data['recent_documents'] as $document)
            <tr>
                <td class="font-bold">{{ $document->title }}</td>
                <td>{{ $document->category ?: 'Sin categoría' }}</td>
                <td class="text-center">{{ $document->grade_level ?: 'Todos' }}</td>
                <td class="text-center">{{ strtoupper($document->file_type) }}</td>
                <td>{{ $document->uploader ? $document->uploader->name : 'N/A' }}</td>
                <td>{{ $document->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="color: #666; font-style: italic;">No hay documentos recientes</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>