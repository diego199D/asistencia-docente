@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid">
    <div class="card p-4 shadow-sm border-0 bg-white rounded-3">
        <h4 class="mb-4 fw-bold text-primary">Registrar Materia</h4>

        <!-- Formulario de registro -->
        <form action="{{ route('materias.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="sigla" class="form-label fw-semibold">Sigla:</label>
                    <input type="text" class="form-control" name="sigla" id="sigla" required>
                </div>

                <div class="col-md-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>

                <div class="col-md-4">
                    <label for="grupo" class="form-label fw-semibold">Grupo:</label>
                    <input type="text" class="form-control" name="grupo" id="grupo" required>
                </div>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Registrar
                </button>
            </div>
        </form>
    </div>

    <!-- Lista de materias -->
    <div class="card p-4 mt-4 shadow-sm border-0 bg-white rounded-3">
        <h4 class="mb-3 fw-bold text-primary">Lista de Materias</h4>

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
                        <th>ID</th>
                        <th>Sigla</th>
                        <th>Nombre</th>
                        <th>Grupo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materias as $materia)
                    <tr>
                        <td>{{ $materia->id }}</td>
                        <td>{{ $materia->sigla }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->grupo }}</td>
                        <td class="text-center">
                            <!-- Botón editar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $materia->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <!-- Botón eliminar -->
                            <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal de edición -->
                    <div class="modal fade" id="editModal{{ $materia->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $materia->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('materias.update', $materia->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-primary">Editar Materia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="sigla" class="form-label fw-semibold">Sigla:</label>
                                            <input type="text" class="form-control" name="sigla" value="{{ $materia->sigla }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label fw-semibold">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" value="{{ $materia->nombre }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="grupo" class="form-label fw-semibold">Grupo:</label>
                                            <input type="text" class="form-control" name="grupo" value="{{ $materia->grupo }}" required>
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
                        <td colspan="5" class="text-center text-muted">No hay materias registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
