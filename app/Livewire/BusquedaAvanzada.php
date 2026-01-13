<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class BusquedaAvanzada extends Component
{
     public $open = false;

    public function mount()
    {
        if ($this->estaEnRutaBloqueada()) {
            $this->open = true;
        } else {
            $this->open = session()->get('openBusquedaAvanzada', false);
        }
    }

    public function toggle()
    {
        if (! $this->estaEnRutaBloqueada()) {
            $this->open = !$this->open;
            session()->put('openBusquedaAvanzada', $this->open);
        }
    }

    private function estaEnRutaBloqueada(): bool
    {
        return Str::startsWith(request()->route()->getName(), 'admin.busqueda');
    }


    public function render()
    {
        return view('livewire.busqueda-avanzada');
    }
}
