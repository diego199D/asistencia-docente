@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Registrar Materia</h3>

    <form action="{{ route('materias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Sigla</label>
            <input type="text" name="sigla" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Grupo</label>
            <input type="text" name="grupo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('materias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
