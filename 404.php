<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f7fafc;
        }

        .error-code {
            font-size: 10rem;
            font-weight: bold;
            color: #3b82f6;
        }

        .error-message {
            font-size: 2rem;
            font-weight: bold;
            color: #1f2937;
            text-align: center;
        }

        .error-image {
            max-width: 400px;
            margin-bottom: 2rem;
        }

        .back-link {
            text-decoration: none;
            background-color: #3b82f6;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.25rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 2rem;
        }

        .back-link:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body>
    <div class="error-page">
        <h1 class="error-code">404</h1>
        <p class="error-message">¡Ups! Parece que te has perdido.</p>
        <a href="/" class="back-link">Volver a la página principal</a>
    </div>
</body>

</html>