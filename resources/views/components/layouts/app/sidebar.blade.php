@php
   $groups = [
    'Plataforma' => [
        [
            'name' => 'Dashboard',
            'icon' => 'home',
            'url' => route('dashboard'),
            'current' => request()->routeIs('dashboard'),
            
        ],
        [
            'name' => 'Residencias',
            'icon' => 'building-office-2',
            'url' => route('admin.residencias.index'),
            'current' => request()->routeIs('admin.residencias.*') || request()->routeIs('admin.aptos.create'),
            'can' => 'admin.residencias.index'
        ],
        [
            'name' => 'Aptos',
            'icon' => 'home-modern',
            'url' => route('admin.aptos.index'),
            'current' => request()->routeIs('admin.aptos.*'),
            'can' => 'admin.aptos.index'
        ],
        [
            'name' => 'Becados',
            'icon' => 'user-group',
            'url' => route('admin.becados.index'),
            'current' => request()->routeIs('admin.becados.*'),
            'can' => 'admin.becados.index'
        ],
        [
            'name' => 'Evaluación',
            'icon' => 'clipboard',
            'livewire' => 'evaluacion-menu',
            'current' => request()->routeIs('admin.evaluar.*'),
            'can' => 'admin.evaluar.becados.indexbecadosEvaluacion'


            
        ],
        [
            'name' => 'Búsqueda Avanzada',
            'icon' => 'magnifying-glass-circle',
            'livewire' => 'busqueda-avanzada',
            'current' => request()->routeIs('admin.evaluar.*'),
            'can' => 'admin.busqueda.residencias.indexResidencias'
            
        ]
    ],
    'Administrador' => [
        [
            'name' => 'Usuarios',
            'icon' => 'user-circle',
            'url' => route('admin.usuarios.index'),
            'current' => request()->routeIs('admin.usuarios.*'),
            'can' => 'admin.usuarios.index'
        ],
    ]
];
@endphp




<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden text-s" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>
            

            @php
                $visibleGroups = [];

                foreach ($groups as $label => $items) {
                    $visibles = collect($items)->filter(function ($item) {
                        return !isset($item['can']) || auth()->user()?->can($item['can']);
                    });

                    if ($visibles->isNotEmpty()) {
                        $visibleGroups[$label] = $visibles;
                    }
                }
            @endphp
           
           <flux:navlist variant="outline">
                @foreach ($visibleGroups as $group => $links)
                    <flux:navlist.group :heading="$group" class="grid">
                        @foreach ($links as $link)
                            @if (!isset($link['can']) || auth()->user()?->can($link['can']))
                                @if ($link['name'] === 'Evaluación')
                                    <livewire:evaluacion-menu />
                                @elseif ($link['name'] === 'Búsqueda Avanzada')
                                    <livewire:busqueda-avanzada />
                                @else
                                    <flux:navlist.item
                                        :icon="$link['icon']"
                                        :href="$link['url'] ?? null"
                                        :current="$link['current'] ?? false"
                                        wire:navigate
                                    >
                                        {{ $link['name'] }}
                                    </flux:navlist.item>
                                @endif
                            @endif
                        @endforeach
                    </flux:navlist.group>
                @endforeach
            </flux:navlist>

            <flux:spacer />


            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Ajustes') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Cerrar Sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
       
       
        {{ $slot }}

        @fluxScripts
      
       
    </body>
</html>
