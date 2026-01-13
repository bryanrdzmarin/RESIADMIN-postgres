<table id="tabla-extranjeros"
    class="border-collapse border border-gray-400 w-full text-left mb-4"
    style="{{ isset($busquedaOrigen) && $busquedaOrigen !== 'extranjeros' ? 'display: none;' : '' }}">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2 text-center">CI</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Nombre</th>
            <th class="border border-gray-300 px-4 py-2 text-center">No Pasaporte</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Fecha de Nacimiento</th>
            <th class="border border-gray-300 px-4 py-2 text-center">No Apto</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Residencia</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Carrera</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Año de Carrera</th>
            <th class="border border-gray-300 px-4 py-2 text-center">País</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Dirección embajada</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Año de entrada</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Eval. Jefe Residencia</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Eval. Jefe Apto</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Eval. Profesor</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Eval. Relaciones Internacionales</th>
            <th class="border border-gray-300 px-4 py-2 text-center">Evaluación final</th>
        </tr>
    </thead>
    <tbody>
        @if($becados === null || $becados->isEmpty())
            <tr class="odd:bg-white even:bg-gray-100">
                <td colspan="16" class="border border-gray-300 px-4 py-2 text-center">
                    No hay datos para mostrar en este momento.
                </td>
            </tr>
        @else
            @foreach($becados as $extranjero)
                <tr class="odd:bg-white even:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->ci ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->nombre ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->numero_pasaporte ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->fecha_nacimiento ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->apto?->numero ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->residencia?->nombre ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->carrera ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->year_carrera ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->pais ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->direccion_embajada ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->year_entrada ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->evaluacion_jefe_residencia ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->evaluacion_jefe_apto ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->evaluacion_profesor ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->evaluacion_jefe_relaciones_internacionales ?? '—' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $extranjero->becado?->evaluacion_final ?? '—' }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>