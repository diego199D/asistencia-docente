<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - FICCT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="card shadow-sm p-4 mx-auto" style="max-width: 600px;">
            <h3 class="text-center mb-4">Perfil del Usuario</h3>
            <p><strong>Nombre:</strong> {{ Auth::user()->usuario }}</p>
            <p><strong>Correo:</strong> {{ Auth::user()->correo }}</p>
            <p><strong>Teléfono:</strong> {{ Auth::user()->telefono }}</p>
            <p><strong>Rol:</strong> {{ Auth::user()->rol->nombre ?? 'Administrador' }}</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Volver al Dashboard</a>
        </div>
    </div>
</body>
</html>