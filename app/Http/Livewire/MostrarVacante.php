<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vacante;

class MostrarVacante extends Component
{
    public $vacante;

    public function render()
    {
        return view('livewire.mostrar-vacante');
    }
}
