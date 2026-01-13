<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apto;
use App\Models\Becado;
use App\Models\BecadoExtranjero;
use App\Models\BecadoNacional;
use App\Models\Residencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    public function index()
    {
        $totalResidencias = Residencia::count();
        $totalAptos = Apto::count();
        $totalBecados = Becado::count();
        $totalExtranjeros = BecadoExtranjero::count();
        $totalNacionales = BecadoNacional::count();

        // Cargamos las residencias junto con el conteo de aptos existentes
        $residencias = Residencia::withCount('aptos')->get();

        // Residencias que no tienen ningún apto agregado
        $residenciasVacias = $residencias->where('aptos_count', 0)->count();

        // Residencias que tienen todos los aptos según su capacidad
        $residenciasOcupadas = $residencias->filter(function ($res) {
            return $res->aptos_count == $res->cantidad_aptos;
        })->count();

        // Residencias que tienen aptos pero aún pueden agregar más
        $residenciasDisponibles = $residencias->filter(function ($res) {
            return $res->aptos_count > 0 && $res->aptos_count < $res->cantidad_aptos;
        })->count();

        $aptos = Apto::all();

        $aptosVacios = $aptos->filter(function ($apto) {
            return $apto->CantidadBecados() === 0;
        })->count();

        $aptosOcupados = $aptos->filter(function ($apto) {
            return $apto->CantidadBecados() === $apto->capacidad;
        })->count();

        $aptosDisponibles = $aptos->filter(function ($apto) {
            return $apto->CantidadBecados() > 0 && $apto->CantidadBecados() < $apto->capacidad;
        })->count();

        // Becados por Año Académico
        $becadosPorAnio = Becado::selectRaw("
            SUM(case when year_carrera = 'Primero' then 1 else 0 end) as primero,
            SUM(case when year_carrera = 'Segundo' then 1 else 0 end) as segundo,
            SUM(case when year_carrera = 'Tercero' then 1 else 0 end) as tercero,
            SUM(case when year_carrera = 'Cuarto' then 1 else 0 end) as cuarto
        ")->first();

        $becadosPorCarrera = Becado::select('carrera', DB::raw('COUNT(*) as total'))
            ->groupBy('carrera')
            ->orderByDesc('total')
            ->get();

        $becadosNacionalesPorCarrera = Becado::select('carrera', DB::raw('COUNT(*) as total'))
            ->where('origen', 'LIKE', '%nacional%') // Filtra nacionales correctamente
            ->groupBy('carrera')
            ->orderByDesc('total')
            ->get();

        $becadosExtranjerosPorCarrera = Becado::select('carrera', DB::raw('COUNT(*) as total'))
            ->where('origen', 'LIKE', '%extranjero%') // Filtra extranjeros correctamente
            ->groupBy('carrera')
            ->orderByDesc('total')
            ->get();

        $evaluacionesResidencias = Residencia::select('evaluacion', DB::raw('COUNT(*) as total'))
        ->groupBy('evaluacion')
        ->get()
        ->map(function ($eval) use ($totalResidencias) {
            $eval->porcentaje = round(($eval->total / $totalResidencias) * 100, 2);
            return $eval;
        });

    $residenciasTotal = Residencia::count();
    $residenciasEvaluadas = Residencia::whereNotNull('evaluacion')->count();
    $residenciasNoEvaluadas = $residenciasTotal - $residenciasEvaluadas;

    $residenciasPorcentajeEvaluadas = round(($residenciasEvaluadas / $residenciasTotal) * 100, 2);
    $residenciasPorcentajeNoEvaluadas = round(($residenciasNoEvaluadas / $residenciasTotal) * 100, 2);

    $residenciasEvaluacionDetalle = Residencia::select('evaluacion', DB::raw('COUNT(*) as total'))
        ->whereNotNull('evaluacion')
        ->groupBy('evaluacion')
        ->get()
        ->map(function ($eval) use ($residenciasEvaluadas) {
            $eval->porcentaje = round(($eval->total / $residenciasEvaluadas) * 100, 2);
            return $eval;
        });

    $aptosEvaluados = Apto::whereNotNull('evaluacion')->count();
    $aptosNoEvaluados = Apto::whereNull('evaluacion')->count();

    // Agrupar por tipo de evaluación
    $aptosEvaluacionDetalle = Apto::select('evaluacion', DB::raw('COUNT(*) as total'))
        ->whereNotNull('evaluacion')
        ->groupBy('evaluacion')
        ->get()
        ->map(function ($eval) use ($aptosEvaluados) {
            $eval->porcentaje = round(($eval->total / $aptosEvaluados) * 100, 2);
            return $eval;
        });

    $becadosEvaluados = Becado::whereNotNull('evaluacion_final')->count();
    $becadosNoEvaluados = Becado::whereNull('evaluacion_final')->count();
    $becadosEvaluacionDetalle = Becado::select('evaluacion_final', DB::raw('COUNT(*) as total'))
        ->whereNotNull('evaluacion_final')
        ->groupBy('evaluacion_final')
        ->get()
        ->map(function ($eval) use ($becadosEvaluados) {
            $eval->porcentaje = round(($eval->total / $becadosEvaluados) * 100, 2);
            return $eval;
        });


     $becadoNacionalEvaluados = Becado::where('origen', 'like', '%nacional%')
        ->whereNotNull('evaluacion_final')
        ->count();

    $becadoNacionalNoEvaluados = Becado::where('origen', 'like', '%nacional%')
        ->whereNull('evaluacion_final')
        ->count();

    $becadosNacionalesEvaluacionDetalle = Becado::select('evaluacion_final', DB::raw('COUNT(*) as total'))
        ->where('origen', 'like', '%nacional%')
        ->whereNotNull('evaluacion_final')
        ->groupBy('evaluacion_final')
        ->get()
        ->map(function ($eval) use ($becadoNacionalEvaluados) {
            $eval->porcentaje = round(($eval->total / $becadoNacionalEvaluados) * 100, 2);
            return $eval;
        });
    
     $becadoExtranjeroEvaluados = Becado::where('origen', 'like', '%extranjero%')
        ->whereNotNull('evaluacion_final')
        ->count();

    $becadoExtranjeroNoEvaluados = Becado::where('origen', 'like', '%extranjero%')
        ->whereNull('evaluacion_final')
        ->count();

    $becadosExtranjerosEvaluacionDetalle = Becado::select('evaluacion_final', DB::raw('COUNT(*) as total'))
        ->where('origen', 'like', '%extranjero%')
        ->whereNotNull('evaluacion_final')
        ->groupBy('evaluacion_final')
        ->get()
        ->map(function ($eval) use ($becadoExtranjeroEvaluados) {
            $eval->porcentaje = round(($eval->total / $becadoExtranjeroEvaluados) * 100, 2);
            return $eval;
        });







        return view('dashboard', compact(
            'totalResidencias',
            'totalAptos',
            'totalBecados',
            'totalExtranjeros',
            'totalNacionales','residenciasVacias',
            'residenciasOcupadas',
            'residenciasDisponibles',
            'aptosVacios',
            'aptosOcupados',
            'aptosDisponibles',
            'becadosPorAnio',
            'becadosPorCarrera', 
            'becadosNacionalesPorCarrera', 
            'becadosExtranjerosPorCarrera',
            'residenciasTotal',
            'residenciasEvaluadas',
            'residenciasNoEvaluadas',
            'residenciasPorcentajeEvaluadas',
            'residenciasPorcentajeNoEvaluadas',
            'residenciasEvaluacionDetalle',
            'aptosEvaluados', 
            'aptosNoEvaluados',
            'aptosEvaluacionDetalle',
            'becadosEvaluados', 
            'becadosNoEvaluados',
            'becadosEvaluacionDetalle',
            'becadoNacionalEvaluados', 
            'becadoNacionalNoEvaluados',
            'becadosNacionalesEvaluacionDetalle',
            'becadoExtranjeroEvaluados',
        'becadoExtranjeroNoEvaluados',
        'becadosExtranjerosEvaluacionDetalle'









        ));
    }


}
