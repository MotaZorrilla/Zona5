<div class="section">
    <div class="section-title">Noticias y Publicaciones</div>
    
    <div class="summary-box">
        <strong>Resumen:</strong>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>Noticias totales publicadas en el período: <span class="font-bold">{{ $news_data['news_statistics']['total_published'] }}</span></li>
            <li>Noticias en borrador: <span class="font-bold">{{ $news_data['news_statistics']['total_draft'] }}</span></li>
            <li>Noticias programadas: <span class="font-bold">{{ $news_data['news_statistics']['total_scheduled'] }}</span></li>
        </ul>
    </div>

    @if($news_data['recent_news']->count() > 0)
        <div class="subsection-title">Noticias Recientes</div>
        
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 35%;">Título</th>
                        <th style="width: 20%;">Autor</th>
                        <th style="width: 20%;">Fecha de Publicación</th>
                        <th style="width: 20%;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news_data['recent_news'] as $index => $news)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="font-bold">{{ Str::limit($news->title, 50) }}</div>
                            <div style="font-size: 9px; color: #7F8C8D;">{{ Str::limit(strip_tags($news->excerpt), 60) }}</div>
                        </td>
                        <td>{{ $news->author ? $news->author->name : 'N/A' }}</td>
                        <td>{{ $news->published_at ? $news->published_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            @if($news->status == 'published')
                                <span style="color: #27AE60;">Publicada</span>
                            @elseif($news->status == 'draft')
                                <span style="color: #F39C12;">Borrador</span>
                            @elseif($news->status == 'scheduled')
                                <span style="color: #3498DB;">Programada</span>
                            @else
                                <span style="color: #95A5A6;">{{ ucfirst($news->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="warning-box">
            No se encontraron noticias publicadas en el período especificado.
        </div>
    @endif

    @if(count($news_data['news_statistics']) > 0)
        <div class="subsection-title">Estadísticas de Contenido</div>
        
        <div class="kpi-grid">
            <div class="kpi-row">
                <div class="kpi-item">
                    <span class="kpi-value text-green">{{ $news_data['news_statistics']['total_published'] }}</span>
                    <span class="kpi-label">Noticias Publicadas</span>
                </div>
                <div class="kpi-item">
                    <span class="kpi-value text-yellow">{{ $news_data['news_statistics']['total_draft'] }}</span>
                    <span class="kpi-label">Borradores</span>
                </div>
                <div class="kpi-item">
                    <span class="kpi-value text-blue">{{ $news_data['news_statistics']['total_scheduled'] }}</span>
                    <span class="kpi-label">Programadas</span>
                </div>
            </div>
        </div>
    @endif
</div>