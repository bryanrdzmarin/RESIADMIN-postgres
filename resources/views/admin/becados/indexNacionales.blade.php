<x-layouts.app>

    <div class="mb-5 flex justify-between items-center">

        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.becados.index') }}">Becados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Becados Nacionales</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="flex gap-x-3 mr-8">
            <form action="{{ route('admin.becadosNacionales.show') }}" method="GET">
                <button type="submit" class="hidden">BUSCAR</button>
              <flux:input icon="magnifying-glass" placeholder="Buscar" type="text" name="busqueda" value="{{ isset($busqueda) ? $busqueda : '' }}" />
            </form>

            <form action="{{ route('admin.becados.create') }}" method="GET">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                    style="padding: 0.5rem 1rem; border-radius: 0.5rem;">
                    Agregar
                </button>
            </form>

        </div>
    </div>

    <flux:radio.group label="" variant="segmented" size="sm" class="w-fit mx-auto mb-4">
        <flux:radio value="todos" class="{{ request()->routeIs('admin.becados.index')|| request()->routeIs('admin.becadosNacionale.show') ? 'bg-white text-black' : '' }}">
            <a href="{{ route('admin.becados.index') }}" class="block w-full text-center font-semibold text-sm">
                Todos
            </a>
        </flux:radio>
        
        <flux:radio value="disponibles" class="{{ request()->routeIs('admin.becados.indexNacionales')|| request()->routeIs('admin.becadosNacionales.show') ? 'bg-white text-black' : '' }}">
            <a href="{{ route('admin.becados.indexNacionales') }}" class="block w-full text-center font-semibold text-sm">
                Nacionales
            </a>
        </flux:radio>
        
        <flux:radio value="ocupados" class="{{ request()->routeIs('admin.becados.indexExtranjeros') ? 'bg-white text-black' : '' }}">
            <a href="{{ route('admin.becados.indexExtranjeros') }}" class="block w-full text-center font-semibold text-sm">
                Extranjeros
            </a>
        </flux:radio>
    </flux:radio.group>



    <table class="border-collapse border border-gray-400 w-full text-left mb-4" >
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">CI</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Fecha de Nacimiento</th>
                <th class="border border-gray-300 px-4 py-2 text-center">No Apto</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Carrera</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Año de Carrera</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Direccion</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($becadosNacionales->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="9"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach($becadosNacionales as $becadoNacional)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becadoNacional->becados_ci }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becadoNacional->becado->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becadoNacional->becado->fecha_nacimiento }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{$becadoNacional->becado->aptos_id  ? $becadoNacional->becado->apto->numero : 'No asignado' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{$becadoNacional->becado->aptos_id  ?$becadoNacional->becado->apto->residencia->nombre : 'No asignada' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becadoNacional->becado->carrera }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becadoNacional->becado->year_carrera }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becadoNacional->direccion }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">

                            <div class="flex space-x-2 items-stretch">
                                <!-- Editar -->
                                <form action="{{ route('admin.becados.edit', ['becado'=>$becadoNacional->becados_ci , 'origen'=>'nacionales']) }}" method="GET">
                                    <button type="submit"
                                        class="h-10 w-14 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-sm">
                                        <i class="fa-solid fa-pen text-lg"></i>
                                    </button>
                                </form>

                                <!-- Eliminar -->
                                <form  action="{{ route('admin.becados.destroy', [$becadoNacional->becados_ci]) }}" method="POST"
                                    class="h-full flex-1 delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="h-10 w-12 flex items-center justify-center bg-red-600 text-white hover:bg-red-700 transition rounded text-sm">
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
        {{ $becadosNacionales->links() }}
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
                            text: "No podrás revertir esta acción. El becado será eliminado.",
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


