<x-layouts.app >

    @if(isset($modoEspecifico))
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.aptos.index') }}">Aptos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Agregar Becado</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @else
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.becados.index') }}">Becados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Agregar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @endif
   
    
    <div class="card">
        <form action="{{ route('admin.becados.store') }}" method="POST" class="space-y-2">
            @csrf

            <flux:input label="Nombre y apellidos:" type="text" name="nombre"  required value="{{ old('nombre') }}" />
            <flux:input label="Carnet de Identidad:" type="text" name="ci" required value="{{old('ci')}}"/>
            <flux:input type="date" max="2999-12-31" label="Fecha de nacimiento:" name="fecha_nacimiento" required value="{{old('fecha_nacimiento')}}" />

            <flux:label class="mb-4">Año carrera:</flux:label>
            <div class="flux-select-container relative w-full mt-2 ">
              <select name="year_carrera" id="year_carrera" class="flux-select" required>
                <option value="">Seleccione una opción</option>
                    <option value="primero" {{ old('year_carrera') == 'primero' ? 'selected' : '' }}>Primero</option>
                    <option value="segundo" {{ old('year_carrera') == 'segundo' ? 'selected' : '' }}>Segundo</option>
                    <option value="tercero" {{ old('year_carrera') == 'tercero' ? 'selected' : '' }}>Tercero</option>
                    <option value="cuarto" {{ old('year_carrera') == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700 pointer-events-none"></i>
            </div>
       

            <flux:label class="mb-4">Programa Académico:</flux:label>
            <div class="flux-select-container relative w-full mt-2"> 
                <select name="programasAcademicos" id="programasAcademicos" class="flux-select" required>
                    <option value="">Seleccione una opción</option>
                    @foreach ($programasAcademicos as $programa)
                        <option value="{{ $programa }}" {{ old('programasAcademicos') == $programa ? 'selected' : '' }} class="flux-select-option">
                            {{ $programa }}
                        </option>
                    @endforeach
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700 pointer-events-none"></i>
            </div>

            <flux:label class="mb-4">Residencia:</flux:label>
            <div class="flux-select-container relative w-full mt-2"> 
                <select name="residencia" id="residencia" @if(isset($modoEspecifico)) disabled @endif required class="flux-select" required>
                    <option value="">Seleccione una opción</option>
                    @foreach ($residenciasDisponibles as $residencia)
                        <option value="{{ $residencia->id  }}" @if(isset($aptoSeleccionado) || old('residencia') == $residencia->id) selected @endif class="flux-select-option">
                            {{ $residencia->nombre }}
                        </option>
                    @endforeach
                </select>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700 pointer-events-none"></i>
            </div>

               @if(isset($modoEspecifico))
                    <input type="hidden" name="residencia" value="{{ $residencia->id }}">
                @endif

            <flux:label class="mb-4">Apto:</flux:label>
            <div class="flux-select-container relative w-full mt-2">
                <select id="aptos" name="apto" @if(isset($modoEspecifico)) disabled @endif required class="flux-select">
                    @if(old('apto') || isset($aptoSeleccionado))
                        {{-- Prioridad 1: Valor de old() si existe (error de validación) --}}
                        @php
                            $aptoId = old('apto') ?? $aptoSeleccionado->id;
                            $aptoNumero = old('apto') ? 'Apto ' . old('apto') : 'Apto ' . $aptoSeleccionado->numero;
                        @endphp
                        <option value="{{ $aptoId }}" selected class="flux-select-option">{{ $aptoNumero }}</option>
                    @else
                        {{-- Opción por defecto --}}
                        <option value="" class="flux-select-option">Seleccione una opción</option>
                    @endif
                </select>

                @if(isset($modoEspecifico))
                    <input type="hidden" name="apto" value="{{ $aptoSeleccionado->id }}">
                @endif
            </div>
            

            <div>
                <flux:label class="mb-4">Procedencia:</flux:label>
                <input type="radio" id="nacional" name="nacionalidad" value="nacional" class="custom-radio" checked required>
                <flux:label for="nacional" class="flux-label">Nacional</flux:label>

                <input type="radio" id="extranjero" name="nacionalidad" value="extranjero" class="custom-radio" {{ old('nacionalidad') == 'extranjero' ? 'checked' : '' }} required>
                <flux:label for="extranjero" class="flux-label">Extranjero</flux:label>


            </div>

            <div id="divNacional" style="display: {{ old('nacionalidad', 'nacional') == 'nacional' ? 'block' : 'none' }};">
                <flux:input label="Dirección:" type="text" name="direccion"  value="{{old('direccion')}}" />
            </div>

           <div id="divExtranjero" style="display: {{ old('nacionalidad', 'nacional') == 'extranjero' ? 'block' : 'none' }};">
                <flux:input class="mb-2" label="País:" type="text" name="pais"  value="{{old('pais')}}"/>
                <flux:input class="mb-2" label="No pasaporte:" type="text" name="pasaporte"  value="{{old('pasaporte')}}" />
                <flux:input class="mb-2" label="Dirección de embajada:" name="direccion_embajada" value="{{old('direccion_embajada')}}" />
                <flux:input class="mb-2" label="Año de entrada al país:" type="number" name="year_entrada"  value="{{old('year_entrada')}}" />
            </div>
    
            <div class="mb-4">
                <flux:label class="mb-4">Agregar evaluación:</flux:label>
                <input type="radio" id="evaluacion_si" name="evaluacion" value="Si" class="custom-radio" {{ old('evaluacion') == 'Si' ? 'checked' : '' }}>
                <flux:label for="evaluacion_si" class="flux-label">Sí</flux:label>
                            
                <input type="radio" id="evaluacion_no" name="evaluacion" value="No" class="custom-radio" {{ old('evaluacion', 'No') == 'No' ? 'checked' : '' }}>
                <flux:label for="evaluacion_no" class="flux-label">No</flux:label>
            </div>
             
           <div id="divEvaluacion" style="display: {{ old('evaluacion', 'No') == 'Si' ? 'block' : 'none' }};" class="mt-2">
                <flux:input class="mb-2" label="Evaluación del jefe de residencia:" type="number" min="2" max="5" name="evaluacion_jefe_residencia"  value="{{old('evaluacion_jefe_residencia')}}"/>
                <flux:input class="mb-2" label="Evaluación del jefe de apto:" type="number" min="2" max="5" name="evaluacion_jefe_apto" value="{{old('evaluacion_jefe_apto')}}"/>
                <flux:input label="Evaluación del profesor:" type="number" min="2" max="5" name="evaluacion_profesor" value="{{old('evaluacion_profesor')}}"/>
            </div>

           <div id="divEvaluacionExtranjeros" style="display: {{ (old('evaluacion', 'No') == 'Si' && old('nacionalidad', 'nacional') == 'extranjero') ? 'block' : 'none' }};" class="mt-2">
                <flux:input label="Evaluación del jefe de relaciones internacionales:" type="number" min="2" max="5" name="evaluacion_jefe_relaciones_internacionales"  value="{{old('evaluacion_jefe_relaciones_internacionales')}}"/>
            </div>
           

            


            <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Guardar</flux:button>
                 @if(isset($modoEspecifico))
                    <a href="{{route('admin.aptos.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @else
                    <a href="{{route('admin.becados.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @endif
            </div>
        </form>
   
    </div>
 @push('js')

 <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Solo ejecutar si no estamos en modo específico
        if (!document.getElementById('aptos').hasAttribute('disabled')) {
            var residenciaSelect = document.getElementById("residencia");
            var aptosSelect = document.getElementById("aptos");

            var residencias = @json($residenciasDisponibles->mapWithKeys(function ($residencia) {
                return [$residencia->id => $residencia->aptos->map(function ($apto) {
                    return ['id' => $apto->id, 'numero' => $apto->numero];
                })];
            }));

            residenciaSelect.addEventListener("change", function () {
                var seleccion = residenciaSelect.value;
                aptosSelect.innerHTML = '<option value="">Seleccione una opción</option>';

                if (residencias[seleccion]) {
                    residencias[seleccion].forEach(function (apto) {
                        var opcion = document.createElement("option");
                        opcion.text = "Apto " + apto.numero;
                        opcion.value = apto.id;
                        aptosSelect.add(opcion);
                    });
                }
            });
        }
    });
    document.querySelectorAll('input[name="nacionalidad"]').forEach((input) => {
        input.addEventListener('change', function() {
            if (this.value === 'nacional'&& document.getElementById('evaluacion_si').checked=== true) {
                document.getElementById('divNacional').style.display = 'block';
                document.getElementById('divExtranjero').style.display = 'none';
                document.getElementById('divEvaluacion').style.display = 'block';
                document.getElementById('divEvaluacionExtranjeros').style.display = 'none';
            }else  if (this.value === 'nacional') {
                document.getElementById('divNacional').style.display = 'block';
                document.getElementById('divExtranjero').style.display = 'none';
            } else if(this.value === 'extranjero' && document.getElementById('evaluacion_si').checked=== true ){
                document.getElementById('divNacional').style.display = 'none';
                document.getElementById('divExtranjero').style.display = 'block';
                document.getElementById('divEvaluacion').style.display = 'block';
                document.getElementById('divEvaluacionExtranjeros').style.display = 'block';
            }else {
                document.getElementById('divNacional').style.display = 'none';
                document.getElementById('divExtranjero').style.display = 'block';
            }
        });
    });


    document.querySelectorAll('input[name="evaluacion"]').forEach((input) => {
        input.addEventListener('change', function() {
            if (this.value === 'Si' && document.getElementById('extranjero').checked=== true ) {
                document.getElementById('divEvaluacion').style.display = 'block';
                document.getElementById('divEvaluacionExtranjeros').style.display = 'block';
            } else if(this.value === 'Si' && document.getElementById('nacional').checked=== true ) {
                document.getElementById('divEvaluacion').style.display = 'block';
                document.getElementById('divEvaluacionExtranjeros').style.display = 'none';
            }else  {
                document.getElementById('divEvaluacion').style.display = 'none';
                document.getElementById('divEvaluacionExtranjeros').style.display = 'none';
            }
        });
    });
 </script>
     
 @endpush
    
</x-layouts.app>


