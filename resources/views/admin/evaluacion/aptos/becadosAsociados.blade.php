<x-layouts.app>

    <div class="mb-5 flex justify-between items-center">

        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.evaluar.aptos.indexEvaluacion') }}">Aptos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Becados asociados</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
   
    <table class="border-collapse border border-gray-400 w-11/12 text-left mx-auto mb-4" >
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2  text-center">{{ __('Ci') }}</th>
                <th class="border border-gray-300 px-4 py-2  text-center">Nombre</th>
                <th class="border border-gray-300 px-4 py-2  text-center">Fecha de Nacimiento</th>
                <th class="border border-gray-300 px-4 py-2  text-center">Año de Carrera</th>
                <th class="border border-gray-300 px-4 py-2  text-center">Carrera</th>
                <th class="border border-gray-300 px-4 py-2  text-center">Origen</th>
                <th class="border border-gray-300 px-4 py-2  text-center">Evaluación</th>
                   
            </tr>
        </thead>
        <tbody>
            @foreach($becados as $becado)
                    <td class="border border-gray-300 px-4 py-2  text-center">{{ $becado->ci }}</td>
                    <td class="border border-gray-300 px-4 py-2  text-center">{{ $becado->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2  text-center">{{ $becado->fecha_nacimiento }}</td>
                    <td class="border border-gray-300 px-4 py-2  text-center">{{ $becado->year_carrera }}</td>
                    <td class="border border-gray-300 px-4 py-2  text-center">{{ $becado->carrera }}</td>
                    <td class="border border-gray-300 px-4 py-2  text-center">{{ $becado->origen }}</td>
                    <td class="border border-gray-300 px-4 py-2  text-center">
                        @if ($becado->evaluacion_final===null)
                            <form action="{{ route('admin.evaluar.becados.evaluarBecado', ['becado' => $becado->ci, 'origen' => 'aptos']) }}" method="GET">
                                <button type="submit" class="h-9 bg-rose-400 text-white hover:bg-rose-600 transition px-2 py-1  rounded text-sm font-semibold">
                                    Evaluar
                                </button>
                            </form>
                        @else
                            {{$becado->evaluacion_final}}
                        @endif      
                    </td>  
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layouts.app>

       
