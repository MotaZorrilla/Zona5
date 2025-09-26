# Subida Manual de DomPDF para Hosting Compartido

## Si no tienes acceso a Composer en tu hosting compartido

### Opción 1: Descargar DomPDF manualmente

1. **Descargar los archivos necesarios:**
   - Ve a: https://github.com/barryvdh/laravel-dompdf
   - Descarga como ZIP
   - También descarga: https://github.com/dompdf/dompdf

2. **Estructura de directorios a crear:**
```
vendor/
├── barryvdh/
│   └── laravel-dompdf/
│       ├── src/
│       ├── config/
│       └── composer.json
├── dompdf/
│   └── dompdf/
│       ├── src/
│       ├── lib/
│       └── composer.json
└── phenx/
    └── php-font-lib/
```

3. **Subir archivos:**
   - Sube `barryvdh/laravel-dompdf` a `vendor/barryvdh/laravel-dompdf/`
   - Sube `dompdf/dompdf` a `vendor/dompdf/dompdf/`
   - Sube `phenx/php-font-lib` a `vendor/phenx/php-font-lib/`

### Opción 2: Usar una versión simplificada

Si la opción 1 es muy compleja, puedes usar esta alternativa:

1. **Crear un controlador alternativo sin DomPDF:**

```php
// En app/Http/Controllers/Admin/ReportController.php
// Reemplazar la línea del PDF con:

// En lugar de:
// $pdf = Pdf::loadView('admin.reports.pdf.general-report', $reportData);

// Usar:
$html = view('admin.reports.pdf.general-report', $reportData)->render();

// Y luego usar una librería más simple como TCPDF o mPDF
// O generar HTML y convertir con un servicio externo
```

### Opción 3: Generar reporte HTML (más simple)

1. **Crear una vista HTML en lugar de PDF:**

```php
// En el controlador, cambiar:
return response()->json([
    'success' => true,
    'message' => 'Reporte generado exitosamente',
    'download_url' => route('admin.reports.view', $filename), // Cambiar a view
    'filename' => $filename
]);
```

2. **Crear ruta para ver HTML:**
```php
// En routes/web.php
Route::get('reports/view/{filename}', [ReportController::class, 'viewHtml'])->name('reports.view');
```

3. **Método para mostrar HTML:**
```php
public function viewHtml($filename)
{
    // Cargar datos y mostrar vista HTML
    $reportData = $this->reportService->generateReportData($dateRange, $options);
    return view('admin.reports.html.general-report', $reportData);
}
```

## Archivos de Configuración Necesarios

### 1. Actualizar composer.json (si tienes acceso)

```json
{
    "require": {
        "barryvdh/laravel-dompdf": "^2.0"
    }
}
```

### 2. Registrar el Service Provider

En `config/app.php`:

```php
'providers' => [
    // ...
    Barryvdh\DomPDF\ServiceProvider::class,
],

'aliases' => [
    // ...
    'PDF' => Barryvdh\DomPDF\Facade\Pdf::class,
],
```

### 3. Crear configuración de DomPDF

Crear `config/dompdf.php`:

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

1. **Crear archivo de prueba** `test-pdf.php` en la raíz:

```php
<?php
require_once 'vendor/autoload.php';

use Barryvdh\DomPDF\Facade\Pdf;

try {
    $pdf = Pdf::loadHTML('<h1>Test PDF</h1><p>Si ves esto, DomPDF funciona correctamente.</p>');
    $pdf->save(public_path('test.pdf'));
    echo "PDF generado correctamente en public/test.pdf";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
```

2. **Ejecutar desde el navegador:** `tudominio.com/test-pdf.php`

## Solución de Problemas

### Error: "Class not found"
- Verifica que `vendor/autoload.php` existe
- Asegúrate de que todos los archivos se subieron correctamente
- Revisa que `composer.json` esté actualizado

### Error: "Permission denied"
- Cambia permisos de `public/uploads/reports/` a 777
- Verifica permisos de `storage/` y `bootstrap/cache/`

### Error: "Font not found"
- Crea directorio `storage/fonts/` con permisos 777
- O usa fuentes web-safe en el CSS del PDF

## Alternativa: Servicio Externo

Si nada funciona, puedes usar un servicio externo como:
- wkhtmltopdf (si está disponible en el hosting)
- Puppeteer (requiere Node.js)
- API externa de conversión HTML a PDF

El sistema de reportes está diseñado para ser flexible y adaptarse a diferentes entornos de hosting.