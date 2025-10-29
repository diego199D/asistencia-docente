@extends('dashboard.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">📅 Gestión de Horarios</h2>

    {{-- Mensajes de éxito o error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario para registrar horario --}}
    <div class="card p-4 mb-4 shadow-sm">
        <form action="{{ route('horarios.store') }}" method="POST">
            @csrf
            <div class="row g-3">

                <div class="col-md-2">
                    <label for="dia" class="form-label fw-bold">Día</label>
                    <select name="dia" id="dia" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        <option>Lunes</option>
                        <option>Martes</option>
                        <option>Miércoles</option>
                        <option>Jueves</option>
                        <option>Viernes</option>
                        <option>Sábado</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="hora_inicio" class="form-label fw-bold">Hora inicio</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label for="hora_fin" class="form-label fw-bold">Hora fin</label>
                    <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label for="docente_id" class="form-label fw-bold">Docente</label>
                    <select name="docente_id" id="docente_id" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="materia_id" class="form-label fw-bold">Materia</label>
                    <select name="materia_id" id="materia_id" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->sigla }} - {{ $materia->nombre }} ({{ $materia->grupo }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="aula_id" class="form-label fw-bold">Aula</label>
                    <select name="aula_id" id="aula_id" class="form-select" required>
                        <option value="">Seleccionar...</option>
                        @foreach ($aulas as $aula)
                            <option value="{{ $aula->id }}">Aula {{ $aula->nroaula }} ({{ $aula->capacidad }} pers.)</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary mt-3">➕ Registrar Horario</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Tabla de horarios --}}
    <div class="card p-3 shadow-sm">
        <h4 class="mb-3 text-center">📘 Lista de Horarios</h4>
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Día</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Docente</th>
                    <th>Materia</th>
                    <th>Aula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($horarios as $horario)
                    <tr>
                        <td>{{ $horario->id }}</td>
                        <td>{{ $horario->dia }}</td>
                        <td>{{ $horario->hora_inicio }}</td>
                        <td>{{ $horario->hora_fin }}</td>
                        <td>{{ $horario->docente->nombre }}</td>
                        <td>{{ $horario->materia->sigla }} - {{ $horario->materia->nombre }} ({{ $horario->materia->grupo }})</td>
                        <td>Aula {{ $horario->aula->nroaula }}</td>
                        <td>
                            <form action="{{ route('horarios.destroy', $horario->id) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este horario?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No hay horarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
