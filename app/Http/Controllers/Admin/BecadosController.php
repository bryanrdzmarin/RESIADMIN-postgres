<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBecadoRequest;
use App\Http\Requests\UpdateBecadoRequest;
use App\Models\Apto;
use App\Models\Becado;
use App\Models\BecadoExtranjero;
use App\Models\BecadoNacional;
use App\Models\Residencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class BecadosController extends Controller
{
   //Mostrar todas los becados 
    public function index (){
       $becados = Becado::orderBy('created_at', 'desc')->paginate();
        return view('admin.becados.index',compact('becados'));
    }


    //Mostrar todas los becados nacionales
    public function indexNacionales ()
    {
        $becadosNacionales = BecadoNacional::with('becado')->latest()->paginate();
        return view('admin.becados.indexNacionales', compact('becadosNacionales'));  
    }


    //Mostrar todas los becados nacionales
    public function indexExtranjeros()
    {
        $becadosExtranjeros = BecadoExtranjero::with('becado')->latest()->paginate();
        return view('admin.becados.indexExtranjeros', compact('becadosExtranjeros'));
    }


    //Mostrar formulario para agregar nuevos becados
    public function create (){
       
        $programasAcademicos = [
            'Ingeniería Civil',
            'Ingeniería Mecánica',
            'Ingeniería Agrícola',
            'Ingeniería Hidráulica',
            'Licenciatura en Educación Mecánica',
            'Licenciatura en Educación Construcción',
            'Licenciatura en Educación Eléctrica',
            'Licenciatura en Educación Agropecuaria',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Licenciatura en Educación Español-Literatura',
            'Licenciatura en Educación Artística',
            'Licenciatura en Educación: Marxismo Leninismo e Historia',
            'Lic. en Educación Logopedia',
            'Lic. en Educación Especial',
            'Lic. en Educación Preescolar',
            'Lic. en Educación Primaria',
            'Lic. en Educación Biología',
            'Lic. en Educación Geografía',
            'Lic. en Educación Química',
            'Agronomía',
            'Ingeniería en Procesos Agroindustriales',
            'Medicina Veterinaria',
            'Licenciatura en Cultura Física',
            'Técnico Superior en Entrenamiento Deportivo',
            'Ingeniería Informática',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Contabilidad y Finanzas',
            'Turismo',
            'Economía',
            'Técnico Superior en Asistencia Turística',
        ];

        $residenciasDisponibles = Residencia::whereHas('aptos', function ($query) {
            $query->whereExists(function ($subquery) {
                $subquery->selectRaw('COUNT(*)')
                    ->from('becados')
                    ->whereColumn('becados.aptos_id', 'aptos.id')
                    ->havingRaw('COUNT(*) < aptos.capacidad');
            });
        })->get();
     
        return view('admin.becados.create', [
        'programasAcademicos' => $programasAcademicos,
        'residenciasDisponibles' => $residenciasDisponibles,
        ]);
    } 

    public function createApto (Apto $apto)
    {
        $programasAcademicos = [
            'Ingeniería Civil',
            'Ingeniería Mecánica',
            'Ingeniería Agrícola',
            'Ingeniería Hidráulica',
            'Licenciatura en Educación Mecánica',
            'Licenciatura en Educación Construcción',
            'Licenciatura en Educación Eléctrica',
            'Licenciatura en Educación Agropecuaria',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Licenciatura en Educación Español-Literatura',
            'Licenciatura en Educación Artística',
            'Licenciatura en Educación: Marxismo Leninismo e Historia',
            'Lic. en Educación Logopedia',
            'Lic. en Educación Especial',
            'Lic. en Educación Preescolar',
            'Lic. en Educación Primaria',
            'Lic. en Educación Biología',
            'Lic. en Educación Geografía',
            'Lic. en Educación Química',
            'Agronomía',
            'Ingeniería en Procesos Agroindustriales',
            'Medicina Veterinaria',
            'Licenciatura en Cultura Física',
            'Técnico Superior en Entrenamiento Deportivo',
            'Ingeniería Informática',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Contabilidad y Finanzas',
            'Turismo',
            'Economía',
            'Técnico Superior en Asistencia Turística',
        ];

        $residencia = Residencia::with(['aptos' => function($query) use ($apto) {
            $query->where('id', $apto->id);
        }])->find($apto->residencias_id);

         return view('admin.becados.create', [
            'programasAcademicos' => $programasAcademicos,
            'residenciasDisponibles' => collect([$residencia]),
            'aptoSeleccionado' => $apto,
            'modoEspecifico' => true 
        ]);

        
    } 


    //Agregar un nuevo becado en la bd
    public function store (StoreBecadoRequest $request){
  
        $becados = new Becado();
        $becados->ci=$request->ci;
        $becados->nombre=$request->nombre;
        $becados->fecha_nacimiento=$request->fecha_nacimiento;
        $becados->year_carrera=$request->year_carrera;
        $becados->carrera=$request->programasAcademicos;
        $becados->origen=$request->nacionalidad;
        $becados->residencias_id=$request->residencia;
        $becados->aptos_id=$request->apto;

        if($request->evaluacion === 'Si'){
            $becados->evaluacion_jefe_residencia=$request->evaluacion_jefe_residencia;
            $becados->evaluacion_jefe_apto=$request->evaluacion_jefe_apto;
            $becados->evaluacion_profesor=$request->evaluacion_profesor;
        }

        $becados-> save();

        if ($request->nacionalidad === 'nacional') {
            $becadoNacional= new BecadoNacional();
            $becadoNacional->direccion=$request->direccion;
            $becadoNacional->becados_ci=$request->ci;
            $becados->evaluarNacionales();
            $becadoNacional->save();

        } elseif ($request->nacionalidad === 'extranjero' && $request->evaluacion === 'Si') {
            $becadoExtranjero= new BecadoExtranjero();
            $becadoExtranjero->numero_pasaporte= $request->pasaporte;
            $becadoExtranjero->pais=$request->pais;
            $becadoExtranjero->direccion_embajada=$request->direccion_embajada;
            $becadoExtranjero->year_entrada=$request->year_entrada;
            $becadoExtranjero->becados_ci=$request->ci;
            $becadoExtranjero->evaluacion_jefe_relaciones_internacionales=$request->evaluacion_jefe_relaciones_internacionales;
            $becadoExtranjero->save();
            $becados->evaluarExtranjeros();
        } elseif ($request->nacionalidad === 'extranjero' && $request->evaluacion === 'No') {
            $becadoExtranjero= new BecadoExtranjero();
            $becadoExtranjero->numero_pasaporte= $request->pasaporte;
            $becadoExtranjero->pais=$request->pais;
            $becadoExtranjero->direccion_embajada=$request->direccion_embajada;
            $becadoExtranjero->year_entrada=$request->year_entrada;
            $becadoExtranjero->becados_ci=$request->ci;
            $becadoExtranjero->save();
        }

        if ($becados->evaluacion_final) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Becado registrado!',
                'text' => "El becado se ha agregado correctamente y su evaluación final es: \"" . $becados->evaluacion_final . "\"",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#059669',
                'iconColor' => '#059669',
            ]);
        }
        else{
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Becado registrado!',
                'text' => "El becado ha sido agregado correctamente.",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#059669',
                'iconColor' => '#059669',
            ]);
        }
       
        return redirect()->route('admin.becados.index');
    }


    //Mostrar el formulario para editar un becado
    public function edit (Becado $becado, $origen)
    {
        $becadoNacional = BecadoNacional::where('becados_ci', $becado->ci)->first();
        $becadoExtranjero = BecadoExtranjero::where('becados_ci', $becado->ci)->first();

        $programasAcademicos = [
            'Ingeniería Civil',
            'Ingeniería Mecánica',
            'Ingeniería Agrícola',
            'Ingeniería Hidráulica',
            'Licenciatura en Educación Mecánica',
            'Licenciatura en Educación Construcción',
            'Licenciatura en Educación Eléctrica',
            'Licenciatura en Educación Agropecuaria',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Licenciatura en Educación Español-Literatura',
            'Licenciatura en Educación Artística',
            'Licenciatura en Educación: Marxismo Leninismo e Historia',
            'Lic. en Educación Logopedia',
            'Lic. en Educación Especial',
            'Lic. en Educación Preescolar',
            'Lic. en Educación Primaria',
            'Lic. en Educación Biología',
            'Lic. en Educación Geografía',
            'Lic. en Educación Química',
            'Agronomía',
            'Ingeniería en Procesos Agroindustriales',
            'Medicina Veterinaria',
            'Licenciatura en Cultura Física',
            'Técnico Superior en Entrenamiento Deportivo',
            'Ingeniería Informática',
            'Licenciatura en Educación Matemática',
            'Licenciatura en Educación Informática',
            'Licenciatura en Educación Física',
            'Contabilidad y Finanzas',
            'Turismo',
            'Economía',
            'Técnico Superior en Asistencia Turística',
        ];

        return view('admin.becados.edit', compact(['becado', 'becadoNacional', 'becadoExtranjero','programasAcademicos', 'origen']));  
    }


    //Guardar los cambios de un becado editada 
    public function update(UpdateBecadoRequest $request, Becado $becados, $origen)
    { 
        $request->validate([
            'ci' => "required|digits:11|unique:becados,ci,{$becados->ci},ci",    
        ]);
        
        // Actualizar los datos generales
        $becados->ci = $request->ci;
        $becados->nombre = $request->nombre;
        $becados->fecha_nacimiento = $request->fecha_nacimiento;
        $becados->year_carrera = $request->year_carrera;
        $becados->carrera = $request->programasAcademicos;
        $becados->origen = $request->nacionalidad;

        // Manejo de la evaluación
        if ($request->evaluacion === 'Si') {
            $becados->evaluacion_jefe_residencia = $request->evaluacion_jefe_residencia;
            $becados->evaluacion_jefe_apto = $request->evaluacion_jefe_apto;
            $becados->evaluacion_profesor = $request->evaluacion_profesor;
        }

        // Guardar cambios
        $becados->save();

        // Actualización condicional para becados nacionales
        if ($request->nacionalidad === 'nacional') {

            $becado_nacional= BecadoNacional::where('becados_ci', $becados->ci)->first();
            $becado_nacional->direccion = $request->direccion;
            $becado_nacional->save();

    
            // Llamar al método de evaluación de nacionales si corresponde
            if ($request->evaluacion === 'Si') {
            $becados->evaluarNacionales();
            $becados->save();
            }
        } elseif ($request->nacionalidad === 'extranjero') {
            $becado_extranjero = BecadoExtranjero::where('becados_ci', $becados->ci)->first();

            $request->validate([
                'pasaporte' => [
                    'required', 
                    'digits:11', 
                    "unique:becados_extranjeros,numero_pasaporte," . ($becado_extranjero ? $becado_extranjero->numero_pasaporte : 'NULL') . ",numero_pasaporte"
                ],
            ]);

            $becado_extranjero->numero_pasaporte = $request->pasaporte;
            $becado_extranjero->pais = $request->pais;
            $becado_extranjero->direccion_embajada = $request->direccion_embajada;
            $becado_extranjero->year_entrada = $request->year_entrada;
            $becado_extranjero->evaluacion_jefe_relaciones_internacionales = ($request->evaluacion === 'Si') ? $request->evaluacion_jefe_relaciones_internacionales : null;

            $becado_extranjero->save();
        
            
            if ($request->evaluacion === 'Si') {
                $becados->evaluarExtranjeros();
                $becados->save();
            }
        }
        if ($becados->evaluacion_final) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Becado editado!',
                'text' => "El becado ha sido editado correctamente y su evaluación final es: \"" . $becados->evaluacion_final . "\"",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#059669',
                'iconColor' => '#059669',
            ]);
        }
        else
        {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Becado editado!',
                'text' => 'El becado se ha editado correctamente',
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#059669',
                'iconColor' => '#059669',
            ]);
        }

      if ($origen === 'becados') {
         return redirect()->route('admin.becados.index');
      } else if ($origen === 'todos') {
        return redirect()->route('admin.aptos.becadosAsociados', ['apto'=>$becados->aptos_id,'origen'=>'todos' ]);
      }else if ($origen === 'ocupados') {
         return redirect()->route('admin.aptos.becadosAsociados', ['apto'=>$becados->aptos_id,'origen'=>'ocupados' ]); 
      }else if ($origen === 'nacionales') {
        return redirect()-> route('admin.becados.indexNacionales') ; 
      }else if ($origen === 'extranjeros') {
        return redirect()-> route('admin.becados.indexExtranjeros') ; 
      }
       
    }


    //Mostrar becados que coincidan con un dato
    public function show(Request $request)
    {
        $busqueda= $request->busqueda;
        
         $becados = Becado::where('ci', '=', $busqueda)
        ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('fecha_nacimiento', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('year_carrera', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('carrera', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('origen', 'LIKE', '%'.$busqueda.'%')
        ->orWhereHas('apto', function($query) use ($busqueda) {
            $query->where('numero',$busqueda)
                  ->orWhereHas('residencia', function($query) use ($busqueda) {
                      $query->where('nombre', 'LIKE', '%'.$busqueda.'%');
                  });
        })
        ->paginate(); 

        return view('admin.becados.index',compact('becados', 'busqueda'));
    }
    

    //Mostrar becados nacionales que coincidan con un dato
    public function showNacionales(Request $request)
    {
        $busqueda= $request->busqueda;
        $becadosNacionales = BecadoNacional::with('becado')
        ->where('direccion', 'LIKE', '%'.$busqueda.'%') // Si "direccion" está en BecadoNacional
        ->orWhereHas('becado', function ($query) use ($busqueda) {
            $query->where('ci', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('fecha_nacimiento', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('year_carrera', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('carrera', 'LIKE', '%'.$busqueda.'%')
                ->orWhereHas('apto', function($query) use ($busqueda) {
                    $query->where('numero', $busqueda)
                        ->orWhereHas('residencia', function($query) use ($busqueda) {
                            $query->where('nombre', 'LIKE', '%'.$busqueda.'%');
                        });
                });
        })
        ->paginate();
       
        return view('admin.becados.indexNacionales',compact('becadosNacionales' , 'busqueda'));
    }


    //Mostrar becados extranjeros que coincidan con un dato
    public function showExtranjeros(Request $request)
    {
        $busqueda= $request->busqueda;
        $becadosExtranjeros = BecadoExtranjero::with('becado')
        ->whereHas('becado', function ($query) use ($busqueda) {
            $query->where('ci', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('fecha_nacimiento', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('year_carrera', 'LIKE', '%'.$busqueda.'%')
                ->orWhere('carrera', 'LIKE', '%'.$busqueda.'%')
                ->orWhereHas('apto', function($query) use ($busqueda) {
                    $query->where('numero', $busqueda)
                        ->orWhereHas('residencia', function($query) use ($busqueda) {
                            $query->where('nombre', 'LIKE', '%'.$busqueda.'%');
                        });
                });
        })
        ->orWhere('numero_pasaporte', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('pais', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('direccion_embajada', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('year_entrada', 'LIKE', '%'.$busqueda.'%')
        ->paginate();

        return view('admin.becados.indexExtranjeros',compact('becadosExtranjeros', 'busqueda'));
    }


    //Eliminar becado
    public function destroy(Becado $becado)
    {
        $becado->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Becado eliminado!',
            'text' => 'El becado se ha eliminado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);
        return redirect()->back();
    }

    
    //Eliminar multiples becados de un apto
    public function destroyMultiplesBecados(Request $request, Apto $apto, $origen) 
   {
      // Recupera los CI seleccionados
      $seleccionados = $request->input('becadosSeleccionados', []);

      // Verifica que haya selecciones
      if (empty($seleccionados)) {
          session()->flash('swal', [
                'icon' => 'warning',
                'title' => '¡Atención!',
                'text' => "No seleccionaste ningún becado",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#F59E0B', 
                'iconColor' => '#F59E0B'
            ]);
            return redirect()->back();
      }else{
         foreach ($seleccionados as $seleccionado) {
            $becado=Becado::find($seleccionado);
            $becado->delete();
         }
      }

      session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Becados eliminados!',
            'text' => 'Los becados se han eliminado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);


      return redirect()->route('admin.aptos.becadosAsociados',[$apto->id,$origen]);
   }




   //OTROS

   // Mostrar vista de notas de becados
    public function indexbecadosEvaluacion(){
      $becados= Becado::orderBy('created_at', 'desc')->paginate();
      return view('admin.evaluacion.becados.index', compact('becados'));
    }

    public function indexbecadosNacionalesEvaluacion(){
      $becados = Becado::where('origen', 'like', '%nacional%')
        ->orderBy('created_at', 'desc')
        ->paginate();

      return view('admin.evaluacion.becados.indexNacionales', compact('becados'));
    }

    public function indexbecadosExtranjerosEvaluacion(){
      
        $becados = Becado::where('origen', 'like', '%extranjero%')
        ->orderBy('created_at', 'desc')
        ->paginate();

      return view('admin.evaluacion.becados.indexExtranjeros', compact('becados'));
    }

    public function showbecadosEvaluacion(Request $request)
    {
        $busqueda= $request->busqueda;
       if (is_numeric($busqueda) && strlen($busqueda) == 1){
            $becados = Becado::where('evaluacion_jefe_residencia', $busqueda)
            ->orWhere('evaluacion_jefe_apto', $busqueda)
            ->orWhere('evaluacion_profesor', $busqueda)
            ->orWhereHas('becadoExtranjero', function ($query) use ($busqueda) {
                $query->where('evaluacion_jefe_relaciones_internacionales', 'LIKE', '%' . $busqueda . '%');
            })
            ->orderBy('created_at', 'desc')->paginate();
        } else {
             $becados = Becado::where('ci', '=', $busqueda)
            ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
            ->orWhere('fecha_nacimiento', 'LIKE', '%'.$busqueda.'%')
            ->orWhere('origen', 'LIKE', '%'.$busqueda.'%')
            ->orWhere('evaluacion_final', 'LIKE', '%'.$busqueda.'%')
            ->orderBy('created_at', 'desc')->paginate();
        }
        
        return view('admin.evaluacion.becados.index',compact('becados', 'busqueda'));
    }

    public function showbecadosNacionalesEvaluacion(Request $request)
    {
        $busqueda= $request->busqueda;
       if (is_numeric($busqueda) && strlen($busqueda) == 1){
            $becados = Becado::where('origen', 'like', '%nacional%')
            ->where(function ($query) use ($busqueda) {
                $query->orWhere('evaluacion_jefe_residencia', $busqueda)
                    ->orWhere('evaluacion_jefe_apto', $busqueda)
                    ->orWhere('evaluacion_profesor', $busqueda);
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
        } else {
            
            $becados = Becado::where('origen', 'like', '%nacional%')
            ->where(function ($query) use ($busqueda) {
                $query->where('ci', '=', $busqueda)
                    ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('fecha_nacimiento', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('evaluacion_final', 'LIKE', '%'.$busqueda.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
        }
        
        return view('admin.evaluacion.becados.indexNacionales',compact('becados', 'busqueda'));
    }

    public function showbecadosExtranjerosEvaluacion(Request $request)
    {
        $busqueda= $request->busqueda;
       if (is_numeric($busqueda) && strlen($busqueda) == 1){
            $becados = Becado::where('origen', 'like', '%extranjero%')
            ->where(function ($query) use ($busqueda) {
                $query->orWhere('evaluacion_jefe_residencia', $busqueda)
                    ->orWhere('evaluacion_jefe_apto', $busqueda)
                    ->orWhere('evaluacion_profesor', $busqueda)
                    ->orWhereHas('becadoExtranjero', function ($query) use ($busqueda) {
                        $query->where('evaluacion_jefe_relaciones_internacionales', 'LIKE', '%' . $busqueda . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
        } else {
            
            $becados = Becado::where('origen', 'like', '%extranjero%')
            ->where(function ($query) use ($busqueda) {
                $query->where('ci', '=', $busqueda)
                    ->orWhere('nombre', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('fecha_nacimiento', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('evaluacion_final', 'LIKE', '%'.$busqueda.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
        }
        
        return view('admin.evaluacion.becados.indexExtranjeros',compact('becados', 'busqueda'));
    }



    //Mostrar formulario para evaluar un becado
    public function evaluarBecado(Becado $becado, $origen)
    {
        return view('admin.evaluacion.becados.evaluar', compact('becado', 'origen'));
    }



    //Guardar notas agregadas
    public function storeEvaluacion(Request $request, Becado $becado, $origen){

        $becado->evaluacion_jefe_residencia = $request->evaluacion_jefe_residencia;
        $becado->evaluacion_jefe_apto = $request->evaluacion_jefe_apto;
        $becado->evaluacion_profesor = $request->evaluacion_profesor;
        if ($becado->origen==='Extranjero') {
            $becado->becadoExtranjero->evaluacion_jefe_relaciones_internacionales =  $request->evaluacion_jefe_relaciones_internacionales;
            $becado->becadoExtranjero->save();
        } 
        
        $becado->save();

        if ($becado->origen==='Nacional') {
            $becado->evaluarNacionales();
        } else if($becado->origen==='Extranjero') {
          $becado->evaluarExtranjeros();
        }
        
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Becado evaluado!',
            'text' => "El becado se ha agregado correctamente y su evaluación final es: \"" . $becado->evaluacion_final . "\"",
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);
       
        if ($origen === 'becados') {
            return redirect()->route('admin.evaluar.becados.indexbecadosEvaluacion');
        } else if ($origen === 'extranjeros') {
            return redirect()->route('admin.evaluar.becados.indexbecadosExtranjerosEvaluacion');
        } else if ($origen === 'nacionales') {
            return redirect()->route('admin.evaluar.becados.indexbecadosNacionalesEvaluacion');
        } else {
            return redirect()->route('admin.evaluar.aptos.becadosAsociadosEvalucion', [$becado->apto->id]);
        }

    }



    //Mostrar formulario para editar notas
    public function editarEvaluacion(Becado $becado, $origen)
    {
        return view('admin.evaluacion.becados.editEvaluacion', compact('becado', 'origen'));
    }


    public function updateEvaluacion(Request $request, Becado $becado, $origen)
    {
        $becado->evaluacion_jefe_residencia=$request->evaluacion_jefe_residencia;
        $becado->evaluacion_profesor=$request->evaluacion_profesor;
        $becado->evaluacion_jefe_apto=$request->evaluacion_jefe_apto;
        $becado->save();
        if ($becado->origen==='Extranjero') {
           $becado->becadoExtranjero->evaluacion_jefe_relaciones_internacionales=$request-> evaluacion_jefe_relaciones_internacionales;
           $becado->becadoExtranjero->save();
        }

        if ($becado->origen=== 'Extranjero') 
        {
          $becado->evaluarExtranjeros() ; 
        }
        else {
            $becado->evaluarNacionales() ;
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Becado editado!',
            'text' => "Evaluación de becado editada correctamente, su evaluación final es: \"" . $becado->evaluacion_final . "\"",
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);
        if ($origen === 'nacionales') {
            return redirect()->route('admin.evaluar.becados.indexbecadosNacionalesEvaluacion');
        } elseif ($origen === 'extranjeros') {
            return redirect()->route('admin.evaluar.becados.indexbecadosExtranjerosEvaluacion');
        } else {
            return redirect()->route('admin.evaluar.becados.indexbecadosEvaluacion');
        }

    }
}
