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
            margin: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header img {
            width: 680px;
            height: 150px;
        }
        .header h3 {
            text-align: center;
            margin: 0;
            padding-left: 10px;
        }
        .table-container {
            width: 100%;
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
    <div class="header">
        <img src="images/bannercusco.jpg" alt="Logo">
    </div>
    <table class="table-container">
        <tr>
            <th>CUI</th>
            <td>{{ $inversion->cuiInversion }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td colspan="3">{{ $inversion->nombreInversion }}</td>
        </tr>
        <tr>
            <th>Nombre Corto</th>
            <td colspan="3">{{ $inversion->nombreCortoInversion }}</td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td colspan="3">
            {{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}
        P: (
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
        E: (
        @if ($inversion->usuario->especialidades->isNotEmpty())
            @foreach ($inversion->usuario->especialidades as $especialidad)
                {{ $especialidad->nombreEspecialidad }}
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        @endif
        )
    </td>
        </tr>
       <!-- Mostrar profesionales y asistentes -->
<tr>
    <th>Profesionales y Asistentes</th>
    <td colspan="3">
        @foreach($inversion->Profesional as $asignacion)
            <strong>{{ $asignacion->usuario->nombreUsuario }} {{ $asignacion->usuario->apellidoUsuario }}</strong> (P: {{ $asignacion->usuario->profesiones->pluck('nombreProfesion')->implode(', ') }}) 
            (E: {{ $asignacion->usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }}) 
            <ul>
                @foreach($inversion->asistente->where('idJefe', $asignacion->usuario->idUsuario) as $asistenteAsignacion)
                    <li>{{ $asistenteAsignacion->usuario->nombreUsuario }} {{ $asistenteAsignacion->usuario->apellidoUsuario }}</li>
                    (P: {{ $asistenteAsignacion->usuario->profesiones->pluck('nombreProfesion')->implode(', ') }}) 
            (E: {{ $asistenteAsignacion->usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }}) 
                @endforeach
            </ul>
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
            <td colspan="3">{{ $inversion->avanceInversion }}%</td>
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
    </table>
    <footer>
        <img src="images/footter.jpg" style="width: 680px; height: 80px" alt="Logo">
        <div class="date-time">
            <span>Fecha: {{ date('d/m/Y') }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>Hora: {{ date('H:i:s') }}</span>
        </div>

    </footer>
</body>
</html>





