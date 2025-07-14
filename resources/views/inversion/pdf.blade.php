<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Inversión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        @page {
            margin: 140px 30px 100px 30px;
        }
        header, footer {
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
        }
        header {
            top: -120px;
            height: 100px;
        }
        footer {
            bottom: -90px;
            height: 50px;
        }
        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .footer-image {
            width: 725px;
            height: 80px;
        }
        .date-time {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 12px;
            color: rgba(15, 15, 15, 0.863);
            text-shadow: 1px 1px 2px #000;
        }
        .content {
            margin-top: -70px;
        }
        h3 {
            text-align: center;
            color: #991818;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 4px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
        }
        th {
            background-color: #991818;
            color: white;
            font-size: 9px;
        }
        ul {
            list-style-type: none;
            padding-left: 10px;
            margin: 0;
        }
        p {
            margin: 0;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="images/banner-cuscof.jpg" alt="Logo" style="width: 732px; height: 55px;">
    </header>

    <footer>
        <div class="footer-content">
            <img src="images/footter.jpg" class="footer-image" alt="Logo">
            <div class="date-time">
                <p>Fecha: {{ date('d/m/Y') }} <span class="time" style="margin-left: 50px">Hora: {{ date('H:i:s') }}</span></p>
            </div>
        </div>
    </footer>

    <div class="content">
        <h3>PROYECTO DE INVERSIÓN</h3>

        <table>
            <tr>
                <th width="5%">CUI</th>
                <td width="25%">{{ $inversion->cuiInversion }}</td>
                <th width="10%">Responsable</th>
                <td>{{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}</td>
                <th width="6%">Avance</th>
                <td width="8%" style="text-align: center"><strong>{{ $inversion->avanceInversion }}%</strong></td>
            </tr>
        </table>

        <table>
            <tr>
                <th width="37%">Provincia</th>
                <th width="37%">Distrito</th>
                <th width="13%">Fecha Inicio</th>
                <th width="13%">Fecha Final</th>
            </tr>
            <tr>
                <td>{{ $inversion->provinciaInversion }}</td>
                <td>{{ $inversion->distritoInversion }}</td>
                <td>{{ $inversion->fechaInicioInversion }}</td>
                <td>{{ $inversion->fechaFinalInversion }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="4">Nombre</th>
            </tr>
            <tr>
                <td colspan="4">{{ $inversion->nombreInversion }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th width="50%">Presupuesto Formulación</th>
                <th width="50%">Presupuesto Ejecución</th>
            </tr>
            <tr>
                <td style="font-size: 16px">{{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}</td>
                <td style="font-size: 16px">{{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th width="50%">Función</th>
                <th width="50%">Estado</th>
            </tr>
            <tr>
                <td>{{ $inversion->funcionInversion }}</td>
                <td>{{ $inversion->estadoInversion }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th width="37%">Nivel</th>
                <th width="37%">Modalidad</th>
                <th width="13%">Inicio Consistencia</th>
                <th width="13%">Fin Consistencia</th>
            </tr>
            <tr>
                <td>{{ $inversion->nivelInversion }}</td>
                <td>{{ $inversion->modalidadInversion }}</td>
                <td>{{ $inversion->fechaInicioConsistenciaInversion }}</td>
                <td>{{ $inversion->fechaFinalConsistenciaInversion }}</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th width="6%">#</th>
                    <th width="47%">Profesional</th>
                    <th width="47%">Asistentes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inversion->profesional as $index => $asignacion)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="font-size: 14px">
                            {{ $asignacion->usuario->nombreUsuario }} {{ $asignacion->usuario->apellidoUsuario }}
                            <p>(<b>P:</b> {{ $asignacion->usuario->profesiones->pluck('nombreProfesion')->implode(', ') }} | 
                               <b>E:</b> {{ $asignacion->usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }})</p>
                        </td>
                        <td>
                            <ul>
                                @foreach($inversion->asistente->where('idJefe', $asignacion->usuario->idUsuario) as $asistenteAsignacion)
                                    <li>
                                        {{ $asistenteAsignacion->usuario->nombreUsuario }} {{ $asistenteAsignacion->usuario->apellidoUsuario }}
                                        <p>(<b>P:</b> {{ $asistenteAsignacion->usuario->profesiones->pluck('nombreProfesion')->implode(', ') }} | 
                                           <b>E:</b> {{ $asistenteAsignacion->usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }})</p>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Comentarios de la Inversión</h3>

        @if($comentarios->isEmpty())
            <p style="text-align: center;">No hay comentarios registrados para esta inversión.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th width="30%">Asunto</th>
                        <th width="30%">Profesional</th>
                        <th width="40%">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comentarios as $comentario)
                        <tr>
                            <td><strong>{{ $comentario->asuntoComentarioInversion }}</strong></td>
                            <td>
                                {{ $comentario->usuario->nombreUsuario ?? 'Desconocido' }}
                                {{ $comentario->usuario->apellidoUsuario ?? '' }}<br>
                                <small><i>
                                    Registrado el {{ \Carbon\Carbon::parse($comentario->fechaComentarioInversion)->format('d/m/Y') }}
                                </i></small>
                            </td>
                            <td>{{ $comentario->comentariosInversion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
