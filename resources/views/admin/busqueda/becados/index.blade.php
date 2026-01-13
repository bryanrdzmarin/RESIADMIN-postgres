<x-layouts.app>
        <form action="{{route('admin.busqueda.becados.indexBecadosMostrar')}}" method="GET" class="mb-4">
            <div class="grid grid-cols-6 gap-2 items-end">

                <flux:input placeholder="Carnet de identidad" type="text" min="1" max="11" name="ci"
                    value="{{ isset($busquedaCI) ? $busquedaCI : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="Nombre y apellidos" type="text" name="nombre"
                    value="{{ isset($busquedaNombre) ? $busquedaNombre : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="Fecha de nacimiento" type="date" name="fecha_nacimiento"
                    value="{{ isset($busquedaFechaNacimiento) ? $busquedaFechaNacimiento : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <div class="border border-gray-300 rounded px-2 py-[4px] w-full">
                    <flux:select name="year_carrera" class="w-full bg-white appearance-none">
                        <option value="">Seleccionar año</option>
                        <option value="primero" {{ isset($busquedaYearCarrera) && $busquedaYearCarrera == 'primero' ? 'selected' : '' }}>Primero</option>
                        <option value="segundo" {{ isset($busquedaYearCarrera) && $busquedaYearCarrera == 'segundo' ? 'selected' : '' }}>Segundo</option>
                        <option value="tercero" {{ isset($busquedaYearCarrera) && $busquedaYearCarrera == 'tercero' ? 'selected' : '' }}>Tercero</option>
                        <option value="cuarto" {{ isset($busquedaYearCarrera) && $busquedaYearCarrera == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                    </flux:select>
                </div>

                <flux:input placeholder="Nombre residencia" type="text" name="nombreResidencia"
                    value="{{ isset($busquedaNombreResidencia) ? $busquedaNombreResidencia : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="No aptos" type="number" name="NoAptos"
                    value="{{ isset($busquedaNoAptos) ? $busquedaNoAptos : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="Carrera" type="text" name="carrera"
                    value="{{ isset($busquedaCarrera) ? $busquedaCarrera : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <div class="border border-gray-300 rounded px-2 py-[4px] w-full">
                    <flux:select name="origen" id="selectOrigen" class="w-full bg-white appearance-none" required>
                        <option value="todos" {{ isset($busquedaOrigen) && $busquedaOrigen == 'todos' ? 'selected' : '' }}>Todos</option>
                        <option value="nacionales" {{ isset($busquedaOrigen) && $busquedaOrigen == 'nacionales' ? 'selected' : '' }}>Nacionales</option>
                        <option value="extranjeros" {{ isset($busquedaOrigen) && $busquedaOrigen == 'extranjeros' ? 'selected' : '' }}>Extranjeros</option>
                    </flux:select>
                </div>

                <flux:input placeholder="Eval. Jefe Residencia" type="number" name="evaluacion_jefe_residencia" min="1" max="5"
                    value="{{ isset($busquedaEvaluacionJefeResidencia) ? $busquedaEvaluacionJefeResidencia : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="Eval. Jefe Apto" type="number" name="evaluacion_jefe_apto" min="1" max="5"
                    value="{{ isset($busquedaEvaluacionJefeApto) ? $busquedaEvaluacionJefeApto : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="Eval. Profesor" type="number" name="evaluacion_profesor" min="1" max="5"
                    value="{{ isset($busquedaEvaluacionProfesor) ? $busquedaEvaluacionProfesor : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <flux:input placeholder="Evaluación final" type="text" name="evaluacion_final"
                    value="{{ isset($busquedaEvaluacionFinal) ? $busquedaEvaluacionFinal : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />

                <div id="camposNacionales" class="hidden col-span-1">
                    <flux:input placeholder="Dirección" type="text" name="direccion"
                        value="{{ isset($busquedaDireccion) ? $busquedaDireccion : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />
                </div>

                <div id="camposExtranjeros" class="hidden col-span-6 grid grid-cols-6 gap-2">
                    <flux:input placeholder="Número de pasaporte" type="text" name="numero_pasaporte"
                        value="{{ isset($busquedaNumeroPasaporte) ? $busquedaNumeroPasaporte : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />
                    <flux:input placeholder="País" type="text" name="pais"
                        value="{{ isset($busquedaPais) ? $busquedaPais : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />
                    <flux:input placeholder="Dirección de embajada" type="text" name="direccion_embajada"
                        value="{{ isset($busquedaDireccionEmbajada) ? $busquedaDireccionEmbajada : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />
                    <flux:input placeholder="Año de entrada" type="number" name="year_entrada" min="1900" max="2100"
                        value="{{ isset($busquedaYearEntrada) ? $busquedaYearEntrada : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />
                    <flux:input placeholder="Eval. Relaciones Internacionales" type="number" name="evaluacion_jefe_relaciones_internacionales" min="1" max="5"
                        value="{{ isset($busquedaEvaluacionJefeRI) ? $busquedaEvaluacionJefeRI : '' }}" class="px-2 py-1 border border-gray-300 rounded w-full" />
                </div>

                {{-- Botón de búsqueda al final, alineado --}}
                <div class="col-span-6 flex justify-end">
                    <flux:button class="text-white font-semibold py-2 px-4 rounded w-28 h-10" type="submit" variant="primary" color="teal">
                        <i class="fas fa-search mr-1"></i> Buscar
                    </flux:button>
                </div>
            </div>
        </form>

    <div class="overflow-x-auto mb-4">
       @if(isset($busquedaOrigen))
            @if($busquedaOrigen === 'todos')
                @include('admin.busqueda.becados.tabla-todos')
            @elseif($busquedaOrigen === 'nacionales')
                @include('admin.busqueda.becados.tabla-nacionales')
            @elseif($busquedaOrigen === 'extranjeros')
                @include('admin.busqueda.becados.tabla-extranjeros')
            @endif
        @else
            {{-- Modo sin búsqueda: JS controla qué tabla se muestra --}}
            @include('admin.busqueda.becados.tabla-todos')
            @include('admin.busqueda.becados.tabla-nacionales')
            @include('admin.busqueda.becados.tabla-extranjeros')
        @endif
        
    </div>


    @if ($becados!= null)
        <div>
            {{ $becados->links() }}
        </div>
    @endif

    @push('js')
       <script>
            document.addEventListener('DOMContentLoaded', function () {
                const origenSelect = document.getElementById('selectOrigen');
                const camposNacionales = document.getElementById('camposNacionales');
                const camposExtranjeros = document.getElementById('camposExtranjeros');

                function actualizarVisibilidad() {
                    const valor = origenSelect.value;

                    camposNacionales.classList.add('hidden');
                    camposExtranjeros.classList.add('hidden');

                    if (valor === 'nacionales') {
                        camposNacionales.classList.remove('hidden');
                    } else if (valor === 'extranjeros') {
                        camposExtranjeros.classList.remove('hidden');
                    }
                    // Si es "todos", no mostramos ninguno
                }

                actualizarVisibilidad(); // al cargar
                origenSelect.addEventListener('change', actualizarVisibilidad); // al cambiar
            });

            document.addEventListener('DOMContentLoaded', function () {
                const select = document.getElementById('selectOrigen');
                const tablaTodos = document.getElementById('tabla-todos');
                const tablaNacionales = document.getElementById('tabla-nacionales');
                const tablaExtranjeros = document.getElementById('tabla-extranjeros');

                function mostrarTablaCorrespondiente() {
                    const valor = select.value;

                    tablaTodos.style.display = valor === 'todos' ? '' : 'none';
                    tablaNacionales.style.display = valor === 'nacionales' ? '' : 'none';
                    tablaExtranjeros.style.display = valor === 'extranjeros' ? '' : 'none';
                }

                select.addEventListener('change', mostrarTablaCorrespondiente);
                mostrarTablaCorrespondiente(); // Ejecuta al cargar la página según valor actual
            });

        </script>
    @endpush
</x-layouts.app>