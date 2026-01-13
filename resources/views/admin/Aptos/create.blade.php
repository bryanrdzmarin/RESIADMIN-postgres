<x-layouts.app>

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.residencias.index') }}">Residencias</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Agregar Apto</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    
    <div class="card">
        <form action="{{ route('admin.aptos.store', [$residencia->id]) }}"method="POST" class="space-y-2">
            
            @csrf
            
            <flux:input label=" ID residencia:" type="text" name="residencias_id" value="{{$residencia->id}}" readonly />
            <flux:input label="Nombre residencia:" type="text" name="residencia_nombre" value="{{$residencia->nombre}}" readonly />
            <flux:input label="Numero:" type="number" name="numero" value="{{old('numero')}}" min="0" />
            <flux:input label="Capacidad:" type="number" name="capacidad" value="{{old('capacidad')}}" min="1" />
            <flux:input label="Jefe de apartamento:" type="text" name="jefe_apartamento" value="{{old('jefe_apartamento')}}"/>
            <flux:input label="Profesor asignado:" type="text" name="profesor_asignado" value="{{old('profesor_asignado')}}" />
        
           <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Guardar</flux:button>
                <a href="{{route('admin.residencias.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                    Cancelar
                </a>
            </div>
            
        </form>
    </div>
   

</x-layouts.app>


