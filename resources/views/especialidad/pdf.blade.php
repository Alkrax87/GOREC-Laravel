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
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            margin-right: 5px; /* Espacio entre la imagen y el texto */
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .especialidad {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .especialidad h2 {
            margin-bottom: 10px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-container {
            margin-bottom: 20px;
        }
        .sub-table {
            margin-top: 10px;
        }
        h3{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="images/gorec-logo2.png" alt="Logo" width="50px" height="50px">
        </div>
        <h3>INVERSION</h3>
    </div>
  
    @foreach ($inversiones as $inversion)
        <h1><strong>{{ $inversion->nombreInversion }}</strong></h1>
    @endforeach
    <div class="container">
        @foreach ($especialidades as $especialidad)
            <div class="especialidad">
                <h2>{{ $especialidad->nombreEspecialidad }}</h2>
                <p><strong>Porcentaje Avance:</strong> {{ $especialidad->porcentajeAvanceEspecialidad }}</p>
                <p><strong>Avance Total:</strong> {{ $especialidad->avanceTotalEspecialidad }}</p>

                @if ($especialidad->fases && $especialidad->fases->count() > 0)
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Porcentaje Programado</th>
                                    <th>Avance (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidad->fases as $fase)
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
                                                            @foreach ($fase->subfases as $subfase)
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No hay fases disponibles.</p>
                @endif
            </div>
        @endforeach
    </div>

</body>
</html>
