@extends('dashboard.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Aulas Disponibles</h2>

    <!-- Contadores -->
    <div class="text-center mb-4">
        <p><strong>🟩 Aulas disponibles:</strong> {{ $disponibles }}</p>
        <p><strong>🟥 Aulas no disponibles:</strong> {{ $noDisponibles }}</p>
    </div>

    <!-- Muestra las aulas agrupadas por piso -->
    @foreach ($aulasPorPiso as $piso => $aulas)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <strong>{{ $piso }}</strong>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-center">
                @foreach ($aulas as $aula)
                    <div style="width: 80px; height: 40px;
                                margin: 5px;
                                text-align: center;
                                line-height: 40px;
                                border-radius: 8px;
                                color: black;
                                background-color: {{ $aula->disponible ? 'lightgreen' : 'red' }};">
                        {{ $aula->nro_aula }}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection