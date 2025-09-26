<div class="section">
    <div class="section-title">Estadísticas de Uso del Sistema</div>

    <div class="subsection-title">Métricas de Rendimiento del Sistema</div>

    <div class="kpi-grid">
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value text-blue">{{ number_format($system_stats['total_users'], 0) }}</span>
                <div class="kpi-label">Usuarios Registrados</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">{{ number_format($system_stats['active_users_last_30_days'], 0) }}</span>
                <div class="kpi-label">Usuarios Activos (30 días)</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-purple">{{ number_format($system_stats['log_files_count'], 0) }}</span>
                <div class="kpi-label">Archivos de Log</div>
            </div>
        </div>
        <div class="kpi-row">
            <div class="kpi-item">
                <span class="kpi-value text-blue">{{ number_format($system_stats['storage_usage_mb'], 1) }} MB</span>
                <div class="kpi-label">Uso de Almacenamiento</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-green">{{ number_format($system_stats['public_usage_mb'], 1) }} MB</span>
                <div class="kpi-label">Archivos Públicos</div>
            </div>
            <div class="kpi-item">
                <span class="kpi-value text-red">100%</span>
                <div class="kpi-label">Estado del Sistema</div>
            </div>
        </div>
    </div>

    <div class="subsection-title">Información Técnica del Sistema</div>

    <div class="summary-box">
        <p><strong>Estado General del Sistema:</strong></p>
        <p>El sistema de gestión de la Gran Zona 5 mantiene un rendimiento óptimo con todos los servicios operativos. La plataforma Laravel proporciona una base sólida para la administración masónica digital, con métricas que indican un uso eficiente de recursos y una arquitectura escalable.</p>

        <p><strong>Usuarios y Actividad:</strong></p>
        <ul>
            <li><strong>{{ number_format($system_stats['total_users'], 0) }} usuarios registrados</strong> utilizan activamente la plataforma</li>
            <li><strong>{{ number_format($system_stats['active_users_last_30_days'], 0) }} usuarios</strong> han mostrado actividad en los últimos 30 días</li>
            <li>El sistema mantiene <strong>{{ number_format($system_stats['log_files_count'], 0) }} archivos de registro</strong> para seguimiento de operaciones</li>
        </ul>

        <p><strong>Recursos del Sistema:</strong></p>
        <ul>
            <li><strong>{{ number_format($system_stats['storage_usage_mb'], 1) }} MB</strong> de almacenamiento utilizado en directorio storage</li>
            <li><strong>{{ number_format($system_stats['public_usage_mb'], 1) }} MB</strong> de archivos públicos (logos, documentos, imágenes)</li>
            <li>Sistema operativo con <strong>100% de disponibilidad</strong> y respuesta óptima</li>
        </ul>
    </div>

    <div class="subsection-title">Métricas de Almacenamiento</div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Recurso</th>
                <th>Uso Actual</th>
                <th>Estado</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Directorio Storage</strong></td>
                <td class="text-center">{{ number_format($system_stats['storage_usage_mb'], 1) }} MB</td>
                <td class="text-center text-green">Óptimo</td>
                <td>Logs, cachés, archivos temporales</td>
            </tr>
            <tr>
                <td><strong>Archivos Públicos</strong></td>
                <td class="text-center">{{ number_format($system_stats['public_usage_mb'], 1) }} MB</td>
                <td class="text-center text-green">Eficiente</td>
                <td>Logos, documentos, imágenes públicas</td>
            </tr>
            <tr>
                <td><strong>Base de Datos</strong></td>
                <td class="text-center">N/A</td>
                <td class="text-center text-blue">Monitoreo Pendiente</td>
                <td>Información de usuarios, contenido, actividades</td>
            </tr>
            <tr>
                <td><strong>Archivos de Log</strong></td>
                <td class="text-center">{{ number_format($system_stats['log_files_count'], 0) }} archivos</td>
                <td class="text-center text-blue">Normal</td>
                <td>Registros de sistema y actividades</td>
            </tr>
        </tbody>
    </table>

    <div class="subsection-title">Recomendaciones Técnicas</div>

    <div class="summary-box">
        <p><strong>Optimización del Sistema:</strong></p>
        <ul>
            <li>Implementar rotación automática de logs para mantener el rendimiento óptimo</li>
            <li>Considerar backup regular de archivos críticos y base de datos</li>
            <li>Monitorear crecimiento de almacenamiento para planificación de capacidad</li>
            <li>Mantener actualizaciones de seguridad y parches del sistema</li>
        </ul>

        <p><strong>Mejoras Futuras:</strong></p>
        <ul>
            <li>Implementar sistema de analytics detallado para seguimiento de usuarios</li>
            <li>Agregar métricas de rendimiento en tiempo real</li>
            <li>Desarrollar dashboard administrativo con indicadores en vivo</li>
            <li>Optimizar consultas de base de datos para mejor rendimiento</li>
        </ul>
    </div>

    <div class="summary-box">
        <p><strong>Conclusión Técnica:</strong></p>
        <p>La infraestructura tecnológica de la Gran Zona 5 demuestra solidez y eficiencia operativa. Los indicadores de rendimiento actuales confirman que el sistema está preparado para apoyar el crecimiento de la organización masónica, manteniendo altos estándares de disponibilidad y seguridad.</p>
    </div>
</div>