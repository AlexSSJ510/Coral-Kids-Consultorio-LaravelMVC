<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'fecha',
        'hora',
        'motivo',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
