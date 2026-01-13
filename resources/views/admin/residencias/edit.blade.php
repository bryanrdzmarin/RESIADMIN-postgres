
<x-layouts.app >

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('admin.residencias.index') }}">Residencias</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    
    <div class="card">

        <form action={{route('residencias.update',[$residencia->id]) }} method="POST" class="space-y-2">

            @csrf
            @method('PUT')

            <flux:input label="Nombre:" type="text" name="nombre" value="{{old('nombre', $residencia->nombre)}}"/>
            <flux:input label="Cantidad de apartamentos:" type="number" name="cantidad_aptos" value="{{old('cantidad_aptos', $residencia->cantidad_aptos)}}" min="1"  />
            <flux:input label="Jefe de consejo de residencia:" type="text" name="jefe_consejo_residencia" value="{{old('jefe_consejo_residencia', $residencia->jefe_consejo_residencia)}}" />
            <flux:input label="Profesor asignado:" type="text" name="profesor_asignado" value="{{old('profesor_asignado',$residencia->profesor_asignado)}}" />
           
           <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Editar</flux:button>
                <a href="{{route('admin.residencias.index')}}" class="flux-button flux-button-primary text-xs" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                    Cancelar
                </a>
            </div>
        
        </form>
    </div>

</x-layouts.app>

