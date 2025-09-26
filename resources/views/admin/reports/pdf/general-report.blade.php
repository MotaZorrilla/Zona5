<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report_info['title'] }}</title>
    <style>
        @page {
            margin: 2cm;
            @top-center {
                content: "{{ $report_info['title'] }}";
                font-size: 10px;
                color: #2C3E50;
            }
            @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-size: 10px;
                color: #2C3E50;
            }
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #2C3E50;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1A472A; /* Dark green (masonic color) */
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
        }

        .title {
            font-size: 28px;
            font-weight: bold;
            color: #1A472A; /* Dark green (masonic color) */
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            color: #2C3E50; /* Dark blue-black */
            margin-bottom: 10px;
            font-weight: bold;
        }

        .jurisdiction {
            font-size: 14px;
            color: #C1272D; /* Red */
            margin-bottom: 10px;
            font-style: italic;
        }

        .report-info {
            font-size: 10px;
            color: #2C3E50;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1A472A; /* Dark green (primary masonic color) */
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #C1272D; /* Red accent */
        }

        .subsection-title {
            font-size: 16px;
            font-weight: bold;
            color: #2C3E50; /* Dark blue-black */
            margin: 15px 0 10px 0;
        }

        .kpi-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .kpi-row {
            display: table-row;
        }

        .kpi-item {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            text-align: center;
            border: 1px solid #D6D6D6;
            background-color: #F8F9FA;
        }

        .kpi-value {
            font-size: 24px;
            font-weight: bold;
            color: #1A472A; /* Dark green */
            display: block;
        }

        .kpi-label {
            font-size: 10px;
            color: #2C3E50;
            margin-top: 5px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        .data-table th {
            background-color: #1A472A; /* Dark green */
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        .data-table th.secondary {
            background-color: #C1272D; /* Red */
        }

        .data-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #D6D6D6;
        }

        .data-table tr:nth-child(even) {
            background-color: #F8F9FA;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-green { color: #27AE60; } /* Green accent */
        .text-red { color: #C1272D; } /* Red */
        .text-blue { color: #2980B9; } /* Blue */
        .text-yellow { color: #F39C12; } /* Yellow accent */
        .text-black { color: #2C3E50; } /* Dark black-blue */

        .page-break {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
        }

        .chart-placeholder {
            width: 100%;
            height: 200px;
            background-color: #F8F9FA;
            border: 2px dashed #D6D6D6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7F8C8D;
            font-style: italic;
            margin: 15px 0;
        }

        .summary-box {
            background-color: #E8F4FD;
            border: 1px solid #AED6F1;
            border-left: 4px solid #2980B9; /* Blue */
            padding: 15px;
            margin: 15px 0;
        }

        .warning-box {
            background-color: #FDF2E9;
            border: 1px solid #F8C4A0;
            border-left: 4px solid #F39C12; /* Yellow */
            padding: 15px;
            margin: 15px 0;
        }

        .danger-box {
            background-color: #FDEDEC;
            border: 1px solid #F5B7B1;
            border-left: 4px solid #C1272D; /* Red */
            padding: 15px;
            margin: 15px 0;
        }

        .success-box {
            background-color: #E9F7EF;
            border: 1px solid #A9DFBF;
            border-left: 4px solid #27AE60; /* Green */
            padding: 15px;
            margin: 15px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #D6D6D6;
            font-size: 10px;
            color: #2C3E50;
            text-align: center;
        }

        .index-item {
            margin: 5px 0;
            padding: 2px 0;
            border-left: 3px solid #1A472A;
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Portada -->
    @include('admin.reports.pdf.partials.header')

    <!-- Resumen Ejecutivo -->
    @include('admin.reports.pdf.partials.executive-summary')

    <!-- Estadísticas de Membresía -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.membership-stats')

    <!-- Estado Financiero -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.financial-status')

    <!-- Gestión de Eventos -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.events-section')

    <!-- Noticias y Publicaciones -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.news-section')

    <!-- Repositorio de Documentos -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.repository-section')

    <!-- Sistema de Mensajería -->
    @include('admin.reports.pdf.partials.messages-section')

    <!-- Directorio de Logias -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.lodges-section')

    <!-- Dignatarios de Zona -->
    @include('admin.reports.pdf.partials.dignitaries-section')

    <!-- Escuela Virtual y Cursos -->
    @include('admin.reports.pdf.partials.courses-section')

    <!-- Actividad Reciente -->
    <div class="page-break"></div>
    @include('admin.reports.pdf.partials.activity-log')

    <!-- Pie de página -->
    @include('admin.reports.pdf.partials.footer')
</body>
</html>