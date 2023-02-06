<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv'=>'required|mimes:pdf'
    ];

    /** 
     * se pasa los datos de la vacante creada por el reclutador
    */
    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    /** 
     * metodo para crear postulacion de los desarrolladores
    */
    public function postularme()
    {
        $datos = $this->validate();// con el metodo validate() aplica las reglas

        // almacenar la imagen
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        // crear el candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id'   => auth()->user()->id,
            'cv'        => $datos['cv']
        ]);

        /** 
         * crear notificacion y enviar email
         * notify obtiene el id del usuario creador de la vacante
         * lo almacena en el campo "notifiable_id" y
         * crea la notificacion del usuario que se ha postulado
        */
        $this->vacante->reclutador->notify(new NuevoCandidato(
            $this->vacante->id,
            $this->vacante->titulo,
            auth()->user()->id
        ));

        // mostrar al usuario un mensaje de ok
        session()->flash('mensaje','Se envio correctamente tu información, mucha suerte!!');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
