<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">Editar Historial Médico</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <strong>¡Ups!</strong> Por favor corrige los siguientes errores:
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('historiales.update', $historial->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="paciente_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Paciente</label>
                <select id="paciente_id" name="paciente_id" required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    <option value="" disabled>-- Seleccione --</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}" {{ $paciente->id == $historial->paciente_id ? 'selected' : '' }}>
                            {{ $paciente->nombre }} {{ $paciente->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="doctor_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Doctor</label>
                <select id="doctor_id" name="doctor_id" required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    <option value="" disabled>-- Seleccione --</option>
                    @foreach ($doctores as $doctor)
                        <option value="{{ $doctor->id }}" {{ $doctor->id == $historial->doctor_id ? 'selected' : '' }}>
                            {{ $doctor->nombre }} {{ $doctor->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ $historial->fecha }}" required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>

            <div class="mb-4">
                <label for="motivo_consulta" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Motivo de Consulta</label>
                <input type="text" id="motivo_consulta" name="motivo_consulta" value="{{ $historial->motivo_consulta }}"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>

            <div class="mb-4">
                <label for="diagnostico" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Diagnóstico</label>
                <textarea id="diagnostico" name="diagnostico" rows="3" required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ $historial->diagnostico }}</textarea>
            </div>

            <div class="mb-6">
                <label for="tratamiento" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Tratamiento</label>
                <textarea id="tratamiento" name="tratamiento" rows="3" required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ $historial->tratamiento }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('historiales.index') }}"
                    class="inline-block px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
