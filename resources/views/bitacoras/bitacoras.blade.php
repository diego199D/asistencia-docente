@extends('dashboard.dashboard')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4 bg-white rounded-3">
        <h4 class="fw-bold text-primary mb-3">Registro de Bitácoras</h4>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>IP</th>
                        <th>Acción</th>
                        <th>Fecha y hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bitacoras as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->user->usuario ?? '—' }}</td>
                            <td>{{ $b->user->correo ?? '—' }}</td>
                            <td>{{ $b->ip_address }}</td>
                            <td>{{ $b->accion }}</td>
                            <td>{{ $b->fecha_hora }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay registros aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
