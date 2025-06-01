<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    /**
     * Mostrar listado de pacientes con paginación usando Stored Procedure.
     */
    public function index()
    {
        $pacientes = DB::select('CALL sp_listar_pacientes()');

        return view('pacientes.index', ['pacientes' => $pacientes]);
    }

    /**
     * Mostrar formulario para crear nuevo paciente.
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Guardar nuevo paciente con stored procedure.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:20',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        DB::statement('CALL sp_guardar_paciente(?, ?, ?, ?, ?, ?, ?)', [
            $validated['dni'],
            $validated['nombre'],
            $validated['apellidos'],
            $validated['fecha_nacimiento'],
            $validated['direccion'],
            $validated['telefono'],
            $validated['email'],
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente');
    }

    /**
     * Mostrar detalles de un paciente usando stored procedure.
     */
    public function show($id)
    {
        $paciente = DB::select('CALL obtener_paciente(?)', [$id]);
        if (empty($paciente)) {
            return redirect()->route('pacientes.index')->withErrors('Paciente no encontrado.');
        }
        return view('pacientes.show', ['paciente' => $paciente[0]]);
    }

    /**
     * Mostrar formulario para editar paciente (obteniendo datos con stored procedure).
     */
    public function edit($id)
    {
        $paciente = DB::select('CALL sp_listar_pacientes(?)', [$id]);
    
        if (empty($paciente)) {
            return redirect()->route('pacientes.index')->withErrors('Paciente no encontrado.');
        }
    
        $paciente = $paciente[0]; // <- Importante para no tener un array sino un objeto
    
        return view('pacientes.edit', compact('paciente'));
    }    

    /**
     * Actualizar paciente usando stored procedure.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required|string|max:20|unique:pacientes,dni,' . $id,
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'email' => 'required|email|unique:pacientes,email,' . $id,
            'telefono' => 'required|string|max:20',
        ]);

        DB::statement('CALL actualizar_paciente(?, ?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $request->dni,
            $request->nombre,
            $request->apellidos,
            $request->fecha_nacimiento,
            $request->direccion,
            $request->email,
            $request->telefono
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    /**
     * Eliminar paciente usando stored procedure.
     */
    public function destroy($id)
    {
        DB::statement('CALL eliminar_paciente(?)', [$id]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}