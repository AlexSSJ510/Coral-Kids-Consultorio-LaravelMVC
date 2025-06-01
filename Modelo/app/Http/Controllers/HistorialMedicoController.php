<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Doctor;
use Illuminate\Pagination\LengthAwarePaginator;

class HistorialMedicoController extends Controller
{
    public function index(Request $request)
    {
        $historiales = DB::select('CALL sp_listar_historiales_medicos()');
    
        // supongamos que no hay búsqueda ni paginación aún...
    
        // crea un paginador manual para no romper la vista
        $page = $request->input('page', 1);
        $perPage = 10;
        $total = count($historiales);
        $offset = ($page - 1) * $perPage;
        $itemsForPage = array_slice($historiales, $offset, $perPage);
    
        $paginated = new LengthAwarePaginator(
            $itemsForPage,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        return view('historiales.index', ['historiales' => $paginated]);
    }    

    // Formulario para crear historial
    public function create($pacienteId = null)
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('historiales.create', compact('pacientes', 'doctores', 'pacienteId'));
    }

    // Guardar historial
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctors,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'nullable|string',
            'diagnostico' => 'required|string|max:500',
            'tratamiento' => 'required|string|max:500'
        ]);

        DB::statement('CALL sp_crear_historial_medico(?, ?, ?, ?, ?, ?)', [
            $request->paciente_id,
            $request->doctor_id,
            $request->fecha,
            $request->motivo_consulta,
            $request->diagnostico,
            $request->tratamiento
        ]);

        return redirect()->route('historiales.index')->with('success', 'Historial médico registrado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $historial = DB::select('SELECT * FROM historiales_medicos WHERE id = ?', [$id])[0];
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('historiales.edit', compact('historial', 'pacientes', 'doctores'));
    }

    // Actualizar historial
    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctors,id',
            'fecha' => 'required|date',
            'motivo_consulta' => 'nullable|string',
            'diagnostico' => 'required|string|max:600',
            'tratamiento' => 'required|string|max:600'
        ]);

        DB::statement('CALL sp_actualizar_historial_medico(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $request->paciente_id,
            $request->doctor_id,
            $request->fecha,
            $request->motivo_consulta,
            $request->diagnostico,
            $request->tratamiento
        ]);

        return redirect()->route('historiales.index')->with('success', 'Historial actualizado correctamente.');
    }

    // Eliminar historial
    public function destroy($id)
    {
        DB::statement('CALL sp_eliminar_historial_medico(?)', [$id]);

        return redirect()->route('historiales.index')->with('success', 'Historial eliminado correctamente.');
    }

    public function verHistorialPorPaciente($id)
    {
        $historiales = DB::select('CALL sp_historiales_por_paciente(?)', [$id]);

        return view('historiales.paciente', compact('historiales'));
    }

}