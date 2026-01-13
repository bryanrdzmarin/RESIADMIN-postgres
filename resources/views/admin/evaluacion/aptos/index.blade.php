<x-layouts.app>

    <div class="mb-5 flex justify-between items-center">

        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Aptos</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="flex gap-x-3 mr-8">
            <form action="{{ route('admin.evaluar.aptos.showAptosEvaluacion') }}" method="GET">
                <button type="submit" class="hidden">BUSCAR</button>
                <flux:input icon="magnifying-glass" placeholder="Buscar" type="text" name="busqueda" value="{{ isset($busqueda) ? $busqueda : '' }}" />
            </form>
        </div>
    </div>


    <table  class="border-collapse border border-gray-400 w-full text-left mb-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Numero Apto</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluacion</th>
            </tr>
        </thead>
        <tbody>
            @if ($aptos->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="3"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach ($aptos as $apto)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$apto->residencia->nombre}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$apto->numero}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        @if ($apto->evaluacion != null)
                            {{$apto->evaluacion}}
                        @else
                            <form action="{{route('admin.evaluar.aptos.becadosAsociadosEvalucion', [$apto->id])}}" method="GET">
                                <button type="submit" class="h-9 bg-rose-400 text-white hover:bg-rose-600 transition px-2 py-1  rounded text-sm font-semibold"> Evaluar </button>
                            </form>
                        @endif
                    
                    </td>
                </tr>
                @endforeach
            @endif
                
        </tbody>
    </table>

    <div>
        {{ $aptos->links() }}
    </div>


</x-layouts.app>