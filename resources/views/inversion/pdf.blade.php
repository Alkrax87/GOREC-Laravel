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
            border: 1px solid #ddd;
            text-align: left;
        }
        .table-container th {
            background-color: #991818;
            font-weight: bold;
        }
        .table-container tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table-container tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/gorec-logo2.png" alt="Logo">
        <h3>INVERSION</h3>
    </div>
    <table class="table-container">
        <tr>
            <th>CUI</th>
            <td>{{ $inversion->cuiInversion }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $inversion->nombreInversion }}</td>
        </tr>
        <tr>
            <th>Nombre Corto</th>
            <td>{{ $inversion->nombreCortoInversion }}</td>
        </tr>
        <tr>
            <th>Jefe</th>
            <td>{{ $inversion->usuario->nombreUsuario . ' ' . $inversion->usuario->apellidoUsuario }}</td>
        </tr>
        <tr>
            <th>Provincia</th>
            <td>{{ $inversion->provinciaInversion }}</td>
        </tr>
        <tr>
            <th>Distrito</th>
            <td>{{ $inversion->distritoInversion }}</td>
        </tr>
        <tr>
            <th>Nivel</th>
            <td>{{ $inversion->nivelInversion }}</td>
        </tr>
        <tr>
            <th>Función</th>
            <td>{{ $inversion->funcionInversion }}</td>
        </tr>
        <tr>
            <th>Modalidad</th>
            <td>{{ $inversion->modalidadInversion }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>{{ $inversion->estadoInversion }}</td>
        </tr>
        <tr>
            <th>Avance</th>
            <td>{{ $inversion->avanceInversion }}%</td>
        </tr>
        <tr>
            <th>Fecha Inicio</th>
            <td>{{ $inversion->fechaInicioInversion }}</td>
        </tr>
        <tr>
            <th>Fecha Final</th>
            <td>{{ $inversion->fechaFinalInversion }}</td>
        </tr>
        <tr>
            <th>Formulación</th>
            <td>{{ 's/ ' . number_format($inversion->presupuestoFormulacionInversion, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <th>Ejecución</th>
            <td>{{ 's/ ' . number_format($inversion->presupuestoEjecucionInversion, 2, '.', ',') }}</td>
        </tr>
    </table>
</body>
</html>





