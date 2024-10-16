<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        @page {
            margin: 140px 30px 100px 30px;
            size: A3 landscape;
            /* Espacio para encabezado y pie de página */
        }
        header {
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }
        footer {
            position: fixed;
            bottom: -90px; /* Ajustar la posición del footer */
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            
        }
        .footer-content {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .footer-image {
            width: 680px;
            height: 80px;
        }
        .date-time {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(15, 15, 15, 0.863); /* Ajusta este color según el fondo de la imagen */
            font-weight: bold;
            font-size: 12px;
            text-shadow: 1px 1px 2px #000; /* Sombra para mejorar la legibilidad */
        }
        .date-time .time {
        margin-left: 60px; /* Ajusta el valor para controlar la distancia */
        }
        .content {
            margin-top: 20px;
        }
        .header img {
            width: 1515px;
            height: 75px;
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
    <header>
        <div class="header">
            <img src="images/banner-cuscof.jpg" alt="Logo">
        </div>
    </header>
    <footer>
        <div class="footer-content">
            <img src="images/footter.jpg" style="width: 1500px; height: 80px" alt="Logo">
            <div class="date-time">
                <p>Fecha: {{ date('d/m/Y') }} <span class="time">Hora: {{ date('H:i:s') }}</span></p>
            </div>
        </div>
    </footer>
    
    <h3>SUB GERENCIA DE ESTUDIOS Y PROYECTOS (INVERSIONES)</h3>
    <div class="table-responsive">
        <table id="segmentosTable" class="table">
          <thead class="cabecera">
            <tr>
              <th>#</th>
              <th class="text-nowrap">CUI</th>
              <th class="text-nowrap">Nombre</th>
              <th class="text-nowrap">Nombre Corto</th>
              <th class="text-center">Responsable</th>
              <th class="text-center">Provincia</th>
              <th class="text-center">Distrito</th>
              <th class="text-center">Nivel</th>
              <th class="text-center">Función</th>
              <th class="text-center">Modalidad</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Avance</th>
              <th class="text-nowrap">Fecha Inicio</th>
              <th class="text-nowrap">Fecha Final</th>
              <th class="text-nowrap">Presupuesto <p>Formulación</p></th>
              <th class="text-nowrap">Presupuesto <p>Ejecución</p></th>
              <th class="text-nowrap">Fecha Inicio: <p>Consistencia</p></th>
              <th class="text-nowrap">Fecha Final: <p>Consistencia</p></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inversiones as $inversion)
              <tr>
                <td class="text-left">{{ $loop->index + 1 }}</td>
                <td class="text-nowrap">{{ $inversion->cuiInversion }}</td>
                <td>{{ $inversion->nombreInversion }}</td>
                <td>{{ $inversion->nombreCortoInversion }}</td>
                <td class="text-nowrap"><b>{{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}</b></td>
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
                <td class="text-center">{{ $inversion->fechaInicioConsistenciaInversion  }}</td>
                <td class="text-center">{{ $inversion->fechaFinalConsistenciaInversion  }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</body>
</html>


  