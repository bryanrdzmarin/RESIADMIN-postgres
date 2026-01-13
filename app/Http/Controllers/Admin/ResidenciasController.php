<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidenciaRequest;
use App\Http\Requests\UpdateResidenciaRequest;
use App\Models\Apto;
use App\Models\Residencia;
use Illuminate\Http\Request;

class ResidenciasController extends Controller
{
    //Mostrar todas las residencias 
    public function index (){
        $residencias =Residencia::orderBy('id', 'desc')->paginate();

        $residenciasEvaluadas=Residencia::whereNotNull('evaluacion')->get();
        foreach ($residenciasEvaluadas as $residenciaEvaluada ) {
            $residenciaEvaluada->evaluacion=null;
            $residenciaEvaluada->save();
        }
        
         $residenciasConTodosAptosEvaluados  = Residencia::whereHas('aptos', function ($query) {
            $query->whereNotNull('evaluacion');
         })->get()->filter(function ($residencia) {
            return $residencia->aptos()->whereNotNull('evaluacion')->count() == $residencia->aptos()->count();
      });

      foreach ( $residenciasConTodosAptosEvaluados  as  $residenciaConTodosAptosEvaluados ) {
         $residenciaConTodosAptosEvaluados->evaluarResidencia();
      }

        return view ('admin.residencias.index',compact('residencias'));
    }

    //Mostrar formulario para crear nuevas residencias 
    public function create ()
    {
        return view('admin.residencias.create');
    } 

    //Guardar una nueva residencia en la bd
    public function store (StoreResidenciaRequest $request)
    {
        Residencia::create($request->validated());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Residencia registrada!',
            'text' => 'La residencia se ha agregado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);
        return redirect()->route('admin.residencias.index'); 
    }

    //Mostrar el formulario para editar una residencia 
    public function edit (Residencia $residencia)
    {
        return view('admin.residencias.edit', compact('residencia'));
    }

    //Guardar los cambios de una residencia editada 
    public function update(UpdateResidenciaRequest $request, Residencia  $residencia)
    {
        $cantidadActualAptos = $residencia->aptos()->count();

        if ($request->cantidad_aptos < $cantidadActualAptos) {
            session()->flash('swal', [
                'icon' => 'warning',
                'title' => '¡Atención!',
                'text' => "No puedes reducir la cantidad de apartamentos a menos de {$cantidadActualAptos}, ya que esa es la cantidad que tiene registrada la residencia.",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#F59E0B', 
                'iconColor' => '#F59E0B'
            ]);
            return redirect()->back();
        }

        $residencia->update($request->validated());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Residencia editada!',
            'text' => 'La residencia se ha editado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);

        return redirect()->route('admin.residencias.edit', $residencia);
    }
    

    //Mostrar una residencias que coincidan con un dato
    public function show(Request $request)
    {
        $busqueda= $request->busqueda;
        $residencias = Residencia::where('nombre', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('jefe_consejo_residencia', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('profesor_asignado', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('evaluacion', 'LIKE', '%'.$busqueda.'%')
        ->orWhere('cantidad_aptos', $busqueda) 
        ->orWhere('id', $busqueda) 
        ->latest('id')
        ->paginate(); 

        return view ('admin.residencias.index',compact('residencias', 'busqueda'));
    }

    // Mostrar Aptos asociados
    public function AptosAsociados (Residencia $residencia){
        return view('admin.residencias.indexAptosAsociados', compact('residencia'));
    }

    //Eliminar residencia 
    public function destroy( Residencia $residencia)
    {
        $residencia->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Residencia eliminada!',
            'text' => 'La residencia se ha eliminado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);
        return redirect()->route('admin.residencias.index');
    }

    //Eliminar multiples aptos de una residencia
    public function destroyMultiplesAptos(Request $request, Residencia $residencia) 
   {
      // Recupera los CI seleccionados
      $seleccionados = $request->input('aptosSeleccionados', []);

      // Verifica que haya selecciones
      if (empty($seleccionados)) {
          session()->flash('swal', [
                'icon' => 'warning',
                'title' => '¡Atención!',
                'text' => "No seleccionaste ningún apto",
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#F59E0B', 
                'iconColor' => '#F59E0B'
            ]);
            return redirect()->back();
      }else{
         foreach ($seleccionados as $seleccionado) {
            $apto=Apto::find($seleccionado);
            $apto->delete();
         }
      }

      session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Aptos eliminados!',
            'text' => 'Los aptos se han eliminado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);

      return redirect()->route('admin.residencias.aptosAsociados',[$residencia->id]);
   }
}
