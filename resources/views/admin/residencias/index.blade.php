
<x-layouts.app >

    <div class="mb-5 flex justify-between items-center">
   
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Residencias</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        
        <div class="flex gap-x-6 mr-8">
            <form action="{{ route('admin.residencias.show') }}" method="GET">
                <button type="submit" class="hidden">BUSCAR</button>
                <flux:input icon="magnifying-glass" placeholder="Buscar" type="text" name="busqueda" value="{{ isset($busqueda) ? $busqueda : '' }}" />
            </form>

            <form action="{{route('admin.residencias.create')}}" method="GET">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                style="padding: 0.5rem 1rem; border-radius: 0.5rem;">
                    AGREGAR
                </button>
            </form>
        </div>
    </div>
    
   
    <table class="border-collapse border border-gray-400 w-full text-left mb-4">

        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Cantidad de Aptos</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Jefe del Consejo de Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Profesor Asignado</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($residencias->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="7"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach($residencias as $residencia)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->id }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->cantidad_aptos }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->jefe_consejo_residencia }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->profesor_asignado }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $residencia->evaluacion }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <div class="flex space-x-2 items-stretch">
                                @php
                                    $cantdaptos = $residencia->aptos->count(); 
                                @endphp

                                <form action="{{route('admin.aptos.create', [$residencia->id])}}" method="GET" class="h-full flex-1">
                                    @csrf
                                    <button type="submit" class="h-8 w-25 flex items-center justify-center px-3 py-2 rounded text-s font-semibold transition bg-blue-500 text-white hover:bg-blue-700" {{ $cantdaptos < $residencia->cantidad_aptos ? '' : 'disabled' }}>
                                        Agg apto
                                    </button>
                                </form>

                                <form  action="{{route('admin.residencias.aptosAsociados', [$residencia->id])}}" method="GET" class="h-full flex-1">
                                    @csrf
                                    <button type="submit" {{ $residencia->aptos->count() == 0 ? 'disabled' : '' }}
                                    class="h-8 w-18 flex items-center justify-center px-3 py-2 rounded text-sm font-semibold transition bg-indigo-500 text-white hover:bg-indigo-600 leading-tight" >
                                        <i class="fa-regular fa-eye"></i>

                                    </button>
                                </form>

                                <form action="{{ route('admin.residencias.edit', [$residencia->id]) }}" method="GET" class="h-full flex-1">
                                
                                    <button type="submit" class="h-8 w-17 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-xs" >
                                        <i class="fa-solid fa-pen text-lg"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.residencias.destroy', [$residencia->id]) }}" method="POST" class="h-full flex-1 delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="h-8 w-15 flex items-center justify-center bg-red-600 text-white hover:bg-red-700 transition rounded text-xs delete-btn">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>  
    </table>

    <div>
        {{$residencias->links()}}
    </div>

    @push('js')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
            let formsDelete = document.querySelectorAll('.delete-form');

            formsDelete.forEach(formDelete => {
                formDelete.addEventListener('submit', function(e) { 
                    e.preventDefault();

                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "No podrás revertir esta acción. El apto será eliminado.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#059669",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar",
                        iconColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formDelete.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
        
</x-layouts.app>

      
 