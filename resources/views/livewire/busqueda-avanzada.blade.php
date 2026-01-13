@php
    use Illuminate\Support\Str;
    $rutaBloqueada = Str::startsWith(request()->route()->getName(), 'admin.busqueda');
@endphp

<div>
    <flux:navlist.item icon="magnifying-glass-circle" href="javascript:void(0)" :current="request()->routeIs('admin.busqueda.*')">
        <button
            @unless($rutaBloqueada) wire:click="toggle" @endunless
            class="flex items-center justify-between w-full {{ $rutaBloqueada ? 'cursor-default opacity-60' : '' }}"
        >
            <span>Búsqueda Avanzada</span>
            <i class="{{ $open ? 'fa fa-angle-up' : 'fa fa-angle-down' }} ml-auto mr-2" aria-hidden="true"></i>
        </button>
    </flux:navlist.item>

    @if ($open)
        <div class="pl-4">
            <flux:navlist.item icon="document-magnifying-glass" href="{{ route('admin.busqueda.residencias.indexResidencias') }}" :current="request()->routeIs('admin.busqueda.residencias.*')">
                Residencias
            </flux:navlist.item>
            <flux:navlist.item icon="document-magnifying-glass" href="{{ route('admin.busqueda.aptos.indexAptos') }}" :current="request()->routeIs('admin.busqueda.aptos.*')">
                Aptos
            </flux:navlist.item>
            <flux:navlist.item icon="document-magnifying-glass"  href="{{ route('admin.busqueda.becados.indexBecados') }}" :current="request()->routeIs('admin.busqueda.becados.*')">
                Becados
            </flux:navlist.item>
            
            
        </div>
    @endif
</div>