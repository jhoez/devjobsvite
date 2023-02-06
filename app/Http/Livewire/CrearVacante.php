<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Categoria;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;// para subir archivos

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads; // trait para subir archivos

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];

    public function crearVacante()
    {
        $datos = $this->validate();// con el metodo validate() aplica las reglas

        // almacenar la imagen
        $imagen = $this->imagen->store('public/vacantes');
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);

        //dd($imagen,$nombreimg);

        // crear la vacante
        Vacante::create([
            'titulo'        => $datos['titulo'],
            'empresa'       => $datos['empresa'],
            'ultimo_dia'    => $datos['ultimo_dia'],
            'descripcion'   => $datos['descripcion'],
            'imagen'        => $datos['imagen'],
            'salario_id'    => $datos['salario'],
            'categoria_id'  => $datos['categoria'],
            'user_id'       => auth()->user()->id,
        ]);

        // crear un mensaje por medio de session
        session()->flash('mensaje','La vacante se publico correctamente!!');

        // redireccionar al usuario
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante',[
            'salarios'=>$salarios,
            'categorias'=>$categorias
        ]);
    }
}
