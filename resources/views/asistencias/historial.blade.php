@extends('dashboard.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="text-primary fw-bold mb-4 text-center">Historial de Asistencias</h3>

            <!-- Tabla de asistencias -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Rol</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asistencias as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->usuario->usuario ?? '—' }}</td>
                                <td>{{ $a->fecha }}</td>
                                <td>{{ ucfirst($a->usuario->rol->nombre ?? 'Sin rol') }}</td>
                                <td>
                                    @if ($a->estado == 'Presente')
                                        <span class="badge bg-success">Presente</span>
                                    @elseif ($a->estado == 'Ausente')
                                        <span class="badge bg-danger">Ausente</span>
                                    @elseif ($a->estado == 'Justificado')
                                        <span class="badge bg-warning text-dark">Justificado</span>
                                    @else
                                        <span class="badge bg-secondary">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No hay registros de asistencia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
