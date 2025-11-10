@extends('dashboard.dashboard')

@section('content')
<div class="container mt-4">
    <!-- 🔹 Reporte de Aulas -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-building"></i> Reporte de Aulas</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aulas as $index => $aula)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $aula->capacidad ?? '-' }}</td>
                            <td>
                                @if($aula->estado === 'Disponible')
                                    <span class="badge bg-success">🟢 Disponible</span>
                                @else
                                    <span class="badge bg-danger">🔴 Ocupada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay aulas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 🔹 Reporte de Asistencias -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-check2-square"></i> Reporte de Asistencias</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover text-center">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Total Asistencias</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reporteAsistencia as $index => $usuario)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $usuario->usuario ?? '-' }}</td>
                            <td>{{ $usuario->correo ?? '-' }}</td>
                            <td>{{ $usuario->total_asistencias ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No se encontraron registros de asistencia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection