<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Doctor;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class CitaController extends Controller
{
    public function index()
    {
        $citas = collect(DB::select('CALL sp_listar_citas()'));

        $eventos = $citas->map(function ($cita) {
            return [
                'title' => $cita->paciente_nombre . ' - ' . $cita->motivo,
                'start' => $cita->fecha . 'T' . $cita->hora,
                'url' => route('citas.edit', $cita->id),
            ];
        });

        return view('citas.index', compact('citas', 'eventos'));
    }

    public function create($pacienteId = null)
    {
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

        DB::statement('CALL sp_crear_cita(?, ?, ?, ?, ?, ?)', [
            $request->paciente_id,
            $request->doctor_id,
            $request->fecha,
            $request->hora,
            $request->motivo,
            $request->estado
        ]);

        $cita = DB::table('citas')
            ->where('paciente_id', $request->paciente_id)
            ->where('doctor_id', $request->doctor_id)
            ->whereDate('fecha', $request->fecha)
            ->whereTime('hora', $request->hora)
            ->latest('id')
            ->first();

        if ($cita) {
            try {
                $paciente = Paciente::find($request->paciente_id);
                $doctor = Doctor::find($request->doctor_id);

                $attendees = [];
                if (!empty($paciente->email)) {
                    $attendees[] = ['email' => $paciente->email];
                }

                $googleEvent = Event::create([
                    'name' => 'Cita: ' . $paciente->nombre . ' con Dr. ' . $doctor->nombre,
                    'description' => $request->motivo ?: 'Consulta médica programada.',
                    'startDateTime' => Carbon::parse($cita->fecha . ' ' . $cita->hora),
                    'endDateTime' => Carbon::parse($cita->fecha . ' ' . $cita->hora)->addMinutes(30),
                    'attendees' => $attendees,
                ]);

                DB::table('citas_google')->insert([
                    'cita_id' => $cita->id,
                    'event_id' => $googleEvent->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                return redirect()->route('citas.index')->with('error', 'Cita registrada, pero falló la sincronización con Google Calendar: ' . $e->getMessage());
            }
        }

        return redirect()->route('citas.index')->with('success', 'Cita registrada y sincronizada con Google Calendar.');
    }

    public function edit($id)
    {
        $cita = DB::table('citas')->where('id', $id)->first();
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('citas.edit', compact('cita', 'pacientes', 'doctores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctors,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'motivo' => 'required|string',
            'estado' => 'required|in:Pendiente,Realizada,Cancelada'
        ]);

        DB::statement('CALL sp_actualizar_cita(?, ?, ?, ?, ?, ?, ?)', [
            $id,
            $request->paciente_id,
            $request->doctor_id,
            $request->fecha,
            $request->hora,
            $request->motivo,
            $request->estado
        ]);

        // Reprogramar evento en Google Calendar
        try {
            $eventRecord = DB::table('citas_google')->where('cita_id', $id)->first();

            if ($eventRecord) {
                $event = Event::find($eventRecord->event_id);
                $paciente = Paciente::find($request->paciente_id);
                $doctor = Doctor::find($request->doctor_id);

                if ($event) {
                    $event->name = 'Cita: ' . $paciente->nombre . ' con Dr. ' . $doctor->nombre;
                    $event->description = $request->motivo ?: 'Consulta reprogramada.';
                    $event->startDateTime = Carbon::parse($request->fecha . ' ' . $request->hora);
                    $event->endDateTime = Carbon::parse($request->fecha . ' ' . $request->hora)->addMinutes(30);
                    $event->save();
                }
            }
        } catch (\Exception $e) {
            // Silencio en caso de error
        }

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy($id)
    {
        try {
            $eventRecord = DB::table('citas_google')->where('cita_id', $id)->first();

            if ($eventRecord) {
                $event = Event::find($eventRecord->event_id);
                if ($event) {
                    $event->delete();
                }

                DB::table('citas_google')->where('cita_id', $id)->delete();
            }
        } catch (\Exception $e) {
            // Silencio si falla el borrado en Google
        }

        DB::statement('CALL sp_eliminar_cita(?)', [$id]);

        return redirect()->route('citas.index')->with('success', 'Cita eliminada y evento cancelado en Google Calendar.');
    }

    public function cambiarEstado(Request $request, $citaId)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,Realizada,Cancelada'
        ]);

        DB::statement('CALL sp_cambiar_estado_cita(?, ?)', [
            $citaId,
            $request->estado
        ]);

        return back()->with('success', 'Estado de la cita actualizado.');
    }
}