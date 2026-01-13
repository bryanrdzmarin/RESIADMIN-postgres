<x-layouts.app>
    <form action="{{ route('admin.busqueda.residencias.indexResidenciasMostrar') }}" method="GET" class="mb-4">
        <div class="grid grid-cols-6 gap-2">
            <flux:input placeholder="Nombre" type="text" name="busquedaNombre"
                value="{{ isset($busquedaNombre) ? $busquedaNombre : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Cantidad de Aptos" type="number" min="1" name="busquedaCantidadAptos"
                value="{{ isset($busquedaCantidadAptos) ? $busquedaCantidadAptos : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Jefe Consejo" type="text" name="busquedaJefeConsejo"
                value="{{ isset($busquedaJefeConsejo) ? $busquedaJefeConsejo : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Profesor Asignado" type="text" name="busquedaProfesor"
                value="{{ isset($busquedaProfesor) ? $busquedaProfesor : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:input placeholder="Evaluación" type="text" name="busquedaEvaluacion"
                value="{{ isset($busquedaEvaluacion) ? $busquedaEvaluacion : '' }}"
                class="px-2 py-1 border border-gray-300 rounded w-full" />

            <flux:button class="text-white font-semibold py-1 px-2 rounded w-15" type="submit" variant="primary" color="teal">
                <i class="fas fa-search"></i>
            </flux:button>    
        </div>
    </form>

    <table class="border-collapse border border-gray-400 w-full text-left mb-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Cantidad de Aptos</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Jefe del Consejo de Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Profesor Asignado</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación</th>
            </tr>
        </thead>
        <tbody>
            @if ($residencias === null || $residencias->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach($residencias as $residencia)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->cantidad_aptos }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->jefe_consejo_residencia }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->profesor_asignado }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->evaluacion }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if ($residencias!= null)
        <div>
            {{$residencias->links()}}
        </div>
    @endif
    
</x-layouts.app>