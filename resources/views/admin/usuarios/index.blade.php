<x-layouts.app >

    <div class="mb-5 flex justify-between items-center">
   
        <flux:breadcrumbs>
            <flux:breadcrumbs.item>Usuarios</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        
        <div class="flex items-stretch gap-x-6 mr-8 h-12">
            <!-- Formulario de búsqueda -->
            <form action="{{ route('admin.usuarios.show') }}" method="GET" class="flex items-center">
                <button type="submit" class="hidden">BUSCAR</button>
                <flux:input icon="magnifying-glass" placeholder="Buscar" type="text" name="busqueda" value="{{ isset($busqueda) ? $busqueda : '' }}" />
            </form>

            <!-- Botón con altura igual al input -->
            <form action="{{route('admin.usuarios.create')}}" method="GET">
                <button type="submit" class="h-full px-4 text-white bg-blue-500 rounded hover:bg-blue-700 transition flex items-center justify-center">
                    <i class="fas fa-user-plus"></i>
                </button>
            </form>
        </div>


    </div>

      <table class="border-collapse border border-gray-400 w-full text-left mb-4">

        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Correo electrónico</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Roles</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="4"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach($users as $user)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        <td class="border border-gray-300 px-4 py-2 text-center align-middle">
                            <div class="flex justify-center items-center space-x-2 min-h-[2.5rem]">
                                <form action="{{ route('admin.usuarios.edit', [$user->id]) }}" method="GET" class="flex items-center">
                                    <button type="submit" class="h-8 w-17 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-xs">
                                        <i class="fa-solid fa-pen text-lg"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.usuarios.destroy', [$user->id]) }}" method="POST" class="delete-form flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-8 w-15 flex items-center justify-center bg-red-600 text-white hover:bg-red-700 transition rounded text-xs delete-btn">
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
        {{$users->links()}}
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
                            text: "No podrás revertir esta acción. El usuario será eliminado.",
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

      
 