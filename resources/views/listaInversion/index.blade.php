@extends('adminlte::page')

@section('title', 'Lista Asignaciones')

@section('content_header')
  <h1><i class="fas fa-clipboard-list"></i> Lista Asignaciones</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="asignacionesTable" class="table table-bordered">
          <thead>
            <tr>
              <th>Inversión</th>
              <th>Proyectistas</th>
              <th>Asistentes</th>
            </tr>
          </thead>
          <tbody>
            @foreach($inversiones as $inversion)
              @foreach($inversion->profesional as $proyectista)
                <tr>
                  <td>{{ $inversion->nombreCortoInversion }}</td>
                  <td>{{ $proyectista->usuario->nombreUsuario . ' ' . $proyectista->usuario->apellidoUsuario }}
                    <br>
                    <b>P:</b>
                    (
                      @if ($proyectista->usuario->profesiones->isNotEmpty())
                        @foreach ($proyectista->usuario->profesiones as $profesion)
                          {{ $profesion->nombreProfesion }}
                          @if (!$loop->last)
                            ,
                          @endif
                        @endforeach
                      @endif
                    )
                    <br>
                    <b>E:</b>
                    (
                      @if ($proyectista->usuario->especialidades->isNotEmpty())
                        @foreach ($proyectista->usuario->especialidades as $especialidad)
                          {{ $especialidad->nombreEspecialidad }}
                          @if (!$loop->last)
                            ,
                          @endif
                        @endforeach
                      @endif
                    )
                  </td>
                  <td>
                    @php
                      $asistentes = $inversion->asistente->where('idJefe', $proyectista->usuario->idUsuario);
                    @endphp
                    @if($asistentes->isEmpty())
                      <i>Sin asistentes</i>
                    @else
                      <ul>
                        @foreach($asistentes as $asistente)
                          <li>{{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }}
                            <br>
                            <b>P:</b>
                            (
                              @if ($asistente->usuario->profesiones->isNotEmpty())
                                @foreach ($asistente->usuario->profesiones as $profesion)
                                  {{ $profesion->nombreProfesion }}
                                  @if (!$loop->last)
                                    ,
                                  @endif
                                @endforeach
                              @endif
                            )
                            <br>
                            <b>E:</b>
                            (
                              @if ($asistente->usuario->especialidades->isNotEmpty())
                                @foreach ($asistente->usuario->especialidades as $especialidad)
                                  {{ $especialidad->nombreEspecialidad }}
                                  @if (!$loop->last)
                                    ,
                                  @endif
                                @endforeach
                              @endif
                            )
                          </li>
                        @endforeach
                      </ul>
                    @endif
                  </td>
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      var table = $('#asignacionesTable').DataTable({
        responsive: true,
        pageLength: 25,
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ registros por página",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando página _PAGE_ de _PAGES_",
          infoEmpty: "No hay registros disponibles",
          infoFiltered: "(filtrado de _MAX_ registros totales)",
          paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
          }
        }
      });
    });
  </script>
@stop