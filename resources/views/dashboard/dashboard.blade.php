<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FICCT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f2f6;
            margin: 0;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background-color: #0a2a5e;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 15px;
        }

        .sidebar img {
            width: 70px;
            margin-bottom: 10px;
        }

        .sidebar h5 {
            font-size: 18px;
            font-weight: 600;
        }

        .sidebar p {
            font-size: 12px;
            color: #ccc;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #12355B;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .topbar {
            height: 60px;
            background: white;
            margin-left: 240px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .content {
            margin-left: 240px;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .topbar,
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="{{ asset('imagen/FICCT.png') }}" alt="FICCT Logo">
            <h5>FICCT</h5>
            <p>Facultad de Ciencias de la Computación y Telecomunicaciones</p>
        </div>

        {{-- Opciones solo para Administrador --}}
        @if (Auth::user()->id_rol == 1)
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('docentes.index') }}" class="{{ request()->routeIs('docentes.index') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Gestión Docentes
            </a>

            <a href="{{ route('materias.index') }}" class="{{ request()->routeIs('materias.*') ? 'active' : '' }}">
                <i class="bi bi-book-fill"></i> Materias y Grupos
            </a>

            <a href="{{ route('horarios.index') }}" class="{{ request()->routeIs('horarios.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Horarios y Aulas
            </a>

            <a href="{{ route('bitacoras') }}" class="{{ request()->routeIs('bitacoras') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Bitácoras
            </a>

            <a href="{{ route('reportes') }}" class="{{ request()->routeIs('reportes') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Reportes
            </a>

            <!-- ✅ NUEVO BOTÓN DE AULAS -->
            <a href="{{ route('aulas.index') }}" class="{{ request()->routeIs('aulas.index') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Aulas
            </a>
            <!-- 🔚 FIN NUEVO BOTÓN -->
        @endif

        {{-- Opciones solo para Docente --}}
        @if (Auth::user()->id_rol == 2)
            <a href="{{ route('mis-horarios') }}" class="{{ request()->routeIs('mis-horarios') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Mis Horarios
            </a>

            <a href="#" class="#">
                <i class="bi bi-check2-square"></i> Asistencia
            </a>
        @endif
    </div>

    <!-- Topbar -->
    <nav class="topbar navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
        <div class="container-fluid justify-content-end">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle"
                    id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-4 me-2"></i>
                    <div class="text-end">
                        <span class="fw-semibold d-block">{{ Auth::user()->usuario ?? 'Usuario' }}</span>
                        <small class="text-muted">{{ Auth::user()->rol->nombre ?? 'Administrador' }}</small>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('perfil') }}">
                            <i class="bi bi-person-lines-fill me-2"></i> Perfil
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="GET">
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>