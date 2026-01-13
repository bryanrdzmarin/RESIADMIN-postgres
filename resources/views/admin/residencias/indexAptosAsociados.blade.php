<x-layouts.app>

    <div class="mb-5 flex justify-between items-center">
   
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.residencias.index') }}">Residencias</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Ver Aptos</flux:breadcrumbs.item>   
        </flux:breadcrumbs>
    </div>
    
    <form action="{{route('admin.residencias.destroyMultiplesAptos',[$residencia->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <table class="border-collapse border border-gray-400 w-full text-left mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-center">Seleccionar</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Numero Apto</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Capacidad</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Jefe de apartamento</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Profesor asignado</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Evaluaciones</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($residencia->aptos->isEmpty())
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td colspan="7"  class="border border-gray-300 px-4 py-2 text-center">
                            No hay datos para mostrar en este momento.
                        </td>
                    </tr>
                @else
                    @foreach ($residencia->aptos as $apto)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                <input type="checkbox"  name="aptosSeleccionados[]" value="{{ $apto->id }}">
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->numero }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->capacidad }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->jefe_apartamento }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->profesor_asignado }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $apto->evaluacion }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">

                                <a href="{{ route('admin.aptos.edit', ['apto'=>$apto->id, 'origen'=> 'residencias'] ) }}"  class="h-10 w-14 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-sm">
                                    <i class="fa-solid fa-pen text-lg"></i>
                                </a>
                            
                            </td>
                            
                        </tr>
                    @endforeach
                @endif
            </tbody>
        

        </table>

        <button type="submit" class="h-9 w-33 flex items-center justify-center bg-red-600 text-white hover:bg-red-700 transition rounded text-sm">
            Eliminar Selección
        </button>
    </form>

</x-layouts.app>