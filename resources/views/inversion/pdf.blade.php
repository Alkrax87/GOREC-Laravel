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
            margin: 140px 30px 100px 30px; /* Espacio para encabezado y pie de página */
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
        margin-left: 50px; /* Ajusta el valor para controlar la distancia */
        }
        .content {
            margin-top: 40px;
        }
        .header img {
            width: 720px;
            height: 55px;
        }
        .table-container {
            width: 98%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
            padding: 10px;
            font-size: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table-container th {
            background-color: #991818;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
        }
        .table-container tr:nth-child(even) {
            background-color: #f9f9f9;
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
            <img src="images/footter.jpg" style="width: 725px; height: 80px" alt="Logo">
            <div class="date-time">
                <p>Fecha: {{ date('d/m/Y') }} <span class="time">Hora: {{ date('H:i:s') }}</span></p>
            </div>
        </div>
    </footer>
   <h3 style="text-align: center; margin: -5%">PROYECTO DE INVERSION</h3>
    <div class="content">
    <table class="table-container">
        <tr>
            <th>CUI</th>
            <td>{{ $inversion->cuiInversion }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td colspan="3"><strong>{{ $inversion->nombreInversion }}</strong></td>
            
        </tr>
        <tr>
            <th>Nombre Corto</th>
            <td colspan="3">{{ $inversion->nombreCortoInversion }}</td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td colspan="3">
            <b>{{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}</b>
            <span style="font-size: 10px">( P: 
                @if ($inversion->usuario->profesiones->isNotEmpty())
                    @foreach ($inversion->usuario->profesiones as $profesion)
                        {{ $profesion->nombreProfesion }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @endif
                )
                &nbsp; | &nbsp;
                ( E: 
                @if ($inversion->usuario->especialidades->isNotEmpty())
                    @foreach ($inversion->usuario->especialidades as $especialidad)
                        {{ $especialidad->nombreEspecialidad }}
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @endif
                )</span>
            </td>
        </tr>
       <!-- Mostrar profesionales y asistentes -->
       <tr>
        <th>Profesionales y Asistentes</th>
        <td colspan="3">
            <strong>Profesionales:</strong><br><br><!-- Título para Profesionales -->
            @foreach($inversion->profesional as $asignacion)
                <strong>{{ $asignacion->usuario->nombreUsuario }} {{ $asignacion->usuario->apellidoUsuario }}</strong>&nbsp; 
                <span style="font-size: 10px">(P: {{ $asignacion->usuario->profesiones->pluck('nombreProfesion')->implode(', ') }}) |
                    (E: {{ $asignacion->usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }}) </span>
                <ul style="list-style: none">
                    <strong>Asistentes:</strong> 
                    @foreach($inversion->asistente->where('idJefe', $asignacion->usuario->idUsuario) as $asistenteAsignacion)
                        <li>- &nbsp; {{ $asistenteAsignacion->usuario->nombreUsuario }} {{ $asistenteAsignacion->usuario->apellidoUsuario }} &nbsp; 
                            <span style="font-size: 10px"> (P: {{ $asistenteAsignacion->usuario->profesiones->pluck('nombreProfesion')->implode(', ') }}) |
                                (E: {{ $asistenteAsignacion->usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }}) </span>  </li>
                    @endforeach
                </ul>
                <br>
            @endforeach
        </td>
    </tr>


        <tr>
            <th>Provincia</th>
            <td>{{ $inversion->provinciaInversion }}</td>
            <th>Distrito</th>
            <td>{{ $inversion->distritoInversion }}</td>
        </tr>
        <tr>
            <th>Nivel</th>
            <td colspan="3">{{ $inversion->nivelInversion }}</td>
        </tr>
        <tr>
            <th>Función</th>
            <td colspan="3">{{ $inversion->funcionInversion }}</td>
        </tr>
        <tr>
            <th>Modalidad</th>
            <td colspan="3">{{ $inversion->modalidadInversion }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td colspan="3">{{ $inversion->estadoInversion }}</td>
        </tr>
        <tr>
            <th>Avance</th>
            <td colspan="3" style="font-size: 15px"><b>{{ $inversion->avanceInversion }}%</b></td>
        </tr>
        <tr>
            <th>Fecha Inicio</th>
            <td colspan="3">{{ $inversion->fechaInicioInversion }}</td>
        </tr>
        <tr>
            <th>Fecha Final</th>
            <td colspan="3">{{ $inversion->fechaFinalInversion }}</td>
        </tr>
        <tr>
            <th>Formulación</th>
            <td colspan="3">{{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <th>Ejecución</th>
            <td colspan="3">{{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <th>Fecha Inicio Consistencia</th>
            <td colspan="3">{{ $inversion->fechaInicioConsistenciaInversion }}</td>
        </tr>
        <tr>
            <th>Fecha Final Consistencia</th>
            <td colspan="3">{{ $inversion->fechaFinalConsistenciaInversion }}</td>
        </tr>
       
    </table>
   
</div>

</body>
</html>





