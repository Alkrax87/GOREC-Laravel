@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
  <h1>Home</h1>
@stop

@section('content')
<div class="container">
  <h1>Listado de Proyectos</h1>
  <a href="{{ route('avanzeProyecto.create') }}" class="btn btn-primary mb-2">Crear Nuevo Proyecto</a>
  <table>
    <thead>
        <tr>
            <th>Proyecto</th>
            <th>Especialidad</th>
            <th>Fase</th>
            <th>Subfase</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proyectos as $proyecto)
        @foreach($proyecto->especialidades as $especialidad)
        @foreach($especialidad->fases as $fase)
        @foreach($fase->subfases as $subfase)
        <tr>
            <td>{{ $proyecto->nombreProyecto }}</td>
            <td>{{ $especialidad->nombreEspecialidad }}</td>
            <td>{{ $fase->nombreFase }}</td>
            <td>{{ $subfase->nombreSubfase }}</td>
        </tr>
        @endforeach
        @endforeach
        @endforeach
        @endforeach
    </tbody>
</table>
</div>

@stop

@section('css')
  {{-- Add here extra stylesheets --}}
  {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop