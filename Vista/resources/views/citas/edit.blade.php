<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Editar Cita</h2>

                <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Paciente</label>
                        <select name="paciente_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" {{ $cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} {{ $paciente->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Doctor</label>
                        <select name="doctor_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($doctores as $doctor)
                                <option value="{{ $doctor->id }}" {{ $cita->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Fecha</label>
                            <input type="date" name="fecha" value="{{ $cita->fecha }}" required class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Hora</label>
                            <input type="time" name="hora" value="{{ $cita->hora }}" required class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Motivo</label>
                        <textarea name="motivo" rows="3" required class="w-full border-gray-300 rounded-md shadow-sm" class="w-full border-gray-300 rounded-md shadow-sm">{{ $cita->motivo }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-1">Estado</label>
                        <select name="estado" required class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Realizada" {{ $cita->estado == 'Realizada' ? 'selected' : '' }}>Realizada</option>
                            <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('citas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md shadow">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md shadow">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>