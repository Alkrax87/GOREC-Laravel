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
            margin: 0;
            padding: 0;
        }
        @page {
            margin: 140px 30px 100px 30px;
            size: A3 landscape;
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
        .date-time {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(15, 15, 15, 0.863);
            font-weight: bold;
            font-size: 12px;
            text-shadow: 1px 1px 2px #000;
        }
        .content {
            margin-top: -60px;
        }
        .header img {
            width: 1515px;
            height: 75px;
        }
        h1 {
            text-align: center;
            color: #991818;
            margin-bottom: 10px;
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
            padding: 5px;
            border: 1px solid #ddd;
            font-size: 12px;
            word-wrap: break-word;
        }
        .table th {
            background-color: #991818;
            color: #fff;
        }
        .bg-color {
            background-color: #991818;
            color: #fff;
        }
        .table .text-nowrap {
            white-space: nowrap;
        }
        .table .text-center {
            text-align: center;
        }
        .table .text-left {
            text-align: left;
        }
        hr.custom-hr {
            border: none;
            height: 2px;
            background: linear-gradient(to right, transparent, #991818, transparent);
            margin: 10px 0;
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
            bottom: -4px
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
                <p>Fecha: {{ date('d/m/Y') }} <span class="time"  style="margin-left: 70px">Hora: {{ date('H:i:s') }}</span></p>
            </div>
        </div>
    </footer>

    <div class="content">
        <h1>PROYECTOS DE INVERSIÓN</h1>
        <div class="table-responsive">
            <table id="segmentosTable" class="table">
                <tbody>
                    @foreach ($inversiones as $inversion)
                        <tr>
                            <th rowspan="6">{{ $loop->index + 1 }}</th>
                            <th style="min-width: 140px">CUI</th>
                            <th style="max-width: 50px; min-width: 50px;">Avance</th>
                            <th colspan="13">Nombre</th>
                        </tr>
                        <tr>
                            <td class="text-center">{{ $inversion->cuiInversion }}</td>
                            <td class="text-center"><b>{{ $inversion->avanceInversion }}%</b></td>
                            <td colspan="13">{{ $inversion->nombreInversion }}</td>
                        </tr>
                        <tr>
                            <th colspan="5">Nombre Corto</th>
                            <th>Usuario</th>
                            <th>Provincia</th>
                            <th>Distrito</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Modalidad</th>
                            <th colspan="4">Función</th>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">{{ $inversion->nombreCortoInversion }}</td>
                            <td class="text-center"><b>{{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}</b></td>
                            <td class="text-center">{{ $inversion->provinciaInversion }}</td>
                            <td class="text-center">{{ $inversion->distritoInversion }}</td>
                            <td class="text-center">{{ $inversion->fechaInicioInversion }}</td>
                            <td class="text-center">{{ $inversion->fechaFinalInversion }}</td>
                            <td class="text-center">{{ $inversion->modalidadInversion }}</td>
                            <td class="text-center" colspan="4">{{ $inversion->funcionInversion }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Nivel</th>
                            <th colspan="5">Estado</th>
                            <th colspan="3">Presupuesto Formulación</th>
                            <th colspan="3">Presupuesto Ejecución</th>
                            <th style="min-width: 120px; max-width: 120px;">Inicio Consistencia</th>
                            <th style="min-width: 120px; max-width: 120px;">Final Consistencia</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">{{ $inversion->nivelInversion }}</td>
                            <td colspan="5" class="text-center">{{ $inversion->estadoInversion }}</td>
                            <td colspan="3" class="text-center"><b>{{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}</b></td>
                            <td colspan="3" class="text-center"><b>{{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}</b></td>
                            <td class="text-center">{{ $inversion->fechaInicioConsistenciaInversion  }}</td>
                            <td class="text-center">{{ $inversion->fechaFinalConsistenciaInversion  }}</td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 0px" colspan="16"><hr class="custom-hr"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>