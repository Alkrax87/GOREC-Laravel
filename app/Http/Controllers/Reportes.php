<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subfase;
use App\Models\Especialidad;
use App\Models\Inversion;
use App\Models\Fase;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Dompdf\Options;
use Auth;

class Reportes extends Controller
{
    // Método para mostrar los gráficos de inversiones, subfases y especialidades
    public function index(){
        // Obtener todas las especialidades, fases y subfases
        $this->sumaTotalAvance();
        $especialidades = Especialidad::all();
        $fases = Fase::all();
        $subfases = Subfase::all();

        // Cargamos los datos de inversion filtrador en base al usuario logeado
        $user = Auth::user();
        if ($user->isAdmin) {
            // Si el usuario es administrador, carga todas las inversiones
            $inversiones = Inversion::all();
        } else {
            // Si no es administrador, carga las inversiones propias y aquellas en las que ha sido asignado como profesional
            $inversionesPropias = Inversion::where('idUsuario', $user->idUsuario)->get();

            // Obtén las inversiones donde el usuario ha sido asignado como profesional
            $inversionesAsignadas = Inversion::whereHas('profesional', function ($query) use ($user) {
                $query->where('idUsuario', $user->idUsuario);
            })->get();

            // Combina las inversiones propias y las asignadas
            $inversiones = $inversionesPropias->merge($inversionesAsignadas)->unique('idInversion');
        }

        $notificaciones = [];
        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 168) {
                $notificaciones[] = $inversion;
            }
        }

        // Retornar la vista con los datos obtenidos
        return view('reportes.graficos', compact('subfases', 'especialidades', 'inversiones', 'fases','notificaciones'));
    }

    // Funcion para obtener avance y nombre de una inversión
    public function obtenerAvanceInversion($idInversion){
        // Obtener una inversion
        $inversion = Inversion::findOrFail($idInversion);

        if ($inversion) {
            return response()->json([
                'avanceInversion' => $inversion->avanceInversion,
                'nombreCortoInversion' => $inversion->nombreCortoInversion,
            ]);
        } else {
            return response()->json(['error' => 'Inversión no encontrada'], 404);
        }
    }

    // Funcion para obtener las especialidades de una inversión
    public function getEspecialidades($idInversion){
        // Obtener las especialidades de una inversion
        $especialidad = Especialidad::where('idInversion', $idInversion)->get();

        if ($especialidad) {
            return response()->json($especialidad);
        } else {
            return response()->json([], 404);
        }
    }

    // Método para obtener las fases de una especialidad
    public function getFases($idEspecialidad){
        // Obtener las fases de una inversion
        $fase = Fase::where('idEspecialidad', $idEspecialidad)->get();

        if ($fase) {
            return response()->json($fase);
        } else {
            return response()->json([], 404);
        }
    }

    // Método para obtener las subfases de una fase
    public function getSubFases($idFase){
        // Obtener las subfases de una fase específica
        $subfases = Subfase::where('idFase', $idFase)->get();

        // Retornar las subfases en formato JSON
        if ($subfases) {
            return response()->json($subfases);
        } else {
            return response()->json([], 404);
        }
    }


    // Método para generar un PDF con los gráficos
    public function generatePDF(Request $request)
    {
    // Obtener los datos de la solicitud
    $data = $request->all();

    // Verificar y asegurar que las imágenes están en formato base64
    $lineChartImage = isset($data['lineChartImage']) ? $data['lineChartImage'] : '';
    $donutChartImage = isset($data['donutChartImage']) ? $data['donutChartImage'] : '';
    $avanceChartImage = isset($data['avanceChartImage']) ? $data['avanceChartImage'] : '';
    
    // Asegurarse de que especialidadesImages sea un array
    $especialidadesImages = isset($data['especialidadesImages']) ? $data['especialidadesImages'] : [];

    // Crear el contenido HTML del PDF
    $html = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            h2 {
                color: #555;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
                margin-bottom: 20px;
            }
            .chart-container {
                margin-bottom: 40px;
                page-break-inside: avoid;
            }
            .chart-container img {
                display: block;
                margin: 0 auto;
                width: 80%;
                height: auto;
            }
             }
            #chart-containers img {
                display: block;
                margin: 0 auto;
                width: 40%;
                height: auto;
            }
            .especialidades-container {
                text-align: center;
                page-break-inside: avoid;
            }
            .especialidades-title {
                text-align: center;
                color: #555;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
                margin-bottom: 20px;
            }
            .especialidades-images {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }
            .especialidades-images img {
                width: 25%;
                height: auto;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Reportes</h1>
        <div id="chart-containers">
            <h2>Inversion Avance</h2>
            <img src="' . $data['avanceChartImage'] . '">
        </div>
               
        <div class="especialidades-container">
            <h2 class="especialidades-title">Especialidades</h2>
            <div class="especialidades-images">;';
        // Agregar gráficos de especialidades
    foreach ($data['especialidadesImages'] as $image) {
    $html .= '<img src="' . $image . '">';
    }

    $html .= '
            </div>
        </div>
         <div class="chart-container">
            <h2>Actividades</h2>
            <img src="' . $data['lineChartImage'] . '">
        </div>
        <div class="chart-container">
            <h2>Sub Actividades</h2>
            <img src="' . $data['donutChartImage'] . '">
        </div>

    </body>
    </html>';
    // Configurar las opciones de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    // Crear una instancia de Dompdf y cargar el contenido HTML
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);

    // Configurar el tamaño y la orientación del papel
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar el PDF
    $dompdf->render();

    // Retornar el PDF generado para su descarga
    return $dompdf->stream('reportes.pdf');
    }
    private function sumaTotalAvance() {
        // Carga de datos de inversiones
        $inversiones = Inversion::all();

        // Sumamos los avances en base a sus especialidades de cada inversión
        foreach ($inversiones as $inversion) {
            $especialidades = Especialidad::where('idInversion', $inversion->idInversion)->get();
            $sumAvanceTotalEspecialidad = $especialidades->sum('avanceTotalEspecialidad');
            $inversion->avanceInversion = $sumAvanceTotalEspecialidad;
            $inversion->save();
        }
    }
}