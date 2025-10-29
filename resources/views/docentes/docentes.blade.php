@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card p-4 shadow-sm border-0 bg-white rounded-3">
        <h4 class="mb-4 fw-bold text-primary">Registrar docente</h4>

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

                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Registrar
                </button>
            </div>
        </form>
    </div>

    <!-- Lista de docentes -->
    <div class="card p-4 mt-4 shadow-sm border-0 bg-white rounded-3">
        <h4 class="mb-3 fw-bold text-primary">Lista de docentes</h4>

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
                        <td>—</td>
                        <td class="text-center">
                            <!-- Botón editar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $docente->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Botón eliminar -->
                            <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este docente?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal de edición -->
                    <div class="modal fade" id="editModal{{ $docente->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $docente->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('docentes.update', $docente->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-primary">Editar docente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label fw-semibold">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" value="{{ $docente->nombre }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="correo" class="form-label fw-semibold">Correo:</label>
                                            <input type="email" class="form-control" name="correo" value="{{ $docente->usuario->correo }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="telefono" class="form-label fw-semibold">Teléfono:</label>
                                            <input type="text" class="form-control" name="telefono" value="{{ $docente->usuario->telefono }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="fechaContrato" class="form-label fw-semibold">Fecha de contrato:</label>
                                            <input type="date" class="form-control" name="fechaContrato" value="{{ $docente->fechaContrato }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-semibold">Nueva contraseña (opcional):</label>
                                            <input type="password" class="form-control" name="password" placeholder="Dejar vacío para no cambiar">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay docentes registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection