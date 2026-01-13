 <table id="tabla-todos"
    class="border-collapse border border-gray-400 w-full text-left mb-4"
    style="{{ isset($busquedaOrigen) && $busquedaOrigen !== 'todos' ? 'display: none;' : '' }}">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-center">CI</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Fecha de Nacimiento</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Origen</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">No Apto</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Residencia</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Carrera</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Año de Carrera</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Eval. Jefe Residencia</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Eval. Jefe Apto</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Eval. Profesor</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Evaluación final</th>
                </tr>
            </thead>
            <tbody>
                @if($becados === null || $becados->isEmpty())
                    <tr class="odd:bg-white even:bg-gray-100">
                        <td colspan="12" class="border border-gray-300 px-4 py-2 text-center">
                            No hay datos para mostrar en este momento.
                        </td>
                    </tr>
                @else
                    @foreach($becados as $becado)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->ci }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->nombre }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->fecha_nacimiento }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->origen }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->aptos_id ? $becado->apto->numero : 'No asignado' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->aptos_id ? $becado->apto->residencia->nombre : 'No asignada' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->carrera }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->year_carrera }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_jefe_residencia	 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_jefe_apto }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_profesor }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $becado->evaluacion_final }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>