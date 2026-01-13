
<x-layouts.app >
    @if (isset($origen) && $origen === 'residencias')
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.residencias.index') }}">Residencias</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.residencias.aptosAsociados',[$apto->residencias_id]) }}">Ver Aptos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item >Editar</flux:breadcrumbs.item>      
        </flux:breadcrumbs>
        
    @elseif ($origen === 'todos')
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.aptos.index') }}">Aptos</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @elseif ($origen === 'ocupados')
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.aptos.indexOcupados') }}">Aptos Ocupados</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @elseif ($origen === 'disponibles')
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('admin.aptos.indexDisponibles') }}">Aptos Disponibles</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    @endif
    
   
    <div class="card">
        <form action="{{ route('admin.aptos.update', ['apto'=>$apto->id,'origen' => $origen]) }}"method="POST" class="space-y-2">
            
            @csrf
            @method('PUT')
            
            <flux:input label=" ID residencia:" type="text" name="residencias_id" value="{{$apto->residencias_id}}" readonly />
            <flux:input label="Nombre residencia:" type="text" name="residencia_nombre" value="{{$apto->residencia->nombre}}" readonly />
            <flux:input label="Numero:" type="number" name="numero" value="{{old('numero',$apto->numero)}}" min="0" />
            <flux:input label="Capacidad:" type="number" name="capacidad" value="{{old('capacidad',$apto->capacidad)}}" min="1" />
            <flux:input label="Jefe de apartamento:" type="text" name="jefe_apartamento" value="{{old('jefe_apartamento',$apto->jefe_apartamento)}}"/>
            <flux:input label="Profesor asignado:" type="text" name="profesor_asignado" value="{{old('profesor_asignado',$apto->profesor_asignado)}}" />
        
           <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Editar</flux:button>

                @if (isset($origen) && $origen === 'residencias')
                    <a href="{{route('admin.residencias.aptosAsociados',[$apto->residencias_id])}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'todos')
                    <a href="{{route('admin.aptos.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'ocupados')
                    <a href="{{route('admin.aptos.indexOcupados')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @elseif ($origen === 'disponibles')
                    <a href="{{route('admin.aptos.indexDisponibles')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @endif
         
            </div>
            
        </form>
    </div>
   
</x-layouts.app>