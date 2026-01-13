<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;


class EvaluacionMenu extends Component
{
   public $open = false;

    public function mount()
    {
        if ($this->estaEnRutaEvaluacion()) {
            $this->open = true;
        } else {
            $this->open = session()->get('openEvaluacion', false);
        }
    }

    public function toggle()
    {
        if (! $this->estaEnRutaEvaluacion()) {
            $this->open = !$this->open;
            session()->put('openEvaluacion', $this->open);
        }
    }

    private function estaEnRutaEvaluacion(): bool
    {
         $nombreRuta = request()->route()->getName();

        return Str::startsWith($nombreRuta, 'admin.evaluar');


    }



    public function render()
    {
        return view('livewire.evaluacion-menu');
    }
}
