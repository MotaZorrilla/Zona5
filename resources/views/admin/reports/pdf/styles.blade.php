<style>
/* Color Palette - Professional Masonic Theme */
:root {
    --primary-black: #1a1a1a;
    --primary-blue: #1e40af;
    --primary-red: #dc2626;
    --secondary-blue: #2563eb;
    --secondary-green: #059669;
    --secondary-purple: #7c3aed;
    --light-gray: #f8fafc;
    --medium-gray: #e2e8f0;
    --dark-gray: #64748b;
    --border-color: #e5e7eb;
}

/* Base Styles */
body {
    font-family: 'Arial', 'Calibri', sans-serif;
    font-size: 11px;
    line-height: 1.4;
    color: var(--primary-black);
    margin: 0;
    padding: 0;
}

/* Header Styles */
.header {
    text-align: center;
    border-bottom: 3px solid var(--primary-blue);
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.header .logo {
    margin-bottom: 15px;
}

.header .title {
    font-size: 18px;
    font-weight: bold;
    color: var(--primary-blue);
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.header .subtitle {
    font-size: 14px;
    color: var(--primary-black);
    margin-bottom: 3px;
    font-weight: bold;
}

.header .jurisdiction {
    font-size: 10px;
    color: var(--dark-gray);
    margin-bottom: 15px;
    font-style: italic;
}

.header .report-info {
    font-size: 10px;
    color: var(--dark-gray);
    margin-top: 10px;
}

.header .report-info p {
    margin: 2px 0;
}

/* Section Styles */
.section {
    margin-bottom: 25px;
    page-break-inside: avoid;
}

.section-title {
    font-size: 14px;
    font-weight: bold;
    color: var(--primary-blue);
    border-bottom: 2px solid var(--primary-blue);
    padding-bottom: 5px;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.subsection-title {
    font-size: 12px;
    font-weight: bold;
    color: var(--primary-black);
    margin-bottom: 10px;
    border-left: 3px solid var(--primary-blue);
    padding-left: 8px;
}

/* KPI Grid */
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
    padding: 10px;
    text-align: center;
    border: 1px solid var(--border-color);
    background: var(--light-gray);
    vertical-align: middle;
}

.kpi-item .kpi-value {
    font-size: 16px;
    font-weight: bold;
    color: var(--primary-blue);
    display: block;
    margin-bottom: 3px;
}

.kpi-item .kpi-label {
    font-size: 9px;
    color: var(--dark-gray);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Table Styles */
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
    font-size: 9px;
}

.data-table th {
    background-color: var(--primary-blue);
    color: white;
    padding: 8px 4px;
    text-align: left;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid var(--primary-blue);
}

.data-table td {
    padding: 6px 4px;
    border: 1px solid var(--border-color);
    vertical-align: top;
}

.data-table tbody tr:nth-child(even) {
    background-color: var(--light-gray);
}

.data-table tbody tr:hover {
    background-color: var(--medium-gray);
}

.data-table .font-bold {
    font-weight: bold;
}

.data-table .text-center {
    text-align: center;
}

.data-table .text-right {
    text-align: right;
}

.data-table .text-blue {
    color: var(--primary-blue);
}

.data-table .text-green {
    color: var(--secondary-green);
}

.data-table .text-red {
    color: var(--primary-red);
}

.data-table .text-yellow {
    color: var(--secondary-yellow);
}

/* Summary Box */
.summary-box {
    background-color: var(--light-gray);
    border: 1px solid var(--border-color);
    border-left: 4px solid var(--primary-blue);
    padding: 12px;
    margin: 15px 0;
    font-size: 10px;
}

.summary-box p {
    margin: 0 0 8px 0;
}

.summary-box ul {
    margin: 8px 0;
    padding-left: 20px;
}

.summary-box li {
    margin-bottom: 4px;
}

/* Warning Box */
.warning-box {
    background-color: #eff6ff;
    border: 1px solid #3b82f6;
    border-left: 4px solid var(--primary-blue);
    padding: 10px;
    margin: 15px 0;
    font-size: 10px;
}

.warning-box p {
    margin: 0 0 8px 0;
    color: #92400e;
}

.warning-box ul {
    margin: 8px 0;
    padding-left: 20px;
}

.warning-box li {
    margin-bottom: 4px;
    color: #92400e;
}

/* Index Styles */
.index-item {
    font-size: 11px;
    margin-bottom: 8px;
    padding: 3px 0;
}

/* Document Footer - appears only at the end of the document */
.document-footer {
    text-align: center;
    margin-top: 50px;
    padding-top: 30px;
    border-top: 2px solid var(--primary-blue);
    font-size: 10px;
    color: var(--dark-gray);
    page-break-inside: avoid;
}

.document-footer p {
    margin: 5px 0;
}

/* Page Breaks */
.page-break {
    page-break-before: always;
}

/* Chart Placeholder */
.chart-placeholder {
    border: 2px dashed var(--border-color);
    padding: 40px;
    text-align: center;
    color: var(--dark-gray);
    font-style: italic;
    margin: 20px 0;
    background-color: var(--light-gray);
}

/* Special Colors */
.text-green {
    color: var(--secondary-green) !important;
}

.text-red {
    color: var(--primary-red) !important;
}

.text-blue {
    color: var(--primary-blue) !important;
}

.text-blue {
    color: var(--primary-blue) !important;
}

.text-purple {
    color: var(--secondary-purple) !important;
}

/* Responsive adjustments for PDF */
@media print {
    .section {
        page-break-inside: avoid;
    }

    .data-table {
        font-size: 8px;
    }

    .data-table th,
    .data-table td {
        padding: 4px 2px;
    }
}
</style>