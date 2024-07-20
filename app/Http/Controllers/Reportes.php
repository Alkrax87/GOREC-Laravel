<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subfase;
use App\Models\Especialidad;
use App\Models\Inversion;
use App\Models\Fase;
use Dompdf\Dompdf;
use Dompdf\Options;
class Reportes extends Controller
{
    //IMPRIMIR LOS CHARTS DE LAS INVERION Y SUBDASES Y ESPECIALIDADES
    public function index(){
        $especialidades = Especialidad::all();
        $fases = Fase::all();
        $subfases = Subfase::all();
        $inversiones = Inversion::all();
        //$subfases = Subfase::select('fechaInicioSubfase', 'avanceRealTotalSubFase')->get();
        // Pasar los datos a la vista
        return view('reportes.graficos', compact('subfases','especialidades','inversiones','fases'));
    }
    //GENERAR PDF PARA LOS CHARTJS
    public function generatePDF(Request $request)
    {
        $data = $request->all();

        $html = '
            <h1>Reportes</h1>
            <h2>Line Chart</h2>
            <img src="' . $data['lineChartImage'] . '" style="width: 100%; height: auto;">
            <h2>Donut Chart</h2>
            <img src="' . $data['donutChartImage'] . '" style="width: 100%; height: auto;">
        ';

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('reportes.graficos');
    }
    //LOS SELECT DE INVERSION Y ESPECIALIDADES
    public function getEspecialidades($idInversion)
    {
        
        $inversion = Inversion::with('especialidades')->where('idInversion', $idInversion)->first();

        if ($inversion) {
            return response()->json($inversion->especialidades);
        } else {
            return response()->json([], 404);
        }
    }
        // Método para obtener las fases de una especialidad
    public function getFases($idEspecialidad)
    {
        $especialidades = Especialidad::with('fases')->where('idEspecialidad', $idEspecialidad)->first();
        return response()->json($especialidades->fases);
    }
    // Método para obtener las subfases de una fase
    public function getSubFases($idFase)
    {
    $subfases = SubFase::where('idFase', $idFase)->get();
    return response()->json($subfases);
    }


}
