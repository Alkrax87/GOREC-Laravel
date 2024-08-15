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
        date_default_timezone_set('America/Lima');
        // Obtener los datos de la solicitud
        $data = $request->all();

        // Verificar y asegurar que las imágenes están en formato base64
        $lineChartImage = isset($data['lineChartImage']) ? $data['lineChartImage'] : '';
        $donutChartImage = isset($data['donutChartImage']) ? $data['donutChartImage'] : '';
        $avanceChartImage = isset($data['avanceChartImage']) ? $data['avanceChartImage'] : '';
        $especialidadesImages = isset($data['especialidadesImages']) ? $data['especialidadesImages'] : [];

        // Rutas absolutas de las imágenes del header y footer
        $headerImage = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('images/banner-cuscofin.jpg')));
        $footerImage = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('images/footter.jpg')));

        // Fecha y hora actuales
        $fecha = date('d/m/Y');
        $hora = date('H:i:s');

        // Crear el contenido HTML del PDF
        $html = '
        <html>
        <head>
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

                .logo img {
                    margin-right: 5px; /* Espacio entre la imagen y el texto */
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
                #chart-containers {
                    text-align: center;
                 }
                 #chart-containers img {
                    display: inline-block;
                    margin: 0 auto;
                    width: 380px;
                    height: auto;
                }
                .especialidades-container {
                    display: flex;
                    flex-direction: column;
                    justify-content: center; /* Centrar verticalmente */
                    align-items: center; /* Centrar horizontalmente */
                    min-height: 100vh; /* Asegura que ocupe al menos la altura completa de la página */
                    page-break-inside: avoid;
                    text-align: center;
                }
                .especialidades-title {
                    text-align: left;
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
    margin-top: 50px; /* Ajusta este valor según sea necesario */
}
                .especialidades-images img {
                    width: 25%;
                    height: auto;
                    margin: 20px;
                }
            </style>
        </head>
        <body>

            <header>
                <img src="' . $headerImage . '" style="width: 980px; height: 90px" alt="Logo">
            </header>
            <footer>
                <img src="' . $footerImage . '" style="width: 980px; height: 90px" alt="Logo">
                <div class="date-time">
                    <p>Fecha: ' . $fecha . ' <span class="time">Hora: ' . $hora . '</span></p>
                </div>
            </footer>
            
            <h1>Reportes Inversion</h1>
            <div id="chart-containers">
                <h2>Inversión Avance</h2>
                <img src="' . $avanceChartImage . '">
            </div>
                   
            <div class="especialidades-container">
                <h2 class="especialidades-title">Especialidades</h2>
                <div class="especialidades-images">';
    
        foreach ($especialidadesImages as $image) {
            $html .= '<img src="' . $image . '">';
        }
    
        $html .= '
                </div>
            </div>
            <div class="chart-container">
                <h2>Actividades</h2>
                <img src="' . $lineChartImage . '">
            </div>
            <div class="chart-container">
                <h2>Sub Actividades</h2>
                <img src="' . $donutChartImage . '">
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
    

    // Retornar el PDF generado para su descarga
   
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