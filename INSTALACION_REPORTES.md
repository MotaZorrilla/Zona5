# Instalación del Módulo de Reportes PDF - Hosting Compartido

## Dependencias Requeridas

Para que el módulo de reportes funcione correctamente en hosting compartido, necesitas:

### 1. Subir DomPDF manualmente

Si no tienes acceso a Composer en el hosting, descarga e incluye DomPDF manualmente:

**Opción A - Con Composer (si tienes acceso):**
```bash
composer require barryvdh/laravel-dompdf
```

**Opción B - Subida manual (hosting compartido):**
1. Descarga `barryvdh/laravel-dompdf` desde GitHub
2. Sube los archivos a `vendor/barryvdh/laravel-dompdf/`
3. Actualiza `composer.json` y `composer.lock` manualmente

## Configuración para Hosting Compartido

### 1. Crear directorio de reportes

Crea manualmente el directorio `public/uploads/reports/` en tu hosting:

```
public/
├── uploads/
│   ├── reports/          ← Crear este directorio
│   ├── logos/           ← Ya existe
│   └── repository/      ← Ya existe
```

### 2. Permisos de escritura

Asegúrate de que el directorio tenga permisos de escritura (755 o 777):
- `public/uploads/reports/` → 755 o 777
- `storage/` → 755 o 777
- `bootstrap/cache/` → 755 o 777

### 3. NO necesitas storage:link

El sistema está configurado para usar `public/uploads/` directamente, sin necesidad de enlaces simbólicos.

## Configuración de DomPDF (Opcional)

Si necesitas personalizar la configuración de DomPDF, edita el archivo `config/dompdf.php`:

```php
<?php

return [
    'show_warnings' => false,
    'public_path' => null,
    'convert_entities' => true,
    'options' => [
        'font_dir' => storage_path('fonts/'),
        'font_cache' => storage_path('fonts/'),
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),
        'allowed_protocols' => [
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],
        'log_output_file' => null,
        'enable_font_subsetting' => false,
        'pdf_backend' => 'CPDF',
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'serif',
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
    ],
];
```

## Verificación de la Instalación

1. Accede al panel de administración
2. Ve a la sección "Reportes" en el sidebar
3. Intenta generar un reporte de prueba
4. Verifica que el PDF se genere correctamente

## Solución de Problemas Comunes

### Error: "Class 'Barryvdh\DomPDF\Facade\Pdf' not found"

Solución: Ejecuta `composer dump-autoload` y limpia la caché:

```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Error de permisos al generar PDF

Solución: Verifica los permisos del directorio uploads:

- Cambia permisos de `public/uploads/reports/` a 777
- Verifica que `storage/` tenga permisos 755 o 777
- En cPanel: Administrador de archivos → Permisos → 777

### Fuentes no se cargan correctamente

Solución: Asegúrate de que las fuentes estén disponibles o usa fuentes web-safe:

```php
// En el CSS del PDF, usa fuentes seguras
font-family: 'DejaVu Sans', Arial, sans-serif;
```

## Características del Módulo

## Instalación Paso a Paso para Hosting Compartido

### Paso 1: Subir archivos
1. Sube todos los archivos del módulo a tu hosting
2. Asegúrate de que `vendor/barryvdh/laravel-dompdf/` esté presente

### Paso 2: Crear directorios
```
Crear manualmente:
- public/uploads/reports/ (permisos 777)
```

### Paso 3: Verificar rutas
- Las rutas ya están configuradas en `routes/web.php`
- El sidebar ya incluye el enlace a Reportes

### Paso 4: Probar el sistema
1. Accede a: `tudominio.com/admin/reports`
2. Genera un reporte de prueba
3. Verifica que se descargue correctamente

## Características del Sistema

✅ **Optimizado para Hosting Compartido:**
- Sin dependencia de comandos Artisan
- Sin necesidad de storage:link
- Archivos guardados directamente en public/uploads/
- Descarga directa mediante asset() URLs

✅ **Funcionalidades incluidas:**
- Generación de reportes PDF completos (15+ páginas)
- Filtros avanzados por período y logia
- Historial de reportes generados
- Interfaz moderna con Ajax
- 11 secciones detalladas con análisis completo

✅ **Contenido del reporte:**
- Resumen ejecutivo con 9 KPIs principales
- Estadísticas de membresía por grado y logia
- Estado financiero completo de tesorería
- Gestión de eventos y calendario
- Repositorio de documentos
- Sistema de mensajería
- Directorio completo de logias
- Dignatarios de zona
- Escuela virtual y cursos
- Actividad reciente del sistema
- Alertas automáticas para situaciones críticas

## Uso del Módulo

1. **Acceder:** Admin → Reportes
2. **Configurar:** Período, filtros opcionales
3. **Generar:** Clic en "Generar Reporte PDF"
4. **Descargar:** Descarga automática del PDF

El sistema genera reportes profesionales con más de 15 páginas de análisis detallado del estado administrativo de la Gran Zona 5.