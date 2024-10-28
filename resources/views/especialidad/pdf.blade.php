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
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        @page {
            margin: 140px 30px 100px 30px;
            size: A4;
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
            bottom: -90px;
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
            color: rgba(15, 15, 15, 0.863);
            font-weight: bold;
            font-size: 10px;
            text-shadow: 1px 1px 2px #000;
        }
        .date-time .time {
            margin-left: 50px;
        }
        .header img {
            width: 745px;
            height: 57px;
        }
        h1 {
            text-align: center;
            color: #991818;
            font-size: 20px;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            color: #991818;
            font-size: 16px;
            margin-top: 10px;
        }
        .h3s {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }
        .content {
            margin-top: -70px;
            padding: 0 20px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .especialidad {
            margin-bottom: 20px;
            border: 2px solid #756d6d;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .especialidad p, ul {
            margin-bottom: 6px;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #a33030;
            font-size: 11px;
        }
        th {
            background-color: #991818;
            color: #fff;
            font-weight: bold;
        }
        .sub-table {
            margin-top: 10px;
            width: 100%;
        }
        .text-bold {
            font-weight: bold;
        }
        hr.custom-hr {
            border: none;
            height: 2px;
            background: linear-gradient(to right, transparent, #991818, transparent);
            margin: 20px 0;
            position: relative;
        }
        hr.custom-hr::before,
        hr.custom-hr::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            height: 4px;
            background: #991818;
            opacity: 0.3;
        }
        hr.custom-hr::before {
            top: -4px;
        }
        hr.custom-hr::after {
            bottom: -4px;
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
            <img src="images/footter.jpg" class="footer-image" alt="Footer Logo">
            <div class="date-time">
                <p>Fecha: {{ date('d/m/Y') }} <span class="time" style="margin-left: 50px">Hora: {{ date('H:i:s') }}</span></p>
            </div>
        </div>
    </footer>

    <div class="content">
        <h1>PROYECTO DE INVERSIÓN</h1>
        @foreach ($inversiones as $inversion)
            <hr class="custom-hr">
            <h3 class="h3s">{{ $inversion->nombreInversion }}</h3>
            <div style="text-align: right">
                <p style="margin: 0px; padding: 0px"><span class="text-bold">Responsable:</span> {{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}</p>
            </div>
            <hr class="custom-hr">
        @endforeach

            <h3>Lista de Especialidades</h3>

            @foreach ($especialidades as $especialidad)
                <p class="text-bold" style="margin: 0px; padding: 0px; font-size: 14px">Especialidad: {{ $especialidad->nombreEspecialidad }}</p>
                <p style="margin: 0px; padding: 0px"><span class="text-bold">Avance Programado:</span> {{ $especialidad->porcentajeAvanceEspecialidad }}% &nbsp;&nbsp; <span class="text-bold">Avance Total:</span> {{ $especialidad->avanceTotalEspecialidad }}%</p>
                <p style="margin: 0px; padding: 0px"><span class="text-bold">Proyectistas:</span></p>
                <ul style="margin: 0px; padding: 5px 20px">
                    @foreach ($especialidad->usuarios as $usuario)
                        <li>{{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }} <span style="font-size: 11px"> (P: {{ $usuario->profesiones->pluck('nombreProfesion')->implode(', ') }}) | (E: {{ $usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }})</span></li>
                    @endforeach
                </ul>
                @if ($especialidad->fases && $especialidad->fases->count() > 0)
                    @foreach ($especialidad->fases as $fase)
                        <div class="table-container" style="margin: 0px; padding: 0px">
                            <table style="margin: 0px; padding: 0px">
                                <thead style="margin: 0px; padding: 0px">
                                    <tr>
                                        <th>Actividad</th>
                                        <th>Avance Programado</th>
                                        <th>Avance (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $fase->nombreFase }}</td>
                                        <td>{{ $fase->porcentajeAvanceFase }}%</td>
                                        <td>{{ $fase->avanceTotalFase }}%</td>
                                    </tr>
                                    @if ($fase->subfases && $fase->subfases->count() > 0)
                                        <tr>
                                            <td colspan="3">
                                                <div class="table-container sub-table">
                                                    <table style="margin: 0px; padding: 0px">
                                                        <thead>
                                                            <tr>
                                                                <th>Sub Actividad</th>
                                                                <th>Fecha Inicio</th>
                                                                <th>Fecha Final</th>
                                                                <th>Avance Programado</th>
                                                                <th>Avance (%)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($fase->subfases->reverse() as $subfase)
                                                                <tr>
                                                                    <td>{{ $subfase->nombreSubfase }}</td>
                                                                    <td>{{ $subfase->fechaInicioSubfase }}</td>
                                                                    <td>{{ $subfase->fechaFinalSubfase }}</td>
                                                                    <td>{{ $subfase->porcentajeAvanceProgramadoSubFase }}%</td>
                                                                    <td>{{ $subfase->avanceRealTotalSubFase }}%</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3">No hay subfases disponibles.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @else
                    <p>No hay fases disponibles.</p>
                @endif

            @endforeach

    </div>
</body>
</html>
