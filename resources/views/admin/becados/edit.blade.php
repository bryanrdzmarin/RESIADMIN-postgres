
<x-layouts.app >
    @if (isset($origen) && $origen === 'becados')
       <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.becados.index') }}">Becados</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    @elseif ($origen === 'todos')
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.index') }}">Aptos</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.becadosAsociados', ['apto'=>$becado->aptos_id,'origen'=>'todos' ]) }}">Ver becados</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
            </flux:breadcrumbs>
    @elseif ($origen === 'ocupados')
            <div class="mb-5 flex justify-between items-center">
                <flux:breadcrumbs>
                    <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item href="{{ route('admin.aptos.indexOcupados') }}">Aptos Ocupados</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item href="{{ route('admin.aptos.becadosAsociados', ['apto'=>$becado->aptos_id,'origen'=>'ocupados' ]) }}">Ver becados</flux:breadcrumbs.item>
                     <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
                </flux:breadcrumbs>
            </div>
    @elseif ($origen === 'extranjeros')
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.becados.index') }}">Becados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.becados.indexExtranjeros') }}">Becados Extranjeros</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @elseif ($origen === 'nacionales')
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.becados.index') }}">Becados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.becados.indexNacionales') }}">Becados Nacionales</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @endif
    
    
    <div class="card">
    <form action="{{ route('admin.becados.update', ['becados'=>$becado->ci, 'origen'=>$origen]) }}" method="POST">
        @csrf
        @method('PUT')

        <flux:input class="mb-2" label="Nombre y apellidos:" type="text" name="nombre"  required value="{{ old('nombre', $becado->nombre) }}" />
        <flux:input class="mb-2" label="Carnet de Identidad:" type="text" name="ci" required value="{{ old('ci', $becado->ci) }}"/>
        <flux:input class="mb-2" type="date" max="2999-12-31" label="Fecha de nacimiento:" name="fecha_nacimiento" required value="{{ old('fecha_nacimiento',  $becado->fecha_nacimiento) }}" />
        
        <flux:label class="mb-4">Año carrera:</flux:label>
        <div class="flux-select-container relative w-full mt-2 mb-2 ">
            <select name="year_carrera" id="year_carrera" class="flux-select" required>
               <option value="primero" {{ strtolower(old('year_carrera', $becado->year_carrera)) == 'primero' ? 'selected' : '' }}>Primero</option>
               <option value="segundo" {{ strtolower(old('year_carrera', $becado->year_carrera)) == 'segundo' ? 'selected' : '' }}>Segundo</option>
               <option value="tercero" {{ strtolower(old('year_carrera', $becado->year_carrera)) == 'tercero' ? 'selected' : '' }}>Tercero</option>
               <option value="cuarto" {{ strtolower(old('year_carrera', $becado->year_carrera)) == 'cuarto' ? 'selected' : '' }}>Cuarto</option>
            </select>
            <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700 pointer-events-none"></i>
        </div>

        <flux:label class="mb-4">Programa Académico:</flux:label>
        <div class="flux-select-container relative w-full mt-2"> 
           <select name="programasAcademicos" id="programasAcademicos" class="flux-select" required>
                @foreach ($programasAcademicos as $programa)
                    <option value="{{ $programa }}" {{ strtolower(trim(old('programasAcademicos', $becado->carrera))) == strtolower(trim($programa)) ? 'selected' : '' }}>
                        {{ $programa }}
                    </option>
                @endforeach
            </select>
            <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700 pointer-events-none"></i>
        </div>


        @if ($becadoNacional)
            <div class="mt-2 mb-2">
                <flux:label>Procedencia:</flux:label>
                <input type="radio" id="nacional" name="nacionalidad" value="nacional" class="custom-radio" checked required>
                <flux:label for="nacional" class="flux-label">Nacional</flux:label>
            </div>
        @else
            <div class="mt-2 mb-2">    
                <flux:label>Procedencia:</flux:label>
                <input type="radio" id="extranjero" name="nacionalidad" value="extranjero" class="custom-radio" checked required>
                <flux:label for="extranjero" class="flux-label">Extranjero</flux:label>
            </div>
       @endif  
    
        @if ($becadoNacional)
            <div id="divNacional" style="display: block;">
                <flux:input label="Dirección:" type="text" name="direccion"  value="{{ old('direccion', $becadoNacional->direccion) }}" />
            </div>
        @endif
    
        @if ($becadoExtranjero)
            <div id="divExtranjero" style="display: block;">
                <flux:input class="mb-2" label="País:" type="text" name="pais"  value="{{ old('pais', $becadoExtranjero->pais) }}"/>
                <flux:input class="mb-2" label="No pasaporte:" type="text" name="pasaporte"  value="{{ old('pasaporte', $becadoExtranjero->numero_pasaporte) }}" />
                <flux:input class="mb-2" label="Dirección de embajada:" name="direccion_embajada"  value="{{ old('direccion_embajada', $becadoExtranjero->direccion_embajada) }}" />
                <flux:input class="mb-2" label="Año de entrada al país:" type="number" name="year_entrada"  value="{{ old('year_entrada', $becadoExtranjero->year_entrada) }}" />
            </div>
        @endif
    
       <div class="mb-4 mt-2">
            <flux:label class="mb-4">Agregar evaluación:</flux:label>

            <input type="radio" id="evaluacion_si" name="evaluacion" value="Si" required class="custom-radio">
            <flux:label for="evaluacion_si" class="flux-label">Sí</flux:label>
            
            <input type="radio" id="evaluacion_no" name="evaluacion" value="No" required class="custom-radio">
            <flux:label for="evaluacion_no" class="flux-label"  id="evaluacion_no_label">No</flux:label>
           
            

        </div>
        
       <div id="divEvaluacion" class="mt-2" style="display: none;" >
            <flux:input class="mb-2" label="Evaluación del jefe de residencia:" type="number" min="2" max="5" name="evaluacion_jefe_residencia"   value="{{ old('evaluacion_jefe_residencia', $becado->evaluacion_jefe_residencia ?? '') }}"/>
            <flux:input class="mb-2" label="Evaluación del jefe de apto:" type="number" min="2" max="5" name="evaluacion_jefe_apto"  value="{{ old('evaluacion_jefe_apto', $becado->evaluacion_jefe_apto ?? '') }}"/>
            <flux:input class="mb-2" label="Evaluación del profesor:" type="number" min="2" max="5" name="evaluacion_profesor" value="{{ old('evaluacion_profesor', $becado->evaluacion_profesor ?? '') }}"/>
        </div>
        
        <div id="divEvaluacionExtranjeros" style="display: {{ (old('evaluacion', 'No') == 'Si' && old('nacionalidad', 'nacional') == 'extranjero') ? 'block' : 'none' }};">
            <flux:input  class="mb-2" label="Evaluación del jefe de relaciones internacionales:" type="number" min="2" max="5" name="evaluacion_jefe_relaciones_internacionales"   value="{{ old('evaluacion_jefe_relaciones_internacionales', $becadoExtranjero->evaluacion_jefe_relaciones_internacionales ?? '') }}"/>
        </div>        

        <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Editar</flux:button>
                @if (isset($origen) && $origen === 'becados')
                    <a href="{{route('admin.becados.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'todos')
                    <a href="{{route('admin.aptos.becadosAsociados', ['apto'=>$becado->aptos_id,'origen'=>'todos' ]) }}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'ocupados')
                    <a href="{{route('admin.aptos.becadosAsociados', ['apto'=>$becado->aptos_id,'origen'=>'ocupados' ]) }}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'extranjeros')

                    <a href="{{ route('admin.becados.indexExtranjeros') }}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'nacionales')
                
                    <a href="{{ route('admin.becados.indexNacionales') }}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @endif
        </div>

    </form>

    
    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var becado = @json($becado);
                console.log(becado);
                var origen = becado.origen ?? "";
                var evaluacion_final = becado.evaluacion_final ?? null;

                console.log("Origen:", origen);
                console.log("Evaluación Final:", evaluacion_final);
                
                var evaluacionSi = document.getElementById("evaluacion_si");
                var evaluacionNo = document.getElementById("evaluacion_no");
                var evaluacionNoLabel = document.getElementById("evaluacion_no_label");
                var divEvaluacion = document.getElementById("divEvaluacion");
                var divEvaluacionExtranjeros = document.getElementById("divEvaluacionExtranjeros");

                if (evaluacion_final!=null ) {
                    evaluacionSi.checked = true; // Seleccionar automáticamente "No"
                    evaluacionNo.style.display = "none";
                    evaluacionNoLabel.style.display = "none";
                    if (origen==="Nacional") {
                        divEvaluacion.style.display = "block";
                        divEvaluacionExtranjeros.style.display = "none";
                    } else if(origen==="Extranjero"){
                        divEvaluacion.style.display = "block";
                        divEvaluacionExtranjeros.style.display = "block";
                    }
                }
                if(evaluacion_final===null){
                    evaluacionNo.checked = true;
                }


                document.querySelectorAll('input[name="evaluacion"]').forEach((input) => {
                    input.addEventListener('change', function() {
                        if (this.value === 'Si' && origen==="Extranjero" ) {
                            document.getElementById('divEvaluacion').style.display = 'block';
                            document.getElementById('divEvaluacionExtranjeros').style.display = 'block';
                        } else if(this.value === 'Si' && origen==="Nacional" ) {
                            document.getElementById('divEvaluacion').style.display = 'block';
                            document.getElementById('divEvaluacionExtranjeros').style.display = 'none';
                        }else if(this.value === 'No') {
                            document.getElementById('divEvaluacion').style.display = 'none';
                            document.getElementById('divEvaluacionExtranjeros').style.display = 'none';
                        }
                    });
                })
            });                 
         </script>

    @endpush
    
</x-layouts.app>
