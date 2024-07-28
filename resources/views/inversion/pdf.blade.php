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
            width: 50px;
            height: 50px;
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
        <img src="images/gorec-logo2.png" alt="Logo">
        <h3>INVERSIÓN</h3>
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
            <th>Jefe</th>
            <td colspan="3">{{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}</td>
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
</body>
</html>





