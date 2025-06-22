<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-pink-200 via-purple-200 to-blue-200 py-10">
        <div class="w-full max-w-3xl bg-white p-10 rounded-3xl shadow-2xl border border-gray-200">

            <h2 class="text-4xl font-extrabold text-center text-indigo-700 mb-10 tracking-tight">
                🗓️ Agendar Nueva Cita
            </h2>

            <form action="{{ route('citas.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Paciente --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">👤 Paciente</label>
                    <select name="paciente_id" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required>
                        @foreach ($pacientes as $paciente)
                            <option value="{{ $paciente->id }}" {{ old('paciente_id', $pacienteId) == $paciente->id ? 'selected' : '' }}>
                                {{ $paciente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Doctor --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">🩺 Doctor</label>
                    <select name="doctor_id" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required>
                        @foreach ($doctores as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->nombre }} ({{ $doctor->especialidad }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">📅 Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha') }}" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- Hora --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">⏰ Hora</label>
                    <input type="time" name="hora" value="{{ old('hora') }}" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- Motivo --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">📝 Motivo</label>
                    <textarea name="motivo" rows="3" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500">{{ old('motivo') }}</textarea>
                </div>

                {{-- Estado --}}
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">📌 Estado</label>
                    <select name="estado" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" required>
                        <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Realizada" {{ old('estado') == 'Realizada' ? 'selected' : '' }}>Realizada</option>
                        <option value="Cancelada" {{ old('estado') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                {{-- Botón --}}
                <div class="flex justify-center pt-6">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg py-3 px-10 rounded-full shadow-lg transition-all duration-300 ease-in-out">
                        ✅ Guardar Cita
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>