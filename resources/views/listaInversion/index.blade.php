@extends('adminlte::page')

@section('title', 'Lista')

@section('content_header')
  <h1><i class="fas fa-truck-moving"></i> Lista</h1>
@stop

@section('content')
<table id="segmentosTables" class="table table-bordered">
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
                    <td>{{ $inversion->nombreInversion }}</td>
                    <td>{{ $proyectista->usuario->nombreUsuario }} ({{ $proyectista->especialidad }})</td>
                    <td>
                        @php
                            $asistentes = $inversion->asistente->where('idJefe', $proyectista->usuario->idUsuario);
                        @endphp

                        @if($asistentes->isEmpty())
                            <i>Sin asistentes</i>
                        @else
                            <ul>
                                @foreach($asistentes as $asistente)
                                    <li>{{ $asistente->usuario->nombreUsuario }} ({{ $asistente->usuario->especialidad }})</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
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
      });
    });
  </script>
@stop


@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
  <style>
    a {
      text-decoration: none;
    }
    .btn-option{
      height: 38px;
    }
    .btn-option i{
      padding-top: 4px;
    }
  </style>
  <style>
    td {
      vertical-align: top;
    }
    
    td[rowspan] {
      vertical-align: middle; /* Alinea el contenido en el centro cuando se usa rowspan */
    }
  </style>
@stop

