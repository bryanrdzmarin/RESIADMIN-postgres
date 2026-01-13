<x-layouts.app>
    <div class="flex flex-col space-y-4">
        
        <div class="mb-5 flex justify-between items-center">

          <flux:breadcrumbs>
              <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.index') }}">Aptos</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Aptos Ocupados</flux:breadcrumbs.item>
          </flux:breadcrumbs>

          <div class="flex gap-x-3 mr-8">
              <form action="{{ route('admin.aptos.showOcupados') }}" method="GET">
                  <button type="submit" class="hidden">BUSCAR</button>
                 <flux:input icon="magnifying-glass" placeholder="Buscar" type="text" name="busqueda" value="{{ isset($busqueda) ? $busqueda : '' }}" />
              </form>
          </div>
      </div>

        
        <div class="flex justify-center mb-0" >
            <flux:radio.group label="" variant="segmented" size="sm" class="w-fit mx-auto mb-4">
                <flux:radio value="todos" class="{{ request()->routeIs('admin.aptos.index') ? 'bg-white text-black' : '' }}">
                    <a href="{{ route('admin.aptos.index') }}" class="block w-full text-center font-semibold text-sm">
                        Todos
                    </a>
                </flux:radio>
                
                <flux:radio value="disponibles" class="{{ request()->routeIs('admin.aptos.indexDisponibles') ? 'bg-white text-black' : '' }}">
                    <a href="{{ route('admin.aptos.indexDisponibles') }}" class="block w-full text-center font-semibold text-sm">
                        Disponibles
                    </a>
                </flux:radio>
                
                <flux:radio value="ocupados" class="{{ request()->routeIs('admin.aptos.indexOcupados')||request()->routeIs('admin.aptos.showOcupados') ? 'bg-white text-black' : '' }}">
                    <a href="{{ route('admin.aptos.indexOcupados') }}" class="block w-full text-center font-semibold text-sm">
                        Ocupados
                    </a>
                </flux:radio>
            </flux:radio.group>
        </div>

        <div class="w-full mx-4 mb-4 mt-0">
            <thead>
            <table class="border-collapse border border-gray-400 w-full text-left">
                <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">Numero Apto</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Capacidad</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
       
            <tbody>
                @if ($aptos->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="4"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
                @else
                    @foreach ($aptos as $apto)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{$apto->numero}}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{$apto->residencia->nombre}}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{$apto->capacidad}}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center align-middle h-full">
                                <div class="flex h-full justify-center items-center space-x-2">
                                    <!-- Ver becados -->
                                    <form action="{{ route('admin.aptos.becadosAsociados', ['apto'=>$apto->id, 'origen'=> 'ocupados']) }}" method="GET">
                                        <button type="submit"
                                            class="h-10 w-28 flex items-center justify-center px-3 py-2 rounded text-sm font-semibold transition bg-indigo-500 text-white hover:bg-indigo-600 leading-tight">
                                            Ver becados
                                        </button>
                                    </form>

                                    <!-- Editar -->
                                    <form action="{{ route('admin.aptos.edit', ['apto'=>$apto->id, 'origen'=> 'ocupados']) }}" method="GET">
                                        <button type="submit"
                                            class="h-10 w-14 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-sm">
                                            <i class="fa-solid fa-pen text-lg"></i>
                                        </button>
                                    </form>

                                    <!-- Eliminar -->
                                    <form action="{{ route('admin.aptos.destroy', [$apto->id]) }}" method="POST" class="delete-form">
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
        </div>
    </div>   

     <div>
        {{ $aptos->links() }}
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

       
</x-layouts.app >

      
