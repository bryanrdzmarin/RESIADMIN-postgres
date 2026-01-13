<x-layouts.app>

    <form action="{{ route('admin.busqueda.aptos.indexAptosMostrar') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-8 gap-2 items-end">


            <flux:input placeholder="No de Aptos" type="number" min="1" name="busquedaNo"
                value="{{ isset($busquedaNo) ? $busquedaNo : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />
            
            <flux:input placeholder="Nombre de residencia" type="text" name="busquedaNombre"
                value="{{ isset($busquedaNombre) ? $busquedaNombre : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Capacidad" type="number" min="1" name="busquedaCapacidad"
                value="{{ isset($busquedaCapacidad) ? $busquedaCapacidad : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Jefe de apartamento" type="text" name="busquedaJefeApartamento"
                value="{{ isset($busquedaJefeApartamento) ? $busquedaJefeApartamento : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Profesor Asignado" type="text" name="busquedaProfesor"
                value="{{ isset($busquedaProfesor) ? $busquedaProfesor : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <div class="border border-gray-300 rounded px-2 py-[4px] w-full">
                <flux:select name="busquedaEstado" class="w-full bg-white appearance-none" required>
                    <option value="" >Seleccionar</option>
                    <option value="Todos" {{ isset($busquedaEstado) && $busquedaEstado == 'Todos' ? 'selected' : '' }}>Todos</option>
                    <option value="disponible" {{ isset($busquedaEstado) && $busquedaEstado == 'disponible' ? 'selected' : '' }}>Disponibles</option>
                    <option value="ocupado" {{ isset($busquedaEstado) && $busquedaEstado == 'ocupado' ? 'selected' : '' }}>Ocupados</option>
                </flux:select>
            </div>

            <flux:input placeholder="Evaluación" type="text" name="busquedaEvaluacion"
                value="{{ isset($busquedaEvaluacion) ? $busquedaEvaluacion : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:button class="text-white font-semibold py-1 px-3 rounded w-20 h-12" type="submit" variant="primary" color="teal">
                <i class="fas fa-search"></i>
            </flux:button>
        </div>

 
        
    </form>

    <table class="border-collapse border border-gray-400 w-full text-left mb-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">Numero Apto</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Capacidad</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Jefe de apartamento</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Profesor asignado</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación</th>
            </tr>
         </thead>
       
        <tbody>
             @if ($aptos === null || $aptos->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="6"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach ($aptos as $apto)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->numero }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->residencia->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->capacidad }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->jefe_apartamento }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->profesor_asignado }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->evaluacion }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
      

    </table>

    @if ($aptos!= null)
        <div>
            {{ $aptos->links() }}
        </div>
    @endif
</x-layouts.app>
