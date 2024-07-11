<!-- resources/views/subfase/update.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Actualizar Avance</h2>
    <form action="{{ route('subfase.updateAvance', $subfase->idSubfase) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="avance_por_usuario_realSubFase">Avance por Usuario Real (%)</label>
            <input type="number" name="avance_por_usuario_realSubFase" class="form-control" required min="0" max="100" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Avance</button>
    </form>
</div>
@endsection
