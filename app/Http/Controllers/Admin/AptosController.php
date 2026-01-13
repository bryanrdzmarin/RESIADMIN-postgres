<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAptoRequest;
use App\Http\Requests\UpdateAptoRequest;
use App\Models\Apto;
use App\Models\Becado;
use App\Models\Residencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class AptosController extends Controller
{
   public function index()
   {
      $aptos=Apto::orderBy('id','desc')->paginate();
      return view('admin.Aptos.index',compact('aptos'));
   }


   public function indexDisponibles() 
   { 
      $aptos = Apto::whereHas('becados', function ($query) {
         $query->havingRaw('COUNT(*) < aptos.capacidad');
      })
      ->paginate(); 

      return view('admin.Aptos.indexDisponibles', ['aptos' => $aptos]);
   }

   public function indexOcupados()
   { 
     $aptos = Apto::whereHas('becados', function ($query) {
        $query->havingRaw('COUNT(*) = capacidad');
      })->paginate(); 
      return view('admin.Aptos.indexOcupados', ['aptos' => $aptos]);
   }


   public function create( Residencia $residencia)
   {
      return view('admin.Aptos.create',compact('residencia'));
   }
 

   public function store(StoreAptoRequest $request)
   { 
      Apto::create($request->validated());
       
      session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Apto registrado!',
            'text' => 'El apto se ha agregado correctamente a la residencia',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
      ]);
      return redirect()->route('admin.aptos.index'); 
   }


    public function show(Request $request)
   {
      $busqueda= $request->busqueda;

      $aptos=Apto::with('residencia')->whereHas('residencia', function ($query) use ($busqueda) {
            $query->where('nombre', 'LIKE', '%'.$busqueda.'%');})
       ->orWhere('numero', $busqueda)
       ->orWhere('capacidad', $busqueda)
       ->orWhere('jefe_apartamento', 'LIKE', '%'.$busqueda.'%')
       ->orWhere ('profesor_asignado', 'LIKE', '%'.$busqueda.'%')
       ->latest('id')
      ->paginate(); 
 
      return view('admin.aptos.index',compact('aptos', 'busqueda'));
   }


   public function showDisponibles(Request $request)
   {
      $busqueda= $request->busqueda;
      $aptos = Apto::with('residencia')
         ->select('aptos.*')
         ->selectSub(function($query) {
            $query->selectRaw('count(*)')
                  ->from('becados')
                  ->whereColumn('becados.aptos_id', 'aptos.id');
         }, 'becados_count')
         ->where(function($query) {
            $query->whereColumn(
                  DB::raw('(SELECT COUNT(*) FROM becados WHERE becados.aptos_id = aptos.id)'), 
                  '<', 
                  'aptos.capacidad'
            );
         })
         ->where(function($query) use ($busqueda) {
            $query->whereHas('residencia', function($q) use ($busqueda) {
                  $q->where('nombre', 'LIKE', '%'.$busqueda.'%');
            })
            ->orWhere('numero', $busqueda)
            ->orWhere('capacidad', $busqueda);
         })
      ->paginate();

      return view('admin.Aptos.indexDisponibles',compact('aptos', 'busqueda'));
   }


   public function showOcupados(Request $request)
   { 
      $busqueda= $request->busqueda;
      $aptos = Apto::with('residencia')
         ->select('aptos.*')
         ->selectSub(function($query) {
            $query->selectRaw('count(*)')
                  ->from('becados')
                  ->whereColumn('becados.aptos_id', 'aptos.id');
         }, 'becados_count')
         ->where(function($query) {
            $query->whereColumn(
                  DB::raw('(SELECT COUNT(*) FROM becados WHERE becados.aptos_id = aptos.id)'), 
                  '=', 
                  'aptos.capacidad'
            );
         })
         ->where(function($query) use ($busqueda) {
            $query->whereHas('residencia', function($q) use ($busqueda) {
                  $q->where('nombre', 'LIKE', '%'.$busqueda.'%');
            })
            ->orWhere('numero', $busqueda)
            ->orWhere('capacidad', $busqueda);
         })
      ->paginate();
 
      return view('admin.Aptos.indexOcupados',compact('aptos', 'busqueda'));
   }


   public function edit( Apto $apto, $origen)
   {
      return view('admin.aptos.edit',compact('apto', 'origen'));
   }
 
 
   public function update(UpdateAptoRequest $request, Apto $apto,  $origen)
   {
   
       $cantidadActualBecados = $apto->becados()->count();
      if ($request->capacidad < $cantidadActualBecados) {
        session()->flash('swal', [
            'icon' => 'warning',
            'title' => '¡Atención!',
            'text' => "No puedes reducir la capacidad del apartamento a menos de {$cantidadActualBecados}, ya que esa es la cantidad de becados agregados actualmente.",
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#F59E0B', 
            'iconColor' => '#F59E0B'
         ]);
         return redirect()->back();
      }

      $apto->update($request->validated());
      session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Apto editado!',
            'text' => 'El apto se ha editado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
      ]);



      if ($origen === 'residencias') {
         return redirect()->route('admin.residencias.aptosAsociados',[$apto->residencias_id]);
      } else if ($origen === 'todos') {
        return redirect()->route('admin.aptos.index'); 
      }else if ($origen === 'disponibles') {
         return redirect()->route('admin.aptos.indexDisponibles'); 
      }else if ($origen === 'ocupados') {
         return redirect()->route('admin.aptos.indexOcupados'); 
      }
      
   }
 
   
   public function destroy(Apto $apto) 
   {
      $apto->delete();
      session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Apto eliminado!',
            'text' => 'El apto se ha eliminado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);
      return redirect()->back();
   }





   //OTROS

   public function reasignarBecados(Apto $apto, $origen)
   {
      $becado = null;
      return view('admin.Aptos.becadosAsociados.reasignar',compact('becado','apto','origen'));
   }
   
   //Mostrar  becados que coincidan con un CI
   public function showCI(Request $request, Apto $apto, $origen) 
   {
      $request->validate([ 'ci' => 'digits:11|numeric', ]);


      $busqueda = $request->busqueda;
      $becado = Becado::where('ci', '=', $busqueda)->get();

      
      if ($becado->isEmpty()) {
          session()->flash('swal', [
               'icon' => 'warning',
               'title' => '¡Atención!',
              'text' => "El Carnet de Identidad ingresado no existe en nuestra base de datos. Por favor, verifique el número e intente nuevamente.",                
               'confirmButtonText' => 'Aceptar',
               'confirmButtonColor' => '#F59E0B', 
               'iconColor' => '#F59E0B'
            ]);
         return redirect()->back();
      }

      return view('admin.Aptos.becadosAsociados.reasignar', compact('becado', 'apto', 'busqueda','origen'));
   }

   public function reubicandoBecado(Request $request, Apto $apto, $origen){

      
      $becado=Becado::find($request->ci);
      $becado->aptos_id= $apto->id;
      $becado->residencias_id = $apto->residencias_id;
      $becado->save();

      session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Becado reubicado!',
            'text' => 'El becado se ha reubicado correctamente al apto',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
      ]);
      if ($origen==='todos') {
         return redirect()->route('admin.aptos.index');
      } else {
        return redirect()->route('admin.aptos.indexDisponibles');
      }
      
      
   }

   public function becadosAsociados(Apto $apto, $origen)
   {
      $becados=$apto->becados;
      return view('admin.Aptos.becadosAsociados.index',compact('becados','apto', 'origen'));
   }

   public function indexEvaluacion()
   {
       
    $aptosConEvaluaciones= Apto::whereNotNull('evaluacion')->get();
    foreach ($aptosConEvaluaciones as $aptoConEvaluaciones) {
      $aptoConEvaluaciones->evaluacion=null;
      $aptoConEvaluaciones->save();
    }

     $aptosConTodosBecadosEvaluados  = Apto::whereHas('becados', function ($query) {
            $query->whereNotNull('evaluacion_final');
         })->get()->filter(function ($apto) {
            return $apto->becados()->whereNotNull('evaluacion_final')->count() == $apto->CantidadBecados();
      });

      foreach ( $aptosConTodosBecadosEvaluados  as  $aptoConTodosBecadosEvaluados ) {
         $aptoConTodosBecadosEvaluados->Evaluar();
      }

    
      $aptos=Apto::whereHas('becados')->paginate();
      return view('admin.evaluacion.aptos.index',compact('aptos'));
   }


   public function becadosAsociadosEvalucion(Apto $apto)
   {
      $becados=$apto->becados;
      return view('admin.evaluacion.aptos.becadosAsociados',compact('becados','apto'));
   }

    public function showAptosEvaluacion(Request $request)
    {
        $busqueda= $request->busqueda;
         $aptos = Apto::whereHas('becados')
            ->where(function ($query) use ($busqueda) {
                $query->where('numero', '=', $busqueda)
                ->orWhere('evaluacion', 'LIKE', '%'.$busqueda.'%')
                    ->orWhereHas('residencia', function ($query) use ($busqueda) {
                        $query->where('nombre', 'LIKE', '%' . $busqueda . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate();
        
        return view('admin.evaluacion.aptos.index',compact('aptos'));
    }

}
