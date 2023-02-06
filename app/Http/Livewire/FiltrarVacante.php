<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Categoria;
use Livewire\Component;

class FiltrarVacante extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    /** 
     * metodo para comunicarse con el componente padre homeVacante
    */
    public function leerDatosFormulario()
    {
        $this->emit('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }

    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.filtrar-vacante',[
            'salarios'=>$salarios,
            'categorias'=>$categorias,
        ]);
    }
}
