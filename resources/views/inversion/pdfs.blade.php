<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            size: A3 landscape;
            margin: 10mm; /* Ajusta el margen */
        }
        body {
            font-family: Arial, sans-serif;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 5px; /* Reduce el padding */
            border: 1px solid #ddd;
            font-size: 12px; /* Reduce el tamaño de la fuente si es necesario */
            word-wrap: break-word; /* Permite que el texto largo se divida */
        }
        .table th {
            background-color: #851010;
        }
        .text-nowrap {
            white-space: nowrap; /* Evitar que el texto se ajuste */
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .cabecera{
            color: #f7f3f3;
        }
    </style>
</head>
<body>
    <img src="images/gorec-logo2.png" alt="Logo" width="90px" height="90px">
    <h1 style="text-align: center">INVERSIONES</h1>
    <div class="table-responsive">
        <table id="segmentosTable" class="table">
          <thead class="cabecera">
            <tr>
              <th>#</th>
              <th class="text-nowrap">CUI</th>
              <th class="text-nowrap">Nombre</th>
              <th class="text-nowrap">Nombre Corto</th>
              <th class="text-center">Jefe</th>
              <th class="text-center">Provincia</th>
              <th class="text-center">Distrito</th>
              <th class="text-center">Nivel</th>
              <th class="text-center">Función</th>
              <th class="text-center">Modalidad</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Avance</th>
              <th class="text-nowrap">Fecha Inicio</th>
              <th class="text-nowrap">Fecha Final</th>
              <th class="text-nowrap">Presupuesto Formulación</th>
              <th class="text-nowrap">Presupuesto Ejecución</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inversiones as $inversion)
              <tr>
                <td class="text-left">{{ $loop->index + 1 }}</td>
                <td class="text-nowrap">{{ $inversion->cuiInversion }}</td>
                <td>{{ $inversion->nombreInversion }}</td>
                <td>{{ $inversion->nombreCortoInversion }}</td>
                <td class="text-nowrap">{{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}</td>
                <td class="text-center">{{ $inversion->provinciaInversion }}</td>
                <td class="text-center">{{ $inversion->distritoInversion }}</td>
                <td class="text-center">{{ $inversion->nivelInversion }}</td>
                <td class="text-center">{{ $inversion->funcionInversion }}</td>
                <td class="text-center">{{ $inversion->modalidadInversion }}</td>
                <td class="text-center">{{ $inversion->estadoInversion }}</td>
                <td class="text-center">{{ $inversion->avanceInversion }}%</td>
                <td class="text-center">{{ $inversion->fechaInicioInversion }}</td>
                <td class="text-center">{{ $inversion->fechaFinalInversion }}</td>
                <td class="text-center">{{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}</td>
                <td class="text-center">{{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</body>
</html>


  