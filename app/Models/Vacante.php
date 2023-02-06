<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    /**
     * parsear ultimo_dia a fecha
    */
    protected $dates = ['ultimo_dia'];

    /** 
     * casteo de fechas
    */
    /* protected $casts = [
        'ultimo_dia' => 'date:Y-m-d',// 'ultimo_dia' => 'datetime:Y-m-d H:00',
    ]; */

    protected $fillable = [
        'titulo',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'salario_id',
        'categoria_id',
        'user_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class)->orderBy('created_at','DESC');
    }

    public function reclutador()
    {
        // belongsto: relacion uno a uno donde una vacante pertenece a un usuario
        return $this->belongsTo(User::class, 'user_id');
    }
}
