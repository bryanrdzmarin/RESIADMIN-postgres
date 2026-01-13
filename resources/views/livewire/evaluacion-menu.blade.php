@php use Illuminate\Support\Str; @endphp

@php
    $rutaBloqueada = Str::startsWith(request()->route()->getName(), 'admin.evaluar');
@endphp

<div>
    <flux:navlist.item icon="clipboard" href="javascript:void(0)" :current="request()->routeIs('admin.evaluar.*')">
        <button
            @unless($rutaBloqueada) wire:click="toggle" @endunless
            class="flex items-center justify-between w-full {{ $rutaBloqueada ? 'cursor-default opacity-60' : '' }}"
        >
            <span> Evaluación </span>
            <i class="{{ $open ? 'fa fa-angle-up' : 'fa fa-angle-down' }} ml-auto mr-2" aria-hidden="true"></i>
        </button>
    </flux:navlist.item>

    @if ($open)
        <div class="pl-4">
            <flux:navlist.item icon="document" href="{{ route('admin.evaluar.becados.indexbecadosEvaluacion') }}" :current="request()->routeIs('admin.evaluar.becados.*')">
                Becados
            </flux:navlist.item>
            <flux:navlist.item icon="document" href="{{ route('admin.evaluar.aptos.indexEvaluacion') }}" :current="request()->routeIs('admin.evaluar.aptos.*')">
                Aptos
            </flux:navlist.item>
        </div>
    @endif
</div>