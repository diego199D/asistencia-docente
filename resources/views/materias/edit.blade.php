@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Editar Materia</h3>

    <form action="{{ route('materias.update', $materia) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Sigla</label>
            <input type="text" name="sigla" class="form-control" value="{{ $materia->sigla }}" required>
        </div>
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $materia->nombre }}" required>
        </div>
        <div class="mb-3">
            <label>Grupo</label>
            <input type="text" name="grupo" class="form-control" value="{{ $materia->grupo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('materias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
