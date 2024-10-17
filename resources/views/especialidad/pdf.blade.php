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

        .logo {
            display: flex;
            align-items: center;
        }
        .header img {
            width: 745px;
            height: 57px;
        }

        .logo img {
            margin-right: 5px; /* Espacio entre la imagen y el texto */
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .especialidad {
            margin-bottom: 10px;
            border: 3px solid #756d6d;
            padding: 10px;
            border-radius: 5px;
        }
        .especialidad p, ul, {
            margin-bottom: 6px;
            margin-top: 1px
           
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #a33030;
        }
        th {
            background-color: #b41919;
        }
        .table-container {
            margin-bottom: 20px;
        }
        .sub-table {
            margin-top: 10px;
            width: 100%;
        }
        h3 {
            text-align: center;
        }
        #table-container th {
            background-color: #991818;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
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
            <img src="images/footter.jpg" style="width: 730px; height: 80px" alt="Logo">
            <div class="date-time">
                <p>Fecha: {{ date('d/m/Y') }} <span class="time">Hora: {{ date('H:i:s') }}</span></p>
            </div>
        </div>
    </footer>
    
    <h3 style="text-align: center; margin: -5%">PROYECTO DE INVERSION</h3>
    @foreach ($inversiones as $inversion)
        <h3><strong>{{ $inversion->nombreInversion }}</strong></h3>
        <p class="text-nowrap"><span style="font-size: 20px;">Responsable:</span> <b>{{ strtoupper($inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario) }}</b></p>
    @endforeach
    
    <div class="container">
        @foreach ($especialidades as $especialidad)
            <div class="especialidad">
                <p style="font-size: 20px;">Especialidad:  <b>{{ $especialidad->nombreEspecialidad }}</b></p>
                <p><b>Avance Programado:</b> {{ $especialidad->porcentajeAvanceEspecialidad }}% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>Avance Total:</b> {{ $especialidad->avanceTotalEspecialidad }}%</span></p>
                <p>Proyectistas:</p>
                @foreach ($especialidad->usuarios as $usuario)
                <ul class="mb-0"><li>{{ $usuario->nombreUsuario . ' ' . $usuario->apellidoUsuario }} <span style="font-size: 11px"> (P: {{ $usuario->profesiones->pluck('nombreProfesion')->implode(', ') }}) |
                    (E: {{ $usuario->especialidades->pluck('nombreEspecialidad')->implode(', ') }})</span>  </li></ul>
                
                 @endforeach
                
                @if ($especialidad->fases && $especialidad->fases->count() > 0)
                    @foreach ($especialidad->fases as $fase)
                        <div class="table-container">
                            <table id="table-container">
                                <thead>
                                    <tr>
                                        <th>Actividad</th>
                                        <th>Avance Programado</th>
                                        <th>Avance (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $fase->nombreFase }}</td>
                                        <td>{{ $fase->porcentajeAvanceFase }}</td>
                                        <td>{{ $fase->avanceTotalFase }}</td>
                                    </tr>
                                    @if ($fase->subfases && $fase->subfases->count() > 0)
                                        <tr>
                                            <td colspan="3">
                                                <div class="table-container sub-table">
                                                    <table>
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
                                                                    <td>{{ $subfase->porcentajeAvanceProgramadoSubFase }}</td>
                                                                    <td>{{ $subfase->avanceRealTotalSubFase }}</td>
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
            </div>
        @endforeach
    </div>
</body>
</html>
