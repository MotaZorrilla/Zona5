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
                color: #666;
            }
            @bottom-center {
                content: "Página " counter(page) " de " counter(pages);
                font-size: 10px;
                color: #666;
            }
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #D4AF37;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #D4AF37;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .report-info {
            font-size: 10px;
            color: #888;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #D4AF37;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #D4AF37;
        }

        .subsection-title {
            font-size: 14px;
            font-weight: bold;
            color: #4F46E5;
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
            border: 1px solid #E5E7EB;
            background-color: #F9FAFB;
        }

        .kpi-value {
            font-size: 24px;
            font-weight: bold;
            color: #D4AF37;
            display: block;
        }

        .kpi-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        .data-table th {
            background-color: #D4AF37;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }

        .data-table td {
            padding: 6px 8px;
            border-bottom: 1px solid #E5E7EB;
        }

        .data-table tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-green { color: #10B981; }
        .text-red { color: #EF4444; }
        .text-blue { color: #3B82F6; }

        .page-break {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
        }

        .chart-placeholder {
            width: 100%;
            height: 200px;
            background-color: #F3F4F6;
            border: 2px dashed #D1D5DB;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6B7280;
            font-style: italic;
            margin: 15px 0;
        }

        .summary-box {
            background-color: #EFF6FF;
            border: 1px solid #DBEAFE;
            border-left: 4px solid #3B82F6;
            padding: 15px;
            margin: 15px 0;
        }

        .warning-box {
            background-color: #FFFBEB;
            border: 1px solid #FED7AA;
            border-left: 4px solid #F59E0B;
            padding: 15px;
            margin: 15px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
            font-size: 10px;
            color: #666;
            text-align: center;
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