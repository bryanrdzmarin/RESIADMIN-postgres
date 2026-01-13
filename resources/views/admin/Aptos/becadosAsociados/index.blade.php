<x-layouts.app >
    @if (isset($origen) && $origen === 'todos')
        <div class="mb-5 flex justify-between items-center">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.index') }}">Aptos</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Ver becados</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>    
    @else
        <div class="mb-5 flex justify-between items-center">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.indexOcupados') }}">Aptos Ocupados</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Ver becados</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    @endif
    

   <form action="{{route('admin.becados.destroyMultiplesBecados',[$apto->id, $origen])}}" method="POST">
    @csrf
     @method('DELETE')
        <table class="border-collapse border border-gray-400 w-11/12 text-left mx-auto mb-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-center">Seleccionar</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">CI</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Fecha de Nacimiento</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Año de Carrera</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Carrera</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Origen</th>
                     <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                   
                </tr>
            </thead>
            <tbody>
                @if ($becados->isEmpty())
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td colspan="8"  class="border border-gray-300 px-4 py-2 text-center">
                            No hay datos para mostrar en este momento.
                        </td>
                    </tr>
                @else
                    @foreach($becados as $becado)
                            <tr class="odd:bg-white even:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                <input type="checkbox"  name="becadosSeleccionados[]" value="{{ $becado->ci }}">
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->ci }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->nombre }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->fecha_nacimiento }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->year_carrera }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->carrera }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->origen }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('admin.becados.edit', [$becado->ci, $origen] ) }}"  class="h-10 w-14 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-sm">
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

