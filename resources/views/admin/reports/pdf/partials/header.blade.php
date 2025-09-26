<div class="header">
    <div class="logo">
        <!-- Logo placeholder - se puede reemplazar con imagen real -->
        <div style="width: 80px; height: 80px; background-color: #D4AF37; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
            GZ5
        </div>
    </div>
    
    <div class="title">{{ $report_info['title'] }}</div>
    
    <div class="subtitle">
        Gran Logia de la República de Venezuela
    </div>
    
    <div class="report-info">
        <p><strong>{{ $report_info['period_description'] }}</strong></p>
        <p>Generado por: {{ $report_info['generated_by'] }}</p>
        <p>Fecha de generación: {{ $report_info['generated_at']->format('d/m/Y H:i:s') }}</p>
    </div>
</div>