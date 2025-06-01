<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'email',
    ];
    
    public function historiales()
    {
        return $this->hasMany(HistorialMedico::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

}
