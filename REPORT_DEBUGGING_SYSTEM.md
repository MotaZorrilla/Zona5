# Sistema de Seguimiento Detallado para Generación de Reportes

## Descripción

Este sistema implementa un sistema de depuración detallado para el proceso de generación de reportes PDF, permitiendo visualizar en tiempo real cada paso del proceso con marcadores visibles en consola.

## Componentes del Sistema

### 1. Servicio de Depuración (`DebugService`)

El servicio de depuración proporciona las siguientes funcionalidades:

- `startTask($taskName, $initialMessage)`: Inicia un proceso de depuración
- `step($stepName, $progress, $additionalInfo)`: Registra un paso en el proceso
- `info($message, $additionalInfo)`: Registra información adicional
- `warning($message, $additionalInfo)`: Registra una advertencia
- `error($message, $additionalInfo)`: Registra un error
- `query($query, $bindings, $time)`: Registra consultas SQL
- `endTask($success, $result)`: Finaliza el proceso de depuración

### 2. Integración en Servicios

#### ReportService

Todos los métodos privados en `ReportService` ahora aceptan un parámetro opcional `$debug` para registrar información detallada del proceso:

- `getReportInfo()`
- `getExecutiveSummary()`
- `getMembershipStats()`
- `getFinancialStatus()`
- `getEventsData()`
- `getRepositoryData()`
- `getMessagesData()`
- `getLodgesData()`
- `getDignitariesData()`
- `getCoursesData()`
- `getActivityData()`
- `getChartsData()`
- `getPeriodDescription()`

#### AsyncTaskService

Todos los métodos principales en `AsyncTaskService` ahora incluyen marcadores de depuración:

- `createTask()`
- `updateProgress()`
- `completeTask()`
- `failTask()`
- `processReportTask()`

### 3. Integración en Controlador

El `ReportController` ahora incluye métodos con marcadores de depuración:

- `generate()`
- `processTask()`
- `getTaskStatus()`

### 4. Comando de Prueba

Se ha creado un comando Artisan para probar el sistema de depuración:

```bash
php artisan test:report-generation --debug
```

## Uso del Sistema

### Habilitar/Desabilitar Depuración

La depuración se puede habilitar/desabilitar en tiempo de ejecución:

```php
$debug = app('debug.service');
$debug->setEnabled(true);  // Habilitar
$debug->setEnabled(false); // Deshabilitar
```

### Niveles de Información

El sistema registra diferentes niveles de información:

- **INFO**: Información general del proceso
- **PASO**: Progreso del proceso con porcentaje
- **WARNING**: Advertencias durante el proceso
- **ERROR**: Errores ocurridos durante el proceso

### Marcadores Visibles en Consola

Cuando se ejecuta el proceso de generación de reportes, se muestran marcadores visibles en consola que indican:

1. Inicio de la tarea
2. Procesamiento de datos (porcentaje de avance)
3. Generación del PDF
4. Guardado del archivo
5. Actualización del estado
6. Finalización completa
7. Tiempos de ejecución
8. Cualquier error que ocurra en cada fase

## Beneficios del Sistema

1. **Visibilidad en tiempo real**: Muestra el progreso real del proceso de generación de reportes
2. **Identificación de problemas**: Permite identificar exactamente dónde se detiene o falla el proceso
3. **Monitoreo detallado**: Proporciona información detallada sobre cada paso del proceso
4. **Depuración eficiente**: Facilita la identificación y resolución de problemas
5. **Seguimiento de rendimiento**: Muestra tiempos de ejecución y uso de memoria

## Archivos Afectados

- `app/Services/DebugService.php` - Servicio de depuración
- `app/Services/ReportService.php` - Servicio de reportes con depuración
- `app/Services/AsyncTaskService.php` - Servicio de tareas asíncronas con depuración
- `app/Http/Controllers/Admin/ReportController.php` - Controlador con depuración
- `app/Console/Commands/TestReportGeneration.php` - Comando de prueba
- `app/Providers/AppServiceProvider.php` - Registro del servicio de depuración
- `app/Console/Kernel.php` - Registro de comandos

## Ejemplo de Salida de Depuración

```
[DEBUG] =========================================
[DEBUG] INICIO DE TAREA: generateReportData
[DEBUG] =========================================
[DEBUG] PASO: Iniciando generación de reporte [5%]
[DEBUG] PASO: Generando información básica del reporte [10%]
[DEBUG] PASO: Generando resumen ejecutivo [15%]
...
[DEBUG] PASO: Tarea completada [10%]
[DEBUG] =========================================
[DEBUG] FIN DE TAREA: generateReportData [ÉXITO]
[DEBUG] Tiempo total: 0.1441s
[DEBUG] Memoria final: 32 MB
[DEBUG] Memoria pico: 32 MB
```

## Pruebas

El sistema se puede probar ejecutando el comando:

```bash
php artisan test:report-generation --debug
```

Esto mostrará todo el proceso de generación de reportes con marcadores de depuración detallados en tiempo real.