@extends('dashboard.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="text-primary fw-bold mb-4">Registro de Asistencia</h3>

            <!-- Mensajes -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('info'))
                <div class="alert alert-warning">{{ session('info') }}</div>
            @endif

            <!-- Botón para marcar asistencia -->
            <form action="{{ route('asistencias.marcar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success px-4 py-2 fw-semibold">
                    <i class="bi bi-check-circle-fill"></i> Marcar Asistencia
                </button>
            </form>

            <!-- Tabla de asistencias -->
            <div class="mt-4">
                <h5 class="fw-bold text-secondary mb-3">Historial de asistencias</h5>
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asistencias as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->fecha }}</td>
                            <td>{{ $a->hora_marcado ?? '—' }}</td>
                            <td>
                                <span class="badge bg-success">{{ $a->estado }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay registros de asistencia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection