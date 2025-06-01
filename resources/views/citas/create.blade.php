<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-pink-200 via-purple-200 to-blue-200 py-10">
        <div class="w-full max-w-2xl bg-white p-10 rounded-2xl shadow-lg border border-gray-300">

            <h2 class="text-5xl font-extrabold text-center text-blue-700 mb-10">Agendar Cita</h2>

            <form action="{{ route('citas.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Paciente</label>
                    <select name="paciente_id" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}" {{ old('paciente_id', $pacienteId) == $paciente->id ? 'selected' : '' }}>
                                {{ $paciente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Doctor</label>
                    <select name="doctor_id" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                        @foreach ($doctores as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->nombre }} ({{ $doctor->especialidad }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Hora</label>
                    <input type="time" name="hora" value="{{ old('hora') }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Motivo</label>
                    <textarea name="motivo" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400">{{ old('motivo') }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Estado</label>
                    <select name="estado" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-400" required>
                        <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Realizada" {{ old('estado') == 'Realizada' ? 'selected' : '' }}>Realizada</option>
                        <option value="Cancelada" {{ old('estado') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                <div class="flex justify-center pt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-lg font-bold py-3 px-10 rounded-full shadow-md transition duration-300 ease-in-out">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>