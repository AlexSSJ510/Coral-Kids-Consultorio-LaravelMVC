<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Doctor;

class CitaController extends Controller
{
    public function index()
    {
        // Llamar stored procedure que retorna listado de citas con paciente y doctor
        $citas = DB::select('CALL sp_listar_citas()');

        // Retorna la vista con el array de citas (recuerda en la vista no usar métodos de Collection)
        return view('citas.index', compact('citas'));
    }

    public function create($pacienteId = null)
    {
        // Obtienes los pacientes y doctores normalmente
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('citas.create', compact('pacientes', 'doctores', 'pacienteId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctors,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'motivo' => 'nullable|string',
            'estado' => 'required|in:Pendiente,Realizada,Cancelada'
        ]);

        // Llamada a stored procedure con los 6 parámetros
        DB::statement('CALL sp_crear_cita(?, ?, ?, ?, ?, ?)', [
            $request->paciente_id,
            $request->doctor_id,
            $request->fecha,
            $request->hora,
            $request->motivo,
            $request->estado
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente.');
    }


    public function cambiarEstado(Request $request, $citaId)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,Realizada,Cancelada'
        ]);

        // Llamada a stored procedure para actualizar estado
        DB::statement('CALL sp_cambiar_estado_cita(?, ?)', [
            $citaId,
            $request->estado
        ]);

        return back()->with('success', 'Estado de la cita actualizado.');
    }
}