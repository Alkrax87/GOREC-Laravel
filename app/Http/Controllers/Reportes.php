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
        $especialidades = Especialidad::all();
        $fases = Fase::all();
        $subfases = Subfase::all();

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Cargar todas las inversiones si el usuario es administrador, de lo contrario, cargar solo las inversiones del usuario
        if ($user->isAdmin) {
            $inversiones = Inversion::all();
        } else {
            $inversiones = Inversion::where('idUsuario', $user->idUsuario)->get();
        }

        foreach ($inversiones as $inversion) {
            $diferenciaHoras = Carbon::now()->subHours(5)->diffInHours($inversion->fechaFinalInversion, false);
            if ($diferenciaHoras > 0 && $diferenciaHoras <= 48) {
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

        // Crear el contenido HTML del PDF
        $html = '
            <h1>Reportes</h1>
            <h2>Line Chart</h2>
            <img src="' . $data['lineChartImage'] . '" style="width: 100%; height: auto;">
            <h2>Donut Chart</h2>
            <img src="' . $data['donutChartImage'] . '" style="width: 100%; height: auto;">
        ';

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
        return $dompdf->stream('reportes.graficos');
    }

}