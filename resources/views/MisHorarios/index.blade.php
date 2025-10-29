@extends('dashboard.dashboard')

@section('content')
    <div class="container mt-4">
        <h2>Mi Horario - {{ $docente->nombre }}</h2>

        @if ($horarios->isEmpty())
            <p>No tienes horarios asignados.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Materia</th>
                        <th>Aula</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $h)
                        <tr>
                            <td>{{ $h->dia }}</td>
                            <td>{{ $h->hora_inicio }}</td>
                            <td>{{ $h->hora_fin }}</td>
                            <td>{{ $h->materia->nombre }}</td>
                            <td>{{ $h->aula->nroaula }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
