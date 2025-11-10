@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card p-4 shadow-sm border-0 bg-white rounded-3">
        <h4 class="mb-4 fw-bold text-primary">Registrar usuario</h4>

        <!-- Formulario de registro -->
        <form action="{{ route('docentes.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="usuario" class="form-label fw-semibold">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" required>
                </div>

                <div class="col-md-6">
                    <label for="nombre" class="form-label fw-semibold">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>

                <div class="col-md-6">
                    <label for="telefono" class="form-label fw-semibold">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                </div>

                <div class="col-md-6">
                    <label for="correo" class="form-label fw-semibold">Correo:</label>
                    <input type="email" class="form-control" name="correo" id="correo" required>
                </div>

                <div class="col-md-6">
                    <label for="fechaContrato" class="form-label fw-semibold">Fecha de contrato:</label>
                    <input type="date" class="form-control" name="fechaContrato" id="fechaContrato" required>
                </div>

                <div class="col-md-3">
                    <label for="password" class="form-label fw-semibold">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <!-- 🔹 SELECTOR DE ROL DINÁMICO -->
                <div class="col-md-3">
                    <label for="id_rol" class="form-label fw-semibold">Rol del usuario:</label>
                    <div class="input-group">
                        <select name="id_rol" id="id_rol" class="form-select" required>
                            <option value="">Seleccione rol</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ ucfirst($rol->nombre) }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" id="btnSeleccionarRol">
                            <i class="bi bi-check-circle"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Registrar
                </button>
            </div>
        </form>
    </div>

    <!-- Lista de usuarios -->
    <div class="card p-4 mt-4 shadow-sm border-0 bg-white rounded-3">
        <h4 class="mb-3 fw-bold text-primary">Lista de usuarios</h4>

        <div class="table-responsive">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <strong>✅ {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            @endif

            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Registro</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Cant. Materias</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($docentes as $docente)
                    <tr>
                        <td>{{ $docente->id }}</td>
                        <td>{{ $docente->nombre }}</td>
                        <td>{{ $docente->usuario->correo }}</td>
                        <td>{{ $docente->usuario->telefono }}</td>
                        <td>{{ ucfirst($docente->usuario->rol->nombre ?? '—') }}</td>
                        <td>—</td>
                        <td class="text-center">
                            <!-- Botón editar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $docente->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Botón eliminar -->
                            <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script para feedback del botón “Seleccionar rol” -->
<script>
document.getElementById('btnSeleccionarRol').addEventListener('click', function () {
    const select = document.getElementById('id_rol');
    const rolText = select.options[select.selectedIndex].text;
    if (select.value) {
        alert('Rol seleccionado: ' + rolText);
    } else {
        alert('Por favor seleccione un rol.');
    }
});
</script>
@endsection