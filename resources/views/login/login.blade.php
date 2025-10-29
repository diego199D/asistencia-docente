<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - FICCT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, #12355B, #001C3A);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #f8f9fa;
            border-radius: 25px;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
            width: 450px;
            padding: 40px 35px;
            text-align: center;
        }

        .login-container img {
            width: 100px;
            margin-bottom: 10px;
        }

        .login-container h5 {
            font-weight: 700;
            color: #0a2a5e;
        }

        .login-container p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 25px;
        }

        .login-container h2 {
            font-weight: 700;
            color: #0a2a5e;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 50px;
            padding-left: 45px;
            height: 45px;
        }

        .input-group-text {
            background: white;
            border: none;
            border-radius: 50px 0 0 50px;
        }

        .btn-login {
            width: 100%;
            background: #0066cc;
            color: white;
            border-radius: 50px;
            padding: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #004c99;
        }

        a {
            font-size: 0.9rem;
            text-decoration: none;
            color: #0a2a5e;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Logo y texto institucional -->
        <div class="text-center mb-3">
            <img src="{{ asset('imagen/FICCT.png') }}" alt="Logo FICCT">
            <h5>FICCT</h5>
            <p>Facultad de Ciencias de la Computación y Telecomunicaciones</p>
        </div>

        <!-- Título -->
        <h2>Iniciar sesión</h2>

        <!-- Mensajes de error -->
        @if($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger p-2">{{ session('error') }}</div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person-fill"></i>
                </span>
                <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" required>
            </div>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>

            <div class="text-end mb-3">
                <a href="#">¿Olvidó su contraseña?</a>
            </div>

            <button type="submit" class="btn btn-login">Ingresar</button>
        </form>
    </div>

</body>
</html>
