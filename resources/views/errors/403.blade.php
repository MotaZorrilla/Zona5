<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permiso Denegado</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        
        .error-container {
            text-align: center;
            max-width: 500px;
            padding: 2rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .error-code {
            font-size: 4rem;
            font-weight: 600;
            color: #ef4444;
            margin: 0;
        }
        
        .error-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin: 1rem 0 0.5rem 0;
        }
        
        .error-message {
            color: #6b7280;
            margin-bottom: 1.5rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.15s;
        }
        
        .btn:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">403</h1>
        <h2 class="error-title">Permiso Denegado</h2>
        <p class="error-message">Lo sentimos, no tienes permiso para acceder a esta página.</p>
        <a href="{{ route('dashboard') }}" class="btn">Volver al Dashboard</a>
    </div>
</body>
</html>