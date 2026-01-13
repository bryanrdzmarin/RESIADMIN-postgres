<x-layouts.app>
    @if (isset($origen) && $origen === 'todos')
        <div class="mb-5 flex justify-between items-center">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.index') }}">Aptos</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Gestión de Reubicación</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>
    @else
        <div class="mb-5 flex justify-between items-center">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">Dashboard</flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('admin.aptos.indexDisponibles') }}">Aptos Disponibles</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Gestión de Reubicación</flux:breadcrumbs.item>
            </flux:breadcrumbs>
         </div>
    @endif

    @if ($becado === null)
        <div class="card mb-5">
            <form action="{{route('admin.aptos.showCI',['apto'=>$apto->id, 'origen'=>$origen])}}" method="GET">
                @csrf          
                <flux:input 
                    label="Ingrese el Carnet de Identidad del becado que desea reubicar a este apto:" 
                    icon="magnifying-glass" 
                    placeholder="Escriba aquí el número de identificación..." 
                    type="text" 
                    name="busqueda" 
                    value="{{ $busqueda ?? '' }}" 
                    maxlength="11"
                    minlength="11"
                />
                <div class="flex justify-end space-x-3 mt-4 mr-8">
                    <flux:button variant="primary" type="submit">Buscar</flux:button>
                </div>

            </form>
        </div>
    @else
        <div class="card">
        <form action="{{route('admin.aptos.reubicandoBecado',[$apto->id, 'origen'=>$origen])}}" method="POST">
            @csrf
            
                <flux:input class="mb-2" label="Nombre Residencia:" type="text" name="residencia_name" value="{{$apto->residencia->nombre}}"  readonly />
                <flux:input class="mb-2" label="No apto:" type="text" name="numero" value="{{$apto->numero}}"  readonly  readonly />
                <flux:input class="mb-2" label="Nombre y apellidos:" type="text" name="nombre" value="{{ $becado[0]->nombre ?? '' }}"  readonly />
                <flux:input class="mb-2" label="Carnet de Identidad:" type="text" name="ci" value="{{ $becado[0]->ci ?? '' }}"   readonly />
                <flux:input class="mb-2" label="Origen:" type="text" name="origen"  value="{{ $becado[0]->origen ?? '' }}" readonly />
                <flux:input class="mb-2" label="Carrera:" type="text" name="carrera"  value="{{ $becado[0]->carrera ?? '' }}" readonly />
        

            <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Reubicar</flux:button>
                 @if (isset($origen) && $origen === 'todos')
                    <a href="{{route('admin.aptos.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @else
                    <a href="{{route('admin.aptos.indexDisponibles')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                        Cancelar
                    </a>
                @endif
                
            </div>
        </form>
    </div>
    @endif
   
    

</x-layouts.app>