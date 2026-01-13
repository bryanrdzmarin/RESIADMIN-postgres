<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apto;
use App\Models\Becado;
use App\Models\BecadoExtranjero;
use App\Models\BecadoNacional;
use App\Models\Residencia;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function indexResidencias(){
        $residencias=null;
        return view('admin.busqueda.residencias.index', compact('residencias'));
    }

    public function indexResidenciasMostrar(Request $request)
    {
        $query = Residencia::query();

        $valores = [
            $request->input('busquedaNombre'),
            $request->input('busquedaCantidadAptos'),
            $request->input('busquedaJefeConsejo'),
            $request->input('busquedaProfesor'),
            $request->input('busquedaEvaluacion'),
        ];

        $hayAlMenosUnValor = collect($valores)->filter(function ($valor) {
            return !is_null($valor) && $valor !== '';
        })->isNotEmpty();

        if (!$hayAlMenosUnValor) 

        {
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => '¡Atención!',
                'text' => "Debes rellenar al menos un campo para buscar",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#F59E0B', 
                'iconColor' => '#F59E0B'
            ]);
            return redirect()->back();
        }

        // Filtros dinámicos
        if ($request->filled('busquedaNombre')) {
            $query->where('nombre', 'LIKE', '%' . $request->busquedaNombre . '%');
        }

        if ($request->filled('busquedaCantidadAptos')) {
            $query->where('cantidad_aptos', $request->busquedaCantidadAptos);
        }

        if ($request->filled('busquedaJefeConsejo')) {
            $query->where('jefe_consejo_residencia', 'LIKE', '%' . $request->busquedaJefeConsejo . '%');
        }

        if ($request->filled('busquedaProfesor')) {
            $query->where('profesor_asignado', 'LIKE', '%' . $request->busquedaProfesor . '%');
        }

        if ($request->filled('busquedaEvaluacion')) {
            $query->where('evaluacion', 'LIKE', '%' . $request->busquedaEvaluacion . '%');
        }

        $residencias = $query->paginate()->appends(request()->query());;

        return view('admin.busqueda.residencias.index', [
            'residencias' => $residencias,
            'busquedaNombre' => $request->busquedaNombre,
            'busquedaCantidadAptos' => $request->busquedaCantidadAptos,
            'busquedaJefeConsejo' => $request->busquedaJefeConsejo,
            'busquedaProfesor' => $request->busquedaProfesor,
            'busquedaEvaluacion' => $request->busquedaEvaluacion,
        ]);
    }

    public function indexAptos(){
        $aptos=null;
        return view('admin.busqueda.aptos.index',  compact('aptos'));
    }

    public function indexAptosMostrar(Request $request)
    {
        $busquedaNombre = $request->input('busquedaNombre');
        $busquedaNo = $request->input('busquedaNo');
        $busquedaCapacidad = $request->input('busquedaCapacidad');
        $busquedaJefeApartamento = $request->input('busquedaJefeApartamento');
        $busquedaProfesor = $request->input('busquedaProfesor');
        $busquedaEvaluacion = $request->input('busquedaEvaluacion');
        $busquedaEstado = $request->input('busquedaEstado');

        $valores = [
            $busquedaNombre, $busquedaNo, $busquedaCapacidad,
            $busquedaJefeApartamento, $busquedaProfesor,
            $busquedaEvaluacion, $busquedaEstado
        ];

        $hayFiltros = collect($valores)->filter(fn($valor) => !is_null($valor) && $valor !== '')->isNotEmpty();

        if (!$hayFiltros) {
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => '¡Atención!',
                'text' => "Debes rellenar al menos un campo para buscar",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#F59E0B',
                'iconColor' => '#F59E0B'
            ]);
            return redirect()->back();
        }

        $query = Apto::with('residencia')
            ->select('aptos.*')
            ->selectSub(function ($q) {
                $q->selectRaw('count(*)')
                ->from('becados')
                ->whereColumn('becados.aptos_id', 'aptos.id');
            }, 'becados_count');

        // Filtro por estado
        if ($busquedaEstado === 'disponible') {
            $query->whereRaw('(SELECT COUNT(*) FROM becados WHERE becados.aptos_id = aptos.id) < aptos.capacidad');
        } elseif ($busquedaEstado === 'ocupado') {
            $query->whereRaw('(SELECT COUNT(*) FROM becados WHERE becados.aptos_id = aptos.id) = aptos.capacidad');
        }

        // Filtros dinámicos
        if (!empty($busquedaNombre)) {
            $query->whereHas('residencia', function ($q) use ($busquedaNombre) {
                $q->where('nombre', 'LIKE', '%' . $busquedaNombre . '%');
            });
        }

        if (!empty($busquedaNo)) {
            $query->where('numero', $busquedaNo);
        }

        if (!empty($busquedaCapacidad)) {
            $query->where('capacidad', $busquedaCapacidad);
        }

        if (!empty($busquedaJefeApartamento)) {
            $query->where('jefe_apartamento', 'LIKE', '%' . $busquedaJefeApartamento . '%');
        }

        if (!empty($busquedaProfesor)) {
            $query->where('profesor_asignado', 'LIKE', '%' . $busquedaProfesor . '%');
        }

        if (!empty($busquedaEvaluacion)) {
            $query->where('evaluacion', 'LIKE', '%' . $busquedaEvaluacion . '%');
        }

        $aptos = $query->latest('id')->paginate()->appends(request()->query());

        return view('admin.busqueda.aptos.index', compact(
            'aptos',
            'busquedaNombre', 'busquedaNo', 'busquedaCapacidad',
            'busquedaJefeApartamento', 'busquedaProfesor',
            'busquedaEvaluacion', 'busquedaEstado'
        ));
    }

    public function indexBecados(){
        $becados=null;
        return view('admin.busqueda.becados.index',  compact('becados'));
    }

    public function indexBecadosMostrar(Request $request)
    {
        $busquedaCI = $request->input('ci');
        $busquedaNombre = $request->input('nombre');
        $busquedaFechaNacimiento = $request->input('fecha_nacimiento');
        $busquedaYearCarrera = $request->input('year_carrera');
        $busquedaCarrera = $request->input('carrera');
        $busquedaOrigen = $request->input('origen');
        $busquedaNombreResidencia = $request->input('nombreResidencia');
        $busquedaNoAptos = $request->input('NoAptos');


        $busquedaEvaluacionJefeResidencia = $request->input('evaluacion_jefe_residencia');
        $busquedaEvaluacionJefeApto = $request->input('evaluacion_jefe_apto');
        $busquedaEvaluacionProfesor = $request->input('evaluacion_profesor');
        $busquedaEvaluacionFinal = $request->input('evaluacion_final');

        // Nacionales
        $busquedaDireccion = $request->input('direccion');

        // Extranjeros
        $busquedaNumeroPasaporte = $request->input('numero_pasaporte');
        $busquedaPais = $request->input('pais');
        $busquedaDireccionEmbajada = $request->input('direccion_embajada');
        $busquedaYearEntrada = $request->input('year_entrada');
        $busquedaEvaluacionJefeRI = $request->input('evaluacion_jefe_relaciones_internacionales');

        $valores = [
            $busquedaCI, $busquedaNombre, $busquedaFechaNacimiento, $busquedaYearCarrera, $busquedaCarrera,
            $busquedaOrigen, $busquedaEvaluacionJefeResidencia, $busquedaEvaluacionJefeApto,
            $busquedaEvaluacionProfesor, $busquedaEvaluacionFinal,
            $busquedaDireccion, $busquedaNumeroPasaporte, $busquedaPais,
            $busquedaDireccionEmbajada, $busquedaYearEntrada, $busquedaEvaluacionJefeRI,$busquedaNoAptos,$busquedaNombreResidencia
        ];

        $hayFiltros = collect($valores)->filter(fn($valor) => !is_null($valor) && $valor !== '')->isNotEmpty();

        if (!$hayFiltros) {
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => '¡Atención!',
                'text' => "Debes rellenar al menos un campo para buscar",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#F59E0B',
                'iconColor' => '#F59E0B'
            ]);
            return redirect()->back();
        }

        if ($busquedaOrigen === 'todos') {
            $becados = Becado::with(['apto', 'residencia'])
                ->when($busquedaCI, fn($q) => $q->where('ci', $busquedaCI))
                ->when($busquedaNombre, fn($q) => $q->where('nombre', 'like', "%{$busquedaNombre}%"))
                ->when($busquedaFechaNacimiento, fn($q) => $q->whereDate('fecha_nacimiento', $busquedaFechaNacimiento))
                ->when($busquedaYearCarrera, fn($q) => $q->where('year_carrera','like', "%{$busquedaYearCarrera}%"))
                ->when($busquedaCarrera, fn($q) => $q->where('carrera', 'like', "%{$busquedaCarrera}%"))
                ->when($busquedaEvaluacionJefeResidencia, fn($q) => $q->where('evaluacion_jefe_residencia', $busquedaEvaluacionJefeResidencia))
                ->when($busquedaEvaluacionJefeApto, fn($q) => $q->where('evaluacion_jefe_apto', $busquedaEvaluacionJefeApto))
                ->when($busquedaEvaluacionProfesor, fn($q) => $q->where('evaluacion_profesor', $busquedaEvaluacionProfesor))
                ->when($busquedaEvaluacionFinal, fn($q) => $q->where('evaluacion_final', 'like', "%{$busquedaEvaluacionFinal}%"))
                ->when($busquedaNombreResidencia, function ($q) use ($busquedaNombreResidencia) {
                    $q->whereHas('residencia', fn($qr) =>
                        $qr->where('nombre', 'like', "%{$busquedaNombreResidencia}%")
                    );
                })
                ->when($busquedaNoAptos, function ($q) use ($busquedaNoAptos) {
                    $q->whereHas('apto', fn($qa) =>
                        $qa->where('numero', $busquedaNoAptos)
                    );
                })
                ->latest('ci')
                ->paginate()->appends(request()->query());
        }

        if ($busquedaOrigen === 'nacionales') {
           $becados = BecadoNacional::with(['becado.apto', 'becado.residencia'])
            ->when($busquedaCI, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('ci', $busquedaCI)
                )
            )
            ->when($busquedaNombre, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('nombre', 'like', "%{$busquedaNombre}%")
                )
            )
            ->when($busquedaFechaNacimiento, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->whereDate('fecha_nacimiento', $busquedaFechaNacimiento)
                )
            )
            ->when($busquedaYearCarrera, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('year_carrera', $busquedaYearCarrera)
                )
            )
            ->when($busquedaCarrera, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('carrera', 'like', "%{$busquedaCarrera}%")
                )
            )
            ->when($busquedaEvaluacionJefeResidencia, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('evaluacion_jefe_residencia', $busquedaEvaluacionJefeResidencia)
                )
            )
            ->when($busquedaEvaluacionJefeApto, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('evaluacion_jefe_apto', $busquedaEvaluacionJefeApto)
                )
            )
            ->when($busquedaEvaluacionProfesor, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('evaluacion_profesor', $busquedaEvaluacionProfesor)
                )
            )
            ->when($busquedaEvaluacionFinal, fn($q) =>
                $q->whereHas('becado', fn($b) =>
                    $b->where('evaluacion_final', 'like', "%{$busquedaEvaluacionFinal}%")
                )
            )
            ->when($busquedaNombreResidencia, fn($q) =>
                $q->whereHas('becado.residencia', fn($r) =>
                    $r->where('nombre', 'like', "%{$busquedaNombreResidencia}%")
                )
            )
            ->when($busquedaNoAptos, fn($q) =>
                $q->whereHas('becado.apto', fn($a) =>
                    $a->where('numero', $busquedaNoAptos)
                )
            )
            ->when($busquedaDireccion, fn($q) =>
                $q->where('direccion', 'like', "%{$busquedaDireccion}%")
            )
            ->latest('becados_ci')
            ->paginate()
            ->appends(request()->query());
        }

        if ($busquedaOrigen === 'extranjeros') {
            $becados = BecadoExtranjero::with(['becado.apto', 'becado.residencia'])
                ->when($busquedaCI, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('ci', 'like', "%{$busquedaCI}%")
                    )
                )
                ->when($busquedaNombre, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('nombre', 'like', "%{$busquedaNombre}%")
                    )
                )
                ->when($busquedaFechaNacimiento, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->whereDate('fecha_nacimiento', $busquedaFechaNacimiento)
                    )
                )
                ->when($busquedaYearCarrera, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('year_carrera', 'like', "%{$busquedaYearCarrera}%")
                    )
                )
                ->when($busquedaCarrera, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('carrera', 'like', "%{$busquedaCarrera}%")
                    )
                )
                ->when($busquedaEvaluacionJefeResidencia, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('evaluacion_jefe_residencia', $busquedaEvaluacionJefeResidencia)
                    )
                )
                ->when($busquedaEvaluacionJefeApto, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('evaluacion_jefe_apto', $busquedaEvaluacionJefeApto)
                    )
                )
                ->when($busquedaEvaluacionProfesor, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('evaluacion_profesor', $busquedaEvaluacionProfesor)
                    )
                )
                ->when($busquedaEvaluacionFinal, fn($q) =>
                    $q->whereHas('becado', fn($b) =>
                        $b->where('evaluacion_final', 'like', "%{$busquedaEvaluacionFinal}%")
                    )
                )
                ->when($busquedaNombreResidencia, fn($q) =>
                    $q->whereHas('becado.residencia', fn($r) =>
                        $r->where('nombre', 'like', "%{$busquedaNombreResidencia}%")
                    )
                )
                ->when($busquedaNoAptos, fn($q) =>
                    $q->whereHas('becado.apto', fn($a) =>
                        $a->where('numero', $busquedaNoAptos)
                    )
                )
                // Campos propios de BecadoExtranjero
                ->when($busquedaNumeroPasaporte, fn($q) =>
                    $q->where('numero_pasaporte', 'like', "%{$busquedaNumeroPasaporte}%")
                )
                ->when($busquedaPais, fn($q) =>
                    $q->where('pais', 'like', "%{$busquedaPais}%")
                )
                ->when($busquedaDireccionEmbajada, fn($q) =>
                    $q->where('direccion_embajada', 'like', "%{$busquedaDireccionEmbajada}%")
                )
                ->when($busquedaYearEntrada, fn($q) =>
                    $q->where('year_entrada', $busquedaYearEntrada)
                )
                ->when($busquedaEvaluacionJefeRI, fn($q) =>
                    $q->where('evaluacion_jefe_relaciones_internacionales', $busquedaEvaluacionJefeRI)
                )
                ->latest('becados_ci')
                ->paginate()
                ->appends(request()->query());
        }

        return view('admin.busqueda.becados.index', compact(
            'becados',
            'busquedaCI', 'busquedaNombre', 'busquedaFechaNacimiento', 'busquedaYearCarrera', 'busquedaCarrera',
            'busquedaOrigen', 'busquedaNombreResidencia', 'busquedaNoAptos',
            'busquedaEvaluacionJefeResidencia', 'busquedaEvaluacionJefeApto', 'busquedaEvaluacionProfesor', 'busquedaEvaluacionFinal',
            'busquedaDireccion', 'busquedaNumeroPasaporte', 'busquedaPais',
            'busquedaDireccionEmbajada', 'busquedaYearEntrada', 'busquedaEvaluacionJefeRI'
        ));
    }
}
