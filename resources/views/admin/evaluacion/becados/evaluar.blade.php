<x-layouts.app >

    @if (isset($origen) && $origen === 'aptos')
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.evaluar.aptos.indexEvaluacion') }}">Aptos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.evaluar.aptos.becadosAsociadosEvalucion', ['apto' => $becado->aptos_id]) }}">Becados asociados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @elseif ($origen === 'becados')
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.evaluar.becados.indexbecadosEvaluacion') }}">Becados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @elseif ($origen === 'extranjeros')
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.evaluar.becados.indexbecadosExtranjerosEvaluacion') }}">Becados Extranjeros</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @elseif ($origen === 'nacionales')
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluaciones</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.evaluar.becados.indexbecadosNacionalesEvaluacion') }}">Becados Nacionales</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Evaluar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @endif

    <div class="card">
       <form action="{{ route('evaluar.becados.storeEvaluacion', ['becado' => $becado->ci, 'origen' => $origen]) }}" method="POST">
            @csrf
            <flux:input class="mb-2" label="Nombre y apellidos:" type="text" name="nombre"  required value="{{old('nombre', $becado->nombre)}}" readonly/>
            <flux:input class="mb-2" label="Carnet de Identidad:" type="text" name="ci" required value="{{old('ci', $becado->ci)}}" readonly/>
            <flux:input class="mb-2" label="Evaluación del profesor:" type="number" min="2" max="5" name="evaluacion_profesor" required value="{{old('evaluacion_profesor')}}"/>
            <flux:input class="mb-2" label="Evaluación del Jefe de Apto:" type="number" min="2" max="5" name="evaluacion_jefe_apto" required value="{{old('evaluacion_jefe_apto')}}"/>
            <flux:input class="mb-2" label="Evaluacion del Jefe de Residencia:" type="number" min="2" max="5" name="evaluacion_jefe_residencia" required value="{{old('evaluacion_jefe_residencia')}}"/>
                
            @if ($becado->origen === 'Extranjero')
                <flux:input class="mb-2" label="Evaluación del Jefe de Relaciones Internacionales:" type="number" min="2" max="5" name="evaluacion_jefe_relaciones_internacionales" required value="{{old('evaluacion_jefe_relaciones_internacionales')}}" />
            @endif

            <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Evaluar</flux:button>

                @if ($origen === 'aptos')
                    <a href="{{ route('admin.evaluar.aptos.becadosAsociadosEvalucion', ['apto' => $becado->aptos_id])}}" class="flux-button flux-button-primary"
                        style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'becados')
                    <a href="{{ route('admin.evaluar.becados.indexbecadosEvaluacion') }}" class="flux-button flux-button-primary"
                        style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'extranjeros')
                    <a href="{{ route('admin.evaluar.becados.indexbecadosExtranjerosEvaluacion') }}" class="flux-button flux-button-primary"
                        style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'nacionales')
                    <a href="{{ route('admin.evaluar.becados.indexbecadosNacionalesEvaluacion') }}" class="flux-button flux-button-primary"
                        style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @endif
                
            </div>
        </form>
    </div>

</x-layouts.app>
