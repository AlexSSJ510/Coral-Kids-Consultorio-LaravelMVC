<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Doctor;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\DomPDF\Facade\Pdf;

class HistorialMedicoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
    
        $historiales = DB::select('CALL sp_listar_historiales_medicos()');
    
        $historiales = collect($historiales);
    
        if ($buscar) {
            $historiales = $historiales->filter(function ($item) use ($buscar) {
                $buscar = strtolower($buscar);
                return str_contains(strtolower($item->nombre_paciente), $buscar) ||
                       str_contains(strtolower($item->nombre_doctor), $buscar);
            });
        }
    
        $page = $request->input('page', 1);
        $perPage = 10;
        $total = $historiales->count();
        $itemsForPage = $historiales->slice(($page - 1) * $perPage, $perPage)->values();
    
        $paginated = new LengthAwarePaginator(
            $itemsForPage,
            $total,
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        return view('historiales.index', ['historiales' => $paginated]);
    }    

    public function create($pacienteId = null)
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('historiales.create', compact('pacientes', 'doctores', 'pacienteId'));
    }

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

    public function edit($id)
    {
        $historial = DB::select('SELECT * FROM historiales_medicos WHERE id = ?', [$id])[0];
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('historiales.edit', compact('historial', 'pacientes', 'doctores'));
    }

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

    public function destroy($id)
    {
        DB::statement('CALL sp_eliminar_historial_medico(?)', [$id]);

        return redirect()->route('historiales.index')->with('success', 'Historial eliminado correctamente.');
    }

    public function verHistorialPorPaciente($id)
    {
        $paciente = Paciente::with('historiales')->findOrFail($id);
        $historiales = $paciente->historiales;
    
        return view('historiales.index', compact('paciente', 'historiales'));
    }    

    public function descargarPDF($id)
    {
        $resultado = DB::select('CALL sp_obtener_historial_medico(?)', [$id]);
    
        if (empty($resultado)) {
            abort(404, 'Historial no encontrado');
        }
    
        $historial = $resultado[0]; // Obtenemos el primer registro (solo uno)
    
        $pdf = Pdf::loadView('historiales.reporte_pdf', compact('historial'));
        return $pdf->stream('historial_' . $historial->id . '.pdf');
    }    
}