<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctoresRaw = DB::select('CALL sp_listar_doctores()');
        $doctores = collect($doctoresRaw);
        return view('doctores.index', compact('doctores'));
    }

    public function create()
    {
        return view('doctores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especialidad' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefono' => 'required|int|min:9'
        ]);

        DB::statement('CALL sp_crear_doctor(?, ?, ?, ?)', [
            $request->nombre,
            $request->especialidad,
            $request->email,
            $request->telefono
        ]);

        return redirect()->route('doctores.index')->with('success', 'Doctor creado correctamente.');
    }

    public function edit($id)
    {
        $doctor = DB::select('CALL sp_obtener_doctor(?)', [$id]);
        return view('doctores.edit', ['doctor' => $doctor[0]]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especialidad' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefono' => 'required|int|min:9'
        ]);

        DB::statement('CALL sp_actualizar_doctor(?, ?, ?, ?, ?)', [
            $id,
            $request->nombre,
            $request->especialidad,
            $request->email,
            $request->telefono
        ]);

        return redirect()->route('doctores.index')->with('success', 'Doctor actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::statement('CALL sp_eliminar_doctor(?)', [$id]);
        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado correctamente.');
    }
}
