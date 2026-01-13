<x-layouts.app >

    <div class="mb-5 flex justify-between items-center">

        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
             <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Becados Extranjeros</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div class="flex gap-x-3 mr-8">
            <form action="{{ route('admin.evaluar.becados.showbecadosExtranjerosEvaluacion') }}" method="GET">
                <button type="submit" class="hidden">BUSCAR</button>
                <flux:input icon="magnifying-glass" placeholder="Buscar" type="text" name="busqueda" value="{{ isset($busqueda) ? $busqueda : '' }}" />
            </form>
        </div>
    </div>

   <flux:radio.group label="" variant="segmented" size="sm" class="w-fit mx-auto mb-4">
        <flux:radio value="todos" class="{{ request()->routeIs('admin.evaluar.becados.indexbecadosEvaluacion') ? 'bg-white text-black' : '' }}">
            <a href="{{ route('admin.evaluar.becados.indexbecadosEvaluacion') }}" class="block w-full text-center font-semibold text-sm">
                Todos
            </a>
        </flux:radio>
        
        <flux:radio value="disponibles" class="{{ request()->routeIs('admin.evaluar.becados.indexbecadosNacionalesEvaluacion') ? 'bg-white text-black' : '' }}">
            <a href="{{ route('admin.evaluar.becados.indexbecadosNacionalesEvaluacion') }}" class="block w-full text-center font-semibold text-sm">
                Nacionales
            </a>
        </flux:radio>
        
        <flux:radio value="ocupados" class="{{ request()->routeIs('admin.evaluar.becados.indexbecadosExtranjerosEvaluacion')||request()->routeIs('admin.evaluar.becados.showbecadosExtranjerosEvaluacion') ? 'bg-white text-black' : '' }}">
            <a href="{{ route('admin.evaluar.becados.indexbecadosExtranjerosEvaluacion') }}" class="block w-full text-center font-semibold text-sm">
                Extranjeros
            </a>
        </flux:radio>
    </flux:radio.group>


    
    <table class="border-collapse border border-gray-400 w-full text-left mb-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-center">CI</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Origen</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación Profesor</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación Jefe Apto</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación Jefe Residencia</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación Jefe Relaciones Internacionales</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Evaluación Final</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                
            </tr>
        </thead>
        <tbody>

            @if ($becados->isEmpty())
                <tr class="odd:bg-white even:bg-gray-100">
                    <td colspan="9"  class="border border-gray-300 px-4 py-2 text-center">
                        No hay datos para mostrar en este momento.
                    </td>
                </tr>
            @else
                @foreach($becados as $becado)
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->ci }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->origen }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_profesor }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_jefe_apto}}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_jefe_residencia }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->becadoExtranjero->evaluacion_jefe_relaciones_internacionales  }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            
                            @if(is_null($becado->evaluacion_final))
                                <form action="{{ route('admin.evaluar.becados.evaluarBecado', ['becado' => $becado->ci, 'origen' => 'extranjeros']) }}" method="GET">
                                    <button type="submit" class="h-9 bg-rose-400 text-white hover:bg-rose-600 transition px-2 py-1  rounded text-sm font-semibold">
                                        Evaluar
                                    </button>
                                </form>
                            @else
                                {{ $becado->evaluacion_final }}
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center align-middle">
                            <div class="flex items-center justify-center">
                                <form action="{{ route('admin.evaluar.becados.editarEvaluacion', ['becado' => $becado->ci, 'origen' => 'extranjeros']) }}" method="GET">
                                <button type="submit" {{is_null($becado->evaluacion_final) ? 'disabled' : '' }}
                                    class="h-9 w-12 flex items-center justify-center bg-green-600 text-white hover:bg-green-700 transition rounded text-sm">
                                    <i class="fa-solid fa-pen text-lg"></i>
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
        {{ $becados->links() }}
    </div>


</x-layouts.app>