@extends('adminlte::page')

@section('title', 'Lista')

@section('content_header')
  <h1><i class="fas fa-clipboard-list"></i> Lista</h1>
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="table-responsive">
        <table id="segmentosTables" class="table table-bordered">
          <thead>
              <tr>
                  <th class="text-nowrap">Inversión</th>
                  <th>Proyectistas</th>
                  <th>Asistentes</th>
              </tr>
          </thead>
          <tbody>
              @foreach($inversiones as $inversion)
                  @foreach($inversion->profesional as $proyectista)
                      <tr>
                        <td>{{ $inversion->nombreCortoInversion }}</td>
                        <td>{{ $proyectista->usuario->nombreUsuario . ' ' . $proyectista->usuario->apellidoUsuario }} <br> <b>P:</b> (
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
                          <b>E:</b> (
                          @if ($proyectista->usuario->especialidades->isNotEmpty())
                            @foreach ($proyectista->usuario->especialidades as $especialidad)
                              {{ $especialidad->nombreEspecialidad }}
                              @if (!$loop->last)
                                ,
                              @endif
                            @endforeach
                          @endif
                          )</td>
                        <td>
                            @php
                                $asistentes = $inversion->asistente->where('idJefe', $proyectista->usuario->idUsuario);
                            @endphp
    
                            @if($asistentes->isEmpty())
                                <i>Sin asistentes</i>
                            @else
                                <ul>
                                    @foreach($asistentes as $asistente)
                                        <li>{{ $asistente->usuario->nombreUsuario . ' ' . $asistente->usuario->apellidoUsuario }} <br> <b>P:</b> (
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
                                          <b>E:</b> (
                                          @if ($asistente->usuario->especialidades->isNotEmpty())
                                            @foreach ($asistente->usuario->especialidades as $especialidad)
                                              {{ $especialidad->nombreEspecialidad }}
                                              @if (!$loop->last)
                                                ,
                                              @endif
                                            @endforeach
                                          @endif
                                          )</li>
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
</div>

@stop

@section('js')
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      var table = $('#segmentosTables').DataTable({
        responsive: true,
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

      // Ocultar valores repetidos en la columna de "Inversión"
      // Agrupación de filas por "Inversión" usando rowspan
      /*
      var lastInversion = null;
      var rowspan = 1;

      $('#segmentosTables tbody tr').each(function(index) {
        var currentInversion = $(this).find('td:first').text().trim();
        
        if (currentInversion === lastInversion) {
          // Incrementa el rowspan de la primera celda de la inversión
          rowspan++;
          $(this).find('td:first').remove(); // Elimina la celda duplicada
          $('#segmentosTables tbody tr').eq(index - rowspan + 1).find('td:first').attr('rowspan', rowspan);
        } else {
          // Resetea el rowspan y actualiza la inversión
          lastInversion = currentInversion;
          rowspan = 1;
        }
      });*/
    });
  </script>
@stop


@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
  <style>
  td {
    vertical-align: top;
    word-wrap: break-word; /* Hace que el texto largo se ajuste a la siguiente línea */
    white-space: normal; /* Permite que el texto use varias líneas */
  }

  /*td[rowspan] {
    vertical-align: middle; /* Alinea el contenido en el centro cuando se usa rowspan */
  }

  /* Establecer un ancho máximo para la columna de "Inversión" para evitar que se extienda demasiado */
  .table td:first-child {
    max-width: 110px; /* Puedes ajustar el valor según tus necesidades */
    word-wrap: break-word; /* Rompe el texto largo en varias líneas */
    white-space: normal; /* Permite que el texto use varias líneas */
  }
  .table td:nth-child(2) {
  max-width: 130px; /* Ajusta este valor según sea necesario */
  word-wrap: break-word;
  white-space: normal;
  }
  .table td:nth-child(3) {
  max-width: 130px; /* Ajusta este valor según sea necesario */
  word-wrap: break-word;
  white-space: normal;
  }
  </style>
@stop

